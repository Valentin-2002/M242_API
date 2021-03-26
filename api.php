<?php

require ('db-connection.php');

// Determine Request Type
$requestType = $_SERVER['REQUEST_METHOD'];

if($requestType === 'POST') {

    // Save Values from POST request in variables
    $postTemp = (int) $_POST['temp'];
    $postPassword = $_POST['password'];
    
    // Check if variables are empty
    if(!empty($postTemp) && !empty($postPassword)) {

        // Check if Temparature Variable Value is in the Valid Range
        if($postTemp > -1 && $postTemp < 51) {

            // Get Password from DB
            $query = 'SELECT password FROM ocamumik_m242.data';
            $statement = $pdo->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $password = $result[0]['password'];

            // Check if POST password and DB Password match
            if($postPassword === $password) {
                
                // Update DB Temparature Value with the Temparature Value from POST Request
                $query = 'UPDATE ocamumik_m242.data SET temp=' . $postTemp;
                $statement = $pdo->prepare($query);
                $statement->execute();

                // Redirect to Homepage with success Message
                header('location:index.php?c=600');

            } else {

                // Redirect to Homepage with Password Error Message
                header('location:index.php?c=601');
            }
        } else {

            // Redirect to Homepage with Temparature Value Error Message
            header('location:index.php?c=602');
        }
    } else {

        // Redirect to Homepage with Fields Empty Error Message
        header('location:index.php?c=603');
    }

} elseif ($requestType === 'GET') {

    // Save GET Param Values in Variables;
    $getToken = $_GET['token'];
    $currentTemp = $_GET['temp'];

    // Check if GET Param Variables are empty
    if(empty($getToken) && empty($currentTemp)) {

        // Exit with Error Code
        echo 700;
        die; 
    }

    // Get Temparature and Token (for identifying) from DB
    $query = "SELECT temp, token FROM ocamumik_m242.data";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
    
    $temp = $result[0]['temp'];
    $token = $result[0]['token'];

    // Check if Token from GET params are not matching with Token in DB
    if($getToken !== $token) {

        // Exit with Error Code
        echo 701;
        die;
    }

    // Update current Temparature DB Value with the Value from GET params
    $query = 'UPDATE ocamumik_m242.data SET current_temp=' . $currentTemp;
        $statement = $pdo->prepare($query);
        $statement->execute();

    // Send temparature Value from DB as Response to the IotKIT
    echo $temp;

} else {

    // Exit with Error Message if Request is not POST or GET
    echo 'Invalid Request!';
    die;
}