<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SiDesa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Nunito:wght@800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1A56DB;
            --bg-banner: linear-gradient(135deg, #1A56DB 0%, #0EA5E9 100%);
            --bg-card: #FFFFFF;
            --text: #1E293B;
            --text-muted: #64748B;
            --radius: 12px;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: var(--bg-banner);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background: var(--bg-card);
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: var(--radius);
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
            text-align: center;
        }

        .login-logo { font-size: 3rem; margin-bottom: 10px; }
        h2 { font-family: 'Nunito', sans-serif; color: var(--text); margin-bottom: 8px; }
        p { color: var(--text-muted); font-size: 0.9rem; margin-bottom: 24px; }

        .form-group { text-align: left; margin-bottom: 15px; }
        label { display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 5px; color: var(--text-muted); }
        input { 
            width: 100%; padding: 12px; border: 1.5px solid #D1D9EF; 
            border-radius: 8px; box-sizing: border-box; font-family: inherit;
        }
        
        .btn-login {
            width: 100%; padding: 12px; background: var(--primary); color: #fff;
            border: none; border-radius: 8px; font-weight: 700; font-size: 1rem;
            cursor: pointer; transition: all 0.3s; margin-top: 10px;
        }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(26,86,219,0.3); }
        
        .error-msg { color: #EF4444; font-size: 0.85rem; margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-logo">🏥</div>
    <h2>SiDesa</h2>
    <p>Masuk untuk mengelola data warga</p>

    <?php
    // Logika login sederhana menggunakan PHP
    if (isset($_POST['login'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];

        if ($user === 'sistem informasi' && $pass === '124') {
            header("Location: index.php"); // Pindah ke dashboard jika sukses
            exit();
        } else {
            echo "<div class='error-msg'>Username atau Password salah!</div>";
        }
    }
    ?>

    <form action="" method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="admin" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="••••••••" required>
        </div>
        <button type="submit" name="login" class="btn-login">Masuk ke Sistem</button>
    </form>
</div>

</body>
</html>
