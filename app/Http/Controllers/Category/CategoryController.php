<?php

namespace APIRestful\Http\Controllers\Category;

use APIRestful\Category;
use Illuminate\Http\Request;
use APIRestful\Http\Controllers\APIController;

class CategoryController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return $this->showAll($categories);
    }

    

    
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];

        $this->validate($request, $rules);

        $category = Category::create($request->all());

        return $this->showOne($category, 201);
    }

    
    public function show(Category $category)
    {
        return $this->showOne($category);
    }

 
    public function update(Request $request, Category $category)
    {
        $category->fill($request->only([
            'name',
            'description',
        ]));

        if ($category->isClean()) {
            return $this->errorResponse('Debes especificar al menos un valor diferente para actualizar.', 422);
        }

        $category->save();

        return $this->showOne($category);
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return $this->showOne($category);
    }
}
