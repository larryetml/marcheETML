<?php 

//Si le paramètre N est défini dans l'url, le stocker dans la variable
$n = ((isset($_GET['n'])) ? $_GET['n'] : false);

include_once('index.php');
?>