<?php

if( isset( $_POST ) ) {

    $file = $_FILES['file'];


    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));


    if ( $fileActualExt == 'json' ){

        if($fileError === 0){

            if($fileSize < 50000){

                $fileDestination = 'assets/scripts/'.$fileName;

                move_uploaded_file($fileTmpName, $fileDestination);

                header("Location: index.html?uploadsuccess");
            } else {

                echo "Error! Datei zu groß!";
            }
        } else {

            echo "Error! Fehlercode: "+$fileError;
        }
    } else {

        echo "Nur JSON Dateien erlaubt!";
    }
}