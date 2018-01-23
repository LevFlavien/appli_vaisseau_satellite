<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Configuration;

class ConfigurationController extends Controller
{

    public function index() {

        $configuration = Configuration::all()->first();

        return view('configuration.form', compact('configuration'));
    }

    public function save(Configuration $configuration) {

        dd($configuration);

        $configuration->save();

        return view('configuration.form');
    }
}
