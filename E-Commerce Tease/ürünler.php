<?php include'baglan.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Made For You</title>

	<link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
	<link rel="shortcut icon" href="img/profile.ico"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">

	<link rel="stylesheet" href="css/ürünler.css">

</head>

<body>

	<nav>
		<div class="container clearfix">
			<div id="logo-box">
				<a href="index.php" class="logo text-uppercase">
					Made For You
				</a>
			</div>
			<div id="nav-links" class="responsive">

				<div id="myNav" class="overlay">
					<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
					<div class="overlay-content">
						<?php 

						session_start();

						if (isset($_SESSION['k_adi'])){
							$k_adi=$_SESSION['k_adi']?>


							<a href="sepet.php" class="text-uppercase" style="font-weight: bold;">Sepetim</a>
							<a href="siparislerim.php" class="text-uppercase" style="font-weight: bold;">Siparislerim</a>
							<a href="accountdetail.php" class="text-uppercase" style="font-weight: bold;"><i class="fas fa-shopping-cart"></i><?php echo $_SESSION['k_adi']; ?></a>
							<a href="hakkinda.php" class="text-uppercase" style="font-weight: bold;">Hakkında</a>
							<a href="logout.php" class="text-uppercase" style="font-weight: bold;"><i class="fas fa-sign-out-alt"></i></a>

						<?php } 




						else 
							{ ?>


								<a href="ürünler.php" class="text-uppercase" style="font-weight: bold;">Ürünler</a>
								<a href="sepet.php" class="text-uppercase" style="font-weight: bold;">Sepetim</a>
								<a href="hakkinda.php" class="text-uppercase" style="font-weight: bold;">Hakkında</a>
								<a href="login.php" class="text-uppercase" style="font-weight: bold;"><i class="fa fa-user icon"></i>Giriş</a>


							<?php } ?>
							
						</div>
					</div>
					<ul>
						<li class="nav-item">
							<a href="javascript:void(0)" class="nav-link text-uppercase nav-icon" onclick="openNav()">
								<i class="fas fa-bars"></i>
							</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link text-uppercase" style="color:#2C3E50;">

							</a>
						</li>
						<li class="nav-item">
								<a href="sepet.php" class="nav-link text-uppercase">
									<i></i>Ürünler
								</a>
							</li>
						
						<li class="nav-item">
							<a href="hakkinda.php" class="nav-link text-uppercase">
								Hakkında
							</a>
						</li>
						

						<?php 

						session_start();

						if (isset($_SESSION['k_adi'])){
							$k_adi=$_SESSION['k_adi']?>

							<li class="nav-item">
								<a href="siparislerim.php" class="nav-link text-uppercase">
									Siparislerim
								</a>
								<li class="nav-item">
									<a href="accountdetail.php" class="nav-link text-uppercase">
										<i class="fas fa-user"></i><?php echo $_SESSION['k_adi']; ?>
									</a>
								</li>
								<li class="nav-item">
							<a href="sepet.php" class="nav-link text-uppercase">
								<i class="fas fa-shopping-cart"></i>
							</a>
						</li>
								<li class="nav-item">
									<a href="logout.php" class="nav-link text-uppercase">
										<i class="fas fa-sign-out-alt"></i>
									</a>
								</li>
							<?php } 


							else 
								{ ?>

						<li class="nav-item">
							<a href="sepet.php" class="nav-link text-uppercase">
								<i class="fas fa-shopping-cart"></i>
							</a>
						</li>

									<li class="nav-item">
										<a href="login.php" class="nav-link text-uppercase">
											<i class="fa fa-user icon"></i>Giriş
										</a>
									</li>
								<?php } ?>


							</ul>
						</div>
					</div>
				</nav>

				<header class="header">
					<a href="ürünler.php" class="logo" class="text-uppercase"><i><b>ÜRÜNLER</b></i></a>
					<input class="menu-btn" type="checkbox" id="menu-btn" />
					<label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>

					<ul class="menu">
						<li><a href="ciftlericin.php">Çiftler İçin</a></li>
						<li><a href="kolyeler.php">Kolyeler</a></li>
						<li><a href="bileklikler.php">Bileklikler</a></li>
						<li><a href="küpeler.php">Küpeler</a></li>
						<li><a href="halhal.php">Halhal</a></li>

					</ul>
				</header>


				<section id="portfolio">

					<div class="container">

						<h1 class="text-uppercase" style="font-size:30px; color:#646060;">ÜRÜNLER</h1>
						<hr class="star-dark">

						<br>



						<div id="portfolio-images" class="clearfix">


							<?php 

