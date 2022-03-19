<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/khachhang.php'); 
    include_once ($filepath.'/../helpers/format.php'); 
 ?>
<?php
   
    if(!isset($_GET['idkhachhang']) || $_GET['idkhachhang']== NULL){
        echo "<script>window.location= 'donhang.php'</script>";
    }else{
         $id = $_GET['idkhachhang'];
    }
     $khachhang= new khachhang();
    
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thông tin chi tiết của khách hàng</h2>

               <div class="block copyblock"> 

                 
                 <?php
                     $get_khachhang = $khachhang->hienthi_khachhang($id);

                     if($get_khachhang){
                        while($result = $get_khachhang->fetch_assoc()){
                     
                  ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                Tên khách hàng
                            </td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['Ten_Khachhang']?>"  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Địa chỉ
                            </td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['Diachi']?>"  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Email
                            </td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['Email']?>"  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                               Số điện thoại
                            </td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['Sdt']?>"  class="medium" />
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