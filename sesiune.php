<h1>Just for debugging</h1>
<?php


    session_start();

    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";


    echo "<pre>";
    print_r($_SERVER);
    echo "</pre>";
    
    // $filename = "myfile.txt";
    // $file = fopen($filename,"a+");

    // $filesize = filesize($filename);
    // $filedata = fread($file, $filesize);


    // echo $filedata;

    // $array = explode("t",$filedata);

    // print_r($array);
?>