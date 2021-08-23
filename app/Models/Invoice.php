<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'card_id',
        'due_date',
        'closing_date',
        'month',
        'year',
    ];

    protected $appends = ['links'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'month' => 'integer',
    ];

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    protected function getLinksAttribute(): array
    {
        return [
            '_self' => env('APP_URL') . "/invoices/$this->id",
            'card' => env('APP_URL') . "/cards/$this->card_id",
            'items' => env('APP_URL') . "/invoices/$this->id/items",
        ];
    }
}
