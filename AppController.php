<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
class AppController extends Controller 
{

 public function init()
 {
     $user = Auth::user();
     return response()->json(['user' => $user], 200);
 }

 public function login(Request $request)
 {
     if(Auth::attempt(['username' => $request->username, 'password' => $request->password], true))
     {
          return response()->json(Auth::user(), 200);
     }
     else {
          return response()->json(['error' => 'Could not log you in. '], 401);
     }
 }
 
 public function rgister(Request $request)
 {
     $user=User::where('username', $request->username)->first();

     if(isset($user->id))
     {
             return response()->json(['error' => 'Username already exists.'], 401);

     }

     $user = new User();

     $user->name = $request->name;
     $user->username = $request->username;
     $user->password = bcrypt($request->password);
     $user->save();

     Auth::login($user,200);

     return response()->json($user,200);
 }

  public function logout()
  {
    Auth::logout();
  }

  public function changePassword(Request $request, $id)
  {
    $user = User::find($id);

    if ($user) {
      $validate = $request->validate([
          'password' => 'required'
      ]);

      if ($validate) {
        if (Hash::check($request['oldPassword'], $user->password))  {
           $user->password = Hash::make($request['password']);

          $user->save();

          return response()->json([
            'success' => true
          ]);
       } else {
           return response()->json([
              'errors' => [
                 'root' => 'Please enter your current password'
              ]
           ]);
       }
       } else {
         return response()-json([
           'errors'=> [
              'root' => $validate
           ]
         ]);
       }
    }
 }
