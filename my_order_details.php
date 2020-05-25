<?php
require('top.php');
require_once('function.php');
$order_id=get_safe_value($con,$_GET['id']);
?>
<div class="body__overlay"></div>
      
 <div class="wishlist-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-remove"><span class="nobr">Product ID</span></th>
                                                <th class="product-name"><span class="nobr">Product Image </span></th>
                                                <th class="product-price"><span class="nobr"> Qty </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Price </span></th>
                                                <th class="product-stock-stauts"><span class="nobr">Total Price Status</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $uid=$_SESSION['USER_ID'];
                                                $res=mysqli_query($con,"SELECT distinct(order_detail.id), order_detail.*,product.name,product.image from order_detail,product,orders where order_detail.order_id='$order_id' and orders.user_id='$uid' and product.id=order_detail.product_id");
                                                $total_price=0;
                                                while($row=mysqli_fetch_assoc($res)){
                                                    $total_price=$total_price+($row['qty']*$row['price']);
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
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<?php
require('footer.php');
?>