<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/thuonghieu.php'; ?>
 <?php
    $thuonghieu = new thuonghieu();//goi class trong file adminlogin
    //su dung phuong thuc gui tap tin, du lieu bang phuong thuc get hay post
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $tenthuonghieu = $_POST['tenthuonghieu'];
        

        $them_thuonghieu = $thuonghieu->them_thuonghieu($tenthuonghieu) ;
    } 
 ?> 
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm mới thương hiệu</h2>

               <div class="block copyblock"> 
               <?php
                    if(isset($them_thuonghieu)) {
                        echo $them_thuonghieu;
                    }
                 ?> 
                 <form action="themthuonghieu.php" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name ="tenthuonghieu" placeholder="Nhập vào tên thương hiệu" class="medium" />
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