<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class userController extends Controller
{
    public function Create(Request $req) {
    //    $validate = array(
    //     "username"=>"Required"
    //    );
    //    $validator = validator::make($req->all(),$validate);
    //    if($validator->fails()){
    //     return response()->json($validator->error(),403);
    //    }
    //    else {

    //    } --> JUST DECIDED TO SAVE THIS CODE HERE; NOTHING MUCH;

      $validator = $req->validate([
         "name"=>"Required",
         "email"=>"Required",
         "password"=>"Required",
         "address"=>"Required",
         "profile"=>"Required",
         
      ]);
      $name = $req->input("name");
      $filename = $name.".".$req->profile->getClientOriginalExtension();
      $req->profile->move("prfoileImg",$filename);

      $user = new User;
      $user->name = $req->name;
      $user->email = $req->email;
      $user->password = Hash::make($req->password);
      $user->address = $req->address; 
      $user->image = $filename;

     $newUser = $user->save();
   
     
     return redirect('userLogin');


    }



    public function Login(Request $req) {
      $details = $req->validate([
       "email"=>"Required",
       "password"=>"Required",
      ]); 

      if(auth()->attempt([
        "email"=>$details["email"],
        "password"=>$details["password"],
      ])) {

        
          $user = Auth()->user();

          if(!$user->is_admin == 1) {
           return redirect("/index");
          }    
          
          else {
            return redirect("/order");
          }
         
      }
         

    }

    public function Logout() {
      auth()->logout();
      return redirect("/");
    }
}
