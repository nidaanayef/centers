<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class HomeController extends BaseController
{
    function index(){
        return view("admin.home.index");
    }
    function indexManager(){
        return view("admin.home.index_manager");
    }
}
