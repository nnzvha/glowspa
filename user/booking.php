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

$error_message = "";

if (!isset($_SESSION['username'])) {
    die("Access denied. Please <a href='login.php'>log in</a> to continue.");
}

$user_username = $_SESSION['username'];

$user_check = $conn->prepare("SELECT username FROM users WHERE username = ?");
$user_check->bind_param("s", $user_username);
$user_check->execute();
$user_check_result = $user_check->get_result();

if ($user_check_result->num_rows == 0) {
    die("User does not exist. Please <a href='login.php'>log in</a> again.");
}

$user_check->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phoneno = $_POST['phoneno'];
    $date = $_POST['date'];
    $services = $_POST['services'];
    $packages = $_POST['packages'];
    $slot = $_POST['slot'];
    $status = 'active';  

    $stmt = $conn->prepare("INSERT INTO bookings (user_username, name, phoneno, date, services, packages, slot, status) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $user_username, $name, $phoneno, $date, $services, $packages, $slot, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Booking successfully made!'); window.location.href='history.php';</script>";
    } else {
        $error_message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
  
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        body, h1, h2, h3, h4, h5, h6 {
            font-family: "Raleway", Arial, Helvetica, sans-serif;
        }

        body {
            background: url('./image/bg1.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
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

        .header {
            text-align: center;
            padding: 50px;
            background: rgba(255, 255, 255, 0.8);
            margin-bottom: 20px;
        }

        .reservation-container {
            max-width: 600px;
            margin: auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.8);
            outline: none;
        }

        .btn-submit {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #45a049;
        }

        .text-center {
            text-align: center;
            margin-top: 20px;
        }

        footer {
            margin-top: 50px;
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

    <div class="header">
        <h1>Booking Page</h1>
        <p>Please fill in the details to complete your booking</p>
    </div>

    <div class="reservation-container">
        <h1 class="text-center">Book Now!</h1>

        <?php
        if (!empty($error_message)) {
            echo '<div class="alert alert-danger">' . $error_message . '</div>';
        }
        ?>

        <form action="booking.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
            </div>

            <div class="form-group">
                <label for="phoneno">Phone Number:</label>
                <input type="tel" id="phoneno" name="phoneno" class="form-control" placeholder="Enter your phone number" required>
            </div>

            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="services">Services:</label>
                <select id="services" name="services" class="form-control" required>
                    <option value="">-- Select Service --</option>
                    <option value="Full Body Massage Therapy">Full Body Massage Therapy</option>
                    <option value="Facial Treatment">Facial Treatment</option>
                    <option value="Head, Neck & Shoulder Massage">Head, Neck & Shoulder Massage</option>
                    <option value="Not selected">Not selected</option>
                </select>
            </div>

            <div class="form-group">
                <label for="packages">Packages:</label>
                <select id="packages" name="packages" class="form-control" required>
                    <option value="">-- Select Package --</option>
                    <option value="Relaxation Package">Relaxation Package</option>
                    <option value="Luxury Indulgence Package">Luxury Indulgence Package</option>
                    <option value="Glow Essentials Package">Glow Essentials Package</option>
                    <option value="Not selected">Not selected</option>
                </select>
            </div>

            <div class="form-group">
                <label for="slot">Slot:</label>
                <select id="slot" name="slot" class="form-control" required>
                    <option value="">-- Select Slot --</option>
                    <option value="1">10am~11am (Slot 1)</option>
                    <option value="2">11am~12pm (Slot 2)</option>
                    <option value="3">12pm~1pm (Slot 3)</option>
                    <option value="4">2pm~3pm (Slot 4)</option>
                    <option value="5">3pm~4pm (Slot 5)</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn-submit">Submit</button>
            </div>
        </form>
    </div>

    <footer class="w3-padding-32 w3-black w3-center">
        <h5>Find Us On</h5>
        <div class="w3-xlarge">
            <i class="fa fa-facebook-official w3-hover-opacity"></i>
            <i class="fa fa-instagram w3-hover-opacity"></i>
            <i class="fa fa-twitter w3-hover-opacity"></i>
            <i class="fa fa-linkedin w3-hover-opacity"></i>
        </div>
        <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank" class="w3-hover-text-green">w3.css</a></p>
    </footer>
</body>
</html>
