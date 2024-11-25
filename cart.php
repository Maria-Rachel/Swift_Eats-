<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="external.css">
    <style>
        body {
            background-color: hsl(240, 24%, 90%);
            font-family: Helvetica, sans-serif;
            color: #333;
            text-align: center;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            font-weight: bold;
            padding: 10px 0;
        }
        .header a {
            text-decoration: none;
            color: #6062c8;
            font-size: 14px;
        }
        .summary {
            font-size: 16px;
            margin-top: 20px;
            line-height: 1.6;
        }
        .total {
            font-weight: bold;
            margin-top: 10px;
            font-size: 18px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <img src="logo-transparent.png" alt="Logo" width="100" height="100">
            <span>Secure Checkout</span>
            <a href="help.php">Help</a> | <a href="sign up.php">Sign Up</a>
        </div>
		<hr><br>
        <?php
            $p_biriyani = 149.00;
            $p_rolls = 69.50;
            $p_pizza = 99.00;
            $p_ice_cream = 99.34;
            $p_burger = 120.45;
            $p_veg_delight = 319.89;

            $n_biriyani = "BIRIYANI";
            $n_rolls = "ROLLS";
            $n_pizza = "PIZZA";
            $n_ice_cream = "ICE CREAM";
            $n_burger = "BURGER";
            $n_veg_delight = "PURE VEG DELIGHT";

            $q_biriyani = 1;
            $q_rolls = 2;
            $q_pizza = 4;
            $q_ice_cream = 3;
            $q_burger = 1;
            $q_veg_delight = 2;

            $delivery_fee = 20.50;
            $tax_rate = 0.08;

            $subtotal = ($p_pizza * $q_pizza) + ($p_burger * $q_burger) + ($p_ice_cream * $q_ice_cream);
            $orderQuantity = $q_pizza + $q_burger + $q_ice_cream;
			echo "<p><strong>Order Summary</strong></p>";

            if ($orderQuantity > 0) {
                echo "You have added $orderQuantity items to your cart.";
            } else {
                echo "Please enter a valid quantity.";
            }

            $tax = $subtotal * $tax_rate;
            $total = $subtotal + $tax + $delivery_fee;
            $discount = 0;

            do {
                if ($orderQuantity >= 10) {
                    $discount = $subtotal * 0.10;
                    echo "You get a 10% discount!<br>";
                } else {
                    $discount = $subtotal * 0.05;
                    echo "You get a 5% discount!<br>";
                }
            } while ($orderQuantity > 10);

            echo "<div class='summary'>";
            
            echo "<p>$n_pizza $q_pizza x = ₹" . ($p_pizza * $q_pizza) . "</p>";
            echo "<p>$n_burger $q_burger x = ₹" . ($p_burger * $q_burger) . "</p>";
            echo "<p>$n_ice_cream $q_ice_cream x = ₹" . ($p_ice_cream * $q_ice_cream) . "</p>";
            echo "<p>Subtotal: ₹" . $subtotal . "</p>";
            echo "<p>Discount: ₹" . $discount . "</p>";
            echo "<p>Tax (8%): ₹" . $tax . "</p>";
            echo "<p>Delivery Fee: ₹" . $delivery_fee . "</p>";
            echo "<p class='total'>Total: ₹" . $total . "</p>";
            echo "</div>";
        ?>

    </div>

</body>
</html>
