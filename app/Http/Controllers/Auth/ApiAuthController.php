<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Util\Xml\Validator;
use Spatie\FlareClient\Http\Response;

class ApiAuthController extends Controller
{
    public function register(Request $request){

        $validator = Validator($request->all(),[
            'name'=>'required|string|min:2',
            'email'=>'required|email|unique:admins',
            'password'=>'required|string'
        ]);
        if(! $validator->fails()){

            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->password = Hash::make($request->input('password'));

            $saved = $admin->save();
            return response()->json(['status'=>true,'message'=>'Registered Successful']);
        }else{

            return response()->json(['status'=>false,'message'=>$validator->getMessageBag()->first()]);
        }
    }
    public function login(Request $request){

         $validator = Validator($request->all(),[
            'email'=>'required|email|exists:admins,email',
            'password'=>'required|string',
        ]);
        if(! $validator->fails()){

            $admin = Admin::where('email','=',$request->input('email'))->first();
            if(Hash::check($request->input('password'), $admin->password)){
                $token = $admin->createToken('admin-api-token'.$admin->id);
                $admin->token = $token->accessToken;

                return response()->json(['status'=>true,'message'=>$token]);

            }
        }else{

            return response()->json(['status'=>false,'message'=>$validator->getMessageBag()->first()]);
        }
    }

    public function logout(Request $request){

    }
}
