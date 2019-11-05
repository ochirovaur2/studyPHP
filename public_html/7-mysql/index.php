<?
	session_start();
	
 	$link = mysqli_connect("shareddb-p.hosting.stackcp.net","myusers-313135b32e", "chita1945", "myusers-313135b32e");
 	if(mysqli_connect_error()) {
      die ("Connection failed");
    }
	
	
    if(array_key_exists('email', $_POST) OR array_key_exists('password', $_POST)) {
      
          if($_POST["email"] == "") {
            echo "<p> Email address is required</p>";
      } else if($_POST["password"] == "") {
            echo "<p> Password is required</p>";
      } else {
            $query = "SELECT `id` FROM `users` WHERE `email` ='".mysqli_real_escape_string($link, $_POST["email"])."'";
            $result = mysqli_query($link, $query);
            if(mysqli_num_rows($result) > 0) {
              echo "This email already exists";
            } else {
              $query = "INSERT INTO `users` (`email`, `password`) VALUES('".mysqli_real_escape_string($link, $_POST["email"])."','".mysqli_real_escape_string($link, $_POST["password"])."')";
              if(mysqli_query($link, $query)) {
              	$_SESSION['email'] = $_POST["email"];
                header("Location: session.php");
              } else {
                echo "There was  a problem  singing you up - please try again later";
              }
            }
          }
     }

	
	
  
?>

<form method="post">
  <input type="text" name="email" placeholder="Email">
  <input type="password" name="password" placeholder="Password">
  <button type="submit">Sign Up</button>
</form>
