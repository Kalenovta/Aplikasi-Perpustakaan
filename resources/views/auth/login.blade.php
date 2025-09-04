<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Login</title>
</head>
<body>
    <header>
        <nav>
            
        </nav>
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
              <h1 class="title">Login</h1>
            <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="name">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password">
                </div>
                <button type="submit" class="btn">submit</button>
                <div class="regis">
                <p>Belum punya akun? <a href="{{ route('register') }}">register sekarang</a></p>
                </div>
            </form>
        </div>
    </main>
</body>
</html>