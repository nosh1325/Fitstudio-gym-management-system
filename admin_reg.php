<!-- admin_reg.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
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
    <h2>Admin Registration</h2>
    
    <form action="admin_reg.php" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone"><br><br>
        <input type="submit" name="register" value="Register">
    </form>
    </div>

    <?php
    if(isset($_POST['register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];

        // Hashing the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Database connection
        $conn = new mysqli("localhost", "root", "", "fitstudio");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Inserting data into database
        $sql = "INSERT INTO Admin (a_name, a_email, a_password, a_phone) VALUES ('$name', '$email', '$hashed_password', '$phone')";
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>
</html>
