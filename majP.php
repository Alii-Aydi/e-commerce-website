<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username']) || $_SESSION['role'] != "admin") {
    header('Location: error.php');
    exit;
}
echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
<link rel="stylesheet" href="style.css"> <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>';
?>
<style>
    .add {
        margin-left: 300px;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    body {
        max-width: calc(100vw - 2em);
    }
</style>
<main>
    <?php include("pannel.php") ?>
    <div class="add">
        <form action="controller.php" method="get" class="form-inline mt-3">
            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="researchAdmin">
                Rechercher
            </button>
        </form>
        <div class="produitsA mb-5 mt-5">
            <?php
            include("produit.php");
            $listP = Produit::getProduits();
            foreach ($listP as $p) {
                echo $p->majPrint();
            }
            ?>
        </div>
    </div>
</main>