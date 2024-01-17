<?php
class Categories
{
    private $cat;

    function __construct($cat)
    {
        $this->cat = $cat;
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
        $s = '<div class="categorie">
                <h2 class="lead text-center"> ' . $this->cat . ' </h2>
                <div class="produits">';
        return $s;
    }

    public function printGC()
    {
        $s = '<div class="btn btn-primary mr-3">' . $this->cat . '</div>';
        return $s;
    }

    public function printC()
    {
        $s = '<option value="' . $this->cat . '">' . $this->cat . '</option>';
        return $s;
    }

    public static function getCats()
    {
        include("connection.php");
        $listP = [];
        $sql = $conn->prepare("select * from categories");
        $sql->execute();
        $resultat =  $sql->fetchAll();

        foreach ($resultat as $p) {
            $produit = new Categories($p[0]);
            $listP[] = $produit;
        }

        return $listP;
    }

    public static function addCat($cat)
    {
        include("connection.php");
        $stmt = $conn->prepare("INSERT INTO categories (cat) VALUES (?)");
        $stmt->bindParam(1, $cat);
        $stmt->execute();
    }

    public static function supCat($cat)
    {
        include("connection.php");
        $sql = "DELETE FROM products WHERE cat = '$cat'";
        $conn->exec($sql);

        $sql = "DELETE FROM categories WHERE cat = '$cat'";
        $conn->exec($sql);
    }
}
