<?php


namespace App\Repositories;


use App\Interfaces\CategoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryInterface
{
    public function index()
    {
        return Category::orderBy('id', 'desc')->get();
    }

    public function store($data)
    {
        return Category::create($data);
    }

    public function update($data)
    {
        return Category::where('id', $data['id'])->update($data);
    }

    public function destroy($id)
    {
        return Category::find($id)->delete();
    }
}
