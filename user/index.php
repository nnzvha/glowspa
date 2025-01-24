<?php
$host = "localhost";
$username = "root"; 
$password = ""; 
$database = "test";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$total_admins_query = "SELECT COUNT(*) AS total_admins FROM admin";
$total_bookings_query = "SELECT COUNT(*) AS total_bookings FROM bookings";
$total_messages_query = "SELECT COUNT(*) AS total_messages FROM messages";

$total_admins_result = $conn->query($total_admins_query)->fetch_assoc();
$total_bookings_result = $conn->query($total_bookings_query)->fetch_assoc();
$total_messages_result = $conn->query($total_messages_query)->fetch_assoc();

$total_admins = $total_admins_result['total_admins'];
$total_bookings = $total_bookings_result['total_bookings'];
$total_messages = $total_messages_result['total_messages'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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

        .dashboard-cards {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .card {
            background-color: lavender;
            border: 1px solid purple;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            min-width: 200px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            margin: 0 0 10px;
        }

        .card p {
            font-size: 24px;
            font-weight: bold;
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
        <h1>Welcome, Admin!</h1>
        <div class="dashboard-cards">
            <div class="card">
                <h3>Total Admins</h3>
                <p><?php echo $total_admins; ?></p>
            </div>
            <div class="card">
                <h3>Total Bookings</h3>
                <p><?php echo $total_bookings; ?></p>
            </div>
            <div class="card">
                <h3>Total Messages</h3>
                <p><?php echo $total_messages; ?></p>
            </div>
        </div>
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
