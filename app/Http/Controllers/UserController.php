<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): Response
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }

    public function show(Request $request, User $user): Response
    {
        return view('user.show', compact('user'));
    }

    public function store(UserStoreRequest $request): Response
    {
        $user = User::create($request->validated());

        return redirect()->route('user.index');
    }
}
