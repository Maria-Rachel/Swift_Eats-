<?php 
session_start();

if (!isset($_SESSION['cust_name'])) {
    header("Location: login.php");
    exit();
}

$host = "localhost:3307";
$username = "root";
$password = "";
$dbname = "SwiftEats";

$con = new mysqli($host, $username, $password, $dbname);


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$cust_name = $_SESSION['cust_name'];


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_account'])) {
    
    $stmt1 = $con->prepare("DELETE FROM customer_login WHERE cust_name = ?");
    $stmt1->bind_param("s", $cust_name);
    $stmt1->execute();

    $stmt2 = $con->prepare("DELETE FROM customer_registeration WHERE cust_name = ?");
    $stmt2->bind_param("s", $cust_name);
    $stmt2->execute();

    
    if ($stmt1->affected_rows > 0 || $stmt2->affected_rows > 0) {
       
        session_destroy();
        header("Location: login.php");
        exit();
    } else {
        
        echo "<script>alert('No account found to delete.');</script>";
    }

    
    $stmt1->close();
    $stmt2->close();
}

$con->close(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>#Swift_Eats</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        a:link {
            color: rgb(132, 99, 37);
            text-decoration: none; 
        }
        a:visited {
            color: rgb(132, 37, 46);
        }
        a:hover {
            color: rgb(37, 132, 73);
            text-decoration: underline; 
        }
        a:active {
            color: rgb(37, 116, 132);
        }   
        .topnav {
            overflow: hidden;
            background-color: black;
            border-radius: 15px;
            display: flex;
            justify-content: center;
        }
        .topnav a {
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 10px 35px;
        }
        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .column {
            float: left;
            width: 15%;
            padding: 5px;
            text-align: center;
        }

        .row::after {
            content: "";
            display: table;
            clear: both;
        }
        @media screen and (max-width: 600px) {
            .column {
                width: 200%;
            }
        }
        footer {
            background-color: rgb(0, 0, 0);
            border-radius: 15px;
            padding: 10px;
            text-align: center;
            color: white;
        }

        footer a {
            color: white !important;
            padding-left: 15px;
        }
        .gstyle {
            color: #6062c8;
            font-family: Helvetica;
        }
        
        .dropdown {
            position: absolute;
            top: 20px;
            right: 20px; 
        }

        .dropbtn {
            background-color: black; 
            color: white;
            padding: 10px;
            border: none;
            border-radius: 10px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #9294D9;
            box-shadow: 0px 9px 16px rgba(0, 0, 0, 0.2);
        }

        .dropdown-content a {
            color: black;
            padding: 12px 30px;
            text-decoration: none;
            display: block;
            font-weight: 500;
            border-radius: 10px;
        }

        .dropdown:hover .dropdown-content {
            display: block;
            border-radius: 10px;
        }

        .dropdown-content a:hover {
            background-color: white;
        }

        
        .overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            transition: opacity 600ms;
            visibility: hidden;
            opacity: 0;
        }
        .overlay:target {
            visibility: visible;
            opacity: 1;
        }

        .popup {
            margin: 70px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            width: 30%;
            position: relative;
            transition: all 5s ease-in-out;
        }

        .popup h2 {
            margin-top: 0;
            color: #6062c8;
            font-family: Tahoma, Arial, sans-serif;
        }
        .popup .close {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #9294D9;
        }
        .popup .close:hover {
            color: red;
        }
        .popup .content {
            max-height: 30%;
            overflow: auto;
        }
		.deletebtn{
			background-color: red;
			color: #fff;
			font-weight: bold;
			padding: 10px 30px;
            margin: 8px 0;
            border: none;
            width: 60%;
            border-radius: 5px;
			cursor: pointer;
		}
    </style>
