<?php
$host = "localhost";
$username = "root"; 
$password = ""; 
$database = "test";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$bookings_query = "SELECT bookings.booking_id, bookings.name, bookings.phoneno, bookings.date, bookings.services, bookings.packages, bookings.slot, bookings.status, users.fullname, users.email
                   FROM bookings
                   JOIN users ON bookings.user_username = users.username"; 
$bookings_result = $conn->query($bookings_query);

if (isset($_POST['update_status'])) {
    $booking_id = $_POST['booking_id'];
    $status = $_POST['status'];
    $update_query = "UPDATE bookings SET status = '$status' WHERE booking_id = $booking_id";
    $conn->query($update_query);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings - Admin Dashboard</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #7a0080;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
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
        <h1>Bookings List</h1>
        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Services</th>
                    <th>Packages</th>
                    <th>Slot</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($bookings_result->num_rows > 0) {
                    while ($row = $bookings_result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['booking_id'] . "</td>
                                <td>" . $row['fullname'] . "</td>
                                <td>" . $row['email'] . "</td>
                                <td>" . $row['phoneno'] . "</td>
                                <td>" . $row['services'] . "</td>
                                <td>" . $row['packages'] . "</td>
                                <td>" . $row['slot'] . "</td>
                                <td>" . $row['date'] . "</td>
                                <td>" . ucfirst($row['status']) . "</td>
                                <td>
                                    <form method='POST' action=''>
                                        <input type='hidden' name='booking_id' value='" . $row['booking_id'] . "' />
                                        <select name='status'>
                                            <option value='active'" . ($row['status'] == 'active' ? ' selected' : '') . ">Active</option>
                                            <option value='completed'" . ($row['status'] == 'completed' ? ' selected' : '') . ">Completed</option>
                                        </select>
                                        <button type='submit' name='update_status'>Update</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No bookings available</td></tr>";
                }
                ?>
            </tbody>
        </table>
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
// Close database connection
$conn->close();
?>
