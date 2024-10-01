<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;
    private $relations = [];
    public function __construct(Model $model, array $relations = [])
    {
        $this->model = $model;
        $this->relations = $relations;
    }

    // Repositorio: UserRepository
    public function all(int $perPage = 15)
    {
        $query = $this->model->latest(); // Ordenamos por la columna created_at (últimos registros)

        // Si existen relaciones, las cargamos
        if (!empty($this->relations)) {
            $query = $query->with($this->relations);
        }

        // Retornamos los resultados paginados
        return $query->paginate($perPage);
    }


    public function getById($id)
    {
        $query = $this->model;
        if (!empty($this->relations)) {
            $query = $query->with($this->relations);
        }

        return $query->find($id);
    }

    public function save(Model $model)
    {
        $model->save();
        return $model;
    }

    public function create(array $data)
    {
        $model = $this->model->create($data);
        return $model;
    }

    public function update(Model $model, array $data)
    {
        $model->fill($data);
        $model->save();
        return $model;
    }

    public function delete(Model $model)
    {
        $model->delete();
    }
}
