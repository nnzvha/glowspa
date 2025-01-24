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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username']; 
    $message = $conn->real_escape_string($_POST['message']); 

    $sql = "INSERT INTO messages (username, message) VALUES ('$username', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Message submitted successfully!'); window.location.href='about.php';</script>";
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
  <title>Submit Message</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <style>
     body, h1, h2, h3, h4, h5, h6 {
            font-family: "Raleway", Arial, Helvetica, sans-serif;
        }
        body {
            background: url('./image/bg1.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .topnav {
    display: flex;
    align-items: center;
    background-color: rgba(51, 51, 51, 0.8);
    padding: 10px;
    margin-bottom: 60px; 
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
		
    .comment-container {
      background: rgba(255, 255, 255, 0.9);
      padding: 30px;
      margin-top: 100px;
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
  </style>
</head>
<body>

    <div class="topnav">
        <img class="logo_image" src="./image/logow.png" alt="Logo" width="12%" height="12%">
        <a href="homepage.php">Home</a>
        <a href="slot.php">Available Slot</a>
        <a href="booking.php">Reservation</a>
        <a href="catalogue.php">Catalogue</a>
        <a href="history.php">My bookings</a>
        <a href="about.php">About</a>
        <a href="logout.php">Logout</a>
    </div>
  
  <div class="comment-container">
    <h2>Submit a Message</h2>
    <form action="comment.php" method="POST">
      <div class="form-group">
        <label for="comment">Your message:</label>
        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message here..." required></textarea>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-submit">Submit</button>
      </div>
    </form>
  </div>
</body>
</html>
