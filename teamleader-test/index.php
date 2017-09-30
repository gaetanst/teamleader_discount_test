<?php
include(dirname(__FILE__).'/logic/logic.php');
$logic = new \Logic\LogicImplementation();

if (isset($_POST['order'])) {
    echo $logic->checkForDiscounts(json_decode($_POST['order'], true));
}
else {
    echo 'Please pass an order';
}