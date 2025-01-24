
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Spa Booking System</title>
    
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
        .about-section {
            background: rgba(255, 255, 255, 0.9);
            padding: 50px;
            margin: 20px auto;
            border-radius: 8px;
            text-align: center;
            max-width: 800px;
        }
        .team-section {
            background: rgba(255, 255, 255, 0.9);
            padding: 50px;
            border-radius: 8px;
            margin: 20px auto;
            max-width: 1000px;
			text-align: center;
        }
        .team-member {
            margin: 20px;
            text-align: center;
        }
        .team-member img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            margin-bottom: 15px;
        }
        .team-member h3 {
            margin: 10px 0 5px;
			text-align: center;
        }
        .team-member p {
            font-size: 14px;
        }
		
		.team-section .row {
			display: flex;
			justify-content: space-between;
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

<div class="about-section">
    <h1>About Our Spa</h1>
    <p>Welcome to our Spa Booking System! We are dedicated to providing you with a serene and rejuvenating experience. Our spa offers a wide range of services, from massages and facials to luxurious spa packages, all designed to help you relax, refresh, and renew.</p>
    <p>We take pride in using natural and high-quality products to ensure your wellness and satisfaction. Our team of professional therapists is here to cater to your every need in a warm and inviting atmosphere.</p>
</div>

<div class="team-section">
    <h2  class="team-heading">Meet Our Team</h2>
    <div class="row">
        <div class="col-md-3 team-member">
            <img src="./image/Aisyah.png" alt="Therapist 1">
            <h3>Siti Aisyah Saifulazhar</h3>
            <p>Senior Massage Therapist</p>
        </div>
        <div class="col-md-3 team-member">
            <img src="./image/huda.png" alt="Therapist 2">
            <h3>Nurhuda Shidin</h3>
            <p>Spa Manager</p>
        </div>
        <div class="col-md-3 team-member">
            <img src="./image/zuha.jpg" alt="Therapist 3">
            <h3>Maizatul Nazuha Saadon</h3>
            <p>Body Specialist</p>
        </div>
		<div class="col-md-3 team-member">
            <img src="./image/Hadirah.png" alt="Therapist 3">
            <h3>Hadirah Afifah Saffie</h3>
            <p>Facial Specialist</p>
        </div>
    </div>
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