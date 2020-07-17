<?php


namespace App\Interfaces;


interface PostInterface
{
    public function all();

    public function searchPost($queryParams);

    public function view($id);

    public function store($data);

    public function update($data);

    public function destroy($id);
}
