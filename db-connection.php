<?php

// DB Access Data
const db_hostname = 'ocamumik.mysql.db.internal';
const db_username = 'ocamumik_m242';
const db_postPassword = 'm242';
const db_name = 'ocamumik_m242';

$pdo;

try{

    // Build a DB Connection with PDO
    $pdo = new PDO("mysql:host=" . db_hostname . ";db_name=" . db_name, db_username, db_postPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){

    // Exit with Error Message
    die("ERROR: Could not connect. " . $e->getMessage());

}