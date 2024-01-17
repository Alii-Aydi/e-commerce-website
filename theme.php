<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>panier</title>
    <link rel="stylesheet" href="style.css">
</head>

<style>
    .container-sm {
        max-width: 768px;
        margin: 0 auto;
    }

    .display-4 {
        font-size: 2.5rem;
        font-weight: bold;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        background-color: #f5f5f5;
        color: black;
        margin-bottom: 2rem;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        text-align: left;
        vertical-align: top;
        border-top: 1px solid #ccc;
    }

    .table th {
        font-weight: bold;
        background-color: #eee;
    }

    .table tbody tr:nth-of-type(even) {
        background-color: #f9f9f9;
    }

    .table tfoot tr:last-of-type th,
    .table tfoot tr:last-of-type td {
        border-top: 2px solid #333;
        font-weight: bold;
    }

    .text-light {
        color: black;
    }

    .text-right {
        text-align: right;
    }
</style>

<main class="container-sm mt-5 mb-5">
    <h1 class="display-4 text-center mb-5 text-light">Facture</h1>
    <table class="table text-light">
        <thead class="">
            <tr>
                <th scope="col">Produit</th>
                <th scope="col">Prix</th>
                <th scope="col">Quantite</th>
                <th scope="col">Total</th>
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
            echo '</tr>'; ?>
            <tr>
                <td colspan="3" class="text-right">Tax (18%)</td>
                <td>$<?php echo $total_cost * .18 ?> </td>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Total</th>
                <th>$<?php echo $total_cost * 1.18 ?></th>
            </tr>
        </tfoot>
    </table>
</main>

</body>

</html>