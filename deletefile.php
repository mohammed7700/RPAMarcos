<?php

$postValue = $_POST['filename'];
$fileName = str_replace(' ', '', $postValue);
$fileInfo = glob("./assets/scripts/".$fileName.".json");

if(!unlink($fileInfo[0])) {

    header("Location: index.php?fehlerBeimLoeschen");
} else {

    header("Location: index.php?loeschenErfolgreich");
}