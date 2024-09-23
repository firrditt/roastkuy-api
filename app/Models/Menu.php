<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    protected $fillable = [
        'outlet_id',
        'category_id',
        'menu_name',
        'description',
        'image',
        'price',
        'discount'
    ];

    public function outlet(): BelongsTo
    {
        return $this->belongsTo(Outlets::class, 'outlet_id');
    }

    public function menusCategory(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class, 'category_id');
    }

    // public function complement(): BelongsToMany
    // {
    //     return $this->belongsToMany(Complement::class, 'menu_has_complement', 'menu_id', 'complement_id');
    // }
}
