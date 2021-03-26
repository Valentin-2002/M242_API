<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <script src="script.js"></script>
    <title>M242 - LB1</title>
</head>
<body>
    <form action="api.php" method="post">

        <?php

            // Load File with PDO for DB Connection
            require ('db-connection.php');

            // Run Select Query
            $query = "SELECT * FROM ocamumik_m242.data";
            $statement = $pdo->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();

            // Get wished and current temparature from the DB
            $currentTemp = $result[0]['current_temp'];
            $temp = $result[0]['temp'];

            // Display current Temparature on Page
            echo '<p id="temp-display">Current Temparature: ' . $currentTemp . '</p>';
        
            // Get Error Code from GET Params if form wasn't submitted successfully
            $errorCode = $_GET['c'];

            // Display the correct Error Message for every available Error Code
            switch ($errorCode) {
                case 600: 
                    echo '<p id="msg" class="success">Sucessfully submitted!</p>';
                    break;
                case 601:
                    echo '<p id="msg">Wrong Password</p>';
                    break;
                case 602:
                    echo '<p id="msg">Enter a Temparature Value between 0 and 50</p>';
                    break;
                case 603:
                    echo '<p id="msg">Enter a Password</p>';
                    break;
            }
        
        ?>

        <label for="temp">Temparature:</label>
        <div>
            <input type="number" name="temp" min="0" max="50" step="1" value="<?= $temp ?>">
        </div>
        <label for="password">Password:</label>
        <div>
            <input type="password" name="password" id="password-input">
        </div>
        <div>
            <input type="submit" value="submit">
        </div>
    </form>
</body>
</html>