<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    protected function getLinksAttribute(): array
    {
        return [
            'card' => env('APP_URL') . "/cards/$this->card_id",
        ];
    }

    protected function setDueDateAttribute($date)
    {
        dd($date);
    }
}
