<?php

require_once 'HitCounter.php';

$result = new HitCounter();

$result->getNumbersOfUsers();
//Comment this line to see the log data
//$result->getLogRecords();