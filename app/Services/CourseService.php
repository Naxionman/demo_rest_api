<?php 
namespace App\Services;

use App\Models\Course;
use App\Repositories\CourseRepository;

class CourseService extends BaseService
{
      public function __construct(CourseRepository $repository)
      {
            parent::__construct($repository);
      }

      public function createCourse(array $data): Course
      {
            return $this->create($data);
      }

      public function updateCourse(int $id, array $data): Course
      {
            return $this->update($id, $data);
      }
}
?>