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
        overflow: hidden;
    }
</style>
<main>
    <?php include("pannel.php") ?>
    <div class="add pt-3 pb-3 container-sm">
        <div class="row">
            <section class="text-light col-12">
                <div class="mb-5">
                    <h1 class="display-4 mb-5">Ajouter</h1>
                    <?php
                    include("categories.php");
                    $listC = Categories::getCats();
                    foreach ($listC as $c) {
                        echo $c->printGC();
                    }
                    ?>
                    <div type="button" class="btn btn-primary rounded-circle p-2" data-toggle="modal" data-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bookmark-plus" viewBox="0 0 16 16">
                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                            <path d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4z" />
                        </svg>
                    </div>
                    <div class="modal fade text-dark" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter une categorie</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="catControl.php" method="post" class="">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="cat">Categorie:</label>
                                            <input type="text" class="form-control" id="cat" name="cat">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-primary" name="ajt">Ajouter</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mt-5">
                <div class="">
                    <h1 class="display-4 mb-5">Supprimer</h1>
                    <form action="catControl.php" method="post" class="">
                        <div class="form-group">
                            <label for="cat">Catégories:</label>
                            <select class="form-control w-25" id="cat" name="cat">
                                <?php
                                $listC = Categories::getCats();
                                foreach ($listC as $c) {
                                    echo $c->printC();
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" name="supp" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
    </div>
</main>

<script>
    $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    })
</script>