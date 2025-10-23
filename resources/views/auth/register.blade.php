<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="{{ asset('css/regis.css') }}">
    <title>Register</title>
</head>
<body>
    <header>
    </header>
    <main>
        <div class="form-container">
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color:red">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h1 class="title">Register</h1>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}">
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password">
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation">
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role">
                        <option value="">-- Pilih Role --</option>
                        <option name="Guru" value="guru">Guru</option>
                        <option Name="Siswa" value="siswa">Siswa</option>
                    </select>
                </div>
                <button type="submit" class="btn">Submit</button>
                <div class="regis">
                <p>Sudah punya akun? <a href="{{ route('login') }}">login sekarang</a></p>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
