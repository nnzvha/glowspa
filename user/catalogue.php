<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "spa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username']; 
    $message = $conn->real_escape_string($_POST['message']);

  
    $sql = "INSERT INTO messages (username, message) VALUES ('$username', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Message submitted successfully!'); window.location.href='catalogue.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spa Booking System</title>

    <!-- External Stylesheets -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        body, h1, h2, h3, h4, h5, h6 { font-family: "Raleway", Arial, Helvetica, sans-serif }
        body {
            background: url('./image/bg1.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .topnav {
            display: flex;
            align-items: center;
            background-color: rgba(51, 51, 51, 0.8);
            padding: 10px;
            flex-wrap: wrap;
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
        }

        section {
            margin: 40px 0;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 30px;
        }

        section h2 {
            background-color: #8b4513;
            color: white;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin: 0;
        }

        .service-container, .package-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            align-items: stretch;
        }

        .row.equal-height {
            display: flex;
            justify-content: center;
            align-items: stretch;
            gap: 20px;
        }

        .service, .package {
            flex: 1;
            min-width: 280px;
            max-width: 400px;
            margin: 20px;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 10px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .service, .package h3 {
            font-weight: bold;
        }

        .service-list, .package-list {
            background: rgba(255, 255, 255, 0.8);
            padding: 15px;
            border-radius: 10px;
            margin-top: 10px;
            flex-grow: 1;
        }

        .service-list, .package-list ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        .timetable {
            padding: 30px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            width: 80%;
            margin: 50px auto;
            text-align: center;
        }

        .timetable h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }

        th, td {
            padding: 15px;
            text-align: center;
            vertical-align: middle;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #8b4513;
            color: white;
        }

        .comment-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            margin-top: 100px;
            margin-bottom: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            margin: auto;
        }

        .comment-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .comment-container .form-group label {
            font-weight: bold;
            color: #555;
        }

        .comment-container .form-group textarea {
            resize: none;
        }

        .comment-container .btn-submit {
            background-color: #357EC7;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1.5rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .comment-container .btn-submit:hover {
            background-color: #c04f1b;
        }

        footer {
            padding: 50px 20px;
            margin-top: 50px;
            background-color: black;
            color: white;
        }

        /* Media Queries for Responsiveness */
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

            .comment-container {
                padding: 20px;
            }

            .timetable {
                width: 100%;
            }

            .row.equal-height {
                flex-direction: column;
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
    <h1>Our Services and Packages</h1>
    <p>GlowSpa</p>
</div>
		<section class="catalogue" id="services">
			<h2>Our Services</h2>
			<div class="row equal-height">
				<!-- Full Body Massage -->
				<div class="col-md-4 service">
					<h3 style="font-weight: bold">Full Body Massage Therapy</h3>
					<h4>(RM150)</h4><br>
					<p>Relax and rejuvenate with our signature massage treatments.</p>
					<div class="service-list">
						<ul>
							<li>Swedish Massage: Light to medium pressure for relaxation</li>
							<li>Deep Tissue Massage: Focuses on muscle tension relief</li>
							<li>Aromatherapy Massage: Essential oils for stress relief</li>
						</ul><br><br>
					</div>
				</div>

				<!-- Facial Treatment -->
				<div class="col-md-4 service">
					<h3 style="font-weight: bold">Facial Treatment</h3>
					<h4>(RM80)</h4><br>
					<p>Pamper your skin with our premium facial treatments.</p><br>
					<div class="service-list">
						<ul>
							<li>Hydrating Facial: Restores moisture for glowing skin</li>
							<li>Anti-Aging Facial: Reduces fine lines & firms skin</li>
							<li>Acne Treatment Facial: Deep cleanse & soothe irritated skin</li>
							<li>Brightening Facial: Evens out skin tone for a fresh glow</li>
						</ul>
					</div>
				</div>

				<!-- Head, Neck & Shoulder Massage -->
				<div class="col-md-4 service">
					<h3 style="font-weight: bold">Head, Neck & Shoulder Massage</h3>
					<h4>(RM120)</h4>
					<p>Enjoy a combination of our best treatments at discounted rates.</p>
					<div class="service-list">
						<ul>
							<li>Targets tension in the upper body, relieving stiffness caused by stress and poor posture</li>
							<li>Relieves tension headaches and stimulates blood circulation in the scalp for relaxation.</li>
						</ul><br><br><br><br>
					</div>
				</div>
			</div>
		</section>

<section class="catalogue" id="services">
    <h2>Our Packages</h2>
    <div class="row equal-height">
       <div class="col-md-4 service">
					<h3 style="font-weight: bold">Relaxation Package</h3>
					<h4>(RM160)</h4><br>
					<p>Unwind with a soothing Aromatherapy Massage, followed by a warm Herbal Foot Soak to relieve stress and tension.</p>
					
					<ul class="service-list">
						<h4>Services included:</h4>
						<li>Aromatherapy Massage</li>
						<li>Herbal Foot Soak</li>
						<li>Lavender Honey Panna Cotta</li>
					</ul>
				</div>

				
				<div class="col-md-4 service">
					<h3 style="font-weight: bold">Luxury Indulgence Package</h3>
					<h4>(RM210)</h4><br>
					<p>Experience the ultimate pampering with a Gold Facial Treatment for radiant, youthful skin, a Balinese Massage to ease tension.</p>
					
					<ul class="service-list">
						<h4>Services included:</h4>
						<li>Gold Facial Treatment</li>
						<li>Balinese Massage</li>
						<li>Dark Chocolate Truffle with Gold Dust</li>
					</ul>
				</div>

				<div class="col-md-4 service">
					<h3 style="font-weight: bold">Glow Essentials Package</h3>
					<h4>(RM150)</h4><br>
					<p>Enjoy a combination of our best treatments at discounted rates.</p>
					
					<ul class="service-list">
						<h4>Services included:</h4>
						<li>Hydrating Facial</li>
						<li>Hydrating Body Wrap</li>
						<li>Berry & Greek Yogurt Parfait</li>
					</ul>
				</div>
    </div>
</section>

<div class="comment-container">
    <h2>Submit a Message</h2>
    <form action="catalogue.php" method="POST">
        <div class="form-group">
            <label for="comment">Your message:</label>
            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message here..." required></textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-submit">Submit</button>
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
