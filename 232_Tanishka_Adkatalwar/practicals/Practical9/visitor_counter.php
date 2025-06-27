<?php
$counter_file = 'visitor_count.txt';

function getVisitorCount() {
    global $counter_file;
    return file_exists($counter_file) ? (int)file_get_contents($counter_file) : 0;
}

function incrementVisitorCount() {
    global $counter_file;
    $count = getVisitorCount() + 1;
    file_put_contents($counter_file, $count);
    return $count;
}

function resetVisitorCount() {
    global $counter_file;
    file_put_contents($counter_file, 0);
    return 0;
}

if (isset($_POST['reset'])) {
    $visitor_count = resetVisitorCount();
    $message = "Visitor count has been reset to zero.";
} else {
    $visitor_count = incrementVisitorCount();
    $message = "";
}

$current_datetime = date('Y-m-d H:i:s');
$visitor_ip = $_SERVER['REMOTE_ADDR'];
$visitor_browser = $_SERVER['HTTP_USER_AGENT'];
$visitor_referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'Direct Visit';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Counter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }
        
        .header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        
        .header h1 {
            margin: 0;
            font-size: 2.5rem;
        }
        
        .header p {
            margin: 0.5rem 0 0;
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .counter-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .counter-value {
            font-size: 5rem;
            font-weight: bold;
            color: #4CAF50;
            margin: 1rem 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .counter-label {
            font-size: 1.5rem;
            color: #666;
            margin-bottom: 1rem;
        }
        
        .visitor-info {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .visitor-info h2 {
            color: #4CAF50;
            margin-top: 0;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 0.5rem;
        }
        
        .info-item {
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .info-label {
            font-weight: bold;
            color: #555;
        }
        
        .reset-form {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .reset-button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }
        
        .message {
            background-color: #ffebee;
            color: #c62828;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            text-align: center;
            display: <?php echo empty($message) ? 'none' : 'block'; ?>;
        }
        
        .footer {
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
            color: #666;
            font-size: 0.9rem;
        }
        
        @media (max-width: 600px) {
            .header h1 {
                font-size: 2rem;
            }
            
            .counter-value {
                font-size: 3.5rem;
            }
            
            .counter-label {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Visitor Counter</h1>
        <p>Tracking the number of visitors to this webpage</p>
    </div>
    
    <div class="container">
        <div class="message"><?php echo $message; ?></div>
        
        <div class="counter-card">
            <div class="counter-label">Total Visitors</div>
            <div class="counter-value"><?php echo $visitor_count; ?></div>
            <p>Thank you for visiting our website!</p>
        </div>
        
        <div class="visitor-info">
            <h2>Current Visitor Information</h2>
            
            <div class="info-item">
                <div class="info-label">Date and Time:</div>
                <div class="info-value"><?php echo $current_datetime; ?></div>
            </div>
            
            <div class="info-item">
                <div class="info-label">IP Address:</div>
                <div class="info-value"><?php echo $visitor_ip; ?></div>
            </div>
            
            <div class="info-item">
                <div class="info-label">Browser:</div>
                <div class="info-value"><?php echo htmlspecialchars($visitor_browser); ?></div>
            </div>
            
            <div class="info-item">
                <div class="info-label">Referrer:</div>
                <div class="info-value"><?php echo htmlspecialchars($visitor_referrer); ?></div>
            </div>
        </div>
        
        <form method="post" class="reset-form">
            <button type="submit" name="reset" class="reset-button">Reset Visitor Count</button>
        </form>
        
    
    <div class="footer">
        <p>&copy; <?php echo date('Y'); ?> Visitor Counter. All rights reserved.</p>
    </div>
</body>
</html>