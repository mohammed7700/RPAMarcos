<?php

foreach (new DirectoryIterator('./assets/scripts') as $file) {

    if($file -> getExtension() === 'json')
        $array[] = json_decode(file_get_contents($file -> getPathname()), true);
}

$result = json_encode($array, JSON_PRETTY_PRINT);

echo $result;
