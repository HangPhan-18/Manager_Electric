<?php
 	 if(isset($_POST['themgiohang'])){
 	 	$tensanpham = $_POST['tensanpham'];
 	 	$idsanpham = $_POST['idsanpham'];
 	 	$gia = $_POST['gia'];
 	 	$soluong = $_POST['soluong'];
 	 	$hinhanh = $_POST['hinhanh'];
 	
 	 	$sql_select_giohang = mysqli_query($con, "SELECT * FROM giohang WHERE ID_Sanpham = '$idsanpham'");
 	 	$count = mysqli_num_rows($sql_select_giohang);
 	 	if($count>0){
 	 		$row_sanpham = mysqli_fetch_array($sql_select_giohang);
 	 		$soluong = $row_sanpham['Soluong']+1;
 	 		$sql_giohang = "UPDATE  giohang SET Soluong ='$soluong' WHERE ID_Sanpham = '$idsanpham'";
 	 	}else{
 	 		$soluong = $soluong;
 	 		$sql_giohang = "INSERT INTO giohang(ID_Sanpham, Ten_Sanpham, Gia, Soluong, Hinhanh) VALUES('$idsanpham', '$tensanpham', '$gia', '$soluong', '$hinhanh')";
 	 	}
 	 	$insert_row = mysqli_query($con, $sql_giohang);
 	 	if($insert_row==0){
 	 		header('Location: index.php?quanly=chitietsp&id='.$idsanpham);
 	 	}
 	 }
 	 elseif(isset($_POST['capnhatgiohang'])){	
 	 		for($i=0; $i<count($_POST['sanphamid']); $i++){
 	 			$idsanpham = $_POST['sanphamid'][$i];
 	 			$soluong = $_POST['soluong'][$i];
 	 			//kiem tra so luong khi cap nhat neu <= 0 thi xoa san pham ra khoi gio hang, nguoc lai thi cap nhat so luong
 	 			if($soluong<=0){
 	 				$sql_delete = mysqli_query($con, "DELETE FROM giohang WHERE ID_Sanpham = '$idsanpham'");
 	 			}else{
 	 				$sql_update = mysqli_query($con, "UPDATE giohang SET Soluong = '$soluong' WHERE ID_Sanpham = '$idsanpham'");
 	 			}
 	 			
 	 		}
 	 }
 	 elseif(isset($_GET['xoa'])){
 	 	$id = $_GET['xoa'];
 	 	$sql_xoa = mysqli_query($con, "DELETE FROM giohang WHERE ID_Giohang = '$id'");
 	 }
 	  //Neu ton tai submit name thanh toan, thi gan cac gia tri name cua cac truong trong form 
 	 elseif(isset($_POST['thanhtoan'])){
  		$name = $_POST['name'];
  		$phone = $_POST['phone'];
  		$address = $_POST['address'];
  		$email = $_POST['email'];
  		$password = md5($_POST['password']);
  		$note = $_POST['note'];	
  		$hinhthuc = $_POST['hinhthuc'];
  		// --> Thi Insert vao bang khach hang 
  		$sql_khachhang = mysqli_query($con,"INSERT INTO khachhang(Hoten, Sdt, Diachi, Email, Password, Thanhtoan, Ghichu) VALUES ('$name', '$phone', '$address', '$email', '$password', '$hinhthuc', '$note')");
  		//neu ton tai insert vao bang khach hang thi chon khach hang moi nhat de chuan bi insert vao bang don hang
  		if($sql_khachhang){
  				$sql_select_KH = mysqli_query($con, "SELECT * FROM khachhang ORDER BY ID_Khachhang DESC LIMIT 1");
  				$mahang = rand(0, 999999);
  				$row_khachhang = mysqli_fetch_array($sql_select_KH);
  				$idkhachhang = $row_khachhang['ID_Khachhang'];
  				$_SESSION['dangnhap_home'] = $row_khachhang['Hoten'];
  				$_SESSION['idkhachhang'] = $idkhachhang;

  				for($i=0; $i<count($_POST['thanhtoan_sanphamid']); $i++){
 	 				$idsanpham = $_POST['thanhtoan_sanphamid'][$i];
 	 				$soluong = $_POST['thanhtoan_soluong'][$i];
					$sql_donhang = mysqli_query($con, "INSERT INTO donhang(ID_Sanpham, ID_Khachhang, Soluong, Madonhang) VALUES('$idsanpham', '$idkhachhang', '$soluong', '$mahang')"); 

					$sql_giaodich = mysqli_query($con, "INSERT INTO giaodich(ID_Khachhang, ID_Sanpham, Soluong, Ma_Giaodich) VALUES('$idkhachhang', '$idsanpham', '$soluong', '$mahang')");
							//Sau khi dat don dat hang thi gio hang bi xoa
 	 				$sql_xoa_thanhtoan = mysqli_query($con, "DELETE FROM giohang WHERE ID_Sanpham = '$idsanpham'");	 		
 	 				}
  				}
  			} 
  		elseif(isset($_POST['thanhtoan_giohang'])){
  			$idkhachhang = $_SESSION['idkhachhang'];
  			$mahang = rand(0, 999999);
  			for($i=0; $i<count($_POST['thanhtoan_sanphamid']); $i++){
  				$idsanpham = $_POST['thanhtoan_sanphamid'][$i];
	 			$soluong = $_POST['thanhtoan_soluong'][$i];
	 			//sau khi da ton tai sesion dang nhap thi thuc hien insert du lieu vao trong bảng giỏ hàng và bảng giao dịch
				$sql_donhang = mysqli_query($con, "INSERT INTO donhang(ID_Sanpham, ID_Khachhang, Soluong, Madonhang) VALUES('$idsanpham', '$idkhachhang', '$soluong', '$mahang')"); 

				$sql_giaodich = mysqli_query($con, "INSERT INTO giaodich(ID_Khachhang, ID_Sanpham, Soluong, Ma_Giaodich) VALUES('$idkhachhang', '$idsanpham', '$soluong', '$mahang')");
				//Sau khi dat don dat hang thi gio hang bi xoa
 				$sql_xoa_thanhtoan = mysqli_query($con, "DELETE FROM giohang WHERE ID_Sanpham = '$idsanpham'");	 		
 	 			}
  			}
