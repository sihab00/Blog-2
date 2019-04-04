<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
    	echo "Showing User List";
    }
    public function show($id, Request $request)
    {
    	//var_dump($request->all('name'));//get the all input data from url

    	//$page = $request->has('page')? $request->input('page'):1; //if page value exist than echo the input value or default value 1; thaan use this tanery operator or below

    	$page = $request->input('page')??1;
    	echo $page;
    	// $page = $request->input('page')?1; this the php 7 feature if exist the value on default 1;
    	echo "<p>Showing User id:".$id."</p>";
    }
}
