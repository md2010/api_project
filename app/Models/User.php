<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Filters\QueryFilter;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
     
    protected $fillable = [
        'name',
        'email',
        'password',
        'contract_start_date',
        'contract_end_date',
        'type',
        'verified'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }

    public function getContractAttribute()
    {
        return "{$this->contract_start_date} - {$this->contract_end_date}";
    }

    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = ucfirst($value);
    }
}
