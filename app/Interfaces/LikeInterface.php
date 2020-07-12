<?php


namespace App\Interfaces;


interface LikeInterface
{
    public function index($postId);

    public function store($data);
}
