<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\post;
use DB;

class PostController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth',['except'=>['index','show']]);
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      //  $posts = post::all();
        $posts=DB::select('select * from posts');
        return view('posts.index')->with('posts',$posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
          'title'=>'required',
          'body'=>'required',
          'cover_image' => 'image|nullable|max:1999'
        ]);
         //handle the file is_uploaded_file
        if ($request->hasFile('cover_image')){
          //Get filename with extension
          $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just file name
           $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
           //Get just ext
           $extension = $request->file('cover_image')->getClientOriginalExtension();
           //File Name to Store
           $fileNameToStore = $filename .'_'.time().'.'.$extension;
           //upload image
           $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }  else{
          $fileNameToStore='noimage.png';
        }
        $post = new post;
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->user_id= Auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/news')->with('succsess','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = post::find($id);
        if(auth()->user()->id!==$post->user_id){
          return redirect('/post')->with('error','UnAuthorized Page!');
        }
        return view('posts.edit')->with('post',$post);
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
      $this->validate($request,[
        'title'=>'required',
        'body'=>'required',
        'cover_image' => 'image|nullable|max:1999'
      ]);
       //handle the file is_uploaded_file
      if ($request->hasFile('cover_image')){
        //Get filename with extension
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
                                              //Get just file name
         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
         //Get just ext
         $extension = $request->file('cover_image')->getClientOriginalExtension();
         //File Name to Store
         $fileNameToStore = $filename .'_'.time().'.'.$extension;
         //upload image
         $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
      }
        $post = post::find($id);
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        if($request->hasFile('cover_image')){
             $post->cover_image = $fileNameToStore;
                }
        $post->save();
        return redirect('/posts')->with('succsess','Post Updated');

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
        $post =post::find($id);
        if(auth()->user()->id!==$post->user_id){
          return redirect('/post')->with('error','UnAuthorized Page!');
        }
        if($post->cover_image != 'noimage.png')
        storage::delete('public/cover_images/'.$post->cover_image );
        $post->Delete();
        return redirect("/posts")->with('success','Post Removed');

    }
}
