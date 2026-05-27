<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', config('app.name', 'Laravel Minimal'))</title>

        <style>
            :root {
                color-scheme: light;
                --paper: #f7f1e8;
                --panel: #fffaf4;
                --ink: #1f2933;
                --muted: #66717d;
                --accent: #c66b3d;
                --accent-dark: #8f4624;
                --border: #e4d5c1;
                --success-bg: #eaf5e8;
                --success-text: #2f5d37;
                --danger-bg: #fbe9e7;
                --danger-text: #8c2f1b;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                background:
                    radial-gradient(circle at top left, rgba(198, 107, 61, 0.18), transparent 30%),
                    linear-gradient(180deg, #fbf6ef 0%, var(--paper) 100%);
                color: var(--ink);
                font-family: Georgia, 'Times New Roman', serif;
            }

            a {
                color: inherit;
            }

            main {
                width: min(960px, calc(100% - 2rem));
                margin: 0 auto;
                padding: 3rem 0 4rem;
            }

            .hero {
                display: grid;
                gap: 1.5rem;
                margin-bottom: 2rem;
            }

            .topbar {
                display: flex;
                align-items: center;
                justify-content: flex-end;
                gap: 0.75rem;
                margin-bottom: 1.5rem;
            }

            .topbar form {
                margin: 0;
            }

            .topbar a,
            .topbar button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-height: 42px;
                padding: 0.7rem 1rem;
                border-radius: 999px;
                border: 1px solid var(--border);
                background: rgba(255, 250, 244, 0.8);
                color: var(--ink);
                text-decoration: none;
            }

            .topbar button {
                background: transparent;
            }

            .topbar strong {
                font-size: 0.95rem;
                font-weight: 600;
            }

            .eyebrow {
                margin: 0;
                letter-spacing: 0.18em;
                text-transform: uppercase;
                font-size: 0.8rem;
                color: var(--accent-dark);
            }

            h1 {
                margin: 0;
                font-size: clamp(2.4rem, 4vw, 4rem);
                line-height: 1;
                max-width: 12ch;
            }

            .lede {
                margin: 0;
                max-width: 48rem;
                color: var(--muted);
                font-size: 1.05rem;
                line-height: 1.7;
            }

            .stats {
                display: inline-flex;
                align-items: baseline;
                gap: 0.65rem;
                width: fit-content;
                padding: 0.85rem 1rem;
                border: 1px solid var(--border);
                border-radius: 999px;
                background: rgba(255, 250, 244, 0.8);
            }

            .stats strong {
                font-size: 1.4rem;
            }

            .layout {
                display: grid;
                gap: 1.5rem;
                grid-template-columns: minmax(0, 340px) minmax(0, 1fr);
            }

            .panel {
                padding: 1.5rem;
                border: 1px solid var(--border);
                border-radius: 24px;
                background: var(--panel);
                box-shadow: 0 14px 40px rgba(31, 41, 51, 0.08);
            }

            .panel h2 {
                margin: 0 0 0.5rem;
                font-size: 1.4rem;
            }

            .panel p {
                margin: 0 0 1.25rem;
                color: var(--muted);
                line-height: 1.6;
            }

            .stack {
                display: grid;
                gap: 1rem;
            }

            label {
                display: grid;
                gap: 0.4rem;
                font-size: 0.95rem;
                color: var(--muted);
            }

            input {
                width: 100%;
                padding: 0.85rem 1rem;
                border: 1px solid var(--border);
                border-radius: 14px;
                background: #fff;
                color: var(--ink);
                font: inherit;
            }

            input:focus {
                outline: 2px solid rgba(198, 107, 61, 0.25);
                outline-offset: 2px;
                border-color: var(--accent);
            }

            button {
                border: 0;
                border-radius: 999px;
                padding: 0.95rem 1.2rem;
                background: var(--accent);
                color: #fff;
                font: inherit;
                cursor: pointer;
                transition: background 0.2s ease;
            }

            button:hover {
                background: var(--accent-dark);
            }

            .flash,
            .errors {
                padding: 0.9rem 1rem;
                border-radius: 16px;
                margin-bottom: 1rem;
            }

            .flash {
                background: var(--success-bg);
                color: var(--success-text);
            }

            .errors {
                background: var(--danger-bg);
                color: var(--danger-text);
            }

            .errors ul {
                margin: 0;
                padding-left: 1.25rem;
            }

            .list {
                display: grid;
                gap: 0.9rem;
            }

            .row {
                display: grid;
                gap: 0.2rem;
                padding: 1rem;
                border: 1px solid var(--border);
                border-radius: 18px;
                background: #fff;
            }

            .row strong {
                font-size: 1.1rem;
            }

            .meta {
                color: var(--muted);
                font-size: 0.95rem;
            }

            .empty {
                padding: 2rem;
                border: 1px dashed var(--border);
                border-radius: 18px;
                text-align: center;
                color: var(--muted);
                background: rgba(255, 255, 255, 0.65);
            }

            @media (max-width: 780px) {
                main {
                    width: min(100%, calc(100% - 1rem));
                    padding-top: 1.25rem;
                }

                .layout {
                    grid-template-columns: 1fr;
                }

                .panel {
                    padding: 1.25rem;
                }
            }
        </style>
    </head>
    <body>
        <main>
            <div class="topbar">
                @auth
                    <strong>{{ auth()->user()->name }}</strong>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                @endauth
            </div>

            @yield('content')
        </main>
    </body>
</html>