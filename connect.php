<?php

    // Connection to the database
    try{
        $db = new PDO('mysql:host=localhost;dbname=meltingk_projects', 'root', '');
        $db->exec('SET NAMES "UTF8"');

        // Create an exception
    } catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
        die;
    }