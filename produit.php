<?php
class Produit
{
  private $ref;
  private $lib;
  private $prix;
  private $img;
  private $desc;
  private $cat;

  function __construct($ref, $lib, $prix, $img, $desc, $cat)
  {
    $this->ref = $ref;
    $this->lib = $lib;
    $this->prix = $prix;
    $this->img = $img;
    $this->desc = $desc;
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
    $s = '<div class="card text-dark" style="width: 18rem;">
          <img src=' . "$this->img" . 'class="card-img-top img-fluid">
          <div class="card-body">
            <h5 class="card-title">' . $this->lib . '</h5>
            <p>Prix <span class="prix text-success">' . $this->prix . ' TND</span></p>
            <p class="card-text">' . $this->desc . '</p>
            <form action="panierController.php" method="post">
              <input type="hidden" name="ref" value="' . $this->ref . '">
              <button type="submit" name="add_to_cart" class="btn btn-primary">Acheter</button>
            </form>
          </div>
        </div>';
    return $s;
  }

  public function majPrint()
  {
    $s = '<div class="card text-dark" style="width: 18rem;">
          <img src=' . "$this->img" . 'class="card-img-top img-fluid">
          <div class="card-body">
            <h5 class="card-title">' . $this->lib . '</h5>
            <p>Prix <span class="prix text-success">' . $this->prix . ' TND</span></p>
            <p class="card-text">' . $this->desc . '</p>
            <form action="produitsControl.php" method="post">
              <input type="hidden" name="ref" value="' . $this->ref . '">
              <button type="submit" name="mod" class="btn btn-info">Modifier</button>
              <button type="submit" name="supp" class="btn btn-danger">Supprimer</button>
            </form>
          </div>
        </div>';
    return $s;
  }

  public static function getProduits()
  {
    include("connection.php");
    $listP = [];
    $sql = $conn->prepare("select * from products");
    $sql->execute();
    $resultat =  $sql->fetchAll();

    foreach ($resultat as $p) {
      $produit = new Produit($p[0], $p[1], $p[2], $p[3], $p[4], $p[5]);
      $listP[] = $produit;
    }

    return $listP;
  }

  public static function getProduit($ref)
  {
    include("connection.php");
    $sql = $conn->prepare("select * from products where ref = " . $ref);
    $sql->execute();
    $produit =  $sql->fetch(PDO::FETCH_OBJ);
    return $produit;
  }

  public static function search($term)
  {
    include("connection.php");
    $listP = [];
    $sql = $conn->prepare("select * from products where lib like '%" . $term . "%'");
    $sql->execute();
    $resultat =  $sql->fetchAll();

    foreach ($resultat as $p) {
      $produit = new Produit($p[0], $p[1], $p[2], $p[3], $p[4], $p[5]);
      $listP[] = $produit;
    }

    return $listP;
  }

  public static function add($data)
  {
    include("connection.php");
    $stmt = $conn->prepare("INSERT INTO products (ref, lib, prix, img, `desc`, cat) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $data->ref);
    $stmt->bindParam(2, $data->lib);
    $stmt->bindParam(3, $data->prix);
    $stmt->bindParam(4, $data->img);
    $stmt->bindParam(5, $data->desc);
    $stmt->bindParam(6, $data->cat);

    $stmt->execute();
  }

  public static function updateProduit($ref, $lib, $prix, $img, $desc, $cat)
  {
    include("connection.php");
    $sql = $conn->prepare("UPDATE products SET lib = ?, prix = ?, img = ?, `desc` = ?, cat = ? WHERE ref = ?");
    $sql->bindParam(1, $lib);
    $sql->bindParam(2, $prix);
    $sql->bindParam(3, $img);
    $sql->bindParam(4, $desc);
    $sql->bindParam(5, $cat);
    $sql->bindParam(6, $ref);
    $sql->execute();
  }

  public static function deleteProduit($ref)
  {
    include("connection.php");
    $sql = $conn->prepare("DELETE FROM products WHERE ref = ?");
    $sql->bindParam(1, $ref);
    $sql->execute();
  }
}
