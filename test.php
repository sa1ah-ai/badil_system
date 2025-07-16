<?php
// $command = escapeshellcmd("python ./python_code/app.py anyname");
$command = escapeshellcmd("python ./python_code/app.py");
exec($command, $output, $reslutcode);
var_dump($output);
