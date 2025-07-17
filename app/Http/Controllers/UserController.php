<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('user.index');
    }
    public function create(){
        return view('user.create');
    }
    public function update(){
        return view('user.update');
    }
    public function home(){
        return "Such devastation... This was not my intention...";
    }
}
