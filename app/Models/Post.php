<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiTrait;

class Post extends Model
{
    use HasFactory, ApiTrait;

    protected $fillable = [
        'name',
        'slug',
        'extract',
        'body',
        'status',
        'user_id',
        'category_id'
    ];

    const BORRADOR = 1;
    const PUBLICADO = 2;

    // Lista blanca para incluir en la url
    protected $allowIncluded = ['user', 'category'];
    protected $allowFilter = ['id', 'name', 'slug'];
    protected $allowSort = ['id', 'name', 'slug']; 

    // Relacion uno a muchos inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacion uno a muchos inversa
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relacion muchos a muchos
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //Relacion uno a muchos polimorfica
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
