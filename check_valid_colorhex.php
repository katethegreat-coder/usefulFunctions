<?php

    // session_start();

    /**
     * Function checking if a hexadecimal code is inserted for colors
     *
     * @param [type] $colorCode
     * @return bool
     */
    function check_valid_colorhex($color) {

        // Strip off the # sign
        $colorCode= ltrim($color, '#');

        // Check if all of the characters are from 3 to 6 hexadecimal digits. 
        if (ctype_xdigit($colorCode) && (strlen($colorCode) == 6 || strlen($colorCode) == 3)) {
            return true;
        } else {
            return false;
            // $_SESSION['error']="La couleur doit être au formate héxadécimal";
        }
            
    }