<?
    $weather = "";
	$error = "";
  if($_GET["city"]){
    $urlContents = file_get_contents('https://api.openweathermap.org/data/2.5/weather?q='.$_GET["city"].'&appid=c379d02dc4cc9d3763e60961e68ed11b');
    $wetherArray = json_decode($urlContents, true);
    
    if($wetherArray["cod"] == 200) {
      $weather = "The wether in ".$wetherArray['name']." is currently ".$wetherArray['weather'][0]["description"]."";
      $temperture =   $wetherArray['main']['temp'] - 273;
      $weather .= "<br> The temperature is ".intval($temperture)."&deg;";
      $wind = $wetherArray["wind"]["speed"];
      $weather .= "<br> The wind speed is ".$wind." m/s.";
      $weather =  '<div class="alert alert-success" role="alert">'.$weather.'</div>';
    } else {
      
      $error = '<div class="alert alert-danger" role="alert">Could not find city - please try again</div>';
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

    <title>Weather</title>
    <style type="text/css">
      *{
        

      }
      html{
        
        background-color: #DBEBEA;
      

      }
      body{
        text-align: center;
        background: none;
        
      }
      .container{
        
        margin-top: 20vh;
        max-width: 500px;
       
        
      }
	  #alert{
        
      }

    </style>
  </head>
  <body>
    <div class="container">
    <h1>What’s The Weather Like Today?</h1>
    <div id="alertOfErrorOrSuccess"></div>
    <form>
      <div class="form-group" method="post">
        <label for="city">Please, enter the name of a city</label>
        <input type="text" class="form-control" id="city" placeholder="Ex. London" required name="city" >
        
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <div  id="alert">
      <? 
      if($_GET) {
     	echo $weather.$error;
      }
      ?>
    </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>