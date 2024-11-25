<?php 
session_start(); // Start the session

error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cust_name = $_POST['Name'];
    $cust_pswd = $_POST['password'];

    // Basic validation for the username
    if (preg_match("/[^A-Za-z' -]/", $cust_name)) {
        die("Invalid name. Name should be alphabetic.");
    }

    // Database connection
    $host = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "SwiftEats";

    $con = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM customer_login WHERE cust_name = ? AND cust_pswd = ?");
    $stmt->bind_param("ss", $cust_name, $cust_pswd);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['cust_name'] = $row['cust_name']; // Store user name in session
        header("Location: main.php"); // Redirect to the main page
        exit();
    } else {
        header("Location: main.php");
    }

    $stmt->close();
    $con->close(); 
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            display: flex;
            text-align: center;
            justify-content: center;
            font-family: Tahoma;
            align-items: center;
            height: 100vh;
            background-color: #6062c8;
        }
        .container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background-color: #ffffff;
            box-shadow: 0px 4px 8px rgba(6, 6, 6, 0.4);
            border-radius: 10px;
            overflow: hidden;
        }
        .submit-button {
            background-color: #6062c8;
            color: white;
            font-weight: bold;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            width: 20%;
            border-radius: 5px;
        }
        .submit-button:hover {
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
        }
        .form-container {
            flex: 1;
            padding: 70px;
        }
        .box-1 {
            flex: 1;
            background-image: url(bg_swifteats5.jpg);
            background-size: cover;
        }
        h3 {
            color: #6062c8;
        }
        h2 {
            margin-top: 10px;
            font-size: 28px;
            font-weight: bold;
        }
        form {
            margin: 20px 0;
        }
        input[type=password], input[type=text] {
            border: none;
            border-bottom: 2px solid black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 style="color: #6062c8; font-weight: bolder; font-family: Tahoma;">LOGIN</h1>
            <h5>or <a href="sign up.php" style="font-weight: lighter;">sign up</a></h5><br>
            <div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <label for="Name">User Name:</label><br><br>
                    <input type="text" id="Name" style="width: 200px; height: 30px;" name="Name" required><br><br><br>
                    <label for="password">Password:</label><br><br>
                    <input type="password" id="password" style="width: 200px; height: 30px;" name="password" required><br><br>
                    <input type="submit" name="login" value="LOGIN" class="submit-button">
                </form>
            </div>
        </div>
        <div class="box-1"></div>
    </div> 
</body>
</html>
