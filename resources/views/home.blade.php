@extends('layouts.app')

@section('title', config('app.name', 'Laravel Minimal'))

@section('content')
            <section class="hero">
                <p class="eyebrow">Minimal Laravel</p>
                <h1>Blade, controller, and database. Nothing extra.</h1>
                <p class="lede">
                    This page is the whole stack: a route, a controller, a Blade view, server-side validation,
                    and the people table. No frontend build step is required.
                </p>
                <div class="stats">
                    <strong>{{ $people->count() }}</strong>
                    <span>{{ Str::plural('saved person', $people->count()) }}</span>
                </div>
            </section>

            <section class="layout">
                <div class="panel">
                    <h2>Add a person</h2>
                    <p>
                        @auth
                            Submit the form and Laravel will validate the request, store the record, and render it back on the page.
                        @else
                            Sign in to unlock the create form. Reading stays public.
                        @endauth
                    </p>

                    @if (session('status'))
                        <div class="flash">{{ session('status') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="errors">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @auth
                        <form class="stack" method="POST" action="{{ route('people.store') }}">
                            @csrf

                            <label>
                                Name
                                <input type="text" name="name" value="{{ old('name') }}" required>
                            </label>

                            <label>
                                Email
                                <input type="email" name="email" value="{{ old('email') }}" required>
                            </label>

                            <button type="submit">Save person</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}">Go to login</a>
                    @endauth
                </div>

                <div class="panel">
                    <h2>Saved people</h2>
                    <p>Records are loaded from the database on every request and rendered directly by Blade.</p>

                    @if ($people->isEmpty())
                        <div class="empty">No records yet. Add one from the form.</div>
                    @else
                        <div class="list">
                            @foreach ($people as $person)
                                <article class="row">
                                    <strong>{{ $person->name }}</strong>
                                    <span class="meta">{{ $person->email }}</span>
                                    <span class="meta">Added {{ $person->created_at->diffForHumans() }}</span>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
@endsection