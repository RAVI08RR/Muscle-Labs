<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderShipment extends Model
{
    protected $fillable = [
        'order_id',
        'courier',
        'tracking_number',
        'label_url',
        'dispatched_at',
    ];

    protected $casts = [
        'dispatched_at' => 'datetime',
    ];

    /**
     * The Lunar order this shipment belongs to.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(\Lunar\Models\Order::class);
    }

    /**
     * Get a public tracking URL for the courier.
     * Royal Mail Click & Drop tracking URL format.
     */
    public function trackingUrl(): ?string
    {
        if (! $this->tracking_number) {
            return null;
        }

        return match ($this->courier) {
            'Royal Mail' => "https://www.royalmail.com/track-your-item#/tracking-results/{$this->tracking_number}",
            'DPD'        => "https://track.dpd.co.uk/search?reference={$this->tracking_number}",
            'Parcelforce' => "https://www.parcelforce.com/track-trace?trackNumber={$this->tracking_number}",
            default      => null,
        };
    }

    /**
     * Determine if this shipment has been dispatched.
     */
    public function isDispatched(): bool
    {
        return $this->dispatched_at !== null;
    }
}
