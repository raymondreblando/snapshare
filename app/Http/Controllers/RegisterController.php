<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function index(): View
    {
        return view('register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        User::create($validatedData);

        return redirect('register')->with('success', 'Your account successfully created');
    }
}
