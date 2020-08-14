<?php

/**
 * Function to create folders
 *
 * @param $name
 * @return bool
 */
function create_dir($name) {
    if (!empty($name) && !is_dir($name)) {
        if (create_dir(dirname($name))) {
            return mkdir($name);
            echo 'Le répertoire '.$name.' vient d\'être créé!'; 
        } else {
            return false;
            echo 'erreur de création';
        }
    } else {
        return true;
        echo 'Le répertoire existe déjà!';  
    }
}
