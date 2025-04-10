<?php

namespace App\Controller;
class HomeController
{
    function presentation1(): void
    {
        $content = 'sono presentation1 e mi trovo in HomeController';
        require 'App/View/home.php';
    }

}