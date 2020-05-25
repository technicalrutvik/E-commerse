<?php
require_once 'top.php';

if(isset($_GET['type']) && $_GET['type']!=''){
   $type = get_safe_value($con,$_GET['type']);
   if($type=='status'){
      $operation= get_safe_value($con,$_GET['operation']);
      $id= get_safe_value($con,$_GET['id']);
      if($operation=='active'){
         $status='1';
      }
      else{
         $status='0';  
      }

      $update_status = "UPDATE product SET status ='$status' WHERE id='$id'";
      mysqli_query($con,$update_status);  

   }
    if($type=='delete'){
      
      $id= get_safe_value($con,$_GET['id']);
   
      $delete_sql = "DELETE FROM product WHERE id='$id'";
      mysqli_query($con,$delete_sql);

   }
}

$sql = "SELECT product.*,catagories.catagories FROM product,catagories WHERE product.catagories_id=catagories.id ORDER BY product.id DESC";
$res = mysqli_query($con,$sql);

?>

<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title"> Product </h4>
                           <h4 class="box-link"><a href="manage_product.php"> Add Products </a></h4>

                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>ID</th>
                                       <th>Categories</th>
                                       <th>Name</th>
                                       <th>Image</th>
                                       <th>MRP</th>
                                       <th>Price</th>
                                       <th>Qty</th> 
                                       <th></th>
                                      
                                      
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    $i=1; 
                                    while($row=mysqli_fetch_assoc($res)) {?>
                                    <tr>
                                       <td class="serial"><?php echo $i ?></td> 
                                       <td><?php echo $row['id'] ?></td>
                                       <td><?php echo $row['catagories'] ?></td>
                                       <td><?php echo $row['name'] ?></td>
                                       <!-- <td><img src="../Media/product/<?php echo $row['image'] ?>"/></td> -->
                                       <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'] ?>"/></td>

                                       <td><?php echo $row['mrp'] ?></td>
                                       <td><?php echo $row['price'] ?></td>
                                       <td><?php echo $row['qty'] ?></td>
                                       

                                       <td>
                                          <?php
                                          if($row['status']==1){
                                          
                                               
                                            echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a>&nbsp;&nbsp;</span>";
                                          }
                                          else{ 
                                             echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a>&nbsp;&nbsp;</span>";
                                          }
                                          echo "&nbsp;<span class='badge badge-edit'><a href='manage_product.php?id=".$row['id']."'>Edit</a></span>";
                                          echo "&nbsp;<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
                                          

                                           ?> 
                                       </td>
                                    </tr>
                                  <?php }  ?>
                                   
                                 </tbody>
                              </table>
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


