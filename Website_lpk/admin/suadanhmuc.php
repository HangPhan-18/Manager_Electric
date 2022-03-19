<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/danhmuc.php'; ?>
<?php
    $danhmuc = new danhmuc();
    if(!isset($_GET['iddanhmuc']) || $_GET['iddanhmuc']== NULL){
        echo "<script>window.location= 'hienthi_danhmuc.php';</script>";
    }else{
         $id = $_GET['iddanhmuc'];
    }
   //goi class trong file adminlogin
    //su dung phuong thuc gui tap tin, du lieu bang phuong thuc get hay post
     if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $tendanhmuc = $_POST['tendanhmuc'];
        

        $sua_danhmuc = $danhmuc->sua_danhmuc($tendanhmuc, $id) ;   
    }
    
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục sản phẩm</h2>

               <div class="block copyblock"> 
                <?php
                    if(isset($sua_danhmuc)) {
                        echo $sua_danhmuc;
                    }
                 ?>
                 <?php
                     $get_tendanhmuc = $danhmuc->Layid_danhmuc($id);

                     if($get_tendanhmuc){
                        while($result =$get_tendanhmuc->fetch_assoc()){
                     
                  ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name ="tendanhmuc" value="<?php echo $result['Ten_Danhmuc']?>" placeholder="Nhập vào tên danh mục muốn sửa" class="medium" />
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