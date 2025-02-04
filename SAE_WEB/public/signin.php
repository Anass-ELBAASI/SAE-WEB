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
if($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $retour = $auth->authenticate($_POST['email'], $_POST['password']);
        if ($retour){
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$_POST['email']]);
            $id = $stmt->fetchColumn();
        }
        if ($id) {
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $_POST['email'];
            $message = "Authentification réussie";
            $code = "success";
        }


    }
    catch(Exception $e) {
        $retour = false;
        $message = "Authentification impossible : " . $e->getMessage();
        $code = "warning";
    }


    $_SESSION['flash'][$code] = $message;


    if (isset($retour) && $retour) {
        header("Location: ../public/accueil.php");
    } else {
        header("Location: ../public/page.php");
    }
    exit();
}