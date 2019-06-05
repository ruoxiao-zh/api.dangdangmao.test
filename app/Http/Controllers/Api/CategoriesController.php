<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Requests\Api\CategoryRequest;
use App\Transformers\CategoryTransformer;

class CategoriesController extends Controller
{
    public function store(CategoryRequest $request, Category $category)
    {
        $category->fill($request->all());
        $category->save();

        return $this->response->item($category, new CategoryTransformer());
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return $this->response->item($category, new CategoryTransformer());
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return $this->response->noContent();
    }

    public function index()
    {
        $ctegories = Category::orderBy('order', 'desc')->recent()->get();

        return $this->response->collection($ctegories, new CategoryTransformer());
    }

    public function show(Category $category)
    {
        return $this->response->item($category, new CategoryTransformer());
    }
}
