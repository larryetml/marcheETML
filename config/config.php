<?php
/**
 * ETML
 * Auteur : Larry Lam
 * Description : Définir les constantes et retourner le tableau.
 * @return : le tableau avec toutes les constantes
 */

//Adresse de l'api qui génère les codes QR
$QR_URL = 'https://api.qrserver.com/v1/create-qr-code/';
//Adresse du site qui sera mise dans le code QR
$WEB_URL = 'http://localhost/marcheetml/student.php';
//Taille de l'image du code QR
$QR_SIZE = '?size=150x150';
//Retourne le tableau avec toutes les constantes
return $CONSTS = [
    'qrUrl'=> $QR_URL,
    'webUrl'=> $WEB_URL,
    'qrSize'=> $QR_SIZE
];
?>