<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class FrontController extends Controller
{
    public function index()
    {

    	return view('welcome');
    }
    public function contact()
    {
    	return view('contact');
    }

}
