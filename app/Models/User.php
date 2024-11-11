<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    // protected $cast = [
    //     'password' => 'encrypted',
    // ];

    protected $fillable = [
        'name', 
        'email', 
        'password',
        'role', // Add role here
    ];

    /**
     * Check if user is Admin
     */
    public function isAdmin()
    {
        return $this->hasRole('Admin');
    }

    /**
     * Check if user is Guest
     */
    public function isGuest()
    {
        return $this->hasRole('Guest');
    }

    public function expenditures()
    {
        return $this->hasMany(Expenditure::class);
    }
}

