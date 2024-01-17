<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['username'])) {
    header('Location: accueil.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        include("user.php");
        $error;
        User::log($username, $password, $error);
    } else {
        $error = 'Champ vide!';
    }
}

echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
<link rel="stylesheet" href="style.css"> <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>';
include("nav.php");
?>
<main class="container-sm mt-5 mb-5">
    <div class="row">
        <div class="col-sm-6 offset-3 text-light">
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error: </strong> <?php echo $error; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
            <h1 class="display-4 text-center">Inscrivez-vous</h1>
            <form action="authLog.php" id="log" method="post" class="mt-5">
                <div class="form-group">
                    <label for="username">Nom:</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Nom">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe:</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe">
                </div>
                <button type="submit" class="btn btn-primary">inscriver</button>
            </form>
            <p class="lead">Pas de compte? <a href="/My_PHP_Projects/Projet-PHP/signe.php">Creez un compte.</a></p>
        </div>
    </div>
</main>
</main>
<?php
include("footer.php")
?>