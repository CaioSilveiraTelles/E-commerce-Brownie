<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Resume;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        \App::setLocale($user->locale);
        $resumes = Resume::where('user_id', $user->id)->paginate(5);
        return view('home', compact('resumes'));
    }

    public function consulta(){
        $user = Auth::user();
        \App::setLocale($user->locale);
        If($user->name =='RH'){
            $resumes = DB::table('resumes')->paginate(5);
            return view('home', compact('resumes'));
        }
        Else{
            $user = Auth::user();
            \App::setLocale($user->locale);
            $resumes = Resume::where('user_id', $user->id)->paginate(5);
            return view('home', compact('resumes'));
            }
          }

    public function search(Request $REQUEST)
    {
        $user = Auth::user();
        \App::setLocale($user->locale);
        If($user->name =='RH'){
            $search = $REQUEST->get('search');
            $resumes = Resume::where('name','like','%'.$search.'%')
                        ->OrWhere('cargo','like','%'.$search.'%')
                        ->OrWhere('email','like','%'.$search.'%')
                        ->OrWhere('nationality','like','%'.$search.'%')
                        ->OrWhere('phone','like','%'.$search.'%')
                        ->paginate(5);
            return view('home', compact('resumes'));
        }
        Else{
            $user = Auth::user();
            \App::setLocale($user->locale);
            $search = $REQUEST->get('search');
            $resumes = Resume::where([
                ['user_id', '=', $user->id],
                ['name', 'like', $search],
            ])->paginate(5);
            
            return view('home', compact('resumes'));
            }
          }   

    }
      
            

    
