<?php

namespace App\Controller;
class ProductController
{
    function show1(): void
    {
        $content='son show1 e mi trovo in ProductController';
        require 'App/View/home.php';
    }

}