<?php

namespace App\Controller;
require 'App\Model\Tablet.php';
use App\Model\Tablet;

class ProductController
{
    private Tablet $tablet;
    public function __construct($db){//facciamo una classe per ogni tabella nel db
        $this->tablet=new Tablet($db);
    }

    public function showAllTablet(){
        $tablets=$this->tablet->showAll();
        require 'App/View/ShowAllTablet.php';
    }

    function show1(): void
    {
        $content='';
        require 'App/View/home.php';
    }

}