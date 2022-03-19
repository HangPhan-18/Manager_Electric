<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/user.php'; ?>
<?php
    $quantri = new user();
    if(!isset($_GET['idquantri']) || $_GET['idquantri']== NULL){
        echo "<script>window.location= 'hienthi_quantri.php';</script>";
    }else{
         $id = $_GET['idquantri'];
    }
   //goi class trong file adminlogin
    //su dung phuong thuc gui tap tin, du lieu bang phuong thuc get hay post
     if($_SERVER['REQUEST_METHOD'] == 'POST'&& isset($_POST['submit'])){
      
        $sua_quantri = $quantri->sua_quantri($_POST, $id) ;   
    }
    
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa thông tin người quản trị</h2>

               <div class="block copyblock"> 
                <?php
                    if(isset($sua_quantri)) {
                        echo $sua_quantri;
                    }
                 ?>
                 <?php
                     $get_admin = $quantri->Layid_admin($id);

                     if($get_admin){
                        while($result =$get_admin->fetch_assoc()){
                     
                  ?>
                 <form action="" method="POST">
                    <table class="form">					
                          <tr>
                    <td>
                        <label>Họ và tên</label>
                    </td>
                    <td>
                        <input type="text" name="adminname" value="<?php echo $result['adminName']?>" class="medium" />
                    </td>
                </tr>   
                <tr>
                    <td>
                        <label>Tên người dùng</label>
                    </td>
                    <td>
                        <input type="text" name="adminuser"  value="<?php echo $result['adminUser']?>">
                    </td>
                </tr>        
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" name ="adminemail"  value="<?php echo $result['adminEmail']?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Password</label>
                    </td>
                    <td>
                        <input type="text" name="password"  value="<?php echo $result['adminPass']?>">
                    </td>
                </tr>
                  <tr>
                    <td>
                        <label>Level</label>
                    </td>
                    <td>
                       <select name ="level">
                            <?php
                            if($result['Level']==1){ 
                             ?>
                            <option selected value="1">1</option>
                            <option value="0">0</option>
                            <?php
                            }else{
                             ?>
                            <option value="1">1</option>
                            <option selected value="0">0</option>
                            <?php
                            } 
                             ?>
                       </select>
                    </td>
                </tr>     
                <tr>
                    <td>
                        <input type="submit" name="submit" Value="Sửa" />
                    </td>
                </tr>
                    </table>
                    </form>
                    <?php
                         }
                    } 
                     ?>

                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>