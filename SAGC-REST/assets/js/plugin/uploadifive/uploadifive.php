<?php

/*
  UploadiFive
  Copyright (c) 2012 Reactive Apps, Ronnie Garcia
 */

// Set the uplaod directory
$uploadDir = '../../../../uploads/';

// Set the allowed file extensions
$fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // Allowed file extensions

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
    if (!is_dir($uploadDir . $_POST['targetFolderName'])) {
        mkdir($uploadDir . $_POST['targetFolderName']);
    }

    $tempFile = $_FILES['Filedata']['tmp_name'];

    //Pega o nome da pasta enviado pelo formData e "Seta"
    $targetFolder = $uploadDir . $_POST['targetFolderName'];
    $uploadDir = $targetFolder;

    //Pega o nome que o arquivo no final do upload irá possuir, passado pelo formData.
    $fileName = $_POST['targetFileName'];

    // Validate the filetype
    $fileParts = pathinfo($_FILES['Filedata']['name']);
    $fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // File extensions   

    $finalFileName = $fileName . '.' . $fileParts['extension'];
    $targetFile = rtrim($uploadDir, '/') . '/' . $finalFileName;
    
    if (in_array(strtolower($fileParts['extension']), $fileTypes)) {

        // Save the file
        move_uploaded_file($tempFile, $targetFile);
        echo 1;
    } else {

        // The file type wasn't allowed
        echo 'Invalid file type.';
    }
}
?>