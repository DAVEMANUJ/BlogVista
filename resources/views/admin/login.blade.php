<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background: #e5eefc; display: grid; place-items: center; min-height: 100vh; }
        .card { width: min(420px, 92vw); background: #fff; padding: 2rem; border-radius: 16px; box-shadow: 0 15px 35px rgba(15, 23, 42, 0.12); }
        input { width: 100%; padding: 0.8rem; margin-top: 0.4rem; margin-bottom: 1rem; border: 1px solid #d1d5db; border-radius: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 0.85rem; background: #2563eb; color: #fff; border: 0; border-radius: 8px; cursor: pointer; }
        .error { color: #dc2626; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Admin Login</h1>
        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
