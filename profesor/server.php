<?php
    $code = $_POST['code'];
    $input = $_POST['input'];

    $codepath = "files/php/" . "code" . "." . "php"; 
    $codepathTest = "files/php/" . "codeTest" . "." . "php"; 

    $codefile = fopen($codepath, "w");
    fwrite($codefile, $code);
    fclose($codefile);

    // $inputfile = fopen($codepathTest, "w");
    // fwrite($inputfile, $input);
    // fclose($inputfile);

    $commond = "phpunit --coverage-html files/coverage --coverage-filter files/php files/php/codeTest.php";
    $output = shell_exec($commond); 
    echo $output;

?>
