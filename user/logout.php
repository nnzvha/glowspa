<?php
session_start();

if (isset($_POST['confirm'])) {
    
    session_unset();
    session_destroy();

    $logged_out = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: url('./img/bglogout.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .logout-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .logout-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .logout-container p {
            margin-bottom: 20px;
            color: #555;
        }

        .logout-container button {
            background-color: #357EC7;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            margin: 0 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-container button:hover {
            background-color: #c04f1b;
        }

        .logout-container a {
            color: #357EC7;
            text-decoration: none;
            font-weight: bold;
        }

        .logout-container a:hover {
            color: #c04f1b;
        }
    </style>
</head>
<body>
<div class="logout-container">
    <?php if (!isset($logged_out)) : ?>
        <h2>Are you sure you want to log out?</h2>
        <form method="POST" action="logout.php">
            <button type="submit" name="confirm">Yes, Log Out</button>
            <a href="homepage.php">Cancel</a>
        </form>
    <?php else : ?>
        <h2>You have successfully logged out</h2>
        <p>Thank you for using our service.</p>
        <a href="login.php">Click here to log in again</a>
    <?php endif; ?>
</div>
</body>
</html>