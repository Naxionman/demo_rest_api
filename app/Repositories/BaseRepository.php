<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Summary of BaseRepository
 */
abstract class BaseRepository
{
      use SoftDeletes;
      
      protected $model;

      public function __construct(Model $model)
      {
            $this->model = $model;
      }

      public function all()
      {
            return $this->model->all();
      }

      public function getById(int $id)
      {
            return $this->model->find($id);
      }

      public function create(array $data)
      {
            return $this->model->create($data);
      }

      public function update(int $id, array $data)
      {
            $model = $this->getById($id);

            if ($model !== null) {
                  $model->update($data);
            }

            return $model;
      }

      public function delete(int $id): ?bool
      {
            $model = $this->getById($id);

            if ($model !== null) {
                  $model->update(['deleted_at' => now()]);
                  return true;
            }

            return false;
      }

      /**
       *  Despite being present in the database, 
       *  those records can only be retrieved 
       *  through this method. 
       */
      public function getDeleted()
      {
            return $this->model->onlyTrashed()->get();
      }
}