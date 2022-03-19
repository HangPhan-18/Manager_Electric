<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/thuonghieu.php';?>
<?php include '../classes/danhmuc.php'; ?>
<?php include '../classes/sanpham.php'; ?>
<?php include '../classes/khachhang.php'; ?>
<?php include_once '../helpers/format.php'; ?>

<?php
	$khachhang = new khachhang();
	$fm = new format();
	if(isset($_GET['binhluanid'])){
        $id = $_GET['binhluanid']; 
        $xoabinhluan = $khachhang->xoa_binhluan($id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Bình luận</h2>
        <div class="block"> 
        <?php
        if(isset($xoabinhluan)){
        	echo $xoabinhluan;
        	}
        ?> 
        	
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tên khách hàng bình luận</th>
					<th>Bình luận</th>
					<th>Quản lý</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$id = session::get('idsanpham');
				$dsbinhluan = $khachhang->hienthi_binhluan($id);
				if($dsbinhluan){
					$i = 0;
					while($result = $dsbinhluan->fetch_assoc()){
						$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['Ten_Khachhang'] ?></td>
					<td><?php echo $result['Chitiet_Binhluan'] ?></td>
									
					<td><a href="?binhluanid=<?php echo $result['ID_Binhluan'] ?>">Xóa</a></td>
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
