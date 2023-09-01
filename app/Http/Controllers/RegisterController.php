<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
    {
    /**
     * Display a listing of the resource.
     */
    public function index()
        {
        $states = State::with('city')->get();
        return view('register.index', compact('states'));
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
        {
        $requestValidated = $request->validated();

        // split the state city
        $stateCityArray = explode('-', $requestValidated['city']);
        $requestValidated['state_id'] = $stateCityArray[0];
        $requestValidated['city_id'] = $stateCityArray[1];

       $user = User::create($requestValidated);
        Auth::login($user);
        return to_route('home');
        }


    }
