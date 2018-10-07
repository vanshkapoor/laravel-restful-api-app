<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
    	$welcome='hellloo';
    	$welcome1='theree!';
    	return view('pages.index',compact('welcome','welcome1'));
    }

    public function about(){
    	return view('pages.about');
    }

    public function services(){
    	$data = array(
    		'title'=>'services',
    		'services'=>['hr','web','data scientist']
    );
    	//return view('pages.services',compact('data'));
    	return view('pages.services')->with($data);
    }
}
