<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RideOrPay</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <header class="mb-4">
            <h1 class="text-2xl font-bold"><a href="{{ route('goals.index') }}">RideOrPay</a></h1>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="mt-4">
            <p class="text-center text-sm text-gray-600">© {{ date('Y') }} RideOrPay. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>