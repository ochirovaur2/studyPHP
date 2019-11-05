<?
    $link = mysqli_connect("shareddb-p.hosting.stackcp.net","myusers-313135b32e", "chita1945", "myusers-313135b32e");
	if(mysqli_connect_error()) {
      die ("Connection failed");
    }
	$alertOfSuccess = "";
	$alertOfError = "";
	$errorOfLogin = "";
    if(array_key_exists('emailForRegistr', $_POST) OR array_key_exists('passwordForRegistr', $_POST)) {
      
          if($_POST["emailForRegistr"] == "") {
            echo "<p> Email address is required</p>";
      } else if($_POST["passwordForRegistr"] == "") {
            echo "<p> Password is required</p>";
      } else {
            $query = "SELECT `id` FROM `users` WHERE `email` ='".mysqli_real_escape_string($link, $_POST["emailForRegistr"])."'";
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_array($result);
            if(mysqli_num_rows($result) > 0) {
              
              $alertOfError = '<div class="alert alert-danger" role="alert">This email already exists</div>';
            } else {
              $query = "INSERT INTO `users` (`email`, `password`) VALUES('".mysqli_real_escape_string($link, $_POST["emailForRegistr"])."','".md5(mysqli_real_escape_string($link, $_POST["passwordForRegistr"]))."')";
              if(mysqli_query($link, $query)) {
              	$alertOfSuccess = '<div class="alert alert-success" role="alert">You have been successfully registered!</div>';
              } else {
                echo "There was  a problem  singing you up - please try again later";
              }
            }
          }
     }
     if(array_key_exists('email', $_POST) OR array_key_exists('password', $_POST)) {

              if($_POST["email"] == "") {
                echo "<p> Email address is required</p>";
          } else if($_POST["password"] == "") {
                echo "<p> Password is required</p>";
          } else {
                $query = "SELECT * FROM `users` WHERE `email` ='".mysqli_real_escape_string($link, $_POST["email"])."'";
                $result = mysqli_query($link, $query);
				$row = mysqli_fetch_array($result);
                if($_POST["email"] == $row["email"]  && md5($_POST["password"]) == $row["password"]) {
                  header("Location: diary.php");
                } else {
                	$errorOfLogin = '<div class="alert alert-danger" role="alert">Password or Email not match</div>';
                  
                }
               
                } 
       }
         

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style type="text/css">
    	*{
    		padding: 0;
    		margin: 0;
    	}
    	html{
    		background-color: #010101;
    		background-image: url("back11.jpg");
    		background-size: cover;
    		background-repeat: no-repeat;
    		max-width: 1000px;
    		margin: 0 auto;
    	}
    	body{
    		background: none;
    	}
    	.container{
    		color: white;
    		margin-top: 15vh;
    		text-align: center;
    	}
    	.inputOfData, #alert{
    		margin: 0 auto;
    		max-width: 450px;
    	}
    	#signUp{

    		display: none;
    	}
    	#changeLoginWithSignUp{
    		margin-top: 5px;
    		font-size: 80%;
    	}
    </style>
  </head>
  <body>
  	<div class="container">
    	<h1>Secret Diary</h1>
    	<p><b>Store your thoughts permanently and securely</b></p>
      	<div id="alert"><? echo $alertOfSuccess.$alertOfError.$errorOfLogin ?></div>
    	<form method="post">
		  <div class="form-group">
		    <label for="email">Email address</label>
		    <input type="email" class="form-control inputOfData" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email" required>
		    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
		  </div>
		  <div class="form-group">
		    <label for="password">Password</label>
		    <input type="password" class="form-control inputOfData" id="password" placeholder="Password" name="password" required>
		  </div>
		  <div class="form-group form-check">
		    <input type="checkbox" class="form-check-input" id="checkbox">
		    <label class="form-check-label" for="checkbox">Stay logged in</label>
		  </div>
		  <button type="submit" class="btn btn-primary" id="signUp">Sign Up!</button>
		  <button type="submit" class="btn btn-primary" id="logIn">Log In</button>
		  <p><label id="changeLoginWithSignUp">Sign Up</label></p>
		</form>
 	</div>
    <!-- Optional JavaScript -->
    <script type="text/javascript">
    	document.getElementById("changeLoginWithSignUp").onclick = function(){
    			if(document.getElementById("changeLoginWithSignUp").innerHTML == "Sign Up"){
    		document.getElementById("logIn").style.display = "none";
    		document.getElementById("signUp").style.display = "inline";
    		document.getElementById("email").name = "emailForRegistr";
    		document.getElementById("password").name = "passwordForRegistr";
    		document.getElementById("changeLoginWithSignUp").innerHTML = "Login";
			}
			else if(document.getElementById("changeLoginWithSignUp").innerHTML == "Login"){
				document.getElementById("logIn").style.display = "inline";
				document.getElementById("email").name = "emal";
    			document.getElementById("password").name = "password";
    			document.getElementById("signUp").style.display = "none";
    			document.getElementById("changeLoginWithSignUp").innerHTML = "Sign Up";
			}
    	}
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>