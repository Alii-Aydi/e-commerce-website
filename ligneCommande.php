<?php
class LigneCommande
{
    private $id;
    private $quantite;
    private $prixUnitaire;
    private $produitId;
    private $commandeId;

    public function __construct($quantite, $prixUnitaire, $produitId, $commandeId)
    {
        $this->quantite = $quantite;
        $this->prixUnitaire = $prixUnitaire;
        $this->produitId = $produitId;
        $this->commandeId = $commandeId;
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

    public static function AddLigneCommande($commandeID)
    {
        include("connection.php");
        foreach ($_SESSION['cart'] as $ref => $item) {
            $quantite = $item['quantity'];
            $prixUnitaire = $item['price'];
            $produitId = $ref;

            $stmt = $conn->prepare("INSERT INTO ligne_commande (quantite, prix_unitaire, produit_id, commande_id) VALUES (?, ?, ?, ?)");
            $stmt->execute([$quantite, $prixUnitaire, $produitId, $commandeID]);
        }
    }

    public static function SommeAchats()
    {
        include("connection.php");
        $stmt = $conn->prepare("SELECT sum(quantite * prix_unitaire) FROM ligne_commande");
        $stmt->execute();
        $res = $stmt->fetch();
        return $res[0];
    }

    public static function facture()
    {
        include("connection.php");

        $stmt = $conn->prepare("
        SELECT c.id as commande_id, c.date_commande, cl.id as client_id, cl.username as client_nom, cl.email as client_prenom, cl.location as client_adresse, p.lib, lc.quantite, lc.prix_unitaire, SUM(lc.quantite * lc.prix_unitaire) as total
        FROM commande c
        JOIN users cl ON c.client_id = cl.id
        JOIN ligne_commande lc ON c.id = lc.commande_id
        JOIN products p ON lc.produit_id = p.ref
        GROUP BY c.id, p.ref;
    ");

        $stmt->execute();

        $invoice_html = '';
        $invoice_total = 0;
        $new_order = true;
        $current_order_id = null;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $date_commande = $row['date_commande'];
            $client_nom = $row['client_nom'];
            $client_prenom = $row['client_prenom'];
            $client_adresse = $row['client_adresse'];
            $produit_nom = $row['lib'];
            $quantite = $row['quantite'];
            $prix_unitaire = $row['prix_unitaire'];

            if ($new_order) {
                $new_order = false;
                $current_order_id = $row['commande_id'];
                $date_commande = $row['date_commande'];
                $client_nom = $row['client_nom'];
                $client_prenom = $row['client_prenom'];
                $client_adresse = $row['client_adresse'];

                $invoice_html .= "<div class='bg-light p-3 mb-3'>";
                $invoice_html .= "<h4>Facture #$current_order_id</h4>";
                $invoice_html .= "<p><strong>Date:</strong> $date_commande</p>";
                $invoice_html .= "<p><strong>Nom:</strong> $client_nom</p>";
                $invoice_html .= "<p><strong>Email:</strong> $client_prenom</p>";
                $invoice_html .= "<p><strong>Adresse:</strong> $client_adresse</p>";
                $invoice_html .= "<table class='table bg-light'><thead><tr><th>Produit</th><th>Quantité</th><th>Prix unitaire</th><th>Total</th></tr></thead><tbody>";
            }

            if ($row['commande_id'] != $current_order_id) {
                // Close the previous invoice and start a new one for the new order
                $invoice_html .= "</tbody><tfoot><tr><td colspan='3'>Total:</td><td>$invoice_total</td></tr></tfoot></table>";
                $invoice_html .= "</div>";
                $invoice_total = 0;

                $current_order_id = $row['commande_id'];
                $date_commande = $row['date_commande'];
                $client_nom = $row['client_nom'];
                $client_prenom = $row['client_prenom'];
                $client_adresse = $row['client_adresse'];

                $invoice_html .= "<div class='bg-light p-3 mb-3'>";
                $invoice_html .= "<h4>Facture #$current_order_id</h4>";
                $invoice_html .= "<p><strong>Date:</strong> $date_commande</p>";
                $invoice_html .= "<p><strong>Nom:</strong> $client_nom</p>";
                $invoice_html .= "<p><strong>Email:</strong> $client_prenom</p>";
                $invoice_html .= "<p><strong>Adresse:</strong> $client_adresse</p>";
                $invoice_html .= "<table class='table bg-light'><thead><tr><th>Produit</th><th>Quantité</th><th>Prix unitaire</th><th>Total</th></tr></thead><tbody>";
            }
            // Add a row for the current line item
            $invoice_html .= "<tr>";
            $invoice_html .= "<td>$produit_nom</td>";
            $invoice_html .= "<td>$quantite</td>";
            $invoice_html .= "<td>$prix_unitaire</td>";
            $invoice_html .= "<td>" . $quantite * $prix_unitaire . "</td>";
            $invoice_html .= "</tr>";

            $invoice_total += $quantite * $prix_unitaire;
        }

        // Close the last table
        $invoice_html .= "</tbody><tfoot><tr><td colspan='3'>Total:</td><td>$invoice_total</td></tr></tfoot></table>";
        $invoice_html .= "</div>";

        echo $invoice_html;
    }
}
