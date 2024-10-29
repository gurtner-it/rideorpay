<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'RideOrPay')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        nav {
            margin: 0;
            padding: 0;
        }
        nav a {
            color: white;
            margin: 0 1rem;
            text-decoration: none;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .container {
            padding: 2rem;
            max-width: 800px;
            margin: auto;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        footer {
            text-align: center;
            padding: 1rem;
            background-color: #333;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>RideOrPay</h1>
        <nav>
            <a href="{{ route('goals.index') }}">Goals</a>
            <a href="{{ route('goals.create') }}">Add Goal</a>
            <a href="#" onclick="alert('Logout not implemented in MVP!');">Logout</a>
        </nav>
    </header>
    
    <div class="container">
        @yield('content')
    </div>
    
    <footer>
        <p>&copy; {{ date('Y') }} RideOrPay. All rights reserved.</p>
    </footer>
</body>
</html>