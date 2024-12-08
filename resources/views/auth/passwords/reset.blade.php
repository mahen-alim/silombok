<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&family=Sora:wght@100..800&family=Varela+Round&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: "Varela Round", serif;
            margin: 0;
            padding: 0;
        }
    </style>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="main-container flex w-full h-screen">
        <div class="reset-container flex w-1/2 bg-light-green p-5 items-center justify-center">
            <div class="reset-card flex flex-col bg-white p-10 gap-5 rounded-lg h-max items-center shadow-md">
                <img src="{{ asset('img/silombok.png') }}" alt="logo" class="mb-5 w-1/2 h-auto">
                
                <h2 class="text-2xl font-bold">Reset Password</h2>

                @if (session('status'))
                    <div class="alert alert-success w-full p-3 rounded-lg bg-green-200 text-green-800">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="flex flex-col gap-3 w-full" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <input 
                        class="rounded-lg p-3 w-full border-2 border-dark-green" 
                        type="email" 
                        name="email" 
                        value="{{ request()->email }}" 
                        placeholder="Email" 
                        readonly 
                    >
                    
                    <input 
                        class="rounded-lg p-3 w-full border-2 border-dark-green" 
                        type="password" 
                        name="password" 
                        placeholder="Password Baru" 
                        required 
                    >
                    
                    <input 
                        class="rounded-lg p-3 w-full border-2 border-dark-green" 
                        type="password" 
                        name="password_confirmation" 
                        placeholder="Konfirmasi Password Baru" 
                        required 
                    >

                    @if ($errors->any())
                        <div class="text-red-500 w-full">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <button type="submit" class="rounded-lg p-3 w-full bg-dark-green text-white hover:bg-green-700 transition">Reset Password</button>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-decoration-none">Kembali ke Login</a>
                </div>
            </div>
        </div>

        <div class="img-container flex w-1/2">
            <img class="w-full" src="{{ asset('img/cabai.png') }}" alt="cabai">
        </div>
    </div>
</body>
</html>
