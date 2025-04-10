<?php

namespace App\Controller;
class ServiceController
{
    function presentation2(): void
    {
        $content='son presentation2 e mi trovo in ServiceController';
        require 'App/View/home.php';
    }
}