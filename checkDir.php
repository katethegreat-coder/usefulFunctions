<?php
/**
 * Function to check if a directory is empty
 *
 * @param [type] $directory
 * @return bool
 */
    function checkDir($directory){
        $foundFiles=0;

        if (is_dir($directory)) {

            if ($dir = opendir($directory)){

                while (($file = readdir($dir)) !== false && $foundFiles==0){

                    if ($file!="." && $file!=".." ) {
                        $foundFiles=1;
                    } 
                }

                closedir($dir);
            }

        }else {
            echo ("Le répertoire n'existe pas");
        }    

        if($foundFiles==0) {
            echo ("Le répertoire existe mais il est vide");
        } else {

            echo ("Le répertoire contient des fichiers");
            // launch any function or code

        }
    }