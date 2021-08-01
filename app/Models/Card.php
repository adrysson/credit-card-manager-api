<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Card extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identifier',
        'company_id',
        'due_date',
        'closing_date',
        'processing_days',
    ];

    protected $appends = ['links'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'due_date' => 'integer',
        'closing_date' => 'integer',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    protected function getLinksAttribute(): array
    {
        return [
            'company' => env('APP_URL') . "/companies/$this->company_id",
            'invoices' => env('APP_URL') . "/cards/$this->id/invoices",
        ];
    }
}
