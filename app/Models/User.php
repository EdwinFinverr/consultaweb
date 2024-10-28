<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'clave_asesor', 'estatus', 'identificacion', 'numero', 'password_change_required', 'email_token',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function setClaveInterbancariaAttribute($value)
    {
        // Verificar si ya existe una clabe interbancaria y si es así, no permitir cambiarla
        if ($this->getAttribute('clave_interbancaria')) {
            throw new \Exception("No se puede cambiar la clabe interbancaria.");
        }

        $this->attributes['clave_interbancaria'] = $value;
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function hasRoles(array $roles)
    {
        foreach ($roles as $role) {
            if ($this->role === $role) {
                return true;
            }
        }
        return false;
    }
    public function datosUsuario()
    {
        return $this->hasOne(DatosUsuario::class, 'user_id'); // Reemplaza 'user_id' con la clave foránea correcta
    }
}