</head>
<body>
    <div style="overflow: hidden;">
        <div style="text-align: center; background-image: url('bg_swifteats5.2.png'); border-radius: 15px; opacity: 0.45;">
            <img title="logo" src="logo-transparent.2.png" alt="#Swift_Eats.com" width="250px" height="250px;">
        </div>
    </div><br>
    <div class="topnav">
        <a href="about.php"><i class="ph ph-caret-double-down"></i> &nbsp;ABOUT</a>
        <a href="search.php"><i class="ph ph-magnifying-glass"></i> &nbsp;SEARCH</a>
        <a href="help.php"><i class="ph ph-question"></i>&nbsp;HELP</a>
        <a href="cart.php"><i class="ph ph-basket"></i>&nbsp;CART</a>
        <a href="offers.php"><i class="ph ph-seal-percent"></i>&nbsp;OFFERS</a>
        <div class="dropdown">
            <button class="dropbtn"><i class="ph-fill ph-dots-three-outline-vertical"></i></button>
            <div class="dropdown-content">
                <a href="login.php"><i class="ph ph-sign-in"></i>&nbsp;Signup</a>
                <a href="#popup1"><i class="ph ph-user-minus"></i>&nbsp; Delete Account</a>
                <a href="dinner.php"><i class="ph-fill ph-sign-out"></i>&nbsp;Logout</a>
            </div>
        </div>
    </div>
    <br><hr>
    <p id="demo"></p>  
    <body>
        <script>
            const dayOfWeek = new Date().getDay();
            const hour = new Date().getHours(); 
            let greeting;

            if (hour < 12) {
                greeting = "<b> Good morning! </b>";
            } else if (hour >= 12 && hour < 18) {
                greeting = "<b> Good afternoon! </b>";
            } else {
                greeting = "<b> Good evening! </b>";
            }
            document.getElementById("demo").innerHTML = greeting;
            document.getElementById("demo").className = "gstyle";
        </script>
    </body>  
    <hr>
    <p style="color: #6062c8; font-family: Helvetica;">
        <b> What's on your mind? </b>
    </p>
    <div class="row"> 
        
	<div class="column">
		<img src="veg delight.png" id="1" onmouseover="mouseoverevent()" width="150px" height="150px;" >
	    <p>Pure Veg Delight</p>
	</div>
	<div class="column">
		<img src="biryani.png" width="150px" height="150px;" >
	    <p>Biriyani<p>
	</div>
	<div class="column">
		<img src="pizza.png" width="150px" height="150px;" >
	    <p>Pizza</p>
	</div>
	<div class="column">
		<img src="burger.png" width="150px" height="150px;" >
	    <p>Burger</p>
	</div>
	<div class="column">
		<img src="rolls.png" width="150px" height="150px;" >
	    <p>Rolls</p>
	</div>
	<div class="column">
		<img src="ice cream.png" width="150px" height="160px;" >
	    <p>Ice Cream</p>
	</div>
	
    </div>

    <br><br>
    <hr> 
    <p style="color: #6062c8; font-family: Helvetica;">
        <b> Top restaurant chains in Bangalore</b>
    </p>
    <br>
    <div class="row">
        <div class="column">
            <img src="pizza hut.jpg" width="150px" height="150px;" style="border-radius: 15px;">
            <p>Pizza Hut</p>
        </div>
        <div class="column">
            <img src="havmor.jpg" width="150px" height="150px;" style="border-radius: 15px;">
            <p>Havmor Havfunn Ice Cream</p>
        </div>
        <div class="column">
            <img src="burger king.jpg" width="150px" height="150px;" style="border-radius: 15px;">
            <p>Burger King</p>
        </div>
        <div class="column">
            <img src="kfc.jpg" width="150px" height="150px;" style="border-radius: 15px;">
            <p>KFC</p>
        </div>
        <div class="column">
            <img src="dominos.jpg" width="150px" height="150px;" style="border-radius: 15px;">
            <p> Domino's</p>
        </div>
        <div class="column">
            <img src="mc donalds.jpg" width="150px" height="150px;" style="border-radius: 15px;">
            <p>McDonald's</p>
        </div>
    </div>
    <br>
    <br>
    <hr>
    <p style="color: #6062c8; font-family: Helvetica;">
        <b> Restaurant chains with online food delivery in Bangalore</b>
    </p>
    <div class="row">
        <div class="column">
            <img src="chinese wok.jpg" width="150px" height="150px;" style="border-radius: 15px;">
            <dl> 
                <dt>Chinese Wok</dt>
                <dd>4.2 • 45-50 mins</dd>
            </dl>
        </div>
        <div class="column">
            <img src="burger king 2.jpg" width="150px" height="150px;" style="border-radius: 15px;">
            <dl> 
                <dt>Burger King</dt>
                <dd>4.2 • 30-35 mins</dd>
            </dl>
        </div>
        <div class="column">
            <img src="pizza hut 2.jpg" width="150px" height="150px;" style="border-radius: 15px;">
            <dl> 
                <dt>Pizza Hut</dt>
                <dd>4.2 • 20-25 mins</dd>
            </dl>
        </div>
        <div class="column">
            <img src="barbeque nation.jpg" width="150px" height="150px;" style="border-radius: 15px;">
            <dl> 
                <dt>UBC By Barbeque Nation</dt>
                <dd>4 • 40-45 mins</dd>
            </dl>
        </div>
        <div class="column">
            <img src="meghana.jpg" width="150px" height="150px;" style="border-radius: 15px;">
            <dl> 
                <dt>Meghana Foods</dt>
                <dd>4.6 • 30-35 mins</dd>
            </dl>
        </div>
        <div class="column">
            <img src="subway.jpg" width="150px" height="150px;" style="border-radius: 15px;">
            <dl> 
                <dt>Subway</dt>
                <dd>4.4 • 20-25 mins</dd>
            </dl>
        </div>
    </div>

   
    <div id="popup1" class="overlay">
        <div class="popup">
            <h2>Confirm Account Deletion</h2>
            <a class="close" href="#">&times;</a>
            <div class="content">
                <form method="POST" action="">
                    <input type="checkbox" id="delete_confirm" name="delete_confirm" required>
                    <label for="delete_confirm">Are you sure you want to delete your account? This action cannot be undone.</label><br>
                    <button type="submit" name="delete_account" class="deletebtn">DELETE ACCOUNT</button>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <a href=""><i class="ph ph-instagram-logo"></i> &nbsp;Instagram</a>
        <a href=""><i class="ph ph-facebook-logo"></i> &nbsp;Facebook</a>
    </footer>
</body>
</html>
