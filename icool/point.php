<?php 
	require_once('required/connect.php');
	if (!isset($_SESSION['token_login'])){
		header('location:splashpage.php');
		exit();
	}
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ICool Coffee & Dessert</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="font/stylesheet.css">
		<link rel="stylesheet" href="font/stylesheet2.css">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	</head>
	<body>
		<div class="container ">
			<div class="head_app" style="height:37px; background-color: #704F3A;height:30px;" >
				<a href="index.php"><i class="fa fa-angle-left fa-2x" style="float:left;margin-left:10px;"></i></a><h1 style="width:94%">ICool Coffee & Dessert</h1>
			</div>
			<div class="content" style="top:40px;">
				<?php 
					$id = $_user['iduser'];
					$sql = "SELECT * FROM user WHERE iduser='$id'";
					$query = mysqli_query($conn,$sql) or die ("$sql".mysqli_error($conn));
					while ($result = mysqli_fetch_assoc($query)) {
				?>
				<form action="" method="POST" id="scan" name="scan">
				<div class="card">
					<center style="height:260px;">
						<input type="text" name="point" id="point" style="display:none;">
						<img src="image/qr.jpg" alt="" width="90%" id="barcode">

					</center>
				</div>
				<div class="point">
					<h1>คะแนนทั้งหมด</h1>
					<p id="sum_point" name="sum_point"><?php echo $result['point']; ?></p>
					<h1>คะแนน</h1>
				</div>
				</form>
				<form action="gift.php" method="POST" style="text-align:center;">
					<input type="text" name="gift" style="display:none;">
					<button type="submit" name="submit" style="background-color: #704F3A; border: 2px solid white;  height: 30px;">แลกขนมหวาน</button>
				</form>
				<?php } ?>
			</div>
			<?php require_once('required/menu_bar.php'); ?>
		</div>

		<script>
			$(document).ready(function()
			    {
					$('#scan').on('submit',function(e)
						{
							$.ajax(
								{
									url:'scan_point.php',
									data:$(this).serialize(),
									type:'POST',
									success:function(data)
										{
											console.log(data);
											$('#sum_point').html(data);
										},
									
								});
							e.preventDefault();
						});
				});
		</script>
	</body>
</html>