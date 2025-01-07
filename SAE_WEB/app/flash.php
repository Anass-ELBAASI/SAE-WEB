<?php

function messageFlash() : void {
    if(isset($_SESSION['flash'])) {
        foreach($_SESSION['flash'] as $type => $message) {
            echo "<div class='alert alert-$type alert-dismissible fade show position-fixed w-100 top-0' role='alert' style='z-index: 1050;'>
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
$message</div>";


        }
        unset($_SESSION['flash']);
    }
}