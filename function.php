<?php
function pr($arr){
	echo '<pre>';
	print_r($arr);
}

function prx($arr){
	echo '<pre>';
	print_r($arr);
	die;
}
function get_safe_value($con,$str){
	if($str!=null){
		$str=trim($str); 
	return mysqli_real_escape_string($con,$str);
	}
}
function get_product($con,$limit='',$cat_id='',$product_id=''){
	$sql="select product.*,catagories.catagories from product,catagories where product.status=1 ";
	if($cat_id!=''){
		$sql.=" and product.catagories_id=$cat_id  ";
	}
	if($product_id!=''){
		$sql.=" and product.id=$product_id  ";
	}

	$sql.=" and product.catagories_id=catagories.id ";

	$sql.=" order by product.id desc ";
	
	if($limit!=''){
		$sql.=" limit $limit ";
	}
	
	 $res=mysqli_query($con,$sql);
	$data=array();
	while($row=mysqli_fetch_assoc($res)){
		$data[]=$row;
	}
	return $data;
}
?>