<?php
require __DIR__.'/autoload.php';
$gateway = new Braintree_Gateway([
    'accessToken' => <your token>,
]);
echo ($clientToken=$gateway->clientToken()->generate());
?>
