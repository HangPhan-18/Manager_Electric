<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/danhmuc.php'; ?>
<?php
    $danhmuc = new danhmuc();//goi class trong file adminlogin
    //su dung phuong thuc gui tap tin, du lieu bang phuong thuc get hay post
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $tendanhmuc = $_POST['tendanhmuc'];
        

        $them_danhmuc = $danhmuc->them_danhmuc($tendanhmuc) ;
    } 
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm mới danh mục sản phẩm</h2>

               <div class="block copyblock"> 
                <?php
                    if(isset($them_danhmuc)) {
                        echo $them_danhmuc;
                    }
                 ?>
                 <form action="themdanhmuc.php" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name ="tendanhmuc" placeholder="Nhập vào tên danh mục" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Lưu" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>