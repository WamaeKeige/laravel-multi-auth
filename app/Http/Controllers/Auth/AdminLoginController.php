<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
  //redirects those who arent logged in as Admin
    public function __construct()
    {
      $this->middleware('guest:admin');
    }
    //login forms.
    public function showLoginForm()
    {
       return view('auth.admin-login');
    }
    public function login(Request $request)
    {
      //validate the form data
      //attempt to log the user in' then redirect;
      $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required|min:6'
      ]);
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        //redirect ro intended place.
        return redirect()->intended(route('admin.dashboard'));
      }
      //if fail
      return redirect()->back()->withInput($request->only('email', 'remember'));
    }
    public function logout()
    {
      Auth::guard('admin')->logout();
      return redirect('/');
    }

}
