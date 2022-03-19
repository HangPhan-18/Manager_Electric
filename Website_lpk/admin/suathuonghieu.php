<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/thuonghieu.php'; ?>
<?php
    $thuonghieu = new thuonghieu();

    if(!isset($_GET['idthuonghieu']) || $_GET['idthuonghieu']== NULL){
        echo "<script>window.location= 'hienthi_thuonghieu.php';</script>";
    }else{
         $id = $_GET['idthuonghieu'];
    }
   //goi class trong file adminlogin
    //su dung phuong thuc gui tap tin, du lieu bang phuong thuc get hay post
     if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $tenthuonghieu = $_POST['tenthuonghieu'];
        $sua_thuonghieu = $thuonghieu->sua_thuonghieu($tenthuonghieu, $id) ;   
    }
    
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa thương hiệu sản phẩm</h2>

               <div class="block copyblock"> 
                <?php
                    if(isset($sua_thuonghieu)) {
                        echo $sua_thuonghieu;
                    }
                 ?>
                 <?php
                     $get_tenthuonghieu = $thuonghieu->Layid_thuonghieu($id);

                     if($get_tenthuonghieu){
                        while($result =$get_tenthuonghieu->fetch_assoc()){
                     
                  ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['Ten_Thuonghieu']?>"name ="tenthuonghieu" placeholder="Nhập vào tên thương hiệu muốn sửa" class="medium" />
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