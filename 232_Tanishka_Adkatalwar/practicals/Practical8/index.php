<?php
session_start();

$error_message = "";
$success_message = "";

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        $error_message = "Please enter both username and password";
    } else {
        $valid_users = [
            'admin' => 'admin123',
            'user1' => 'password123',
            'student' => 'student123'
        ];
        
        if (array_key_exists($username, $valid_users) && $valid_users[$username] === $password) {
            $_SESSION['user'] = $username;
            $_SESSION['login_time'] = date('Y-m-d H:i:s');
            
            header("Location: dashboard.php");
            exit();
        } else {
            $error_message = "Invalid username or password";
        }
    }
}

if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            padding: 30px;
        }
        
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        
        .btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .note {
            margin-top: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        
        .note p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sign In</h1>
        
        <?php if (!empty($error_message)): ?>
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($success_message)): ?>
            <div class="success-message">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>
        
        <form method="post" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" name="login" class="btn">Sign In</button>
        </form>
        
        <div class="note">
            <p>For demonstration purposes, you can use:</p>
            <p><strong>Username:</strong> admin | <strong>Password:</strong> admin123</p>
            <p><strong>Username:</strong> user1 | <strong>Password:</strong> password123</p>
            <p><strong>Username:</strong> student | <strong>Password:</strong> student123</p>
        </div>
    </div>
</body>
</html>