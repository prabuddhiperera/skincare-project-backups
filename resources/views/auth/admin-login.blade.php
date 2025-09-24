<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f8f8; }
        .login-container { width: 400px; margin: 100px auto; padding: 30px; background: white; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input { width: 100%; padding: 10px; margin: 10px 0; }
        button { width: 100%; padding: 10px; background: #333; color: white; border: none; cursor: pointer; }
        button:hover { background: #555; }
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Admin Login</h2>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <input type="text" name="name" placeholder="Admin Name" required>
        <input type="password" name="password" placeholder="Password" required>
        <label>
            <input type="checkbox" name="remember"> Remember Me
        </label>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
