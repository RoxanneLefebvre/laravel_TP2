<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


//use PDF;
use Barryvdh\DomPDF\facade\PDF;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = BlogPost::all();
        //return $blogs[0]->title;
        return view('blog.index', ['blogs'=>$blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorie = new Categorie;
        $categorie = $categorie->selectCategorie();
        //si methode static donc pas de instanciation de la classe, on ferait $categorie = Categorie::selectCategorie();
        return view('blog.create', ['categories'=>$categorie]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        echo $request->body_fr;

        $newPost = BlogPost::create([
            'title'=> $request->title,
            'title_fr'=> $request->title_fr,
            'body'=> $request->body,
            'body_fr'=> $request->body_fr,
            'user_id'=> Auth::user()->id,
            'categories_id'=>$request->categories_id
        ]);

        return redirect(route('blog.show', $newPost));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blogPost)
    {
        Gate::define('update', function (User $user, BlogPost $blogPost) {
            $user_id = Auth::user()->id;
            return $user_id === $blogPost->user_id;
        });
        
        Gate::define('delete', function (User $user, BlogPost $blogPost) {
            $user_id = Auth::user()->id;
            return $user_id === $blogPost->user_id;
        });


        return view('blog.detail', ['blogPost'=>$blogPost, 'test'=>'blabla']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, BlogPost $blogPost, Request $request)
    {
        // fait un changeement dans model pour avoir la function pour avoir les categorie au lieu de la recopier encore une fois
        $categorie = new Categorie;
        $categorie = $categorie->selectCategorie();
  
        
        return view('blog.edit', ['blogPost'=>$blogPost, 'categories'=>$categorie]);
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        $blogPost->update([ //pas de nouvelle instanciation car le post existe deja :: ca ca instantie lol
            'title'=> $request->title,
            'body'=> $request->body
        ]);

        return redirect(route('blog.show', $blogPost->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        
        return redirect(route('blog.index'));
    }

    public function query()
    {
    $query = BlogPost::select(DB::raw('count(*) as blogs, user_id'))
    ->groupBy('user_id')
    ->get();

        return $query;
    }

    public function page(){
        $blogPosts = BlogPost::select()
        ->paginate(5);
        
        return view('blog.page',['blogPosts'=>$blogPosts]);
    }

    public function pdf(BlogPost $blogPost){
       

        $pdf = PDF::loadview('blog.show-pdf', [
            'blogPost'=> $blogPost,
        ]);

        return $pdf->stream('blog.pdf');

    }
}

