<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Token;

class TokensController extends Controller
{
    public function index() {

        $token = Token::all()->first();

        return view('tokens.index', compact('token'));
    }

    public function show(Token $token) {


        return view('tokens.form', compact('token'));
    }

    public function create() {

        return view('tokens.form');
    }

    public function store(Token $token) {

        $token::create();

        return redirect('tokens.index');
    }
}
