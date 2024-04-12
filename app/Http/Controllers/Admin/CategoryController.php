<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use function Livewire\Volt\title;

class CategoryController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.category.index', [
            'title' => 'categories'
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
    public function show(string $id)
    {
        //
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

    public function datatables()
    {
        return datatables(Category::query())
            ->addIndexColumn()
            ->addColumn('action', fn ($item) => view('pages.category.action', compact('category')))
            ->toJson();
    }

    public function json()
    {
        $category = Category::all();

        return $this->success(
            ItemResource::collection($items),
            'Berhasil mengambil semua data'
        );
    }

}
