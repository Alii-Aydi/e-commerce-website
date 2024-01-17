<?php
echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
<link rel="stylesheet" href="style.css"> <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>';
if (isset($_GET["research"])) {
    include("nav.php");
    if (!empty($_GET["search"])) {
        include("produit.php");
        $listP = Produit::search($_GET["search"]);
        echo '<main class="container-sm mt-5 mb-5">';
        echo '<h1 class="display-4 text-light">Resulats pour "' . $_GET["search"] . '"</h1>';
        echo '<div class="container-sm produits mt-5">';
        if (empty($listP)) {
            echo '<p class="lead text-light">Pas des resultas</p>';
        } else {
            foreach ($listP as $p) {
                echo $p;
            }
        }
        echo '</div>';
        echo '</main>';
        echo '<style>
        .produits {
            gap:50px;
          }
        </style>';
    } else {
        header('Location:accueil.php');
    }
    include("footer.php");
}

if (isset($_GET["researchAdmin"])) {
    echo '<style>
        .add {
            margin-left: 300px;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        body {
            max-width: calc(100vw - 2em);
        }
    </style>';
    echo '<main>';
    include("pannel.php");
    if (!empty($_GET["search"])) {
        include("produit.php");
        $listP = Produit::search($_GET["search"]);
        echo '<div class="add">';
        echo '<form action="controller.php" method="get" class="form-inline mt-3">
            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="researchAdmin">
                Rechercher
            </button>
        </form>';
        echo '<div class="produitsA mb-5 mt-5">';
        if (empty($listP)) {
            echo '<p class="lead text-light">Pas des resultas</p>';
        } else {
            foreach ($listP as $p) {
                echo $p->majPrint();
            }
        }
        echo '</div>';
        echo '</div>';
        echo '</main>';
    } else {
        header('Location:majP.php');
    }
}
