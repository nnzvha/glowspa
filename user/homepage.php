<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spa Booking System</title>
    
   
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
        .header {
            text-align: center;
            padding: 50px;
            background: rgba(255, 255, 255, 0.8);
        }
        .carousel {
            margin: 20px auto;
        }
        .carousel-inner {
            max-height: 400px; /* Reduced height */
            overflow: hidden;
        }
        .carousel-image {
            width: 100%;
            height: auto;
            object-fit: cover; 
        }
        
        @media (max-width: 768px) {
            .carousel-inner {
                max-height: 250px; /* Reduced height for smaller screens */
            }
        }
        
        .content {
            text-align: center;
            padding: 80px 20px;
            background: rgba(255, 255, 255, 0.8);
            margin-top: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .content p {
            font-size: 1.2em;
            color: #333;
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

  
    <div class="header">
        <h1>Welcome to Our Spa</h1>
        <p>Relax, Refresh, and Rejuvenate</p>
		<p>Operation hours: 10am~2pm and 3pm~5pm</p>
	
    </div>
    
   
    <div class="container">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
           
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

          
            <div class="carousel-inner">
                <div class="item active">
                    <img src="./image/img1.jpg" alt="Image 1" class="carousel-image">
                </div>
                <div class="item">
                    <img src="./image/img4.jpg" alt="Image 2" class="carousel-image">
                </div>
                <div class="item">
                    <img src="./image/img5.jpg" alt="Image 3" class="carousel-image">
                </div>
            </div>

         
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    
    <script>
        $(document).ready(function() {
           
            $("#myCarousel").carousel();
			
            $(".item1").click(function() {
                $("#myCarousel").carousel(0);
            });
            $(".item2").click(function() {
                $("#myCarousel").carousel(1);
            });
            $(".item3").click(function() {
                $("#myCarousel").carousel(2);
            });

            $(".left").click(function() {
                $("#myCarousel").carousel("prev");
            });
            $(".right").click(function() {
                $("#myCarousel").carousel("next");
            });
        });
    </script>

    <div class="content">
        <p>At GlowSpa, we believe in offering more than just a massage; we provide an experience that restores your mind, body, and soul. Whether you're looking to relieve stress, enhance your well-being, or indulge in a luxurious escape, our team of expert therapists is here to give you the ultimate relaxation you deserve.</p>
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
