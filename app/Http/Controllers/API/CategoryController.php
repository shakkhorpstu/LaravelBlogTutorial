<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    // all category
    public function index()
    {
        $categories = $this->categoryRepository->index();
        return response()->json([
            'success' => true,
            'message' => 'Category fetched successfully',
            'data'    => $categories
        ]);
    }

    // single category
    public function view($id)
    {
        $category = $this->categoryRepository->view($id);
        return response()->json([
            'success' => $category ? true : false,
            'message' => 'Category fetched successfully',
            'data'    => $category
        ]);
    }

    // save category to db
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = \Validator::make($data, [
            'title' =>'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ]);
        }

        $category = $this->categoryRepository->store($data);
        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data'    => $category
        ]);
    }

    // update category value in db
    public function update(Request $request)
    {
        $data = $request->all();

        $validator = \Validator::make($data, [
            'title' =>'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ]);
        }

        $category = $this->categoryRepository->update($data);
        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data'    => $category
        ]);
    }

    // delete category from db
    public function destroy($id)
    {
        $category = $this->categoryRepository->destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully',
            'data'    => $category
        ]);
    }
}
