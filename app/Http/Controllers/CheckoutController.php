<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CheckoutLoginRequest;
use Illuminate\Support\MessageBag;
use App\User;

class CheckoutController extends Controller
{
    public function login()
    {
    	return view('checkout.login');
    }

    public function postLogin(CheckoutLoginRequest $request)
    {
    	$email = $request->get('email');
    	$password = $request->get('checkout_password');
    	$is_guest = $request->get('is_guest') > 0;

    	if($is_guest) {
    		return $this->guestCheckout($email);
    	}
    	return $this->authenticatedCheckout($email,$password);
    }

    public function authenticatedCheckout($email, $password)
    {
    	return 'Logic untuk authenticated checkout belum dibuat';
    }

    public function guestCheckout($email)
    {
    	//check if user exist, if so, ask login
    	if($user = User::where('email',$email)->first()) {
    		if($user->hasPassword()) {
    			//(A) Logic ketika email ada di DB dengan password
    			$errors = new MessageBag();
    			$errors->add('checkout_password','Alamat email "'.$email.'" sudah terdaftar, silahkan masukkan password.');
    			//redirect and change is_guest value
    			return redirect('checkout/login')->withErrors($errors)->withInput(compact('email') + ['is_guest'=> 0]);
    		}
    		//(B) Logic ketika email di DB tanpa password
    		//show view to request new password
    		session()->flash('email',$email);
    		return view('checkout.reset-password');
    	}
    	// (C) Logic ketika email tidak ada di DB
    }
}
