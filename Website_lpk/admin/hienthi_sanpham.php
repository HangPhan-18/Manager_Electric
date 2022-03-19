<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/danhmuc.php'; ?>
<?php include '../classes/thuonghieu.php'; ?>
<?php include '../classes/sanpham.php'; ?>
<?php include_once '../helpers/format.php'; ?>
<?php 
	$sanpham = new sanpham();
	$format = new format();
 ?>
 <?php
    //su dung phuong thuc gui tap tin, du lieu bang phuong thuc get hay post
  	 if(isset($_GET['idsanpham'])){
         $id = $_GET['idsanpham'];
         $xoasanpham = $sanpham->xoa_sanpham($id);
    }

 ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách sản phẩm</h2>
        <div class="block"> 
        	<?php 
        		if (isset($xoasanpham)) {
        			echo $xoasanpham;
        		}
        	 ?> 
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width="3%">ID</th>
					<th width="20%">Tên sản phẩm</th>
					<th width="10%">Tên danh mục</th>
					<th width="10%">Tên thương hiệu</th>
					<th width="10%">Giá sản phẩm</th>
					<th width="10%">Hình ảnh sản phẩm</th>
					<th width="20%">Mô tả sản phẩm</th>
					<th width="7%">Nổi bật</th>
					<th width="10%">Hành động</th>
				</tr>
			</thead>
			<tbody>
				<?php
					
					$hienthi_sanpham = $sanpham->hienthi_sanpham();
					if($hienthi_sanpham) {
						$i=0;
						while($result = $hienthi_sanpham->fetch_assoc()){
							$i++;	
				 ?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['Ten_Sanpham'] ?></td>
					<td><?php echo $result['Ten_Danhmuc'] ?></td>
					<td><?php echo $result['Ten_Thuonghieu'] ?></td>
					<td><?php echo $result['Gia_Sanpham'] ?></td>
					<td><img src="upload/<?php echo $result['Hinhanh_Sanpham'] ?>" width="80px">
						
					</td>
					<td>
						<?php
							echo$result['Mota_Sanpham']?>
					</td>
					<td style="color: red;">
					 <?php 
					 	if($result['Noibat_Sanpham']==1){
					 		echo 'Nổi bật';
					 	}
					 	else{
					 		echo ' Không nổi bật';
					 	}
					 ?>	 	
					 </td>
					<td><a href="suasanpham.php?idsanpham=<?php echo $result['ID_Sanpham'] ?>">Sửa</a> || <a href="?idsanpham=<?php echo $result['ID_Sanpham'] ?>">Xóa</a></td>
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
	<style>
		td{
			text-align: center;
		}
	</style>
<!-- Hiển thị 1 đến ... trong tổng số ... mục nhập -->
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
