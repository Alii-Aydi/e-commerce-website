<?php
if (isset($_POST["ajt"])) {
    $ref = $_POST['ref'];
    $lib = $_POST['lib'];
    $prix = $_POST['prix'];
    $img = $_POST['img'];
    $desc = $_POST['desc'];
    $cat = $_POST['cat'];
    include("produit.php");
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
            <link rel="stylesheet" href="style.css"> <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>';

    try {
        if (empty($ref) || empty($lib) || empty($prix) || empty($img) || empty($desc) || empty($cat)) {
            echo '<style>
                .add {
                    margin-left: 300px;
                }
                body {
                    max-width: calc(100vw - 2em);
                }
            </style>';
            include("pannel.php");
            echo '<div class="add pt-3 pb-3">
                <div class="row">
                    <form action="produitsControl.php" method="post" class="text-light col-6 offset-3">
                        <h2 class="text-center mb-3">Ajouter un Article</h2>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error: </strong> Valider les champs!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
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
                    <select class="form-control" id="cat" name="cat">';
            include("categories.php");
            $listC = Categories::getCats();
            foreach ($listC as $c) {
                echo $c->printC();
            }
            echo '</select>
                </div>
                <button type="submit" name="maj" class="btn btn-info">Maj</button>
            </form>
        </div>
    </div>
</main>';
            exit;
        }

        $product = new Produit($ref, $lib, $prix, $img, $desc, $cat);
        Produit::add($product);
        echo '<style>
                .add {
                    margin-left: 300px;
                }
            </style>';
        include("pannel.php");
        echo '<div class="add pt-3 pb-3">
                <div class="row">
                    <form action="produitsControl.php" method="post" class="text-light col-6 offset-3">
                        <h2 class="text-center mb-3">Ajouter un Article</h2>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Creation complet!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
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
                    <select class="form-control" id="cat" name="cat">';
        include("categories.php");
        $listC = Categories::getCats();
        foreach ($listC as $c) {
            echo $c->printC();
        }
        echo '</select>
                </div>
                <button type="submit" name="maj" class="btn btn-info">Maj</button>
            </form>
        </div>
    </div>
</main>';
        exit;
    } catch (Exception $e) {
        echo '<style>
                .add {
                    margin-left: 300px;
                }
                body {
                    max-width: calc(100vw - 2em);
                }
            </style>';
        include("pannel.php");
        echo '<div class="add pt-3 pb-3">
                <div class="row">
                    <form action="produitsControl.php" method="post" class="text-light col-6 offset-3">
                        <h2 class="text-center mb-3">Ajouter un Article</h2>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error: </strong> Ref dublicer!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
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
                    <select class="form-control" id="cat" name="cat">';
        include("categories.php");
        $listC = Categories::getCats();
        foreach ($listC as $c) {
            echo $c->printC();
        }
        echo '</select>
                </div>
                <button type="submit" name="maj" class="btn btn-info">Maj</button>
            </form>
        </div>
    </div>
</main>';
        exit;
    }
}

if (isset($_POST["mod"])) {

    $ref = $_POST['ref'];
    include("produit.php");
    $prod = Produit::getProduit($ref);

    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
            <link rel="stylesheet" href="style.css"> <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>';

    echo '<style>
                .add {
                    margin-left: 300px;
                }
                body {
                    max-width: calc(100vw - 2em);
                }
            </style>';
    include("pannel.php");
    echo '<div class="add pt-3 pb-3">
        <div class="row">
            <form action="produitsControl.php" method="post" class="text-light col-6 offset-3">
                <h2 class="text-center mb-3">Modifier Article</h2>
                <div class="form-group">
                    <input type="hidden" type="text" class="form-control" id="ref" name="ref" value="' . $prod->ref . '">
                </div>
                <div class="form-group">
                    <label for="lib">Libellé:</label>
                    <input type="text" class="form-control" id="lib" name="lib" value="' . $prod->lib . '">
                </div>
                <div class="form-group">
                    <label for="prix">Prix:</label>
                    <input type="text" class="form-control" id="prix" name="prix" value="' . $prod->prix . '">
                </div>
                <div class="form-group">
                    <label for="img">Image:</label>
                    <input type="url" class="form-control" id="img" name="img" value="' . $prod->img . '">
                </div>
                <div class="form-group">
                    <label for="desc">Description:</label>
                    <textarea class="form-control" id="desc" name="desc">' . $prod->desc . '</textarea>
                </div>
                <div class="form-group">
                    <label for="cat">Catégorie:</label>
                    <select class="form-control" id="cat" name="cat">';
    include("categories.php");
    $listC = Categories::getCats();
    foreach ($listC as $c) {
        if ($c->cat === $prod->cat) {
            echo '<option value="' . $c->cat . '" selected> ' . $c->cat . '</option>';
        } else {
            echo '<option value="' . $c->cat . '"> ' . $c->cat . ' </option>';
        }
    }
    echo '</select>
                </div>
                <button type="submit" name="maj" class="btn btn-info">Maj</button>
            </form>
        </div>
    </div>
</main>';
    exit;
}

if (isset($_POST["maj"])) {
    $ref = $_POST['ref'];
    $lib = $_POST['lib'];
    $prix = $_POST['prix'];
    $img = $_POST['img'];
    $desc = $_POST['desc'];
    $cat = $_POST['cat'];
    $message = '';

    if (empty($ref) || empty($lib) || empty($prix) || empty($img) || empty($desc) || empty($cat) || !is_numeric($prix) || $prix < 0) {
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
        <link rel="stylesheet" href="style.css"> <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>';

        echo '<style>
            .add {
                margin-left: 300px;
            }
            body {
                max-width: calc(100vw - 2em);
            }
        </style>';
        include("pannel.php");
        echo '<div class="add pt-3 pb-3">
    <div class="row">
        <form action="produitsControl.php" method="post" class="text-light col-6 offset-3">
            <h2 class="text-center mb-3">Modifier Article</h2>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error: </strong> Valider les champs!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
            <div class="form-group">
                <input type="hidden" type="text" class="form-control" id="ref" name="ref" value="' . $ref . '">
            </div>
            <div class="form-group">
                <label for="lib">Libellé:</label>
                <input type="text" class="form-control" id="lib" name="lib" value="' . $lib . '">
            </div>
            <div class="form-group">
                <label for="prix">Prix:</label>
                <input type="text" class="form-control" id="prix" name="prix" value="' . $prix . '">
            </div>
            <div class="form-group">
                <label for="img">Image:</label>
                <input type="url" class="form-control" id="img" name="img" value="' . $img . '">
            </div>
            <div class="form-group">
                <label for="desc">Description:</label>
                <textarea class="form-control" id="desc" name="desc">' . $desc . '</textarea>
            </div>
            <div class="form-group">
                <label for="cat">Catégorie:</label>
                <select class="form-control" id="cat" name="cat">';
        include("categories.php");
        $listC = Categories::getCats();
        foreach ($listC as $c) {
            echo '<option value="' . $c->cat . '"> ' . $c->cat . '</option>';
        }
        echo '</select>
            </div>
            <button type="submit" name="maj" class="btn btn-info">Maj</button>
        </form>
    </div>
</div>
</main>';
        exit;
    }

    include("produit.php");
    Produit::updateProduit($ref, $lib, $prix, $img, $desc, $cat);

    header("Location: majP.php");
    exit();
}

if (isset($_POST["supp"])) {
    $ref = $_POST['ref'];
    include("produit.php");
    Produit::deleteProduit($ref);
    header("Location: majP.php");
}
