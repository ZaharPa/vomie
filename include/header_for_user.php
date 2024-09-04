<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>vomie - <?=$title?></title>
		<link rel="icon" href="styles/logo.jpg" type="image/x-icon" />
		<meta name="viewport" content="width=device-width, intial-scale=1.0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="0">
		<meta http-equiv="pragma" content="no-cache">
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    	<link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&display=swap" rel="stylesheet">		
	</head>
	<body>
		<nav class="navbar">
			<div class="logo">vomie</div>
    			<ul class="menu">
    				<li class="menu-item">
    					<a href="#" class="menu-link">home</a>
    					<ul class="dropdown-menu">
    						<li><a href='#'> Movies </a></li>
    						<li><a href='#'> Movies </a></li>
    						<li><a href='#'> Movies </a></li>
    						<li><a href='#'> Movies </a></li>
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
        						<li><a href='#'> Movies </a></li>
        						<li><a href='#'> Movies </a></li>
        						<li><a href='#'> Movies </a></li>
        						<li><a href='#'> Movies </a></li>
        					</ul>
        				</li>
    				</ul>
				<?php }?>
			</div>
		</nav>
