<!DOCTYPE html>
<html lang="en" data-theme="cupcake">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Sistem Perpustakaan</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <div class="text-center lg:text-left">
                <h1 class="text-5xl font-bold">Sistem Perpustakaan</h1>
                <p class="py-6">Silakan login untuk melanjutkan.</p>
            </div>
            <div class="card shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                <form class="card-body" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nama User</span>
                        </label>
                        <input type="text" name="nama_user" placeholder="Nama User" class="input input-bordered" value="{{ old('nama_user') }}" required autofocus />
                        @error('nama_user')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" name="password" placeholder="password" class="input input-bordered" required />
                    </div>
                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
