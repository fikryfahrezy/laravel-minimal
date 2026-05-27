<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'people' => Person::query()
                ->latest()
                ->get(['id', 'name', 'email', 'created_at']),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:people,email'],
        ]);

        Person::query()->create($validated);

        return redirect()
            ->route('home')
            ->with('status', 'Person added.');
    }
}