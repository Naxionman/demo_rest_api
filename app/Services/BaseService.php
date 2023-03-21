<?php

namespace App\Services;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Repositories\BaseRepository;

abstract class BaseService
{
      protected $repository;

      public function __construct(BaseRepository $repository)
      {
            $this->repository = $repository;
      }

      public function all()
      {
            return $this->repository->all();
      }

      public function getById(int $id)
      {
            return $this->repository->getById($id);
      }

      public function create(array $data)
      {
            $this->validate($data);

            return $this->repository->create($data);
      }

      public function update(int $id, array $data)
      {
            $model = $this->repository->getById($id);

            if ($model !== null) {
                  $this->validate($data);

                  return $this->repository->update($id, $data);
            }

            return $model;
      }

      public function delete(int $id)
      {
            return $this->repository->delete($id);
      }

      protected function validate(array $data)
      {
            // Implementing validation rules for the data
            $rules = [
                  'title' => 'required|string',
                  'description' => 'required|string',
                  'status' => 'required|in:Published,Pending',
                  'is_premium' => 'required|boolean',
            ];

            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                  throw new ValidationException($validator);
            }
      }
}
?>