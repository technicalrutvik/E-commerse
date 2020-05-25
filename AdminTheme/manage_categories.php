<?php
require_once 'top.php';
$categories='';
$catagories='';
$msg='';

if(isset($_GET['id']) && $_GET['id']!=null){
   $id = get_safe_value($con,$_GET['id']);
   $res =mysqli_query($con,"SELECT * FROM catagories WHERE id= '$id'");
   $check=mysqli_num_rows($res);
   if($check>0){
      $row=mysqli_fetch_assoc($res);
      $categories=$row['catagories']; 
   }
   else{
      header('location:categories.php');
         die();
   } 
}


if(isset($_POST['submit'])){
    $catagories=get_safe_value($con,$_POST['categories']);

   $res =mysqli_query($con,"SELECT * FROM catagories WHERE catagories= '$catagories'");
   $check=mysqli_num_rows($res); 
   if($check>0){
       if(isset($_GET['id']) && $_GET['id']!=null){
         $getData = mysqli_fetch_assoc($res);
            if($id==$getData['id']){

            } else{
               $msg='Categories already exist';
             }
       }
       else{
            $msg='Categories already exist';
       }

   }
   if($msg==''){
       if(isset($_GET['id']) && $_GET['id']!=null){
         $sql=mysqli_query($con,"UPDATE catagories SET catagories = '$catagories' WHERE id='$id'");
         header('location:categories.php');
         }
         else{
               $sql=mysqli_query($con,"INSERT INTO catagories(catagories,status) VALUES ('$catagories','1')");
         }
         header('location:categories.php');
         die();
   }
}
?>

   <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Categories</strong><small> Form</small></div>
                        <form method="post">
                            <div class="card-body card-block">
                           <div class="form-group"><label for="company" class=" form-control-label">Categories</label>
                              <input type="text" name="categories" id="company" placeholder="Enter Categories name" class="form-control" required value="<?php echo $categories ?>"></div>
                     
                           <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                           <span id="payment-button-amount">Submit</span>
                           </button>
               <div class="field_error"><?php echo $msg; ?></div>

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


