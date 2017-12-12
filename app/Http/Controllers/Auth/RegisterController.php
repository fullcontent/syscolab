<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Colaber;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Session;
use CRUDBooster;
use DB;
use Illuminate\Auth\Authenticatable;
use Request;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/colaber';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:cms_users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   

        

       
        
        $user = User::create([
            'name' => $data['name'],
            'photo' => $photo,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'status' => "Active",
            'id_cms_privileges' => "2",
            
        ]);

        $dadosColaber = new Colaber;
        $dadosColaber->user_id = $user->id;
        $dadosColaber->marca = $user->name;
        $dadosColaber->save();


        $priv = DB::table("cms_privileges")->where("id",$user->id_cms_privileges)->first();
        $roles = DB::table('cms_privileges_roles')
        ->where('id_cms_privileges',$user->id_cms_privileges)
        ->join('cms_moduls','cms_moduls.id','=','id_cms_moduls')
        ->select('cms_moduls.name','cms_moduls.path','is_visible','is_create','is_read','is_edit','is_delete')
        ->get();

        $photo = ($user->photo)?asset($user->photo):asset('vendor/crudbooster/avatar.jpg');

        Session::put('admin_id',$user->id);            
        Session::put('admin_is_superadmin',$priv->is_superadmin);
        Session::put('admin_name',$user->name);    
        Session::put('admin_photo',$photo);
        Session::put('admin_privileges_roles',$roles);
        Session::put("admin_privileges", $user->id_cms_privileges);
        Session::put('admin_privileges_name',$priv->name);          
        Session::put('admin_lock',0);
        Session::put('theme_color',$priv->theme_color);
        Session::put("appname",CRUDBooster::getSetting('appname'));     

        CRUDBooster::insertLog(trans("crudbooster.log_login",['email'=>$user->email,'ip'=>Request::server('REMOTE_ADDR')]));       
      

        return $user;



    }

    
}
