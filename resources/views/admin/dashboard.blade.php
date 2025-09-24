<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        .header {
            background: #2c3e50;
            color: #fff;
            padding: 15px;
            text-align: center;
        }
        .container {
            margin: 30px auto;
            max-width: 800px;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 {
            margin-bottom: 15px;
            color: #2c3e50;
        }
        p {
            font-size: 16px;
            color: #555;
        }
        .logout-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #e74c3c;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout-btn:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Admin Panel</h2>
    </div>

    <div class="container">
        <h1>Welcome, Admin!</h1>
        <p>You are now logged in to the admin dashboard.</p>

        <!-- Logout form -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>
