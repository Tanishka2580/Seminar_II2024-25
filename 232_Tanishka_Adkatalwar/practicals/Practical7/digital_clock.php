<?php
header("Content-Type: text/html");
$currentTime = time();
$hours = date("H", $currentTime);
$minutes = date("i", $currentTime);
$seconds = date("s", $currentTime);
$ampm = date("A", $currentTime);
$date = date("l, F j, Y", $currentTime);
$timezone = date_default_timezone_get();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Clock - Server Time</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .container {
            text-align: center;
            padding: 20px;
        }
        
        .clock-container {
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }
        
        .clock {
            font-size: 5rem;
            font-weight: bold;
            color: #fff;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            font-family: 'Courier New', monospace;
        }
        
        .date {
            font-size: 1.5rem;
            color: #ddd;
            margin-top: 10px;
        }
        
        .info {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            color: #333;
            margin-top: 0;
        }
        
        .server-info {
            text-align: left;
            margin-top: 20px;
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #764ba2;
        }
        
        .server-info p {
            margin: 5px 0;
            color: #555;
        }
        
        .refresh-button {
            background-color: #764ba2;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        
        .time-unit {
            display: inline-block;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 0 15px;
            border-radius: 8px;
            margin: 0 5px;
        }
        
        .separator {
            animation: blink 1s infinite;
        }
        
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="clock-container">            
            <div class="clock">
                <span class="time-unit"><?php echo $hours; ?></span>
                <span class="separator">:</span>
                <span class="time-unit"><?php echo $minutes; ?></span>
                <span class="separator">:</span>
                <span class="time-unit"><?php echo $seconds; ?></span>
                <span style="font-size: 2rem; margin-left: 10px;"><?php echo $ampm; ?></span>
            </div>
            
            <div class="date">
                <?php echo $date; ?>
            </div>
        </div>
        
        <div class="info">
            <h1>Server Time Digital Clock</h1>
            <p>This digital clock displays the current time from the server.</p>
            <p>The time is automatically updated when you refresh the page.</p>
            
            <button class="refresh-button" onclick="location.reload();">Refresh Time</button>
            
            <div class="server-info">
                <p><strong>Server Timezone:</strong> <?php echo $timezone; ?></p>
                <p><strong>Server Date & Time:</strong> <?php echo date("Y-m-d H:i:s", $currentTime); ?></p>
                <p><strong>Unix Timestamp:</strong> <?php echo $currentTime; ?></p>
                <p><strong>PHP Version:</strong> <?php echo phpversion(); ?></p>
            </div>
        </div>
    </div>
</body>
</html>