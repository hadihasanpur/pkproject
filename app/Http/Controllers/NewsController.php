<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\News;
use DB;



class NewsController extends Controller
{
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
        ///  $news = News::all();
        $news=DB::table('news')->orderby('date', 'asc')->paginate(3);
        return view('news.index')->with('news',$news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' =>'required',
        //  'body' => 'required',
             'img1' => 'image|nullable|max:1999'
      ]);
      //handle the file is_uploaded_file
      if ($request->hasFile('img1')){
        //Get filename with extension
        $filenameWithExt = $request->file('img1')->getClientOriginalName();
        //Get just file name
       $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
       //Get just ext
       $extension = $request->file('img1')->getClientOriginalExtension();
       //File Name to Store
       $fileNameToStore = $filename .'_'.time().'.'.$extension;
       //upload image
       $path = $request->file('img1')->storeAs('public/News_images',$fileNameToStore);
      } else {
        $fileNameToStore='noimage.png';
      }
      $news = new News;
      $news->title=$request->input('title');
      $news->body=$request->input('body');
      $news->img1 = $fileNameToStore;
      $news->user_id = auth()->user()->id;

      $news->save();
      return redirect('/news')->with('succsess','news Created');

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
        //
        $news = News::find($id);
        return view('news.show')->with('news',$news);
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
        //
        $news = News::find($id);
        if(auth()->user()->id!==$news->user_id){
          return redirect('/news')->with('error','UnAuthorized Page!');
        }
        return view('news.edit')->with('news',$news);
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
          'img1' => 'image|nullable|max:1999'
        ]);
         //handle the file is_uploaded_file
        if ($request->hasFile('img1')){
          //Get filename with extension
          $filenameWithExt = $request->file('img1')->getClientOriginalName();
                                                //Get just file name
           $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
           //Get just ext
           $extension = $request->file('img1')->getClientOriginalExtension();
           //File Name to Store
           $fileNameToStore = $filename .'_'.time().'.'.$extension;
           //upload image
           $path = $request->file('img1')->storeAs('public/News_images',$fileNameToStore);
        }
          $news = News::find($id);
          $news->title=$request->input('title');
          $news->body=$request->input('body');
          if($request->hasFile('img1')){
               $news->img1 = fileNameToStore;
                  }
          $news->save();
          return redirect('/news')->with('succsess','$news Updated');

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
