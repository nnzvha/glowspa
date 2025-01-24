<!DOCTYPE html>
<head>
  <title>New Admin</title>
  <style>
    body {
      background-image: url("./image/bglogin.jpg");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      font-family: "Times New Roman", Times, serif;
      color: black;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .container {
      background-color: rgba(255, 255, 255, 0.8); 
      color: black; 
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    .container h1 {
      font-size: 2em;
      margin-bottom: 20px;
      color: black; 
    }

    .input-field {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      background-color: #f0f0f0; 
      color: black; 
      border: 1px solid #444;
      border-radius: 5px;
      font-size: 1em;
      box-sizing: border-box;
    }

    .input-field:focus {
      outline: none;
      border-color: #ff5733;
      background-color: #e0e0e0;
    }

    .submit-btn {
      width: 100%;
      padding: 12px;
      background-color: #357EC7;
      border: none;
      color: white;
      font-size: 1.2em;
      border-radius: 5px;
      cursor: pointer;
      box-sizing: border-box;
    }

    .submit-btn:hover {
      background-color: #c04f1b;
    }

    .link {
      color: #357EC7; 
      font-size: 0.9em;
      text-decoration: none;
      margin-top: 10px;
      display: inline-block;
      text-align: center;
      width: 100%;
    }

    .link:hover {
      text-decoration: underline;
    }

    .back-link {
      text-align: center;
      margin-bottom: 20px;
    }

  </style>
</head>
<body>
  <div class="container">

    <h1>Admin Sign Up</h1>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="registerForm">
      Username: <input class="input-field" name="username" type="text" required><br>
	   Email: <input class="input-field" name="email" type="email" required><br>
      Password: <input class="input-field" name="password" type="password" required><br>
     
      <br>
      <input class="submit-btn" type="submit" name="AddAdmin" value="Register">
    </form>
	
	<p>
      <a class="link" href="./adminlogin.php">Click here if already have an account</a>
    </p>
    <br>

    <?php
    if (isset($_POST['AddAdmin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $conn = mysqli_connect("127.0.0.1", "root", "", "test") or die(mysqli_error());
        $sql = "INSERT INTO admin(username, password, email)
                VALUES ('$username', '$hashed_password', '$email')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Admin signup successful! You can now log in.'); window.location.href = 'adminlogin.php';</script>";
        } else {
            echo '<p class="error-message">Error: ' . mysqli_error($conn) . '</p>';
        }

        mysqli_close($conn);
    }
    ?>

  </div>
</body>
</html>
