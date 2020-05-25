<?php
require('top.php');
$order_id=get_safe_value($con,$_GET['id']);
if(isset($_POST['yes'])){
	echo $update_order_status=$_POST['yes'];
	mysqli_query($con,"UPDATE orders set order_status='$update_order_status'");
}
?>

<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title"> Order Details </h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
 
                           	   <table class="table">
                                         <tbody>
                                            <?php

                                                $res=mysqli_query($con,"SELECT distinct(order_detail.id), order_detail.*,product.name,product.image ,orders.address,orders.city,orders.pincode from order_detail,product,orders where order_detail.order_id='$order_id'  and product.id=order_detail.product_id");
                                                $total_price=0;
                                                while($row=mysqli_fetch_assoc($res)){
                                                    $total_price=$total_price+($row['qty']*$row['price']);
                                                    $address=$row['address'];
                                                    $city=$row['city'];
                                                    $pincode=$row['pincode'];
                                                   
                                            ?>	
                                            <tr>
                                           
                                            <td class="product-name"><a href="#"><?php echo $row['name'] ?></a></td>
                                            <td class="product-name"><a href="#"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']  ?>"></a></td>
                                             <td class="product-price"><span class="amount"><?php echo $row['qty'] ?></span></td>
                                            <td class="product-name"><a href="#"><?php echo $row['price'] ?></a></td>
                                            <td class="product-price"><span class="amount"><?php echo $row['price']*$row['qty'] ?></span></td>
                                        
                                            </tr>
                                        <?php } ?>
                                           <tr>
                                             <td colspan="3"></span></td>
                                            <td class="product-name">Total Price</td>
                                            <td class="product-price"><span class="amount"><?php echo $total_price ?></span></td>
                                        
                                            </tr>
                                        </tbody>
                                    </table>
                                          <div class="address.details">
                                        	<strong>Address</strong>
                                        	<?php echo $address ?>, <?php echo $city ?>,    <?php echo $pincode ?><br/><br/>
                                        	<strong> Order Status</strong>
                                        	<?php
                                        	$res=mysqli_query($con,"SELECT order_status.name from order_status,orders where orders.id='$order_id' and orders.order_status=order_status.id");
                                        	$order_status_arr=mysqli_fetch_assoc($res);
                                        	echo $order_status_arr['name'];
                                        	?>
                                        	<div>
                                        		<form method="post"  >
                                        			<select class="form-control" name="yes"  >
						                                <option>Select Status</option>
						                                <?php
						                                  $res=mysqli_query($con,"SELECT * FROM order_status");
						                                  while($row=mysqli_fetch_assoc($res)){
						                                    if($row['id']==$update_order_status){
						                                    echo "<option selected value=".$row['id'].">".$row['name']."</option>";
						                                    }
						                                    else{
						                                    echo "<option value=".$row['id'].">".$row['name']."</option>";
						                                    }
						                                       
						                                  }
							                                ?>
							                        </select>
							                        <input type="submit" class="form-control">
                                        		</form>
                                        	</div>
                                        </div>  
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
</div>







<?php
require('footer.php');
?>