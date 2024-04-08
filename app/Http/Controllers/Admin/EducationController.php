<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EducationRequest;
use App\Models\Category;
use App\Models\Education;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

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
//        dd($request);
        $image = $request->file('image')->getClientOriginalName();

        Education::create([
            'image' => $image,
            'title' => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->contents,
        ]);

        $destination_path = getcwd() . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'educations' . DIRECTORY_SEPARATOR;
        $targetFile = $destination_path . basename($image);
        move_uploaded_file($request->file('image')->getPathname(), $targetFile);

        return to_route('educations.index')->with('alert_s', 'Berhasil menambahkan Edukasi');
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
            'educations' => $education,
            'categories' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EducationRequest $request, Education $education)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Education $education)
    {
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
