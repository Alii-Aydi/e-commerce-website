<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Boutique</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php
  include("nav.php")
  ?>
  <main class="text-light">
    <div class="case">
      <div class="content container-sm px-4">
        <h1 class="display-4">Bienvenu <?php if (isset($_SESSION['username'])) echo $_SESSION['username'] ?> dans notre boutique!</h1>
        <h2 class="font-weight-light">Consulter les produits par categorie</h2>
      </div>
      <img src="assets/16544-transformed.png" alt="" srcset="">
      <video id="vd" autoplay muted loop>
        <source src="assets/_import_60c2f83e6650d0.23903201_FPpreview.mp4">
      </video>
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
      </svg>
    </div>
    <div class="over"></div>
    <section class="acc">
      <?php
      include("categories.php");
      $listC = Categories::getCats();
      include("produit.php");
      $listP = Produit::getProduits();
      foreach ($listC as $c) {
        echo $c;
        foreach ($listP as $p) {
          if ($p->cat == $c->cat)
            echo $p;
        }
        echo '</div></div>';
      }
      ?>
    </section>
  </main>
  <?php
  include("footer.php")
  ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>