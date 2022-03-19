<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/giohang.php'); 
	include_once ($filepath.'/../helpers/format.php'); 
 ?>

 <?php
	 $cart = new giohang();
  if(isset($_GET['id'])){
      $id = $_GET['id'];
      $time = $_GET['thoigian'];
      $gia = $_GET['gia'];
      $xuly = $cart->xuly_donhang($id, $time, $gia);
    }

    if(isset($_GET['idxoa'])){
      $id = $_GET['idxoa'];
      $time = $_GET['thoigian'];
      $gia = $_GET['gia'];
      $xoa = $cart->xoa_donhang($id, $time, $gia);
    }

  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Đơn hàng</h2>
                <div class="block"> 
                <?php
                if(isset($xuly)){
                	echo $xuly;
                } 
                 ?> 
                  <?php
                if(isset($xoa)){
                	echo $xoa;
                } 
                 ?>        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">Thứ tự</th>
							<th width="25%">Sản phẩm</th>
							<th width="7%">Số lượng</th>
							<th width="7%">Giá</th>
							<th width="10%">Thời gian đặt</th>
							<th width="15%">Xem chỉ tiết khách hàng</th>
							<th width="10%">Quản lý</th>

						</tr>
					</thead>
					<tbody>
						<?php
							$cart = new giohang();
							$format = new format();
							$lay_donhang = $cart->lay_donhang();
							$i= 0;
							if($lay_donhang){
								while($result = $lay_donhang->fetch_assoc()){
									$i++;
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $result['Ten_Sanpham'] ?></td>
							<td><?php echo $result['Soluong'] ?></td>
							<td><?php echo $result['Gia_Sanpham']?></td>
							<td><?php echo $format->formatDate($result['Ngay_Dathang']) ?></td>
							<td><a href="khachhang.php?idkhachhang=<?php echo $result['ID_Khachhang'] ?>">Tại đây</a></td>
							<td>
								<?php
								if($result['Tinhtrang']==0){
								 ?>
									 <a href="?id=<?php echo $result['ID_Dathang']?>&gia=<?php echo $result['Gia_Sanpham']?>&thoigian=<?php echo $result['Ngay_Dathang']?>">Đang chờ xử lý...</a>

								 <?php
								}elseif($result['Tinhtrang']==1){ 
								  ?>
								 	<a href="?id=<?php echo $result['ID_Dathang']?>&gia=<?php echo $result['Gia_Sanpham']?>&thoigian=<?php echo $result['Ngay_Dathang']?>">Đang vận chuyển</a>

								 <?php
								 }elseif($result['Tinhtrang']==2){ 
								  ?>
								 <a href="?idxoa=<?php echo $result['ID_Dathang']?>&gia=<?php echo $result['Gia_Sanpham']?>&thoigian=<?php echo $result['Ngay_Dathang']?>">Xóa đơn hàng</a>
								<?php
								} 
								 ?>
							</td>
						</tr>
						<?php
							}
						} 
						 ?>
						
						
						
						
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