require('ürünsayi.php'); // sayfada gösterilecek içerik miktarını belirtiyoruz.

$sorgu = "SELECT COUNT(*) AS toplam FROM urunler,kategoriler WHERE urunler.kategoriler_id=kategoriler.kategoriler_id
";
$sonuc = $conn->query($sorgu); 
$row6 = $sonuc->fetch_assoc();
$toplam_icerik = $row6['toplam'];

$toplam_sayfa = ceil($toplam_icerik / $sayfada);

// eğer sayfa girilmemişse 1 varsayalım.
$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;

// eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
if($sayfa < 1) $sayfa = 1; 

// toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
// kaçıncı içerikten başlanacağını ifade edecek limit değeri.
$limit = ($sayfa - 1) * $sayfada;


$barsor2 ="SELECT urunler.ad as 'ad',urunler.fiyat as 'fiyat',urunler.urun_id as 'id',urunler.resimyolu
FROM urunler,kategoriler
WHERE urunler.kategoriler_id=kategoriler.kategoriler_id 
Order By fiyat asc limit ".$limit.",".$sayfada;
$result2 = $conn->query($barsor2);
if ($result2->num_rows > 0) {


	while($row = $result2->fetch_assoc()) 
	{ 

		?>

		<form id="detailform" name="detailform" action="details.php" method="POST">


			<div class="col">
				<div class="portfolio-item">
					<a href="#">	

						<h3 class="text-uppercase"><?php echo $row['ad']; ?></h3>
						<input type="hidden" name="urunlerid"  value="<?php echo $row['id']; ?>"/>

						<img class="img-fluid" src="img/<?php echo $row['resimyolu']; ?>" alt="">

						
						
						<div class="img-overlay">	
							<div class="icon">
								<button style="
								border: none;
								background: none;" type="submit" name="detaylar"><a><i class="fas fa-search-plus fa-3x"></i></a></button>
							</div>



							<button style="border: none;background: none;"  name="sepeteekle" type="submit" >
								<a class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span> Sepete Ekle</a>
							</button>

						</form>


					</div>
					<h4><?php echo $row['fiyat']; ?> TL</h4>
				</a>

			</div>

		</div>

	</form>

<?php }
}

?>
</div>














</div>


<?php 


for($s = 1; $s <= $toplam_sayfa; $s++) {
if($sayfa == $s) { // eğer bulunduğumuz sayfa ise link yapma.
	?>
	<div class="pageC">
		<a href=""><?php echo $s; ?></a>
		<?php 


	} 
	else {
		?>
		<div class="pageC">
			<?php 


			echo '<a href="?sayfa=' . $s . '">' . $s . '</a> ';
		}
		?>
	</div>

	<?php 

}
?>
<hr class="star-dark">

</section>
<section id="portfoliola">
	<div class="container">
		<h1 class="text-uppercase">
			ÖNERİLEN ÜRÜNLER
		</h1>
		<hr class="star-dark">

		<div id="portfolio-images" class="clearfix">

			<?php  
			$barsor3 = "SELECT urunler.ad as 'ad',urunler.fiyat as 'fiyat',urunler.urun_id as 'id',urunler.resimyolu
			FROM urunler,kategoriler
			WHERE urunler.kategoriler_id=kategoriler.kategoriler_id AND kategoriler.ad='anasayfa'
			Order By fiyat asc ";

			$result3 = $conn->query($barsor3);
			if ($result3->num_rows > 0) {
				

				while($row3 = $result3->fetch_assoc()) 
				{ 

					?>
					<form id="detailform" name="detailform" action="details.php" method="POST">

						<div class="col">
							<div class="portfolio-item">

								<a href="#">	
									<img class="img-fluid" src="img/<?php echo $row3['resimyolu']; ?>" alt="">
									<input type="hidden" name="urunlerid"  value="<?php echo $row3['id']; ?>"/>
									<div class="img-overlay">	
										<div class="icon">

											<button style="
											border: none;
											background: none;" name="detaylar" type="submit"><a ><i class="fas fa-search-plus fa-3x"></i></a></button>
										</div>							
									</div>
								</a>


							</div>

						</div>
					</form>
				<?php }
			}
			?>


		</div>

	</div>
</div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="jquery.big-slide.js"></script>

<script>
	function openNav() {
		document.getElementById("myNav").style.width = "100%";
	}

	function closeNav() {
		document.getElementById("myNav").style.width = "0%";
	}
</script>
<script>

	$('.pageC a').click(function() {
		$(this).addClass('active').siblings().removeClass('active');
	});
</script>

<?php include 'footer.php' ?>