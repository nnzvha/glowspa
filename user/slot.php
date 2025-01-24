<?php
$host = "localhost";
$username = "root"; 
$password = ""; 
$database = "test";

$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_slots = "SELECT * FROM slots";
$result_slots = $conn->query($sql_slots);

$sql_packageslots = "SELECT * FROM packageslots";
$result_packageslots = $conn->query($sql_packageslots);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Slots - GlowSpa Admin</title>
    
    
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
            max-width: 1200px;
            margin: 20px auto;
        }
        h1 {
            text-align: center;
            color: #444;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #7a0080;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
		
		.timetable {
				padding: 30px;
				background: rgba(255, 255, 255, 0.95);
				border-radius: 10px;
				width: 80%;
				margin: 50px auto; /* Center the timetable container */
				text-align: center;
			}

			.timetable h2 {
				margin-bottom: 20px; /* Space between the heading and the table */
			}

			table {
				width: 100%;
				border-collapse: collapse;
				margin: 0 auto; /* Center the table within its container */
			}

			th, td {
				padding: 15px;
				text-align: center; /* Center content horizontally */
				vertical-align: middle; /* Center content vertically */
				border-bottom: 1px solid #ddd;
			}

			th {
				background-color: #8b4513;
				color: white;
			}

			tr {
				display: table-row;
			}

			td {
				text-align: center;
				vertical-align: middle;
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
        <h1>Available Slots</h1>
<section class="timetable">
			<h2>Slots Time</h2>
			<table>
				<tr>
					<th>Time</th>
					<th>Slots</th>
				</tr>
				<tr>
					<td>10:00 AM - 11:00 AM</td>
					<td>Slot 1</td>
				</tr>
				<tr>
					<td>11:00 AM - 12:00 PM</td>
					<td>Slot 2</td>
				</tr>
				<tr>
					<td>12:00 PM - 1:00 PM</td>
					<td>Slot 3</td>
				</tr>
				<tr>
					<td>2:00 PM - 3:00 PM</td>
					<td>Slot 4</td>
				</tr>
				<tr>
					<td>3:00 PM - 4:00 PM</td>
					<td>Slot 5</td>
				</tr>
			</table>

        
        <h2>Service Slots</h2>
        <?php
        if ($result_slots->num_rows > 0) {
           
            echo "<table>";
            echo "<tr><th>ID</th><th>Date</th><th>Service</th><th>Available Slots</th><th>Created At</th></tr>";
            while ($row = $result_slots->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['date'] . "</td>
                        <td>" . $row['service'] . "</td>
                        <td>" . $row['avail_slots'] . "</td>
                        <td>" . $row['created_at'] . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No available slots found in the slots table.</p>";
        }

        
        echo "<h2>Package Slots</h2>";
        if ($result_packageslots->num_rows > 0) {
            
            echo "<table>";
            echo "<tr><th>ID</th><th>Date</th><th>Package</th><th>Available Slots</th><th>Created At</th></tr>";
            while ($row = $result_packageslots->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['package_id'] . "</td>
                        <td>" . $row['date'] . "</td>
                        <td>" . $row['package'] . "</td>
                        <td>" . $row['avail_slots'] . "</td>
                        <td>" . $row['created_at'] . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No available slots found in the packageslots table.</p>";
        }

       
        $conn->close();
        ?>

    </div>

</body>
</html>
