<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Resources\Admin\CategoryResource;
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
        $categories = Category::all();
        return view('pages.category.index', [
            'title' => 'categories',
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return $this->success(
            CategoryResource::make($category),
            'Berhasil menambahkan Kategori'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->success(
            CategoryResource::make($category),
            'Berhasil mengambil detail Kategori'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return $this->success(
            CategoryResource::make($category),
            'Berhasil mengubah Kategori'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->success(
            message: 'Berhasil menghapus barang'
        );
    }

    public function datatables()
    {
        return datatables(Category::query())
            ->addIndexColumn()
            ->addColumn('action', fn ($category) => view('pages.category.action', compact('category')))
            ->toJson();
    }

    public function json()
    {
        $categories = Category::all();

        return $this->success(
            CategoryResource::collection($categories),
            'Berhasil mengambil semua data'
        );
    }

}
