<?php 
use scripts\Database;
use scripts\class\Viewer;

if (!empty($_POST)) {
    $name = htmlspecialchars($_POST['nameUser'], ENT_QUOTES, 'UTF-8');
    $email = filter_input(INPUT_POST, 'emailUser', FILTER_SANITIZE_EMAIL);
    
    if (strlen($_POST['passUser']) >= 8 && strlen($_POST['passUser']) <= 20)
    {
        $password = trim($_POST['passUser']);
        $curUser = new Viewer();
        $link = Database::getLink();
        $curUser->regUser($link, $email, $password, $name);
        $_SESSION['role'] = $curUser->getRole();
        $_SESSION['name'] = $curUser->getName();
        
        if(isset($_SESSION['role']))
        {
            header("Location: index.php?page=main");
            exit();
        }
    } else {
        echo '<script language="javascript">';
        echo 'alert("Incorrect data")';
        echo '</script>';
    }
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>vomie - register</title>
		<link rel="icon" href="styles/logo.jpg" type="image/x-icon" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="0">
		<meta http-equiv="pragma" content="no-cache">
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&display=swap">		
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
    		 	<h2>Registration</h2> 	
    		 	<form action="index.php?page=register" method="post">
    		 		<label for="nameUser">name</label> 
    		 		<input type="text" name="nameUser" id="nameUser" required>
    		 		<label for="emailUser">email</label> 
    		 		<input type="email" name="emailUser" id="emailUser" required>
    		 		<label for="passUser">password</label> 
    		 		<input type="password" name="passUser" id="passUser" title="Must be 8-20 characters long" required>
    		 		<button type="submit">submit</button>
    		 	</form>
    		</div>
		</div>
	</body>
</html>