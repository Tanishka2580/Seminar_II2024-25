<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['logout'])) {
    $username = $_SESSION['user'];
    $login_time = $_SESSION['login_time'];
    $logout_time = date('Y-m-d H:i:s');
    
    $login_timestamp = strtotime($login_time);
    $logout_timestamp = strtotime($logout_time);
    $session_duration = $logout_timestamp - $login_timestamp;
    
    $hours = floor($session_duration / 3600);
    $minutes = floor(($session_duration % 3600) / 60);
    $seconds = $session_duration % 60;
    $duration_formatted = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    
    session_destroy();
    
    session_start();
    $_SESSION['logout_message'] = "You have been successfully logged out. Your session lasted for $duration_formatted.";
    $_SESSION['username'] = $username;
    
    header("Location: index.php");
    exit();
}

$username = $_SESSION['user'];
$login_time = $_SESSION['login_time'];
$current_time = date('Y-m-d H:i:s');

$login_timestamp = strtotime($login_time);
$current_timestamp = strtotime($current_time);
$session_duration = $current_timestamp - $login_timestamp;

$hours = floor($session_duration / 3600);
$minutes = floor(($session_duration % 3600) / 60);
$seconds = $session_duration % 60;
$duration_formatted = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        .header {
            background-color: #333;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-avatar {
            background-color: #4CAF50;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            margin-right: 10px;
        }
        
        .logout-form {
            margin-left: 15px;
        }
        
        .logout-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        
        .welcome-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .welcome-card h2 {
            color: #333;
            margin-top: 0;
        }
        
        .session-info {
            background-color: #e8f5e9;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .session-info h3 {
            color: #2e7d32;
            margin-top: 0;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 15px;
        }
        
        .info-item {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        
        .info-item h3 {
            color: #333;
            margin-top: 0;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        
        .info-value {
            font-size: 18px;
            color: #4CAF50;
            font-weight: bold;
        }
        
        .clock {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin: 20px 0;
            font-family: 'Courier New', monospace;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Dashboard</h1>
        
        <div class="user-info">
            <div class="user-avatar">
                <?php echo strtoupper(substr($username, 0, 1)); ?>
            </div>
            <span><?php echo htmlspecialchars($username); ?></span>
            
            <form method="post" action="" class="logout-form">
                <button type="submit" name="logout" class="logout-btn">Sign Out</button>
            </form>
        </div>
    </div>
    
    <div class="container">
        <div class="welcome-card">
            <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
            <p>You are now signed in to your account. This is your personal dashboard.</p>
        </div>
        
        <div class="session-info">
            <h3>Current Session Information</h3>
            <p><strong>Login Time:</strong> <?php echo $login_time; ?></p>
            <p><strong>Current Time:</strong> <span id="current-time"><?php echo $current_time; ?></span></p>
            <p><strong>Session Duration:</strong> <span id="session-duration"><?php echo $duration_formatted; ?></span></p>
        </div>
        
        <div class="info-grid">
            <div class="info-item">
                <h3>User Profile</h3>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
                <p><strong>Role:</strong> <?php echo ($username === 'admin') ? 'Administrator' : 'Regular User'; ?></p>
                <p><strong>Last Login:</strong> <?php echo $login_time; ?></p>
            </div>
            
            <div class="info-item">
                <h3>System Information</h3>
                <p><strong>PHP Version:</strong> <?php echo phpversion(); ?></p>
                <p><strong>Server:</strong> <?php echo $_SERVER['SERVER_SOFTWARE']; ?></p>
                <p><strong>Client IP:</strong> <?php echo $_SERVER['REMOTE_ADDR']; ?></p>
            </div>
            
            <div class="info-item">
                <h3>Digital Clock</h3>
                <div class="clock" id="clock"></div>
            </div>
        </div>
    </div>
    
    <script>
        function updateTime() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            
            document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
            
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            document.getElementById('current-time').textContent = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            
            const loginTime = new Date('<?php echo $login_time; ?>').getTime();
            const currentTime = now.getTime();
            const durationMs = currentTime - loginTime;
            
            const durationSec = Math.floor(durationMs / 1000);
            const durationHours = Math.floor(durationSec / 3600);
            const durationMinutes = Math.floor((durationSec % 3600) / 60);
            const durationSeconds = durationSec % 60;
            
            const formattedDuration = 
                String(durationHours).padStart(2, '0') + ':' +
                String(durationMinutes).padStart(2, '0') + ':' +
                String(durationSeconds).padStart(2, '0');
            
            document.getElementById('session-duration').textContent = formattedDuration;
        }
        
        updateTime();
        setInterval(updateTime, 1000);
    </script>
</body>
</html>