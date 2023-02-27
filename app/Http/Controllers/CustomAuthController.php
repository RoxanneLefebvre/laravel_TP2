<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $newUser = User::create([
        //     'name'=> $request->title,
        //     'email'=> $request->body,
        //     'password'=> 1,
        // ]);

        // return redirect(route('blog.show', $newPost));    //autre facon de le faire ci dessous

        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|max:20'
            

        ]);

        

        $user = new User;
        
        
        // 'user_id'=> Auth::user()->id,
        
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        
        $student = new Student;
        $student->user_id = $user->id;
        $student->save();

        $to_name = $request->name;
        $to_email = $request->email;

        $body="<a href='route'>cliquez ici pour confirmer votre compte</a>";

        // Mail::send('email.mail', $data=
        // [
        //     'name'=>$to_name,
        //     'body'=>$body
        // ],

        // function($message) use ($to_name, $to_email)
        // {
        //     $message->to($to_email, $to_name)->subject('Courrier de test');
        // });

        return redirect()->back()->withSuccess(trans('lang.msg_succes'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

   

    /**
     * @param  \Illuminate\Http\Request  $request
     *function d'authentification
     * @return \Illuminate\Http\Response
     */
    public function authentification(Request $request)
    {
       
        $request->validate([
            'email'=>'required|email|exists:users',
            'password'=>'required|min:6|max:20'
        ]);

        $credentials = $request->only('email', 'password');

        if(!Auth::validate($credentials)):
            return redirect(route('login'))
                ->withErrors(trans('auth.failed'))
                ->withInput();
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        

        Auth::login($user, $request->get('remember'));
        return redirect()->intended('dashboard')->withSuccess('signed in');


        
    }

    /**
     * function qui renvoit sur dashboard si auth est valide
     */
    public function dashboard()
    {
        

        if(Auth::check()){
            
            return view('dashboard');
        }
            return redirect(route('login'))->withErrors('non autoriser');
        
    }

    /**
     * function de deconnexion
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }

    /**
     * function qui renvoit le formulaire doublie de mot de passe
     */
    public function forgotPassword()
    {
        return view('auth.forgot-password');
  
    }

    /**
     * * @param  \Illuminate\Http\Request  $request
     * function qui creer un mot de passe temporaire
     * @return \Illuminate\Http\Response
     */
    public function tempPassword(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:users',
        ]);

        $user= User::where('email', $request->email)->get();

        $user = $user[0];
        $userId = $user->id;

        $tempPass = str::random(25);
        $user->temp_password = $tempPass;
        $user->save();

        //return $link;
        $to_email = $user->email;
        $to_name = $user->name;
        $link = "<a href='http://localhost:8000/new-password/".$userId."/".$tempPass."'>Cliques ici pour reinitialiser votre mot de passe</a>";


        Mail::send('email.mail', $data=
        [
            'name'=>$to_name,
            'body'=>$link
        ],

        function($message) use ($to_name, $to_email)
        {
            $message->to($to_email, $to_name)->subject('Reset Password');
        });

        return redirect()->back()->withSuccess('check your email to change password');


    }

    /**
     * fucntion qui compare le mot de passe temporaire et permet den mettre un nouveau
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function newPassword(User $user, $tempPassword){
        if($user->temp_password === $tempPassword){
           return view('auth.new-password');
        }
        return redirect('forgot-password')->withErrors('les identifiants ne correspondent pas');
    }


    public function storeNewPassword(User $user, $tempPassword, Request $request){
        if($user->temp_password === $tempPassword){
            $request->validate([

                'password'=>'required|min:6|confirmed',
            ]);
            $user->temp_password=null;
            $user->password = Hash::make($request->password);
            $user->save();
        
            return redirect(route('login'))->withSuccess(trans('lang.pass_changed'));

        }
        return redirect('forgot-password')->withErrors('les identifiants ne correspondent pas');
    }
}
