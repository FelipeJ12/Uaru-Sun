<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

// Usuarios que me siguen
public function seguidores()
{
    return $this->belongsToMany(User::class, 'follows', 'seguido_id', 'seguidor_id');
}

// Usuarios a los que yo sigo
public function siguiendo()
{
    return $this->belongsToMany(User::class, 'follows', 'seguidor_id', 'seguido_id');
}

    public function posts()
{
    return $this->hasMany(Post::class);
}

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public function favoritos(){
        return $this->hasMany(Favorito::class);
    
    }
    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function datos()
    {
        return $this->hasOne(Datousuario::class);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    
public function publicaciones()
{
    return $this->hasMany(Publicacion::class);
}

public function datousuario()
    {
        // Si tu tabla de 'datousuarios' usa user_id como clave foránea:
        return $this->hasOne(Datousuario::class);
    }


}