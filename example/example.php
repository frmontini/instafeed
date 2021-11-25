<?php 

include('../src/InstaFeed/Utils.php');

$utils = new InstaFeed\Utils();

/* TO GET INSTAGRAM CONTENT */

$username = 'socialeadsbrasil';
$data = $utils->getData($username);
print_r($data);

/* TO CLEAR CACHE */

$username = 'example';
$utils->noCache($username);


?>