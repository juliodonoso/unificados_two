<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Support\Facades\Hash;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;
   

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function usersindex() // Index de los usuarios
    {

       if( Auth::user()->idtype  == 1) {
        $lusers = Auth::user()->get(); 
       }
       if( Auth::user()->idtype  == 7) {
        $lusers = Auth::user()
        ->where('idtype',6)->get(); 
       }

        // $lusers = Auth::user()->get(); 
        $titulo = 'Listado de usuarios';      
        return view('auth.listusers')
        ->with('titulo',$titulo)
        ->with('lusers',$lusers);    
    }

    public function edituser() //  Pantalla de edicion de ususarios
    {   

        $luserid = $_POST['bt01'];
        $ledit = auth::user()        
        ->where('id',$luserid)
        ->get();      
        $titulo = 'Listado de usuarios'; 
        return view('auth.edituser')
        ->with('titulo',$titulo)
        ->with('ledit',$ledit)
        ->with('luserid',$luserid);
    }

    public function upuser($luserid)  // Grabar los cambios en los usuarios
    {
        $lname = $_POST['bname'];
        $lpass = $_POST['pwd01'];
        $ltype = $_POST['opt01'];
        $upuse = auth::user()
        ->where('id',$luserid)
        ->update([  
            'idtype' => $ltype,
            'name' =>$lname,
            'password' => Hash::make($lpass),]);  
        $lusers = Auth::user()->get(); 
        $titulo = 'Listado de usuarios';      
        return view('auth.listusers')
        ->with('titulo',$titulo)
        ->with('lusers',$lusers);     
    }


}
