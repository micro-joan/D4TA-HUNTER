<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>D4TA-HUNTER by MicroJoan</title>

    <link href="swatch/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/docs/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="bootstrap/docs/assets/js/google-code-prettify/prettify.css" rel="stylesheet">
    <link href="test/bootswatch.css" rel="stylesheet">

  </head>

  <style rel="stylesheet" type="text/css">
    body {
      font-family: Arial, Helvetica, sans-serif;
    }
  </style>

  <body id="top" class="preview" data-spy="scroll" data-target=".subnav" data-offset="80">

  <div class="container">

  <!-- Navbar
  ================================================== -->
  <section id="navbar" style="padding-top: 0">
    <div class="page-header">
      <center><img src="img/logo.gif"></center>
    </div>
  </section>
  <marquee>CREATED FOR ETHICAL PURPOSES ONLY, DATA LEAK & OSINT TOOL DESIGNED BY MICROJOAN</marquee>


<br><br><br>
<center>
  <img src="img/bugsbunny.gif">
</center>
<br>


<div class="row">
  <div class="span4 col-12" style="width: 100% !important">

    <ul class="nav nav-tabs">
      <li class="active"><a href="#A" style="color:white">SEARCH PERSON</a></li>
      <li><a href="D4ta-hunter_company.php" style="color:white">SEARCH COMPANY</a></li>
    </ul>
    <div class="tabbable">
      <div class="tab-content">
        <div class="tab-pane active" id="A">
          
          <section id="forms">
            <br><br>
            <div class="row">

              <div class="span7 offset1" style="width: 70%; margin-left: 15%;">

                <form class="well form-search" form action="" method="post">
                  <input type="text" class="input" id="datos" name="datos" placeholder="Email, phone or nickname">
                  <input type="text" class="input" id="key" name="key" placeholder="BreachDirectory.org key">
                  <button type="submit" name="submit">Hunt!!</button>
                </form>

                <section id="tables">

                <?php

                  /*ini_set('display_startup_errors', 1);
                  ini_set('display_errors', 1);
                  error_reporting(-1);*/
                  
                  if (isset($_POST['submit'])){

                    /*KEYS APIS*/

                    $data = $_POST['datos'];
                    $key_api_value_breach = $_POST['key'];

                    if ($key_api_value_breach > '') { //comprobamos que el archivo txt existe en el directorio
                            
                    } else { //si no existe mostramos mensajes de error
                      echo '
                        <div class="row">
                          <div class="span12" style="width: 96.5% !important;">
                              <div class="alert alert-block">
                                <img class="pull-left" style="margin-top: -8px" src="img/test/drudgesiren.gif" width="80">
                                <h4 class="alert-heading">API KEY not found</h4>
                                <p>Please insert your BreachDirectory api key to continue.</p>
                              </div>
                          </div>
                      </div>';
                    }
                    
                    $url = "https://breachdirectory.p.rapidapi.com/?func=auto&term=".$data;
                    $curl = curl_init($url);

                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                    $headers = array(
                      "X-RapidAPI-Host: breachdirectory.p.rapidapi.com",
                      "X-RapidAPI-Key: ".$key_api_value_breach.""
                    );

                    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

                    $resp = curl_exec($curl);
                    curl_close($curl);

                    $array = json_decode($resp, true);//respuesta de los datos

                    
                    //si existen datos pintamos las cabeceras
                    if($array > "" && $key_api_value_breach > ""){
                      echo '
                      <table class="table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>DATA</th>
                            <th>CENSORED PASSWORD</th>
                            <th>SHA1 HASH</th>
                          </tr>
                        </thead>
                      <tbody>';
                    }

                    $hashes_lista = "";
                    $pwned_sites_list = "";
                    $api_expired = false;

                      foreach ($array as $value1) {
                      
                        //var_dump($value1);
                        if($value1 === "You have exceeded the MONTHLY quota for Requests on your current plan, BASIC. Upgrade your plan at https://rapidapi.com/rohan-patra/api/breachdirectory"){
                            echo '
                            <div class="row">
                              <div class="span12" style="width: 96.5% !important;">
                                  <div class="alert alert-block">
                                    <img class="pull-left" style="margin-top: -8px" src="img/test/mchammer.gif" width="50">
                                    <h4 class="alert-heading">Your free KEY of BreachDirectory was expired.</h4><br>
                                    <p>Update the BreachDirectory.org API-KEY with the following resources. <a href="renew_api_breach.php" target="_blank" style="color: red;">renew key.</a></p><br>
                                  </div>
                              </div>
                            </div>';
                        }

                        //sacamos del array los sitios que han sido expuestos
                        $pwned_sites = $value1[0]["sources"];

                        foreach ($pwned_sites as $value_pw) {
                          
                            $pwned_sites_list .= "<li>".$value_pw."</li>"; 
                        }

                        //sacamos los datos de los leaks de las contraseñas
                        for($leaks_list = 0; $leaks_list < 30; $leaks_list ++){

                          $contraseña = $value1[$leaks_list]["password"];
                          $hash = $value1[$leaks_list]["sha1"];
                        
                          if($contraseña == "" || $hash == ""){}else
                          {
                            echo '
                              <tr>
                                <td>'.$leaks_list.'</td>
                                <td>'.$data.'</td>
                                <td>'.$contraseña.'</td>
                                <td>'.$hash.'</td>
                              </tr>';
                              $hashes_lista .= "<li>".$hash."</li>";
                          }
                           $contador ++;
                        }

                      }

                        ////si ha sido comprometido mostramos la alerta
                        if($array > ""){

                          echo '
                          <div class="row">
                            <div class="span12" style="width: 96.5% !important;">
                                <div class="alert alert-block">
                                  <img class="pull-left" style="margin-top: -8px" src="img/test/drudgesiren.gif" width="80">
                                  <h4 class="alert-heading">Alert credentials found</h4>
                                  <p>Credentials have been found, your data may be at risk.</p>
                                </div>
                            </div>
                          </div>
                          ';
                         }else{
                          echo "<script>alert('It seems that the account has not been compromised')</script>";
                         }

                  
                  echo " </table>";

                  //si ha sido comprometido mostramos cuadros con listado de sitios y hashes
                  if($array > ""){
                      echo '<div class="row">
                              <div class="span3">
                                <div class="alert alert-error">
                                  <strong>Exposed sites</strong><br> <ul>'.$pwned_sites_list.'</ul>
                                </div>
                              </div>
                              <div class="span5">
                                <div class="alert alert-success">
                                  <strong>Hash list</strong><br> <ul>'.$hashes_lista.'</ul>
                                  <a href="https://crackstation.net/" target="_blank">Crack hashes online</a><br>
                                  <a href="https://hashes.com/en/decrypt/hash" target="__blank">Hashes.com</a><br>
                                </div>
                              </div>
                            </div>';
                  }
                }
                
                 ?>

                </section>
              </div>

            </div>
          </section>

        </div>

      </div>
    </div> <!-- /tabbable -->
    
  </div>
