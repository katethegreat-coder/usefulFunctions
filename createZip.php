<?php
/**
 * Create a Zip file of the content of a folder
 *
 * @return zip
 */
function createZip (){
    
    // Get real path of the "files" directory
    echo $rootPath = realpath('files');

    // Initialize an archive object
    $zip = new ZipArchive();

    // Define where the zip will be stored
    $zip->open('zip/file.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE );
    
    // Create "recursive directory iterator" to iterate recursively over filesystem directories, here "files" 
    /** @var SplFileInfo[] $files */
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rootPath), RecursiveIteratorIterator::LEAVES_ONLY);
    
    // Loop on files
    foreach ($files as $name => $file){
        // Skip the directory
        if (!$file->isDir()){
            // Get real and relative path for current files
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($rootPath) + 1);
    
            // Add current files to archive
            $zip->addFile($filePath, $relativePath);
        }
    }
    
    // Zip archive will be created only after closing the object
    $zip->close();
}
