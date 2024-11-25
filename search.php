<!DOCTYPE html>
<html>
<head>
    <title>Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="external.css">
    <style>
        
        body {
            background-color: hsl(240, 24%, 90%);
            text-align: center;
            font-family: Helvetica, sans-serif;
        }

        
        .search-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        
        h2 {
            color: #6062c8;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        
        .search-input {
            width: 75%;
            max-width: 400px;
            height: 40px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #c6c6f0;
            border-radius: 20px;
            box-sizing: border-box;
        }

        
        .search-button {
            width: 100px;
            height: 40px;
            margin-left: 10px;
            font-size: 16px;
            color: white;
            background-color: #6062c8;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .search-button:hover {
            background-color: #4849a1;
        }
    </style>
</head>
<body>
   
    <div class="search-container">
        <h2>SEARCH</h2>
        <form action="main.php">
            <input type="text" class="search-input" placeholder="Search for restaurants or food" required>
            <input type="submit" class="search-button" value="Search">
        </form>
    </div>
</body>
</html>
