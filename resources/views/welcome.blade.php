
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #ffffffff;
            padding: 40px;
        }

        .card {
            background: #ffffff;
            max-width: 500px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            align-items: center;
            justify-content: center;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .info-group {
            margin-bottom: 20px;
        }

        .info-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .value {
            background: #fdf4e3;
            padding: 10px;
            border-radius: 5px;
            color: #000000ff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .toggle-btn {
            background: none;
            border: none;
            color: #333;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="card">
        <a href="{{ route('logout') }}">logout</a>
        <h2>Selamat Datang, {{ $user['name'] }}</h2>

        <div class="info-group">
            <label>Username:</label>
            <div class="value"><?php echo $user['name']; ?></div>
        </div>

        <div class="info-group">
            <label>Email:</label>
            <div class="value"><?php echo $user['email']; ?></div>
        </div>

        
    </div>

   

</body>
</html>
