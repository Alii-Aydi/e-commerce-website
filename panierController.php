<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require_once 'vendor/autoload.php';

if (isset($_POST['add_to_cart'])) {
    $ref = $_POST['ref'];
    include("produit.php");
    $prod = Produit::getProduit($ref);

    if (isset($_SESSION['cart'][$ref])) {
        $_SESSION['cart'][$ref]['quantity']++;
    } else {
        $_SESSION['cart'][$ref] = array(
            "lib" => $prod->lib,
            "price" => $prod->prix,
            "quantity" => 1
        );
    }

    header('Location: panier.php');
}

if (isset($_POST['remove_from_cart'])) {
    $product_id = $_POST['product_id'];

    unset($_SESSION['cart'][$product_id]);

    header('Location: panier.php');
    exit();
}

if (isset($_POST['checkout'])) {
    if (!(isset($_SESSION['username']))) {
        header('Location: log.php');
        exit;
    }

    ob_start();
    include './theme.php';

    $name = $_SESSION['username']; //nom client
    $email = $_SESSION['email']; //email client
    $subject = 'Facture';
    $message = ob_get_clean();

    $inlineStyler = new CssToInlineStyles();
    $message = $inlineStyler->convert($message);

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; //email provider kima gmail yahoo...
    $mail->SMTPAuth = true;
    $mail->Username = 'calculi.tn@gmail.com'; //l email mta3ek... lazem tactivi 2 steps verfication w app password
    $mail->Password = 'klrreyrpxqvhggit'; //l app password mouch l mot de pass l 3adia
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);
    $mail->setFrom($email, $name); //client
    $mail->addAddress($email); //l address li mach teb3thelha l email
    $mail->Subject = ($subject);
    $mail->isHTML(true);
    $mail->Body = $message;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->send();

    include("commande.php");
    include("ligneCommande.php");
    $dateCommande = date('Y-m-d H:i:s');
    $commandeID = Commande::AddCommande($dateCommande, $_SESSION['id']);
    LigneCommande::AddLigneCommande($commandeID);

    unset($_SESSION['cart']);

    header("Location: ./response.html");
}
