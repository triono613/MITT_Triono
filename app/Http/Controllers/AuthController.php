<?php

namespace App\Http\Controllers;


use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Models\User;
use JWT;
use Tymon\JWTAuth\Contracts\JWTSubject as JWTSubject;


class AuthController extends Controller
{

    public function loginView()
    {
        return view('Layouts/login');
    }

    public function registerView()
    {
        return view("register");
    }

    public function dashboardView()
    {
        return redirect()->action('dashboardController@index');
    }


  public function register( Request  $request) {

    $data = $request->all();


    // echo "<pre>";
    // print_r( $request );
    // die;

            $this->validate($request ,[
                    'username' =>  'required|unique:users',
                    'email' => 'required|unique:users'
            ]);

                User::create([
                    'username' => $data['username'],
                    'name' => $data['name'],
                    'address' => $data['address'],
                    'birthdate' => $data['birthdate'],
                    'email' => $data['email'],
                    //'password' => "password2022"
                   'password' => bcrypt( 'password2022' )

                ]);


            RETURN RESPONSE()->JSON([
                //'user_id'=> $request->user()->password,
                'ERRORCODE'=>'0',
                'ERRORDESC'=> "Success",
                "TAG"=> [
                    "Sukses mendaftarkan username, gunakan password : password2022"
                  ]
                //'token'=> $token,
            ]);

  }


        public function login( Request $request ){

            // dd($request->all());

            $this->validate( $request, [
                'username' =>  'required',
                'password' => 'required'
            ]);

            $credentials = $request->only('username', 'password');

            $token = JWTAuth::attempt($credentials);

            try {

                if ( !$token ) {
                    return response()->json(['error' => 'invalid_credentials'], 401);
                } else {
                    $data = response()->json([
                        "status"=>true,
                        "redirect_location"=>url("dashboard"),
                        'username'=> $request->user()->username,
                        'tokenType'=> 'jwt',
                        'token'=> $token
                    ]);
                    // return redirect("dashboardView")->with( 'data', $data );
                    return redirect()->action('dashboardController@index');
;
                }
            } catch (JWTException $e) {

                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            // dd( $request->user() );

                // RETURN RESPONSE()->JSON([
                //     // 'user_id'=> $request->user()->id,
                //     'username'=> $request->user()->username,
                //     'tokenType'=> 'jwt',
                //     'token'=> $token
                // ]);

            // return response()->json(compact('token'));


        }

}
