<?php
	
	if (!isset($_SESSION['islogged'])){
		$_SESSION['islogged'] = false;        
	}

	$menu = 
		'<nav class="navbar navbar-default">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="index.php">Team Brazucas</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">					
						<ul class="nav navbar-nav navbar-right">';

	if ($_SESSION['islogged'] == true) {
		$menu = $menu . '<li><a href="userInformation.php">Profile</a></li>
							<li><a href="orderPizza.php">Orders</a></li>
							<li><a href="orderPizza.php">Previous Orders</a></li>';
	} 

								
	$menu = $menu . 
						'</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>';	

		echo $menu;
?>