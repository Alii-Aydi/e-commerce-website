<?php
if (isset($_POST["ajt"])) {
    $cat = $_POST['cat'];

    include("categories.php");
    Categories::addCat($cat);

    header("Location: gererCategories.php");
}

if (isset($_POST["supp"])) {
    $cat = $_POST['cat'];

    include("categories.php");
    Categories::supCat($cat);

    header("Location: gererCategories.php");
}
