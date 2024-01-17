<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="./accueil.php">Alfa</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="./accueil.php">Accueil</a>
            </li>
            <?php if (!(isset($_SESSION['username']))) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="./log.php">Inscrivez-vous</a>
                </li>
            <?php } ?>
            <?php if ((isset($_SESSION['username']))) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="./out.php">Logout</a>
                </li>
            <?php } ?>
            <?php if ((isset($_SESSION['role'])) && $_SESSION['role'] == "admin") { ?>
                <li class="nav-item">
                    <a class="nav-link" href="./admin.php">Admin</a>
                </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link" href="./contact.php">Contact</a>
            </li>
        </ul>
        <div class="navbar-nav ml-auto">
            <form action="controller.php" method="get" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="research">
                    Rechercher
                </button>
            </form>
            <?php
            if (isset($_SESSION['cart'])) {
                $num_items = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $num_items++;
                }
            } else {
                $num_items = 0;
            }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="panier.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                    </svg>
                    Panier <span class="text-danger"><?php echo $num_items ?> </span></a>
            </li>
        </div>
    </div>
</nav>