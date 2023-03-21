<?php 
namespace App\Http\Controllers;

use App\Services\CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
      protected $service;

      public function __construct($service)
      {
            $this->service = $service;
      }

      public function index(): JsonResponse
      {
            $models = $this->service->all();
            return response()->json($models);
      }

      public function show(int $id): JsonResponse
      {
            $model = $this->service->getById($id);

            if ($model === null) {
                  return response()->json(['error' => 'Model not found'], 404);
            }

            return response()->json($model);
      }

      public function store(Request $request): JsonResponse
      {
            $data = $request->validate([
                  'title' => 'required|string',
                  'description' => 'required|string',
                  'status' => 'nullable|string|in:Published,Pending',
                  'is_premium' => 'nullable|boolean',
                  'created_at' => 'nullable|date',
            ]);

            $model = $this->service->create($data);

            return response()->json($model, 201);
      }

      public function update(Request $request, int $id): JsonResponse
      {
            $data = $request->validate([
                  'title' => 'required|string',
                  'description' => 'required|string',
                  'status' => 'nullable|string|in:Published,Pending',
                  'is_premium' => 'nullable|boolean',
                  'created_at' => 'nullable|date',
            ]);
            
            $model = $this->service->getById($id);

            if ($model === null) {
                  return response()->json(['error' => 'Model not found'], 404);
            }
            
            $model = $this->service->update($id, $data);
            
            return response()->json($model);
      }
            
      public function destroy(int $id): JsonResponse
      {
            $model = $this->service->getById($id);
           
            if ($model === null) {
                  return response()->json(['error' => 'Model not found'], 404);
            }
            
            $this->service->delete($id);
            
            return response()->json([], 204);
      }
}
?>