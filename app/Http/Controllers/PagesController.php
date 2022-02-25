<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
      $title="This My Index Title From Controller";
       return view('pages.index')->with('title',$title);
    }
    public function about(){
      $title="This My About Title From Controller";
       return view('pages.about')->with('title',$title);;
    }
    public function services(){
      $data=array(
        'title'=>'Services',
        'Services'=>['Web Designing','SEO','Programing']
      );
       return view('pages.services')->with($data);;
    }
}
