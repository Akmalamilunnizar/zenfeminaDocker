<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryRequest;
use App\Http\Requests\Api\EducationRequest;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\Api\EducationResource;
use App\Models\Category;
use App\Models\Education;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;

class EducationController extends Controller
{
    use ApiResponser;
    public function trending()
    {
        $education = Education::orderBy('on_clicked', 'DESC')
            ->limit(4)
            ->get();

        return $this->success(
            EducationResource::collection($education),
            "Berhasil mendapatkan data"
        );
    }

    public function allCategory()
    {
        $category = Category::all();
//        return CategoryResource::collection($category);

        return $this->success(
            CategoryResource::collection($category),
            "Berhasil mendapatkan data"
        );
    }

    public function getAll()
    {
        $education = Education::all();

        return $this->success(
            EducationResource::collection($education),
            "Berhasil mendapatkan data"
        );
    }

    public function getByCategory(CategoryRequest $request)
    {
        $education = Education::where('category_id', $request->category_id)->get();

        return $this->success(
            EducationResource::collection($education),
            "Berhasil mendapatkan data"
        );
    }

    public function getById(EducationRequest $request)
    {
        $education = Education::find($request->id);

        return $this->success(
            EducationResource::make($education),
            "Berhasil mendapatkan data"
        );
    }

    public function onClick(EducationRequest $request) :JsonResponse
    {
        $education = Education::find($request->id);
        $education->on_clicked += 1;
        $education->save();

        return $this->success(
            message: "Berhasil mengubah data"
        );
    }
}