</div>
 
</section>

<br><br><br><br><br><br>
<hr>
<!-- Footer
      ================================================== -->
      <footer class="footer">
        <p class="pull-left" style="margin-top: -14px"><a href="https://microjoan.com/" target="_blank"><img src="img/microjoan.jpg" style="width: 222px;"></a></p>
        <p class="pull-right" style="margin-top: -14px"><img src="img/test/hacker.gif">&nbsp; Programmed by <a href="https://www.linkedin.com/in/joan-moya-torremocha/">Joan Moya (MicroJoan)</a></p>
      </footer>
 <center><a href="https://darkhacking.es/" target="_blank"><img src="img/darkhacking.jpg" style="margin-top: -12px; width: 200px;"></a></center>
    </div><!-- /container -->


    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap/docs/assets/js/jquery.js"></script>
    <script src="bootstrap/docs/assets/js/google-code-prettify/prettify.js"></script>
    <script src="bootstrap/docs/assets/js/bootstrap-transition.js"></script>
    <script src="bootstrap/docs/assets/js/bootstrap-alert.js"></script>
    <script src="bootstrap/docs/assets/js/bootstrap-modal.js"></script>
    <script src="bootstrap/docs/assets/js/bootstrap-dropdown.js"></script>
    <script src="bootstrap/docs/assets/js/bootstrap-scrollspy.js"></script>
    <script src="bootstrap/docs/assets/js/bootstrap-tab.js"></script>
    <script src="bootstrap/docs/assets/js/bootstrap-tooltip.js"></script>
    <script src="bootstrap/docs/assets/js/bootstrap-popover.js"></script>
    <script src="bootstrap/docs/assets/js/bootstrap-button.js"></script>
    <script src="bootstrap/docs/assets/js/bootstrap-collapse.js"></script>
    <script src="bootstrap/docs/assets/js/bootstrap-carousel.js"></script>
    <script src="bootstrap/docs/assets/js/bootstrap-typeahead.js"></script>
    <script src="bootstrap/docs/assets/js/bootstrap-affix.js"></script>
    <script src="bootswatch.js"></script>


  </body>
</html>

