<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
