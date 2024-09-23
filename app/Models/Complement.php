<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Complement extends Model
{
    use HasFactory;

    protected $table = 'complement';

    protected $fillable = [
        'name',
        'type',
        'image'
    ];

    public function menu():BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'menu_has_complement', 'complement_id', 'menu_id');
    }
}
