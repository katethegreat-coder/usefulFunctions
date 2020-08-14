<?php

    /********************THUMBNAIL************************/

    /**
     * Cut the picture into a square
     *
     * @param int $size size of the square
     * @param string $name picture's file name
     */
    function thumb($size , $name) {

        // Separate name from extension
        $beginName= pathinfo($name, PATHINFO_FILENAME);
        $extension= pathinfo($name, PATHINFO_EXTENSION);

        // Define the entire name
        $entireName= __DIR__ . '/../uploads/' . $name;

        // Create a thumbnail
        $thumbData=getimagesize($entireName);
        $finalWidth=$size;
        $finalHeight=$size;
        $thumbnailDestination= imagecreatetruecolor($finalWidth, $finalHeight);

        switch($thumbData['mime']) {
            case 'image/jpeg':
                $srcPicture= imagecreatefromjpeg($entireName);
                break;
            case 'image/png':
                $srcPicture= imagecreatefrompng($entireName);
                break;
            case 'image/gif':
                $srcPicture= imagecreatefromgif($entireName);
                break;
        }

        // Set up distances from the corner and if the picture is a square
        $cornerDisY=0;
        $cornerDisX=0;

        if ($thumbData[0]>$thumbData[1]) {
            // Distance from the corner if landscape
            $cornerDisX=($thumbData[0]-$thumbData[1])/2;
            $squareSizeSrc= $thumbData[1];
        }

        if ($thumbData[0]<=$thumbData[1]) {
            // Distance from the corner if portrait
            $cornerDisY=($thumbData[1]-$thumbData[0])/2;
            $squareSizeSrc= $thumbData[0];
            }

        imagecopyresampled(
            $thumbnailDestination,
            $srcPicture,
            0,
            0,
            $cornerDisX,
            $cornerDisY,
            $finalWidth,
            $finalHeight,
            $squareSizeSrc,
            $squareSizeSrc,
        );

        // Save the resampled picture and define the path
        $nameresampledThumb= __DIR__ . '/../uploads/' . $beginName . '-'. $size. 'x' . $size . '.' . $extension;

        switch ($thumbData['mime']) {
            case 'image/jpeg':
                imagejpeg($thumbnailDestination, $nameresampledThumb);
                break;
            case 'image/png':
                imagepng($thumbnailDestination, $nameresampledThumb);
                break;
            case 'image/gif':
                imagegif($thumbnailDestination, $nameresampledThumb);
                break;
        }
        
        imagedestroy($thumbnailDestination);
        imagedestroy($srcPicture);

    }

    /********************RESIZE************************/

    /**
     * Resize the picture -75%
     * 
     * @param string $name picture's file name
     * @param int $percent percent of the decrease
     *
     */
    function resizedPicture ($name, $percent) {

        // Separate name from extension
        $beginName= pathinfo($name, PATHINFO_FILENAME);
        $extension= pathinfo($name, PATHINFO_EXTENSION);

        // Create the entire name of the picture
        $entireName= __DIR__ . '/../uploads/' . $name;

        // Get picture's information
        $pictureData=getimagesize($entireName);

        // set size of the final picture
        $finalWidth= $pictureData[0] * $percent/100;  // [0]: width
        $finalHeight= $pictureData[1] * $percent/100; // [1]: height

        // create an empty space for the final picture in RAM Memory
        $pictureDestination= imagecreatetruecolor($finalWidth, $finalHeight);

    // load source picture into memory depending on its type
    switch($pictureData['mime']) {
        case 'image/jpeg':
            $srcPicture= imagecreatefromjpeg($entireName);
            break;
        case 'image/png':
            $srcPicture= imagecreatefrompng($entireName);
            break;
        case 'image/gif':
            $srcPicture= imagecreatefromgif($entireName);
            break;
    }

    // copy the source picture into the destination picture
    imagecopyresampled(
        $pictureDestination,        
        $srcPicture,                
        0,                          
        0,                          
        0,                          
        0,                         
        $finalWidth,                
        $finalHeight,               
        $pictureData[0],            
        $pictureData[1]            
    );

    $nameresampledImage= __DIR__ . '/../uploads/' . $beginName . '-'. $percent.'.' . $extension;

    switch ($pictureData['mime']) {
        case 'image/jpeg':
        imagejpeg($pictureDestination, $nameresampledImage);
            break;
        case 'image/png':
        imagepng($pictureDestination, $nameresampledImage);
            break;
        case 'image/gif':
        imagegif($pictureDestination, $nameresampledImage);
            break;
    }

    // destroy pictures not used to free any memory associated with pictures
    imagedestroy($pictureDestination);
    imagedestroy($srcPicture);

    }

?>