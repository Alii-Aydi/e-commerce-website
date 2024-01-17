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
    }

    body {
        max-width: calc(100vw - 2em);
    }
</style>
<main>
    <?php include("pannel.php") ?>
    <div class="add pt-3 pb-3">
        <div class="row">
            <form action="produitsControl.php" method="post" class="text-light col-6 offset-3">
                <h2 class="text-center mb-3">Ajouter un Article</h2>
                <div class="form-group">
                    <label for="ref">Référence:</label>
                    <input type="text" class="form-control" id="ref" name="ref">
                </div>
                <div class="form-group">
                    <label for="lib">Libellé:</label>
                    <input type="text" class="form-control" id="lib" name="lib">
                </div>
                <div class="form-group">
                    <label for="prix">Prix:</label>
                    <input type="text" class="form-control" id="prix" name="prix">
                </div>
                <div class="form-group">
                    <label for="img">Image:</label>
                    <input type="url" class="form-control" id="img" name="img">
                </div>
                <div class="form-group">
                    <label for="desc">Description:</label>
                    <textarea class="form-control" id="desc" name="desc"></textarea>
                </div>
                <div class="form-group">
                    <label for="cat">Catégorie:</label>
                    <select class="form-control" id="cat" name="cat">
                        <?php
                        include("categories.php");
                        $listC = Categories::getCats();
                        foreach ($listC as $c) {
                            echo $c->printC();
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="ajt" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
</main>