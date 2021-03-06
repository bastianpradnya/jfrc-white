<?php
require_once "../config/Apps.php";
$apps = new Apps();
$apps->clientHeader();

?>

<div class="login">
	<div class="wrap">

		<div class="col_1_of_login span_1_of_login">
			<h4 class="title">Pelanggan Baru</h4>
			<p>Bagi Costumer yang belum memiliki akun, silahkan anda mendaftar terlebih dahulu untuk menjadi member atau pelanggan toko JFRC 37. Dengan cara mengklick tombol Buat Acount </p>
			<div class="button1">
			   <a href="register.php"><input type="submit" name="Submit" value="Buat Account"></a>
			 </div>
			 <div class="clear"></div>
		</div>

		<?php
		include "../config/Dbconnect.php";

		//deklarate variabel
		$pesan = array(null, null, null, null );
		$email = $password = null;

		//validasi jika user sudah login dengan memanggil fungsi sessioncek
		sessionCek($conn);


		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			$email = $_POST['email'];
			$password = md5($_POST['password']);

			if(empty($email) || empty($password)){
				if(empty($email)){
					$pesan[0] = "* Email tidak boleh kosong.";
				}
				if(empty($password)){
					$pesan[1] = "* Password tidak boleh kosong.";
				}
			}else{

				$sql = "SELECT email FROM costumer WHERE email = '$email' AND password ='$password' ";
				$result = $conn->query($sql) or trigger_error($result);

				if($result->num_rows > 0){
					//pemanggilan record menjadi array asosiatif.
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

					//inisialisasi aray asosiatif menjadi var
					$sesNamaCustomer = $row ['email'];

					/*
					 * digunakan untuk membuat sesi,
					 * dimana sesi ini digunakan untuk mengakses halaman admin.
					 */
					$_SESSION['email'] = $sesNamaCustomer;

					/*
					 * jika username dan password sesuai dengan data yang ada didatabase
					 * maka dilakukan direct link ke halaman Admin.
					 * dirrect link ini menuju ke halaman dashboard admin.
					 */
					echo "
						<script language='javascript'>
							 window.location.href = '../client/'
						</script>
					   ";

					echo "Login Berhasil";
				}else{
					$pesan[2] = " Email atau Password salah";
				}
			}
		}
		?>

		<div class="col_1_of_login span_1_of_login">
			<div class="login-title">
				<h4 class="title">Login Pelanggan</h4>
				<div id="loginbox" class="loginbox">
					<p style="color: #990000"><?php echo $pesan[2] ?></p>
				<form action="#" method="post" >

				  <fieldset class="input">
					<p id="login-form-username">
					  <label for="modlgn_username">Email</label>
					  <input id="modlgn_username" type="text" name="email" class="inputbox" size="18" autocomplete="off" placeholder="Masukkan Email">
						<p style="color: #990000"><?php echo $pesan[0] ?></p>
					</p>

					<p id="login-form-password">
					  <label for="modlgn_passwd">Password</label>
					  <input id="modlgn_passwd" type="password" name="password" class="inputbox" size="18" autocomplete="off" placeholder="Masukkan Password">
					  <p style="color: #990000"><?php echo $pesan[1] ?></p>
					</p>

					<div class="remember">
						<p id="login-form-remember">
						  <label for="modlgn_remember"><a class="delivery-list" href="#">Lupa Password Anda ? </a></label>
					   </p>
						<input type="submit" name="Submit" class="button" value="Login"><div class="clear"></div>
					 </div>
				  </fieldset>

				 </form>
			</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<br><br><br><br><br><br>
<?php
$apps->clientFooter();
?>

      