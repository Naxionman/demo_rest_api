<?php 
namespace App\Http\Controllers;

use App\Services\CourseService;

class CourseController extends BaseController
{
      public function __construct(CourseService $service)
      {
            parent::__construct($service);
      }
}
?>