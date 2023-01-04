<?php
// box-shadow: 0px 0px 1px 1px #8A4C31 inset;	box-shadow kullanımı şekli

//YAPILACAK
// item_comment eklenecek

include("ayarlar.php");

session_start();
?>
<html>

<head>
	<title>kaplanDevelop</title>
	<meta charset="utf-8" />
	<!-- bise fark etmedi ayni -->
	<!-- <meta http-equiv = "Content-Type" content = "text/html; charset = iso-8859-9" /> -->

	<!-- css -->
	<link rel="stylesheet" type="text/css" href="../dist/css/reset.css">
	<link rel="stylesheet" type="text/css" href="../dist/css/phpstyle.css">

	<!-- font-awesome -->
	<link rel="stylesheet" type="text/css" href="../font-awesome/css/font-awesome.min.css">

	<!-- Jquery -->
	<script src="../src/scripts/jquery-3.4.1.js"></script>

	<!-- custom.js -->
	<script src="../src/scripts/custom.js"></script>

</head>

<body>

	<!-- HEADER -->
	<header>
		<div class="center">

			<div class="header_left">
				<div class="logo">

				</div>
			</div>

			<div class="header_right">

				<?php
				if (isset($_SESSION["oturum"])) {
					echo '
						<ul id = "online">

							<li>
								<a href="user_page.php">' . $_SESSION["isim"] . $_SESSION["soyisim"] . '</a>
							</li>

							<li>
								<a href="cikis.php">Çıkış Yap</a>
							</li>
						
						</ul>
					';
				} else {
					echo '
						<ul id = "offline">
					
							<li>
								<a href="">Ziyaretçi</a>
							</li>

							<li>
								<a href="giris.php">GİRİŞ YAP</a>
							</li>

							<li>
								<a href="sheets.php">SHEETS</a>
							</li>

							<li>
								<a href="news.php">Günün Haberleri</a>
							</li>

							<li>
								<a href="../audio.html">Audio Player</a>
							</li>

							<li>
								<a href="map.php">Harita</a>
							</li>

							<li>
								<a href="kayit.php">KAYDOL</a>
							</li>
					
						</ul>
					';
				}
				?>
			</div>

		</div>
	</header>

	<a name="item_top"></a>

	<div class="container">
		<!-- LEFT_SECTION -->
		<div id="left_section">

			<div id="left_container">
				<ul>
					<li>
						<a href="index.php"><em class="fa fa-home"></em></a>
					</li>
					<li>
						<a href="#"><em class="fa fa-search"></em></a>
					</li>
					<li>
						<!-- <a href="#item_top"><em class="fa fa-angle-double-up"></em></a> -->
						<em id="l_up" class="fa fa-angle-double-up"></em>
					</li>
					<!-- <li>
						<a href="#"><em class="fa fa-angle-double-up"></em></a>
					</li>
					<li>
						<a href="#"><em class="fa fa-angle-double-down"></em></a>
					</li> -->
					<li>
						<!-- <a href="#footer"><em class="fa fa-angle-double-down"></em></a> -->
						<em id="l_down" class="fa fa-angle-double-down"></em>
					</li>
				</ul>
			</div>

		</div>

		<!-- MAIN_SECTION -->
		<div class="main_section">


			<?php

			// $find_item = mysqli_query($baglan, "SELECT * FROM items");
			// $get_item = mysqli_fetch_array($find_item);
			// extract($get_item);
			// echo $item_foto;
			// echo $item_id;


			$find_items = mysqli_query($baglan, "SELECT * FROM items ");
			while ($get_content = mysqli_fetch_assoc($find_items)) {
				extract($get_content);
				$get_item_id = $item_id;
				$get_item_user_id = $user_id;
			?>
				<div class="item">

					<div class="item_top">

						<div class="item_top_left">
							<ul>
								<li>
									<a href="#">
										<img src="">
									</a>
								</li>
								<li>
									<a href="#">
										<?php
										// echo $get_item_user_id;
										$a1 = mysqli_query($baglan, "SELECT * FROM users WHERE user_id = '$get_item_user_id'");
										while ($a2 = mysqli_fetch_assoc($a1)) {
											extract($a2);
											// echo var_dump($a2);
											if ($a2) {
												echo $user_name;
											} else {
												echo "Unknown User";
											}
										}

										// if (isset($_SESSION["oturum"])) {
										// }
										?>


									</a>
								</li>
							</ul>
						</div>

						<div class="item_top_right">
							<a href="#"><em class="fa fa-share"></em></a>
						</div>

					</div>

					<div class="item_center">
						<img src="">
						<?php
						echo "
								<img src='{$item_content}' width = '400px' height = '200px'>
							";
						?>
					</div>

					<div class="item_bottom">

						<div class="item_bottom_top">
							<ul>
								<li>
									<a href="#"><em class="fa fa-heart-o"></em></a>
									<a href="#"><em class="fa fa-share-alt"></em></a>
									<a href="#"><em class="fa fa-save"></em></a>
								</li>
							</ul>
						</div>

						<div class="item_bottom_center">
							<div class="comments">
								<ul>
									<!-- yazdırmanın php yolu-------------------------------------- -->
									<?php
									$c_find = mysqli_query($baglan, "SELECT * FROM comments WHERE item_id='$get_item_id' ");
									// echo var_dump($c_find);

									while ($c_info = mysqli_fetch_assoc($c_find)) {


										// array degerleri olarak bulundu degisken yapmak lazım onları. index degeri yerine degiskenleri kullanmak icin gerekli
										extract($c_info);
										$get_user_id = $user_id;
										$f1 = mysqli_query($baglan, "SELECT * FROM users WHERE user_id = '$get_user_id'");
										while ($f2 = mysqli_fetch_assoc($f1)) {
											extract($f2);

											echo "
												<li><span class='user'>" . $user_name . $user_surname . "</span><span class='user_commit'>" . $comment . "</span><span><a href='#'><em class='fa fa-heart-o'></em></a></span></li>
											";
										}
									}

									?>
									<!-- yazdırmanın html yolu-------------------------------------- -->
									<!-- bunu tam kesemedim -->
									<!-- 
							<li><span class="user">kullanıcı</span><span class="user_commit">---hello world---</span><span><a href="#"><em class="fa fa-heart-o"></em></a></span></li>
							<li><span class="user">kullanıcı</span><span class="user_commit">---hello world---</span><span><a href="#"><em class="fa fa-heart-o"></em></a></span></li>
							<li><span class="user">kullanıcı</span><span class="user_commit">---hello world---</span><span><a href="#"><em class="fa fa-heart-o"></em></a></span></li>
							<li><span class="user">kullanıcı</span><span class="user_commit">---hello world---</span><span><a href="#"><em class="fa fa-heart-o"></em></a></span></li> 
 -->

								</ul>
							</div>
						</div>

						<div class="item_bottom_bottom">
							<form action="comment.php" method="POST">
								<div class="form_container">

									<input type="text" name="yorum" placeholder="Salla Biseler...">
									<input type="hidden" name="item_id" value="<?php echo $get_item_id ?>">
									<!-- button yazınca oluyo input submit deyince olmuyo postalma olayında -->
									<button type="submit" name="new_comment">SEND</button>

								</div>
							</form>
						</div>

					</div>
				</div>
			<?php
			}
			?>
		</div>

		<!-- RIGHT_SECTION -->
		<div id="right_section">
			<div class="chat"></div>
			<div class="up_btn">
				yukarı çık
			</div>
		</div>

	</div>

	<div class="footer">
		<p>burası footer babuş &copykaplanDevelop</p>
		<a name="footer"></a>
	</div>

</body>

</html>