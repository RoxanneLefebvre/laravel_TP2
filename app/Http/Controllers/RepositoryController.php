<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\facade\PDF;

class RepositoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = Repository::select()
        ->paginate(4);

        $icons = [
            'pdf' => 'pdf',
            'doc' => 'word',
            'docx' => 'word',
            'xls' => 'excel',
            'xlsx' => 'excel',
            'ppt' => 'powerpoint',
            'pptx' => 'powerpoint',
            'txt' => 'text',
            'png' => 'image',
            'jpg' => 'image',
            'zip' => 'zip',

        ];

        Gate::define('update', function (User $user, Repository $repository) {
            $user_id = Auth::user()->id;
            return $user_id === $repository->user_id;
        });
        
        Gate::define('delete', function (User $user, Repository $repository) {
            $user_id = Auth::user()->id;
            return $user_id === $repository->user_id;
        });

        return view('repo.repository', ['files'=>$files],compact('icons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('repo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $file = $request->file('file');

        $request->validate([
            'file'=>'required|mimes:pdf,doc,zip',
            'title'=>'required',

        ]);
       
        $file->move(base_path('/public/img/'), $file->getClientOriginalName());

        $newFile = new Repository();

        $newFile->title_fr = $request->title_fr;
        $newFile->title = $request->title;
        $newFile->user_id = Auth::user()->id;
        $newFile->path = '/img/' . $file->getClientOriginalName();
        $newFile->type = $file->getClientOriginalExtension();
        $newFile->save();

        
        



        
         
        
        return redirect(route('repo.repository'))->withSuccess('file uploaded!');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Repository  $repository
     * @return \Illuminate\Http\Response
     */
    public function show(Repository $repository)
    {

        Gate::define('update', function (User $user, Repository $Repository) {
            $user_id = Auth::user()->id;
            return $user_id === $Repository->user_id;
        });
        
        Gate::define('delete', function (User $user, Repository $Repository) {
            $user_id = Auth::user()->id;
            return $user_id === $Repository->user_id;
        });
        return view('repo.detail', ['repository'=> $repository]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Repository  $repository
     * @return \Illuminate\Http\Response
     */
    public function edit(Repository $repository)
    {
        return view('repo.edit', ['repository'=>$repository]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Repository  $repository
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repository $repository)
    {

        $request->validate([
            'file'=>'required|mimes:pdf,doc,zip',
            'title'=>'required',

        ]);

        $file = $request->file('file');
        $file->move(base_path('/public/img/'), $file->getClientOriginalName());
        var_dump($file);
        $path = '/img/' . $file->getClientOriginalName();
        $type = $file->getClientOriginalExtension();
        
        $repository->update([ //pas de nouvelle instanciation car le post existe deja :: ca ca instantie lol
            'title'=> $request->title,
            'title_fr'=> $request->title_fr,
            'path'=> $path, 
            'type'=> $type 
        ]);

        return redirect(route('repo.repository', $repository->id))->withSuccess('file updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Repository  $repository
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repository $repository)
    {
        print_r($repository->id);
        $repository->delete();
        
        return redirect(route('repo.repository'))->withSuccess('file deleted');
    }


    
}
