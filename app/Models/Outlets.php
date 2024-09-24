<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Outlets extends Model
{
    use HasFactory;

    protected $table = 'outlets';

    protected $nullable = [
        'gofood_link',
        'shopeefood_link',
        'grabfood_link',
        'travelokaeats_link',
    ];

    protected $fillable = [
        'slug',
        'outlet_name',
        'address',
        'lat',
        'lon',
        'operation_time',
        'contact',
        'description',
        'logo',
        'cover',
        'banner',
        'featured_image'
    ];

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class, 'outlet_id', 'id');
    }

}
