<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $table = 'promo';

    protected $fillable = [
        'account_id',
        'image',
        'promo_name',
        'description',
        'outdate_promo',
        'detail_tutorial',
        'detail_condition',
        'type',
    ];
}
