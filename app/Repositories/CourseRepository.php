<?php 
namespace App\Repositories;

use App\Models\Course;

class CourseRepository extends BaseRepository
{
      public function __construct(Course $course)
      {
            parent::__construct($course);
      }

      public function getById(int $id): ?Course
      {
            return $this->model->find($id);
      }
}
?>