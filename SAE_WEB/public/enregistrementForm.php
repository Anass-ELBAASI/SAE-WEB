<?php
if(!session_id())
    session_start();

use Romai\SaeWeb\traitement;
use Romai\SaeWeb\remplirFormu;
use Romai\SaeWeb\BddConnect;


require_once '../vendor/autoload.php';
require_once '../app/flash.php';

messageFlash();

$bdd = new BddConnect();

$pdo = $bdd->connexion();
$trousseau = new traitement($pdo);
$form= new remplirFormu($trousseau);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $qualite_vie_serialized = isset($_POST['qualite_vie_detail']) ? implode(',', $_POST['qualite_vie_detail']) : null;
        $retour = $form->enregistrerForm($_SESSION['user_id'], $_POST['region'], $_POST['age'], $_POST['lieu_vie'], $_POST['orientation_cdaph'], $_POST['choix_vie'], $_POST['activites_pro'], $qualite_vie_serialized, $_POST['besoins_soutien']);
        $message = "Vos réponses ont bien été enregistrées";
        $code = "success";
    }
    catch(Exception $e) {
        var_dump($_POST['qualite_vie_detail']);
        $retour = false;
        $message = "Enregistrement impossible : " . $e->getMessage();
        $code = "warning";
    }


    $_SESSION['flash'][$code] = $message;

    $direction = $_SERVER['HTTP_ORIGIN'];
    header("Location: ../public/formulaire.html");

}