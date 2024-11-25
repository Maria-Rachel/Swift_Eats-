<?php 
session_start(); // Start the session

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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cust_name = $_POST['fname'];
    $cust_email = $_POST['Email'];
    $cust_gender = $_POST['gender'];
    $cust_pswd = $_POST['firstpassword'];
    $cust_confirmation_pswd = $_POST['secondpassword'];
    $cust_dob = $_POST['DOB'];
    
    // Validate that passwords match
    if ($cust_pswd !== $cust_confirmation_pswd) {
        echo "<script>alert('Passwords do not match.');</script>";
    } elseif (preg_match("/[^A-Za-z' -]/", $cust_name)) {
        echo "<script>alert('Invalid name. Name should be alphabetic.');</script>";
    } else {
        // Check if the username already exists
        $stmt = $con->prepare("SELECT * FROM customer_login WHERE cust_name = ?");
        $stmt->bind_param("s", $cust_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('Username already exists. Please choose another one.');</script>";
        } else {
            // Insert new user into the customer_login table
            $stmt = $con->prepare("INSERT INTO customer_login (cust_name, cust_pswd) VALUES (?, ?)");
            $stmt->bind_param("ss", $cust_name, $cust_pswd);
            $stmt->execute();

            // Insert into customer_registration table
            $stmt = $con->prepare("INSERT INTO `customer_registeration`(`cust_name`, `cust_email`, `cust_gender`, `cust_pswd`, `cust_confirmation_pswd`, `cust_DOB`) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", $cust_name, $cust_email, $cust_gender, $cust_pswd, $cust_confirmation_pswd, $cust_dob);
            $stmt->execute();

            // Redirect to login page
            header("Location: login.php");
            exit();
        }
        $stmt->close();
    }
}

$con->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            display: flex;
            text-align: center;
            justify-content: center;
            font-family: tahoma;
            align-items: center;
            height: 100vh;
            background-color: #6062c8;
        }
        .container{
            display:flex;
            width: 70%;
            max-width: 1200px;
            max-height: 97%;
            background-color: white;
            box-shadow: 0px 4px 8px rgba(6, 6, 6, 0.4);
            border-radius: 10px;
            overflow: hidden;
        }
        .submit-button {
            background-color:#6062c8;
            color: white;
            font-weight: bold;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            width: 30%;
            border-radius: 5px;
        }
        .submit-button:hover {
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
        }
        .form-container{
            flex: 1;
        }
        .box-1{
            flex: 1;
            background-image: url(bg_swifteats5.jpg);
            background-size: cover;
        }
        h2{
            margin-top: 10px;
            font-size: 28px;
            font-weight: bold;
            color:#6062c8;
        }
        form {
            margin: 5px 0;
        }
        input[type=password], input[type=text]{
            border: none;
            border-bottom: 2px solid black;
        }
        .message {
            color: #6062c8;
            font-family: Helvetica;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box-1">
        </div>
        <div class="form-container">
            <h2>Sign Up</h2><br>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="Signup">
                <label for="fname">Full name:</label><br>
                <input type="text" id="fname" style="width: 200px; height: 30px;" name="fname" required><br><br>
                <label for="Email">Email id:</label><br>
                <input type="text" id="Email" style="width: 200px; height: 30px;" name="Email" required><br><br>
                <label for="DOB">Date of birth:</label><br>
                <input type="date" id="DOB" style="width: 200px; height: 30px;" name="DOB" required><br><br>
                <p>Gender</p>
                <input type="radio" id="male" name="gender" value="Male" required>
                <label for="gender">Male</label><br>
                <input type="radio" id="female" name="gender" value="Female">
                <label for="gender">Female</label><br>
                <input type="radio" id="other" name="gender" value="Other">
                <label for="gender">Other</label><br><br>
                <label for="fpassword">Password</label><br>
                <input type="password" id="fpassword" style="width: 200px; height: 30px;" name="firstpassword" required><br><br>
                <label for="spassword">Re-Enter Password</label><br>
                <input type="password" id="spassword" style="width: 200px; height: 30px;" name="secondpassword" required><br><br>
                <input type="submit" class="submit-button" name="Signup" value="SIGN UP">
                <p id="message" class="message"></p>  
            </form>
        </div>
    </div>
    <script>
    function validateform() {
        var fname = document.Signup.fname.value;   
        var x = document.Signup.Email.value;
        var atposition = x.indexOf("@");
        var dotposition = x.lastIndexOf(".");
        var firstpassword = document.Signup.firstpassword.value;
        var secondpassword = document.Signup.secondpassword.value;

        if (fname == null || fname == "") {
            alert("Name can't be blank");
            return false;
        } else if (firstpassword.length < 6) {
            alert("Password must be at least 6 characters long.");
            return false;
        } else if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= x.length) {
            alert("Please enter a valid e-mail address");
            return false;
        } else if (firstpassword != secondpassword) {
            alert("Passwords must be the same!");
            return false;
        }

        document.getElementById('message').innerHTML = "Thank you for signing up! 😀";
         setTimeout(function() {
        window.location.replace('main.php'); 
        }, 3000);
        return false;
    
    }
  </script>
</body>
</html>
