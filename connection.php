<?php


try {
    $conn = new PDO('mysql:host=localhost;dbname=', , );
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
