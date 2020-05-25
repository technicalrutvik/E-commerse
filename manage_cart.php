<?php
 require('connection.php');
 require('function.php');
 require('add_to_cart.php');

 $pid=get_safe_value($con,$_POST['pid']);
 $qty=get_safe_value($con,$_POST['qty']);
 $type=get_safe_value($con,$_POST['type']);

$obj = new add_to_cart();

if($type=='add'){
	$obj->addproduct($pid,$qty);
}
if($type=='remove'){
	$obj->removeproduct($pid);
}
if($type=='update'){
	$obj->updateproduct($pid,$qty);
}
echo $obj->totalproduct();
?>