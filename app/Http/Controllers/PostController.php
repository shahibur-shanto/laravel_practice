<?php

namespace App\Http\Controllers;

use App\Mail\WellcomeMail;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */

    public static function middleware():array
    {
        // TODO: Implement middleware() method.
        return [

//            new Middleware('auth',only:['store']),
            new Middleware('auth',except:['index','show'])
        ];
    }

    public function index()
    {

//        $data = Post::orderBy('created_at','desc')->get();
            $data = Post::latest()->paginate(6);
//            $data =Post::orderBy('created_at','desc')->paginate(5);
        return view('posts.index',['posts'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //Validate
        $request->validate([
            'title'=>['required', "max:255"],
            'body'=>['required'],
            'image'=>['nullable','file','max:1000','mimes:png,jpg,webp']
        ]);

        $path = null;
        if ($request->hasFile('image')){
            $path = Storage::disk('public')->put('posts_images',$request->image);
        }




        //Create Posts
//        Post::create(['user_id'=>Auth::id(),...$fields]);
          $post =   Auth::user()->posts()->create([
                'title'=>$request->title,
                'body'=>$request->body,
                'image'=>$path
            ]);

        Mail::to(Auth::user())->send(new WellcomeMail(Auth::user(),$post));

        //Redirect
        return back()->with('success','Your Post Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show',['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('modify',$post);
        return view('posts.edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('modify',$post);
        $request->validate([
            'title'=>['required', "max:255"],
            'body'=>['required'],
            'image'=>['nullable','file','max:1000','mimes:png,jpg,webp']

        ]);

        $path = $post->image ?? null;
        if ($request->hasFile('image')){
            if($post->image){
                Storage::disk('public')->delete($post->image);
            }
            $path = Storage::disk('public')->put('posts_images',$request->image);
        }
        $post->update([
            'title'=>$request->title,
            'body'=>$request->body,
            'image'=>$path
        ]);

        return redirect()->route('dashboard')->with('success','Your Post Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        Gate::authorize('modify',$post);

        //Delete post image if it exists

        if($post->image){
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return back()->with('delete','Your post deleted successfully');
    }
}
