<?php

$host = "localhost";
$username = "root"; 
$password = ""; 
$database = "test";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start(); 
$admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : 1; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $date = $conn->real_escape_string($_POST['date']);
    $service = $conn->real_escape_string($_POST['service']);
    $avail_slots = intval($_POST['avail_slots']);
    
    $created_at = date('Y-m-d H:i:s'); 

    $insert_sql = "INSERT INTO slots (admin_id, date, service, avail_slots, created_at) 
                   VALUES ($admin_id, '$date', '$service', $avail_slots, '$created_at')";
    
    if ($conn->query($insert_sql) === TRUE) {
        echo "<script>alert('Slot added successfully!'); window.location.href = 'slots_management.php';</script>";
    } else {
        echo "Error inserting slot: " . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $slot_id = intval($_POST['slot_id']);
    $date = $conn->real_escape_string($_POST['date']);
    $service = $conn->real_escape_string($_POST['service']);
    $avail_slots = intval($_POST['avail_slots']);
    
    $update_sql = "UPDATE slots SET date='$date', service='$service', avail_slots=$avail_slots 
                   WHERE id=$slot_id AND admin_id=$admin_id";
    
    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Slot updated successfully!'); window.location.href = 'slots_management.php';</script>";
    } else {
        echo "Error updating slot: " . $conn->error;
    }
}

if (isset($_GET['delete'])) {
    $slot_id = intval($_GET['delete']);
    $delete_sql = "DELETE FROM slots WHERE id = $slot_id AND admin_id = $admin_id";
    
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Slot deleted successfully!'); window.location.href = 'slots_management.php';</script>";
    } else {
        echo "Error deleting slot: " . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $slot_id = intval($_GET['id']);
    $select_sql = "SELECT * FROM slots WHERE id = $slot_id AND admin_id = $admin_id";
    $slot_result = $conn->query($select_sql);

    if ($slot_result->num_rows > 0) {
        $slot_data = $slot_result->fetch_assoc();
    } else {
        echo "Slot not found.";
        exit;
    }
}

$select_sql = "SELECT * FROM slots WHERE admin_id = $admin_id ORDER BY date ASC";
$slots_result = $conn->query($select_sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Slots - GlowSpa Admin</title>
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

        .form-container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            box-sizing: border-box;
        }

        .form-container label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        .form-container input,
        .form-container select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-container button {
            background-color: #7a0080;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .form-container button:hover {
            background-color: #9d00a6;
        }

        .form-container .cancel {
            background-color: #ccc;
            display: block;
            text-align: center;
            margin-top: 10px;
            padding: 8px;
            border-radius: 4px;
            text-decoration: none;
        }

        .form-container .cancel:hover {
            background-color: #aaa;
        }

        .table-container {
            margin-top: 40px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
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
        <h1><?php echo isset($slot_data) ? 'Edit' : 'Add'; ?> Service Slot</h1>
        <div class="form-container">
            <form action="" method="POST">
                <?php if (isset($slot_data)) { ?>
                    <input type="hidden" name="slot_id" value="<?php echo $slot_data['id']; ?>">
                <?php } ?>
                <label for="date">Date</label>
                <input type="date" name="date" id="date" value="<?php echo isset($slot_data) ? $slot_data['date'] : ''; ?>" required>

                <div class="form-group">
                    <label for="service">Services:</label>
                    <select id="service" name="service" class="form-control" required>
                        <option value="">-- Select Service --</option>
                        <option value="Full Body Massage Therapy" <?php echo (isset($slot_data) && $slot_data['service'] == 'Full Body Massage Therapy') ? 'selected' : ''; ?>>Full Body Massage Therapy</option>
                        <option value="Facial Treatment" <?php echo (isset($slot_data) && $slot_data['service'] == 'Facial Treatment') ? 'selected' : ''; ?>>Facial Treatment</option>
                        <option value="Head, Neck & Shoulder Massage" <?php echo (isset($slot_data) && $slot_data['service'] == 'Head, Neck & Shoulder Massage') ? 'selected' : ''; ?>>Head, Neck & Shoulder Massage</option>
                    </select>
                </div>

                <label for="avail_slots">Available Slots</label>
                <input type="number" name="avail_slots" id="avail_slots" value="<?php echo isset($slot_data) ? $slot_data['avail_slots'] : ''; ?>" required>

                <button type="submit" name="<?php echo isset($slot_data) ? 'update' : 'submit'; ?>"><?php echo isset($slot_data) ? 'Update' : 'Add'; ?> Service Slot</button>
                <a href="slots_management.php" class="cancel">Cancel</a>
            </form>
        </div>

        <div class="table-container">
            <h2>Available Slots</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Service</th>
                        <th>Available Slots</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $slots_result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['service']; ?></td>
                            <td><?php echo $row['avail_slots']; ?></td>
                            <td>
                                <a href="slots_management.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                                <a href="slots_management.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this slot?')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('hidden');
            document.getElementById('main-content').classList.toggle('collapsed');
        });
    </script>
</body>
</html>
