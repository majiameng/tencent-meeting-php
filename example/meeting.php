<?php

use Tinymeng\Tencent\Meeting\Client;

require_once "../vendor/autoload.php";

$meeting = Client::meeting([]);
var_dump($meeting);
