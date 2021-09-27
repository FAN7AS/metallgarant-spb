<?php
file_put_contents('log.txt', date("d.m.Y H:i:s") . ": " . print_r($_REQUEST, true) . PHP_EOL, FILE_APPEND | LOCK_EX);