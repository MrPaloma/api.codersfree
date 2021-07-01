<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    // Lista blanca para incluir en la url
    protected $allowIncluded = ['posts', 'posts.user'];
    protected $allowFilter = ['id', 'name', 'slug'];
    protected $allowSort = ['id', 'name', 'slug'];

    // Relacion de uno a muchos
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // La instancia $query hace referencia a la consulta que tienes en el controlador
    public function scopeIncluded(Builder $query)
    {
        if (empty($this->allowIncluded) || empty(request('included'))) {
            return;
        }
        
        $relations = explode(',', request('included'));

        $allowIncluded = collect($this->allowIncluded);

        foreach ($relations as $key => $relationship) {

            if (!$allowIncluded->contains($relationship)) {

                unset($relations[$key]);

            }

        }

        $query->with($relations);
    }

    // Con esta funcion se puede filtrar los datos en la consulta
    public function scopeFilter(Builder $query)
    {
        if (empty($this->allowFilter) || empty(request('filter'))) {
            return;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);

        foreach ($filters as $filter => $valor) {
            if ($allowFilter->contains($filter)) {
                $query->where($filter, 'LIKE' , '%' . $valor . '%');
            }
        }
    }

    public function scopeSort(Builder $query)
    {
        // Verifica si exite la variable sort, y si se envio por la URL
        if (empty($this->allowSort) || empty(request('sort'))) {
            return;
        }

        $sortFields = explode(',', request('sort'));
        $allowSort = collect($this->allowSort);

        foreach ($sortFields as $sortField) {

            $direction = 'asc';

            

            if ($allowSort->contains($sortField)) {
                $query->orderBy($sortField, 'asc');
            }
        }
    }
}
