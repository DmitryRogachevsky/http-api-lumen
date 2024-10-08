<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class ExchangeRate extends Model
{
    use HasFactory;

    protected $table = 'exchange_rates';
    protected $fillable = [
        'date',
        'currency_name',
        'currency_abbreviation',
        'scale',
        'official_rate',
    ];

    public static function getData(): Collection
    {
        return self::select(
            'date',
            'currency_name',
            'currency_abbreviation',
            'scale',
            'official_rate',
        )->get();
    }
}
