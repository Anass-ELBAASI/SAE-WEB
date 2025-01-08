<?php
if(!session_id())
    session_start();

use Romai\SaeWeb\DBUserRepository;
use Romai\SaeWeb\Authentification;
use Romai\SaeWeb\BddConnect;


require_once '../vendor/autoload.php';

$bdd = new BddConnect();

$pdo = $bdd->connexion();
$trousseau = new DBUserRepository($pdo);
$auth = new Authentification($trousseau);
//var_dump($_POST);
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $retour = $auth->register($_POST['email'], $_POST['password'], $_POST['repassword'], $_POST['nom'], $_POST['prenom']);
        $message = "Vous êtes enregistré. Vous pouvez vous authentifier";
        $code = "success";
    }
    catch(Exception $e) {
        $retour = false;
        $message = "Enregistrement impossible : " . $e->getMessage();
        $code = "warning";
    }


    $_SESSION['flash'][$code] = $message;
    $_SESSION['admin']= $_POST['email'];

    header("Location: ../public/page.php");

}