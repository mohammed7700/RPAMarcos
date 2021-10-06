<?php

$fileName = $_POST['filename'];
$fileInfo = glob("./assets/scripts/".$fileName.".json");

if(!unlink($fileInfo[0])) {

    header("Location: index.php?fehlerBeimLoeschen");
} else {

    header("Location: index.php?loeschenErfolgreich");
}