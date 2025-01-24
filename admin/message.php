<?php

$host = "localhost";
$username = "root"; 
$password = ""; 
$database = "test";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$messages_query = "SELECT username, message FROM messages";
$messages_result = $conn->query($messages_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages - Admin Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
        }

        .header {
            display: flex;
            align-items: center;
            background-color: #7a0080;
            color: white;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .menu-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            margin-right: 10px;
        }

        .menu-toggle:hover {
            color: #ddd;
        }

        .header h1 {
            font-size: 20px;
            margin: 0;
            font-weight: bold;
        }

        .sidebar {
            width: 250px;
            background-color: #7a0080;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            padding-top: 60px;
            transition: transform 0.3s ease;
            z-index: 999;
            overflow: hidden;
        }

        .sidebar.hidden {
            transform: translateX(-250px);
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 10px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar ul li:hover {
            background-color: #9d00a6;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: white;
            display: block;
        }

        .main-content {
            margin-left: 250px;
            margin-top: 60px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .main-content.collapsed {
            margin-left: 0;
        }

        .main-content h1 {
            text-align: center;
            color: #7a0080;
            margin-bottom: 20px;
        }

        .message-box {
            background-color: #f4f4f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .message-box h3 {
            margin: 0 0 10px;
            color: #7a0080;
        }

        .message-box p {
            font-size: 16px;
            color: #333;
        }

    </style>
</head>
<body>
    <div class="header">
        <button class="menu-toggle">☰</button>
        <h1>GlowSpa Admin</h1>
    </div>
    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="admins.php">Admins</a></li>
            <li><a href="bookings.php">Bookings</a></li>
			<li><a href="slots_management.php">Service Slots</a></li>
            <li><a href="package.php">Package Slots</a></li>
            <li><a href="message.php">Messages</a></li>
            <li><a href="logouts.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content" id="main-content">
        <h1>Messages</h1>
        <?php
        if ($messages_result->num_rows > 0) {
            while ($row = $messages_result->fetch_assoc()) {
                echo "<div class='message-box'>
                        <h3>Message from: " . $row['username'] . "</h3>
                        <p>" . $row['message'] . "</p>
                      </div>";
            }
        } else {
            echo "<p>No messages available.</p>";
        }
        ?>
    </div>
    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
            mainContent.classList.toggle('collapsed');
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>