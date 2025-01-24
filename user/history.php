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
    header("Location: login.php");
    exit();
}

$logged_in_username = $_SESSION['username'];

if (isset($_GET['cancel_booking_id'])) {
    $cancel_booking_id = $_GET['cancel_booking_id'];

    $delete_stmt = $conn->prepare("DELETE FROM bookings WHERE booking_id = ? AND user_username = ? AND status = 'active'");
    $delete_stmt->bind_param("is", $cancel_booking_id, $logged_in_username);

    if ($delete_stmt->execute()) {
        echo "<script>alert('Booking canceled successfully!'); window.location.href='history.php';</script>";
    } else {
        echo "Error: " . $delete_stmt->error;
    }

    $delete_stmt->close();
}

$select_stmt = $conn->prepare("SELECT * FROM bookings WHERE user_username = ? ORDER BY created DESC");
$select_stmt->bind_param("s", $logged_in_username);
$select_stmt->execute();
$result = $select_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Booking Page</title>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        body, h1, h2, h3, h4, h5, h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
        body {
            background: url('./image/bg1.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .topnav {
            display: flex;
            align-items: center;
            background-color: rgba(51, 51, 51, 0.8);
            padding: 10px;
        }
        .topnav img {
            width: 80px;
            margin-right: 10px;
        }
        .topnav a {
            color: #f2f2f2;
            text-decoration: none;
            padding: 14px 16px;
            font-size: 17px;
        }
        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 20px auto;
        }
        h1 {
            text-align: center;
            color: #444;
            margin-bottom: 30px;
        }
        .table-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .table-row {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background: #fff;
        }
        .table-row p {
            margin: 8px 0;
            font-size: 14px;
            line-height: 1.6;
        }
        .table-row p strong {
            color: #555;
        }
        .cancel-button {
            display: inline-block;
            margin-top: 10px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .cancel-button:hover {
            background-color: #c0392b;
        }
        .status-completed {
            color: green;
            font-weight: bold;
        }
        .status-active {
            color: orange;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .service, .package {
                flex: 1 1 100%;
                max-width: 100%;
            }

            .topnav {
                flex-direction: column;
                align-items: flex-start;
            }

            .topnav a {
                padding: 10px;
                font-size: 16px;
            }
    </style>
</head>
<body>
      <div class="topnav">
        <img class="logo_image" src="./image/logow.png" alt="Logo" width="12%" height="12%">
        <a href="homepage.php">Home</a>
        <a href="catalogue.php">Catalogue</a>
        <a href="slot.php">Available Slot</a>
        <a href="booking.php">Reservation</a>        
        <a href="history.php">My bookings</a>
        <a href="about.php">About</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="container">
        <h1>Booking History</h1>

        <?php if ($result->num_rows > 0): ?>
            <div class="table-container">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="table-row">
                        <p><strong>Booking ID:</strong> <?php echo htmlspecialchars($row['booking_id']); ?></p>
                        <p><strong>Name:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
                        <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($row['phoneno']); ?></p>
                        <p><strong>Date:</strong> <?php echo htmlspecialchars($row['date']); ?></p>
                        <p><strong>Service:</strong> <?php echo htmlspecialchars($row['services']); ?></p>
                        <p><strong>Package:</strong> <?php echo htmlspecialchars($row['packages']); ?></p>
                        <p><strong>Slot:</strong> <?php echo htmlspecialchars($row['slot']); ?></p>
                        <p><strong>Booking Time:</strong> <?php echo htmlspecialchars($row['created']); ?></p>
                        <p><strong>Status:</strong> 
                            <span class="<?php echo $row['status'] == 'completed' ? 'status-completed' : 'status-active'; ?>">
                                <?php echo ucfirst($row['status']); ?>
                            </span>
                        </p>
                        <?php if ($row['status'] == 'active'): ?>
                            <a href="?cancel_booking_id=<?php echo $row['booking_id']; ?>" class="cancel-button">Cancel</a>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>No bookings found.</p>
        <?php endif; ?>

        <?php 
        $select_stmt->close();
        $conn->close(); 
        ?>
    </div>

</body>
</html>
