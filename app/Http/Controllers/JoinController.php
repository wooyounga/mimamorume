<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class JoinController extends Controller
{
    public function create() {
      return view('user.join');
    }

    public function store(Request $request) {
      $this->validate($request, [
        'user_type' => 'required',
        'name' => 'required|max:255',
        'id' => 'required|max:255|unique:user',
        'pw' => 'required|confirmed',
        'age' => 'required|integer',
        'gender' => 'required|max:50',
        'email' => 'required|email|max:255',
        'telephone' => 'required|max:50',
        'cellphone' => 'required|max:50',
        'zip_code' => 'required|max:50',
        'main_address' => 'required|max:50',
        'rest_address' => 'max:50',
      ]);

      $user = \App\User::create([
        'user_type' => $request->input('user_type'),
        'name' => $request->input('name'),
        'id' => $request->input('id'),
        'pw' => bcrypt($request->input('pw')),
        'age' => $request->input('age'),
        'gender' => $request->input('gender'),
        'email' => $request->input('email'),
        'telephone' => $request->input('telephone'),
        'cellphone' => $request->input('cellphone'),
        'zip_code' => $request->input('zip_code'),
        'main_address' => $request->input('main_address'),
        'rest_address' => $request->input('rest_address'),
      ]);

      $user_id = $request->get('id');
      $user_pw = $request->get('pw');

      Session::set('id', $user_id);

      return redirect('addinfo');
    }
}
