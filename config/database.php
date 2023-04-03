<?php

try {

    $db = new PDO(
        'mysql:host=localhost;dbname=monpremierblog',
        'root',
        'root',
        [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_WARNING,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

} catch (Exception $e) {
    echo 'Echec de connexion: ' . $e->getMessage();
    exit; // Arret du script en cas d'erreur de connexion a la BDD
}

?>