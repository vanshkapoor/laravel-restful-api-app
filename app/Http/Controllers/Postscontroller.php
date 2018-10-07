<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\fascades\Storage; 
use App\post;
use DB;

class Postscontroller extends Controller
{
    
     //access control   
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
        //$posts= post::all();
        //$posts= post::orderBy('title','asc')->get();
        //$posts=post::where('title','vansh')->get();
        //by sql query:
        //$posts= DB::select('SELECT * FROM posts');
        $posts= post::orderBy('title','asc')->paginate(5);
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

        //
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
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
             //max size as 1999 as apache server has max image size of 2mbs
        ]);

        if($request->hasFile('cover_image')){

            //get filename with the extension
            $filenamewithExt=$request->file('cover_image')->getClientOriginalName();

            //get just filename
            $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);

            //get extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            //new file name (everytime)
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);

        } else {
            
            $fileNameToStore = 'noimage.jpg';

        }


        //return 123;
        $post = new post;
        $post->title = $request->input('title');
        //$post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success','post created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $post = post::find($id);

        //checking for access control
        if(auth()->user()->id !== $post->user_id);
        {
        return redirect('/posts')->with('error','unauthorized');    
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
        $this->validate($request,[
            'title'=>'required',
            //'body'=>'required'
        ]);
        if($request->hasFile('cover_image')){

            //get filename with the extension
            $filenamewithExt=$request->file('cover_image')->getClientOriginalName();

            //get just filename
            $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);

            //get extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            //new file name (everytime)
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);

        } 
        //return 123;
        $post = post::find($id);
        $post->title = $request->input('title');
        //$post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;    
        }        
        
        $post->save();

        return redirect('/posts')->with('success','post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = post::find($id);

        if(auth()->user()->id !== $post->user_id);
        {
        return redirect('/posts')->with('error','unauthorized');    
        }
        if($post->cover_image!='noimage.jpg'){
            Storage:delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with('success','post removed');

    }
}
