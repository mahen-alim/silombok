<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Reset Password</h2>
                
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ request()->email }}" required readonly>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>

                    @if ($errors->any())
                        <div class="text-danger mb-3">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary w-100">Ganti Password</button>
                </form>
                
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-decoration-none">Kembali ke Login</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>