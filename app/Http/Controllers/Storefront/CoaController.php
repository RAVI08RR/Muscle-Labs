<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\ProductCoa;
use Illuminate\Support\Facades\Storage;

class CoaController extends Controller
{
    public function pdf(ProductCoa $coa)
    {
        if (! $coa->coa_pdf_path) {
            abort(404, 'COA PDF file not available.');
        }

        $disk = $coa->coa_pdf_disk ?? 'local';

        if (! Storage::disk($disk)->exists($coa->coa_pdf_path)) {
            abort(404, 'File missing from storage.');
        }

        return Storage::disk($disk)->response($coa->coa_pdf_path, 'COA-' . $coa->batch_number . '.pdf', [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function image(ProductCoa $coa)
    {
        if (! $coa->coa_image_path) {
            abort(404, 'COA Image file not available.');
        }

        $disk = $coa->coa_image_disk ?? 'local';

        if (! Storage::disk($disk)->exists($coa->coa_image_path)) {
            abort(404, 'File missing from storage.');
        }

        return Storage::disk($disk)->response($coa->coa_image_path);
    }
}
