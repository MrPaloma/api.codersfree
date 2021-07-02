<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class Category extends Model
{
    use HasFactory, ApiTrait;

    protected $fillable = [
        'name',
        'slug'
    ];

    // Lista blanca para incluir en la url
    protected $allowIncluded = ['posts', 'posts.user'];
    protected $allowFilter = ['id', 'name', 'slug'];
    protected $allowSort = ['id', 'name', 'slug']; #atributos con los que se puede ordenar

    // Relacion de uno a muchos
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
