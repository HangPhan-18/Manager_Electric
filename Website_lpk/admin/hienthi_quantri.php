<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/user.php'; ?>

<?php
    $quantri = new user();//goi class trong file adminlogin
    //su dung phuong thuc gui tap tin, du lieu bang phuong thuc get hay post
  	 if(isset($_GET['idxoa'])){
         $id = $_GET['idxoa'];
         $xoa_nguoidung = $quantri->xoa_quantri($id);
    }

 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách danh mục</h2>
                <div class="block"> 
                	<?php
                		if(isset($xoadanhmuc)){
                			echo $xoadanhmuc;
                		} 
                	 ?>

                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Họ tên người dùng</th>
							<th>Tên người dùng</th>
							<th>Email</th>
							<th>Level</th>
							<th>Quản lý</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$hienthi_user = $quantri->hienthi_quantri();
							if($hienthi_user) {
								$i=0;
								while($result = $hienthi_user->fetch_assoc()){
									$i++;
							
							
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $result['adminName'] ?></td>
							<td><?php echo $result['adminUser'] ?></td>
							<td><?php echo $result['adminEmail'] ?></td>
							<td><?php echo $result['Level'] ?></td>

							<td><a href="sua_quantri.php?idquantri=<?php echo $result['Idadmin'] ?>">Sửa</a> || <a onclick="return confirm('Bạn chắc có muốn xóa người dùng này chứ?')"href="?idxoa=<?php echo $result['Idadmin']?>">Xóa</a></td>
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