?>
	<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				Giỏ hàng của bạn
			</h3>
			<!-- //tittle heading -->
			<div class="checkout-right">
				<?php
					$sql_lay_giohang = mysqli_query($con, "SELECT * FROM giohang ORDER BY ID_Giohang DESC"); 
				 ?>	
				<div class="table-responsive">
					<form action="" method="POST">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>Thứ tự</th>
								<th>Sản phẩm</th>
								<th>Số lượng</th>
								<th>Tên sản phẩm</th>
								<th>Giá</th>
								<th>Tổng cộng</th>
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$i= 0;
								$total = 0;
								while($row_giohang = mysqli_fetch_array($sql_lay_giohang)){ 
									$tongcong = $row_giohang['Soluong'] * $row_giohang['Gia'];
									$total += $tongcong;
									$i++;
							 ?>

							<tr class="rem1">
								<td class="invert"><?php echo $i ?></td>
								<td class="invert-image">
									<a href="chitietsp.php">
										<img src="images/<?php echo $row_giohang['Hinhanh'] ?>" alt=" " class="img-responsive" width = 120px>
									</a>
								</td>
								<td class="invert">
									<!-- update so luong dua vao sanphamid, update nhieu san pham cung 1 luc nen sanphamid[] la 1 mang gom nhieu chuoi ID_Sanpham -->
									<input type="number" min="1" name="soluong[]" value="<?php echo $row_giohang['Soluong']?>">
									<input type="hidden" name="sanphamid[]" value="<?php echo $row_giohang['ID_Sanpham']?>">
								</td>
								<td class="invert"><?php echo $row_giohang['Ten_Sanpham'] ?></td>
								<td class="invert"><?php echo number_format($row_giohang['Gia']).'đ' ?></td>
								<td class="invert"><?php echo number_format($tongcong).'đ' ?></td>
								<td class="invert">
									<a href="?quanly=giohang&xoa=<?php echo $row_giohang['ID_Giohang']?>" style="color: red; font-size: 17px; font-weight: bold;">Xóa</a>
								</td>
							</tr>
							<?php 
								}
							 ?>
							 <tr>
							 	<td colspan="7" style="font-weight: bold; font-size: 20px; color: blue;">Tổng tiền: <?php echo number_format($total).'đ' ?></td>
							 </tr>
							 <tr>
							 	<td colspan="7"><input type="submit"class="btn btn-success" value="Cập nhật giỏ hàng" name="capnhatgiohang">
							 	<?php
							 	//Kiểm tra tồn tại sesion đăng nhập và phải có sản phẩm trong giỏ hàng
							 	$sql_giohang_select = mysqli_query($con, "SELECT * FROM giohang");
							 	//Kiểm đếm có bao nhiêu sản phẩm trong giỏ hàng
							 	$count_giohang = mysqli_num_rows($sql_giohang_select);
							 	if(isset($_SESSION['dangnhap_home']) && $count_giohang > 0){ 
							 		while($row_thanhtoan_giohang = mysqli_fetch_array($sql_giohang_select)){
							 	 ?>

							 	<input type="hidden" name="thanhtoan_sanphamid[]" value="<?php echo $row_thanhtoan_giohang['ID_Sanpham']?>">
								 <input type="hidden" min="1" name="thanhtoan_soluong[]" value="<?php echo$row_thanhtoan_giohang['Soluong']?>">
								 <?php
								 } 
								  ?>
							 	<input type="submit" class="btn btn-primary" value="Thanh toán giỏ hàng" name="thanhtoan_giohang"></td>
							 	<?php
							 	} 
							 	 ?>
							 </tr>
							
						</tbody>
					</table>
					</form>
				</div>
			</div>
			<?php
			if(!isset($_SESSION['dangnhap_home'])){ 
			 ?>
			<div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					<h4 class="mb-sm-4 mb-3">Thêm mới địa chỉ giao hàng</h4>
					<form action="" method="post" class="creditly-card-form agileinfo_form">
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row">
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="name" placeholder="Họ và tên" required="">
									</div>
									<div class="w3_agileits_card_number_grids">
										<div class="w3_agileits_card_number_grid_left form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Số điện thoại" name="phone" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Địa chỉ" name="address" required="">
											</div>
										</div>
									</div>
									<div class="controls form-group">
										<input type="text" class="form-control" placeholder="Email" name="email" required="">
									</div>
									<div class="controls form-group">
										<input type="text" class="form-control" placeholder="Password" name="password" >
									</div>
									<div class="controls form-group">
											<textarea style="resize: none;" class="form-control" placeholder="Ghi chú" name="note" required=""></textarea>
										
									</div>
									<div class="controls form-group">
										<select class="option-w3ls" name="hinhthuc"> 
											<option>Chọn hình thức thanh toán</option>
											<option value="0">Thanh toán bằng tiền mặt</option>
								

										</select>
									</div>
								</div>
								<?php
									$sql_laygiohang = mysqli_query($con, "SELECT * FROM giohang ORDER BY ID_Giohang DESC");
									while($row_thanhtoan = mysqli_fetch_array($sql_laygiohang)){

								 ?>
								 <input type="hidden" name="thanhtoan_sanphamid[]" value="<?php echo $row_thanhtoan['ID_Sanpham']?>">
								 <input type="hidden" min="1" name="thanhtoan_soluong[]" value="<?php echo $row_thanhtoan['Soluong']?>">									
									<?php
									} 
									 ?>

								<input type="submit" name="thanhtoan" class="btn btn-success" value="Vận chuyển tới địa chỉ này" style="width: 25%;"></input>
							</div>
						</div>
					</form>

				</div>
			</div>
			<?php 
		}
			 ?>
			
		
		</div>
	</div>
	<!-- //checkout page -->