<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryRequest;
use App\Http\Requests\Api\EducationRequest;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\Api\EducationResource;
use App\Models\Category;
use App\Models\Education;
use Illuminate\Http\JsonResponse;

class EducationController extends Controller
{
    public function trending()
    {
        $education = Education::orderBy('on_clicked', 'DESC')
            ->limit(4)
            ->get();
        return EducationResource::collection($education);
    }

    public function allCategory()
    {
        $category = Category::all();
        return CategoryResource::collection($category);
    }

    public function getAll()
    {
        $education = Education::all();
        return EducationResource::collection($education);
    }

    public function getByCategory(CategoryRequest $request)
    {
        $education = Education::where('category_id', $request->category_id)->get();
        return EducationResource::collection($education);
    }

    public function getById(EducationRequest $request) :EducationResource
    {
        $education = Education::find($request->id);
        return new EducationResource($education);
    }

    public function onClick(EducationRequest $request) :JsonResponse
    {
        $education = Education::find($request->id);
        $education->on_clicked += 1;
        $education->save();

        return response()->json([
            'data' => true
        ])->setStatusCode(200);
    }
}
