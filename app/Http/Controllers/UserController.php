<?php
namespace App\Http\Controllers;
class UserController extends Controller { public function index(){ $users=require resource_path('data/users.php'); return view('users.index',compact('users')); } }
