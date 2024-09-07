
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
    		 	<form action="registration" method="post">
    		 		<label for="nameUser">name</label> 
    		 		<input type="text" name="nameUser" id="nameUser" required>
    		 		<label for="emailUser">email</label> 
    		 		<input type="email" name="emailUser" id="emailUser" required>
    		 		<label for="passUser">password</label> 
    		 		<input type="password" name="passUser" id="passUser" required>
    		 		<button type="submit">submit</button>
    		 	</form>
    		</div>
		</div>
	</body>
</html>