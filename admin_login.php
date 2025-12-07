<!-- admin_login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Domine:wght@400..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

    *{  
    box-sizing: border-box;
    font-family: "Domine", serif;
    }
    body{
    background: #c1e6a4;
    display: flex;
    margin: 10px;
    min-height: 100vh;
    align-items: center;
    justify-content: center;
    text-align: center;
    }
    .container{
        padding: 20px;
        text-align: center;
        margin-top: 80px;
    }
    form {
        margin-bottom: 20px;
        padding: 120px 40px;
        justify-content: center;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        width: 400px;
        margin: auto;
    }
    </style>
</head>
<body>
<div class="container">
    <h2>Admin Login</h2>
    <form action="admin_login.php" method="post">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" name="login" value="Login">
    </form>
    </div>

    <?php
    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Database connection
        $conn = new mysqli("localhost", "root", "", "fitstudio");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetching hashed password from database
        $sql = "SELECT a_password FROM Admin WHERE a_email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['a_password'];

            // Verifying password
        if (password_verify($password, $hashed_password)) {
            // Redirect to inventory.php
            header("Location: inventory.php");
            exit; // Make sure to exit after redirection
        } else {
            echo "Invalid email or password";
        }
    } else {
        echo "Invalid email or password";
    }

    $conn->close();
}
?>

