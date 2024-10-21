<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procurement App</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8fafc;
            margin: 0;
            font-family: 'Nunito', sans-serif;
        }

        .container {
            text-align: center;
        }

        .header-buttons {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .header-buttons a {
            margin-right: 10px;
            padding: 10px 20px;
            background-color: #1f2937;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .header-buttons a:hover {
            background-color: #4b5563;
        }

        h1 {
            font-size: 48px;
            font-weight: bold;
            color: #374151;
        }
    </style>
</head>

<body>
    <!-- Header with Login and Register Buttons -->
    <div class="header-buttons">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 left-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/suppliers') }}">Go to Suppliers List</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <div class="container">
        <h1>Welcome to procurement app</h1>
    </div>
</body>

</html>
