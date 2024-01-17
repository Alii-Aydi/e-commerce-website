<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>panier</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include("nav.php")
    ?>
    <main class="container-sm mt-5 mb-5">
        <h1 class="display-4 text-center mb-5 text-light">Panier</h1>
        <form action="panierController.php" method="post">
            <table class="table text-light">
                <thead class="">
                    <tr>
                        <th scope="col">Produit</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Quantite</th>
                        <th scope="col">Total</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($_SESSION['cart'])) {
                        // Display each item in the cart
                        foreach ($_SESSION['cart'] as $product_id => $product) {
                            echo '<tr>';
                            echo '<td>' . $product['lib'] . '</td>';
                            echo '<td>$' . $product['price'] . '</td>';
                            echo '<td>' . $product['quantity'] . '</td>';
                            echo '<td>$' . $product['price'] * $product['quantity'] . '</td>';
                            echo '<td>';
                            echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
                            echo '<input class="btn btn-danger" type="submit" name="remove_from_cart" value="Remove">';
                            echo '</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <?php $total_cost = 0;
                    if (!empty($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $product) {
                            $total_cost += $product['price'] * $product['quantity'];
                        }
                    }
                    echo '<tr>';
                    echo '<td colspan="3" class="text-right"><b>SubTotal:</b></td>';
                    echo '<td>$' . $total_cost . '</td>';
                    echo '<td></td>';
                    echo '</tr>'; ?>
                    <tr>
                        <th colspan="3" class="text-right">Tax (18%)</th>
                        <td><?php echo $total_cost * .18 ?> </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-right">Total</th>
                        <td><?php echo $total_cost * 1.18 ?></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <?php
            if (!(isset($_SESSION['cart']))) {
                echo '<button type="submit" name="checkout" class="btn btn-primary float-right" disabled>Confirmer</button>';
            } else {
                echo '<button type="submit" name="checkout" class="btn btn-primary float-right">Confirmer</button>';
            }
            ?>
        </form>
    </main>
    <?php
    include("footer.php")
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>