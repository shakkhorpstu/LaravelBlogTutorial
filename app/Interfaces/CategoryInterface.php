<?php


namespace App\Interfaces;


interface CategoryInterface
{
    public function index();

    public function store($data);

    public function update($data);

    public function destroy($id);
}
