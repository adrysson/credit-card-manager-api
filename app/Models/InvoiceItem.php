<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id',
        'transaction_id',
        'value',
    ];

    protected $appends = ['links'];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    protected function getLinksAttribute(): array
    {
        return [
            '_self' => env('APP_URL') . "/invoice_items/$this->id",
            'invoice' => env('APP_URL') . "/invoices/$this->invoice_id",
            'transaction' => env('APP_URL') . "/transactions/$this->transaction_id",
        ];
    }
}
