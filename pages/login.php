<?php
use scripts\class\Viewer;
use scripts\Database;
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>vomie - login</title>
		<link rel="icon" href="styles/logo.jpg" type="image/x-icon" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="0">
		<meta http-equiv="pragma" content="no-cache">
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/log-reg.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&display=swap" />		
	</head>
	<body>
		<div class="top-label">
			<div class="logo">vomie</div>
			<div class="right">
				<a href="javascript:history.back()">back</a>
			</div>
		</div>
		<div class="container-reg-log">
			<div class="reg-log">
				<h2>Login</h2>
				<form action="index.php?page=login" method="post">
					<label for="emailUser">email</label>
					<input type="email" name="emailUser" id="emailUser" required>
					<label for="passUser">password</label>
					<input type="password" name="passUser" id="passUser" required>
					<button type="submit">submit</button>
				</form>
			</div>
		</div>
		<div id="modal" class="modal">
			<div class="modal-content">
				<span class="close">&times;</span>
				<p id="modal-text" class="modal-text"></p>
			</div>
		</div>
		<script src="scripts/JavaScript/showModal.js"></script>
	</body>
</html>


<?php 
if (!empty($_POST)) {
    $email = filter_input(INPUT_POST, 'emailUser', FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['passUser']);
    $curUser = new Viewer;
    $link = Database::getLink();
    
    if ($curUser->loginUser($link, $email, $password))
    {
        $_SESSION['role'] = $curUser->getRole();
        $_SESSION['name'] = $curUser->getName();
        $_SESSION['id_user'] = $curUser->getId();
        
        header("Location: index.php?page=main");
        close();
        exit();
    } else {
        echo '<script type="text/javascript">',
            'showModal("Incorrect data");',
            '</script>';
    }
}
?>