<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
class user
{
    private $nom;
    private $mp;

    function __construct($nom, $mp)
    {
        $this->nom = $nom;
        $this->mp = $mp;
    }
    public function __get($attr)
    {
        if (!isset($this->$attr)) return "erreur";
        else return ($this->$attr);
    }
    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }

    public function __toString()
    {
        $s = 'Nom: ' . $this->nom;
        return $s;
    }

    public static function sign($username, $email, $adress, $password, &$error)
    {
        include("connection.php");
        $stmt = $conn->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $error = 'Username already exists';
        } else {
            $stmt = $conn->prepare('INSERT INTO users (username, email, location, password) VALUES (:username, :email, :adress, :password)');
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':adress', $adress);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $conn->lastInsertId();
            header('Location: accueil.php');
        }
    }

    public static function log($username, $password, &$error)
    {
        include("connection.php");
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=:nom");
        $stmt->bindParam(':nom', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['id'] = $user['id'];
                header("Location: accueil.php");
                exit();
            } else {
                $error = "Nom ou mot de passe faux.";
            }
        } else {
            $error = "Nom ou mot de passe faux.";
        }
    }
}
