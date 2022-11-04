<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();

        return view('users.index', compact('users'));
    }
    public function CreateUser(Request $req)
    {
        $validator = Validator($req->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
      ]);
      if ($validator->fails()) {
        $errors = $validator->errors()->getMessages();
        return Redirect::back()->withErrors($errors);
      }
       $user=new User();
          $user->name=$req->name;
          $user->email=$req->name;
          $user->password=Hash::make($req->password);
          $user->save();
          return Redirect::back()->withSuccess('User Register Sucessfuly');

    }
}
