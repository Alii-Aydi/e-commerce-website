<?php


try {
    $conn = new PDO('mysql:host=localhost;dbname=alpha', 'root', '');
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
