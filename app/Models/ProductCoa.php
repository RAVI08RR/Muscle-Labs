<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ProductCoa extends Model
{
    protected $fillable = [
        'product_id',
        'coa_image_path',
        'coa_image_disk',
        'coa_pdf_path',
        'coa_pdf_disk',
        'batch_number',
        'test_date',
    ];

    protected $casts = [
        'test_date' => 'date',
    ];

    /**
     * Get the Lunar product this COA belongs to.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(\Lunar\Models\Product::class);
    }

    /**
     * Get a signed/temporary URL for the COA PDF.
     */
    public function pdfUrl(?int $expiryMinutes = 60): ?string
    {
        if (! $this->coa_pdf_path) {
            return null;
        }

        $disk = $this->coa_pdf_disk ?? 'local';

        if (Storage::disk($disk)->getAdapter() instanceof \League\Flysystem\Local\LocalFilesystemAdapter) {
            return route('coa.pdf', ['coa' => $this->id]);
        }

        return Storage::disk($disk)->temporaryUrl($this->coa_pdf_path, now()->addMinutes($expiryMinutes));
    }

    /**
     * Get a signed/temporary URL for the COA image.
     */
    public function imageUrl(?int $expiryMinutes = 60): ?string
    {
        if (! $this->coa_image_path) {
            return null;
        }

        $disk = $this->coa_image_disk ?? 'local';

        if (Storage::disk($disk)->getAdapter() instanceof \League\Flysystem\Local\LocalFilesystemAdapter) {
            return route('coa.image', ['coa' => $this->id]);
        }

        return Storage::disk($disk)->temporaryUrl($this->coa_image_path, now()->addMinutes($expiryMinutes));
    }
}
