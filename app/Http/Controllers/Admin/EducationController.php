<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EducationRequest;
use App\Models\Category;
use App\Models\Education;
use App\Repository\Admin\EducationRepo;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EducationController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.education.index', [
            'title' => 'Educations',
            'educations' => Education::all(),
            'length' => Education::all()->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('pages.education.create', [
            'title' => 'new Education',
            'categories' => $category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EducationRequest $request)
    {
        EducationRepo::save($request->all());
        return $this->success(
            message: 'Berhasil menambahkan artikel'
        );
    }

    /**
     * Display the specified resource.
     */
    public function search(Request $request)
    {
        $education = Education::query()
            ->where('title', 'like', '%'.$request->search_string.'%')
            ->orWhere('content', 'like', '%'.$request->search_string.'%')
            ->get();

        if($education->count() <= 0)
            return response()->json([
                'status' => 'nothing'
            ])->setStatusCode(200);

        return response()->json([
            'educations' => $education
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Education $education)
    {
        $category = Category::all();
        return view('pages.education.edit', [
            'title' => 'Edit Education',
            'education' => $education,
            'categories' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EducationRequest $request, Education $education)
    {
        EducationRepo::save($request->all(), $education);

        return $this->success(
            message: 'Berhasil mengubah artikel artikel'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Education $education)
    {
        Storage::disk('public')->delete($education->image);
        $education->delete();
        return $this->success(Education::all(), message: 'Berhasil menghapus Artikel');
    }

    public function education()
    {
        $education = Education::all();
        $length = $education->count();

        return response()->json([
            'educations' => $education,
            'length' => $length
        ]);
    }
}
