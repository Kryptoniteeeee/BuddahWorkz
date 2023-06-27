     <!DOCTYPE HTML>

<html>
	<head >
		<title>BuddahWorkz Powered By Etech - Las Piñas</title>

			<link href="img/log.jpg" rel="icon">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
<body>
	<style>
body {
  background-image: url('img/a.png');
  background-repeat: no-repeat;
  background-attachment: fixed;
	background-position: center center;
	background-size: cover;
}
</style>
	<body class="is-preload landing" >
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<h1 id="logo"><a href="indexx.php">BuddahWorkz</a></h1>
					<nav id="nav">
						<ul>
								






							<li>
								<a href="#">Services</a>
								<ul>
<li class="active" ><a rel="tooltip"  data-placement="bottom" title="Home" id="home" href="indexx.php" class=""><i class="icon-home icon-large"></i>&nbsp;Home</a></li>
						
						<li><a href="edit_info.php"><i class="icon-pencil icon-large"></i>&nbsp;Edit Info</a></li>
					<li><a href="myschedule.php"><i class="icon-file-alt icon-large"></i>&nbsp;My Schedule</a></li>
						<li><a href="logout.php"><i class="icon-signout icon-large"></i>Logout</a></li>
										<ul>
											<li><a href="edit_info.php">Option 1</a></li>
											<li><a href="myschedule.php">Option 2</a></li>
											<li><a href="logout.php">Option 3</a></li>
											
										</ul>
									</li>
								</ul>
							</li>
									<?php
					$query=mysqli_query($conn,"select * from members where member_id='$session_id'")or die(mysqli_error($conn));
					$row=mysqli_fetch_array($query);
					?>
					<li>
						
							
	<li class="active" ><a href="dasboard.php" class="">Welcome:&nbsp;<i class="icon-user icon-large"></i>&nbsp;<?php echo $row['firstname']." ".$row['lastname']; ?></a></li>	
						
					
								</ul>
							</li>
							<li><a href="#four"></a></li>
						
						</ul>
					</nav>
				</header>


				

        		<!-- Scripts -->
				<script src="assets/js/jquery.min.js"></script>
				<script src="assets/js/jquery.scrolly.min.js"></script>
				<script src="assets/js/jquery.dropotron.min.js"></script>
				<script src="assets/js/jquery.scrollex.min.js"></script>
				<script src="assets/js/browser.min.js"></script>
				<script src="assets/js/breakpoints.min.js"></script>
				<script src="assets/js/util.js"></script>
				<script src="assets/js/main.js"></script>
</div>

		</body>
	</html>


	     
    