<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use CrudTrait;
    protected $fillable = [
        'prenom',
        'nom',
        'ine',
        'UFR',
        'Licence',
        'date_naissance',
        'telephone',
        'email',
        'photo',
        'password',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get all of the reclamations for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reclamations(): HasMany
    {
        return $this->hasMany(Reclamation::class);
    }

    /**
     * Get all of the reclamationReceptionnees for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reclamationReceptionnees(): HasMany
    {
        return $this->hasMany(User::class, 'user_traitement_id', 'id');
    }
}
