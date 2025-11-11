<?php
session_start();

// cek apakah user sudah login
if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
    header("Location: dashboard.php");
    exit();
}

// Proses login saat form dikirim
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // login sederhana (username: dina, password: 123)
    if ($username === "dina" && $password === "123") {
        // Set session variables
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'mahasiswi';
        $_SESSION['login_time'] = time();
        
        
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
   
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);
    }

    .login-container {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        width: 350px;
        position: relative;
    }

    .user-icon {
        text-align: center;
        margin-bottom: 20px;
    }

    .user-icon i {
        background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);
        color: white;
        font-size: 50px;
        padding: 20px;
        border-radius: 50%;
        box-shadow: 0 5px 15px rgba(255, 154, 158, 0.3);
    }

    h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
        font-weight: 600;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    .input-group {
        margin-bottom: 20px;
        position: relative;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #555;
        font-weight: 500;
    }

    .input-with-icon {
        position: relative;
    }

    .input-with-icon i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #ff9a9e;
        font-size: 18px;
    }

    input {
        width: 100%;
        padding: 12px 12px 12px 45px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
        transition: border 0.3s;
    }

    input:focus {
        outline: none;
        border-color: #ff9a9e;
        box-shadow: 0 0 0 2px rgba(255, 154, 158, 0.2);
    }

    .button-group {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    button {
        flex: 1;
        padding: 12px;
        border: none;
        border-radius: 8px;
        color: white;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    button[name="login"] {
        background-color: #ff6b6b;
    }

    button[name="login"]:hover {
        background-color: #ff5252;
        transform: translateY(-2px);
    }

    button[name="reset"] {
        background-color: #a5a5a5;
    }

    button[name="reset"]:hover {
        background-color: #8a8a8a;
        transform: translateY(-2px);
    }

    .forgot-password {
        text-align: center;
        margin-top: 15px;
    }

    .forgot-password a {
        color: #ff6b6b;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s;
    }

    .forgot-password a:hover {
        text-decoration: underline;
        color: #ff5252;
    }
</style>
<body>
    <div class="login-container">
        <div class="user-icon">
            <i class="fas fa-user-circle"></i>
        </div>
        <h2>Form Login</h2>
        <form method="post">
            <div class="input-group">
                <label for="username">Username</label>
                <div class="input-with-icon">
                    <i class="fas fa-user"></i>
                    <input type="text" id="username" name="username" placeholder="Masukkan username" required>
                </div>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <div class="input-with-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                </div>
            </div>
            <div class="button-group">
                <button type="submit" name="login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
                <button type="reset" name="reset">
                    <i class="fas fa-times"></i> Batal
                </button>
            </div>

            </div>
        </form>
    </div>
</body>
</html>