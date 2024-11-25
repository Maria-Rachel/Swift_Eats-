<?php
$daynum = date('w');
$offerMessage = "";

switch ($daynum) {
    case 0:
        $offerMessage = "Special Sunday Brunch: 25% off!";
        break;
    case 1:
        $offerMessage = "Start your week with a 10% discount!";
        break;
    case 2:
        $offerMessage = "Tasty Tuesday: Free dessert with every meal!";
        break;
    case 3:
        $offerMessage = "Midweek Madness: 15% off on all orders!";
        break;
    case 4:
        $offerMessage = "Thirsty Thursday: Buy 1 Get 1 Free on drinks!";
        break;
    case 5:
        $offerMessage = "Fry-Day Specials: 20% off on all fried items!";
        break;
    case 6:
        $offerMessage = "Weekend Feast: Enjoy 30% off on family meals!";
        break;
    default:
        $offerMessage = "Check out our daily specials!";
        break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offers</title>
    <link rel="stylesheet" href="external.css"> <!-- External CSS -->
    <style>
        body {
            background-color: hsl(240, 24%, 90%); /* Solid background color */
            text-align: center;
            font-family: Helvetica, sans-serif;
            margin: 0;
            padding: 20px; /* Added padding for better spacing */
        }
        .outer-container {
            background-color: black; /* Outer container with black background */
            border-radius: 15px;
            padding: 20px;
            max-width: 600px;
            margin: 50px auto; /* Centering the container */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Softer shadow */
        }
        .inner-container {
            background-color: white; /* Inner container with white background */
            border-radius: 12px;
            padding: 20px; /* Padding for inner content */
        }
        h1 {
            color: #6062c8;
            margin-bottom: 20px;
        }
        .offer-message {
            font-weight: bold;
            color: #6062c8;
            margin-bottom: 20px;
            font-size: 1.2em; /* Slightly larger font size for emphasis */
        }
        dl {
            text-align: left;
            padding: 0;
            margin: 0;
            font-size: 1.1em;
        }
        dt {
            font-weight: bold;
            margin: 10px 0 5px;
        }
        dd {
            margin: 0 0 15px 20px;
            color: #6062c8;
            font-weight: 400;
            font-family: Helvetica;
        }
    </style>
</head>
<body>
    <div class="outer-container">
        <div class="inner-container">
            <h1>⚠️ OFFERS</h1>
            <p class="offer-message"><?php echo $offerMessage; ?></p>
            <dl>
                <dt>• Wow! Momo</dt>
                <dd>ITEMS AT ₹129</dd>
                <dt>• Barbeque Nation</dt>
                <dd>₹150 OFF and above</dd>
                <dt>• Subway</dt>
                <dd>30% OFF up to ₹75</dd>
                <dt>• Kwality Walls</dt>
                <dd>₹125 OFF</dd>
                <dt>• Brik Oven</dt>
                <dd>60% OFF up to ₹120</dd>
                <dt>• Iyengars Bakery</dt>
                <dd>20% OFF up to ₹120</dd>
            </dl>
        </div>
    </div>
</body>
</html>
