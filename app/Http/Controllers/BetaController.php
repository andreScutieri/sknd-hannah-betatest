<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use App\Beta;

class BetaController extends Controller
{
	protected $redirectPath = '/thankyou';

    public function getBetaForm() {

    	return view('beta.registerbeta');

    }

    public function postBetaForm(Request $request) {
    	$this->validator($request->all())->validate();

    	return $this->create($request->all()) ? redirect($this->redirectPath) : back();

    }

    public function showThankYou() {
    	return view('beta.thankyou');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|alpha_dash|unique:betas',
            'email' => 'required|email|max:255|unique:betas',
        ]);
    }

    protected function create(array $data)
    {
        return Beta::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'token' => hash_hmac('sha256', Str::random(40), env('APP_KEY')),
        ]);
    }


}
