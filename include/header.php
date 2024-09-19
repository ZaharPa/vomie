<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>vomie - <?=$title?></title>
		<link rel="icon" href="styles/logo.jpg" type="image/x-icon" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="0">
		<meta http-equiv="pragma" content="no-cache">
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&display=swap">		
    	<?php if ($title === 'view-all') {?>
        	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    	<?php }?>
	</head>
	<body>
		<nav class="navbar">
			<div class="logo">vomie</div>
    			<ul class="menu">
    				<li class="menu-item">
    					<a href="index.php" class="menu-link">home</a>
    					<ul class="dropdown-menu">
    						<li><a href='index.php?page=view-all'> View all movies </a></li>
    						<li><a href='#'> Movies </a></li>
    						<?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
    						<li><a href='index.php?page=add-movie'> Add Movie </a></li>
    						<?php }?>
    					</ul>
    				</li>
    			</ul>
			<div class="right-section">
				<div class="search-container">
					<input type="text" placeholder="Search" class="search-input">
					<button class="search-btn">
						<i class="fas fa-search"></i>
					</button>
				</div>
				<?php if (!isset($_SESSION['role'])) {?>
    				<div class="log-reg">
    					<a href="index.php?page=login">Login</a>
    					<a href="index.php?page=register">Register</a>
    				</div>
				<?php } else {?>	
    				<ul class="user-menu">
        				<li class="user-menu-item">
        					<img src="avatar.jpg" alt="User Avatar" class="avatar">
        					<ul class="dropdown-menu">
        						<li><a href='#'> My profile </a></li>
        						<li><a href='index.php?logOut'> Exit </a></li>
        					</ul>
        				</li>
    				</ul>
				<?php }?>
			</div>
		</nav>
