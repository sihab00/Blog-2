<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Validator;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::select('id','name','slug','status')->paginate(10);
        return view('backend.category.index')->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $rules=[
            'name'=>'required|unique:categories,name',
            'status'=>'required'
       ];

       $validator = Validator::make($request->all(), $rules);

       if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
       }
       Category::create([
            'name'=>trim($request->input('name')),
            'slug'=>str_slug(trim($request->input('name'))),
            'status'=>trim($request->input('status')),
        ]);

       Session::flash('success','Category added successfully!');

       return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        $category = Category::with('posts','posts.user')->select('id','name','slug','status','created_at')->where('id',$id)->first();
        
       return view('backend.category.show')->withCategory($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::select('id','name','status')->where('id',$id)->first();
       return view('backend.category.edit')->withCategory($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $rules=[
            'name'=>"required|unique:categories,name,$id",
            'status'=>'required'
       ];

       $validator = Validator::make($request->all(), $rules);



       if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
       }

       $category = Category::find($id);

       // $category->name = $request->name;
       // $category->slug = str_slug($request->name);
       // $category->status = $request->status;

       // $category->save();

       $category->update([
        'name'=>trim($request->input('name')),
        'slug'=>str_slug(trim($request->input('name'))),
        'status'=>trim($request->input('status')),
        ]);
       Session::flash('success','Category updated successfully!');

       return redirect()->route('categories.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $category = Category::find($id);
       $category->delete();
       Session::flash('success','Category deleted successfully!');

       return redirect()->route('categories.index');

    }
}
