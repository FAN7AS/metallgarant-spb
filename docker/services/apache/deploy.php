#!/usr/local/bin/php
<?php

include "/ndepto/tempLate.php";
include "/ndepto/nRuner.php";
include "/ndepto/mOver.php";

use ndepto\tempLate;
use ndepto\nRuner;
use ndepto\mOver;


return (new nRuner($argv))
    ->action(function(nRuner $runner) {

        $template = new tempLate($runner, '/templates');
        $template->run();


    })
    ->action(function(nRuner $runner) {

        $mover = new mOver($runner, '/templates/.parsed');
        $mover->run();

    })
    ->run();