<?php

require "photozou/app.php";

$test = main();

function main()
{
    echo 'donwload photozou-album id?:';
    $album_id = (int)trim(fgets(STDIN));
 
    echo 'donwload image limit?(1-1000):';
    $limit = (int)trim(fgets(STDIN));

    echo 'your photozou id?:';
    $photozou_id = trim(fgets(STDIN));

    echo 'your photozou password?:';
    $password = trim(fgets(STDIN));

    $phptozou = new Photozou($photozou_id, $password);
    $phptozou->download_all_images($album_id, $limit);
}