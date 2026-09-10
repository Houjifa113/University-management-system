<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function addUser(Request $req){
    $req->validate([
     'Username'=> 'required',
     'email'=> 'required | email | lowercase',
     'password'=> 'required | min:4',
     'gender'=> 'required',
     'department'=> 'required',
     'image'=>'required'

    ],[
    'username.required'=>'username can not be empty',
    'email.required'=>'email can not be empty',
    'password.required'=>'must input a password',
    'gender.required'=>'Must choose a gender',
    'image.required'=>'Upload an image',

    ]);
    return $req;
    }
}