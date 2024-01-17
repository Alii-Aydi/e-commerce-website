<?php
class Commande
{
    private $id;
    private $dateCommande;
    private $clientId;
    private $ligneCommandes = array();

    public function __construct($dateCommande, $clientId)
    {
        $this->dateCommande = $dateCommande;
        $this->clientId = $clientId;
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
        $s = '';
        return $s;
    }

    public static function AddCommande($dateCommande, $clientID)
    {
        include("connection.php");
        $stmt = $conn->prepare("INSERT INTO commande (date_commande, client_id) VALUES (?, ?)");
        $stmt->execute([$dateCommande, $clientID]);
        $commandeId = $conn->lastInsertId();
        return $commandeId;
    }

    public static function getDates()
    {
        $startDate = date('Y-m-01');
        $endDate = date('Y-m-t');

        include("connection.php");
        $stmt = $conn->prepare('SELECT DATE(date_commande) AS order_date, COUNT(*) AS order_count FROM commande WHERE date_commande BETWEEN :start_date AND :end_date GROUP BY DATE(date_commande)');
        $stmt->execute(['start_date' => $startDate, 'end_date' => $endDate]);
        $orderData = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

        header('Content-Type: application/json');
        echo json_encode($orderData);
    }

    public static function getOrders()
    {
        include("connection.php");
        $stmt = $conn->prepare('SELECT COUNT(*) AS order_count FROM commande');
        $stmt->execute();
        $orders = $stmt->fetch();
        return $orders['order_count'];
    }

    public static function getNonShipped()
    {
        include("connection.php");
        $stmt = $conn->prepare('SELECT COUNT(*) AS order_count FROM commande WHERE shipped = 0');
        $stmt->execute();
        $orders = $stmt->fetch();
        return $orders['order_count'];
    }
}
