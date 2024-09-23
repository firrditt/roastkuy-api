<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid;


class Account extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'accounts';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'roles',
        'member_number',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function booted()
    {
        static::creating(function($model){
            $model->uuid = Uuid::uuid4();
        });
    }

    public static function generateMemberNumber()
    {
        $lastMember = self::orderBy('id', 'desc')->first();
        $lastGeneratedNumber = $lastMember ? substr($lastMember->member_number, 0, 4) : 1000;

        $lastGeneratedNumber ++;

        $time = time();
        $lastThreeDigits = substr(date('dm', $time), -3); 
        $memberNumber = str_pad($lastGeneratedNumber, 4, STR_PAD_LEFT) . $lastThreeDigits;

        return $memberNumber;
    }

    public function promos(): HasMany
    {
        return $this->hasMany(Promo::class);
    }
}
