@extends('layouts.app')

@section('title', 'Login')

@section('content')
            <section class="hero">
                <p class="eyebrow">Account Access</p>
                <h1>Sign in to manage people.</h1>
                <p class="lede">
                    This keeps writes behind Laravel's session guard while the homepage remains public.
                </p>
            </section>

            <section class="layout">
                <div class="panel">
                    <h2>Sign in</h2>
                    <p>Use your account email and password to unlock the create form.</p>

                    @if ($errors->any())
                        <div class="errors">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="stack" method="POST" action="{{ route('login.store') }}">
                        @csrf

                        <label>
                            Email
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus>
                        </label>

                        <label>
                            Password
                            <input type="password" name="password" required>
                        </label>

                        <button type="submit">Sign in</button>
                    </form>
                </div>
            </section>
@endsection