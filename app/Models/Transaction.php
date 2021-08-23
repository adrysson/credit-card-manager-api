<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identifier',
        'value',
        'card_id',
        'installments',
        'date',
    ];

    protected $appends = ['links'];

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    public function invoiceItems(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    protected function getLinksAttribute(): array
    {
        return [
            '_self' => env('APP_URL') . "/transactions/$this->id",
            'card' => env('APP_URL') . "/cards/$this->card_id",
            'invoice_items' => env('APP_URL') . "/transactions/$this->id/invoice_items",
        ];
    }
}
