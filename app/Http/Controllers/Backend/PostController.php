<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use Session;
use Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category','user')->select('id','title','category_id','user_id','status')->paginate(10);
        return view('backend.post.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts = Post::with('category','user')->select('category_id','user_id')->get();

        return view('backend.post.create')->withPosts($posts);
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
            'title'=>'required|unique:posts,title',
            'content'=>'required',
            'category'=>'required',
            'user'=>'required',
            'status'=>'required',
            'thumbnail_path'=>'required|image|max:10240'
       ];

       $validator = Validator::make($request->all(), $rules);

       if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
       }
       $photo = $request->file('thumbnail_path');

        $fileName= uniqid('thumbnail_path',true).str_random(10).'.'.$photo->getClientOriginalExtension();

        if ($photo->isValid()) {
            $photo->storeAs('postImage',$fileName);
        }
       Post::create([
            'user_id'=>$request->input('user'),
            'category_id'=>$request->input('category'),
            'title'=>trim($request->input('title')),
            'content'=>trim($request->input('content')),
            'thumbnail_path'=>$fileName,
            'status'=>trim($request->input('status')),
        ]);

       Session::flash('success','Post added successfully!');

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
        $post = Post::with('category','user')->select('id','title','content','category_id','user_id','status','created_at')->where('id',$id)->first();
       return view('backend.post.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = [];
        $post['categories']=Category::select('id','name')->get();
       $post['post'] =Post::with('category','user')->find($id);
      
       return view('backend.post.edit',$post);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
