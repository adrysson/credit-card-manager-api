<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    protected $appends = ['links'];

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }

    protected function getLinksAttribute(): array
    {
        return [
            'cards' => env('APP_URL') . "/companies/$this->id/cards",
        ];
    }
}
