<!DOCTYPE html>

<head>
  <title>New User</title>
  <style>
    body {
    background-image: url("./image/bg1.jpg");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    font-family: "Times New Roman", Times, serif;
    color: black; /* Ensure the default text color is black */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
    color: black; /* Set text color to black */
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
    color: black; /* Ensure heading color is black */
}

.input-field {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    background-color: #f0f0f0; /* Light gray background for input fields */
    color: black; /* Set input text color to black */
    border: 1px solid #444;
    border-radius: 5px;
    font-size: 1em;
    box-sizing: border-box;
}

.input-field:focus {
    outline: none;
    border-color: #ff5733;
    background-color: #e0e0e0; /* Slightly darker gray on focus */
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
    color: #357EC7; /* Changed link color to blue */
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
    

    <h1>SIGN UP</h1>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="registerForm">
      Username: <input class="input-field" name="username" type="text" required><br>
      Password: <input class="input-field" name="password" type="password" required><br>
      Full Name: <input class="input-field" name="fullname" type="text" required><br>
      Email: <input class="input-field" name="email" type="email" required><br>
      <br>
      <input class="submit-btn" type="submit" name="AddUser" value="Register">
    </form>
	<p>
      <a class="link" href="./login.php">Back to login page</a>
    </p>
	
	<br>

    <?php
    if (isset($_POST['AddUser'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];

        $conn = mysqli_connect("127.0.0.1", "root", "", "test") or die(mysqli_error());

        $sql = "INSERT INTO users (username, password, fullname, email)
                VALUES ('$username', PASSWORD('$password'), '$fullname', '$email')";

     
		if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Signup successful! You can now log in.'); window.location.href = 'login.php';</script>";
                } else {
                    echo '<p class="error-message">Error: ' . mysqli_error($conn) . '</p>';
                }

        mysqli_close($conn);
    }
    ?>
  </div>
</body>
</html>
