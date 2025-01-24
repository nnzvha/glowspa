<?php
session_start();

$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "test"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['username'])) {
    header("Location: adminlogin.php");
    exit();
}

if (isset($_GET['delete_admin_id'])) {
    $admin_id = $_GET['delete_admin_id'];

    $delete_stmt = $conn->prepare("DELETE FROM admin WHERE admin_id = ?");
    $delete_stmt->bind_param("i", $admin_id);

    if ($delete_stmt->execute()) {
        echo "<script>alert('Admin deleted successfully!'); window.location.href='admins.php';</script>";
    } else {
        echo "Error: " . $delete_stmt->error;
    }

    $delete_stmt->close();
}

if (isset($_POST['edit_admin_id'])) {
    $admin_id = $_POST['edit_admin_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $update_stmt = $conn->prepare("UPDATE admin SET username = ?, email = ? WHERE admin_id = ?");
    $update_stmt->bind_param("ssi", $username, $email, $admin_id);

    if ($update_stmt->execute()) {
        echo "<script>alert('Admin details updated successfully!'); window.location.href='admins.php';</script>";
    } else {
        echo "Error: " . $update_stmt->error;
    }

    $update_stmt->close();
}

$sql = "SELECT admin_id, username, email FROM admin ORDER BY admin_id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin List</title>
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
        }

        th, td {
            text-align: left;
            padding: 12px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-edit {
            background-color: #5cb85c;
        }

        .btn-edit:hover {
            background-color: #4cae4c;
        }

        .btn-delete {
            background-color: #d9534f;
        }

        .btn-delete:hover {
            background-color: #c9302c;
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
    <h1>Admin List</h1>
    <table>
        <thead>
            <tr>
                <th>Admin ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['admin_id']); ?></td>
                        <td>
                            <form action="" method="POST" class="form-inline">
                                <input type="text" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" class="form-control" required>
                        </td>
                        <td>
                                <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" class="form-control" required>
                        </td>
                        <td class="action-buttons">
                            <input type="hidden" name="edit_admin_id" value="<?php echo $row['admin_id']; ?>">
                            <button type="submit" class="btn btn-edit">Save</button>
                            <a href="?delete_admin_id=<?php echo $row['admin_id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this admin?');">Delete</a>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No admins found.</td>
                </tr>
            <?php endif; ?>
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

<?php $conn->close(); ?>

</body>
</html>
