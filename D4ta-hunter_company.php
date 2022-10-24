<!-- Happy April Fool's Day from Team Divshot!-->
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

  <style>

    body {
      font-family: Arial, Helvetica, sans-serif;
    }

    .tor-browser{
      display:none;
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
      <li><a href="D4ta-hunter.php" style="color:white">SEARCH PERSON</a></li>
      <li class="active"><a href="#B" style="color:white">SEARCH COMPANY</a></li>
    </ul>
    <div class="tabbable">
      <div class="tab-content">
        <div class="tab-pane active" id="A">
          
        <section id="forms">
          <br><br>
          <div class="row">
          
            <div class="span7 offset1" style="width: 70%; margin-left: 15%;">
                <form class="well form-search" method="post">
                  <input type="text" class="input" id="domain_company" name="domain_company" placeholder="Company domain">
                  <button type="submit" name="submit_company" class="submit_company" class="btn">Hunt!!</button>
                </form>

                <div class="tor-browser">

                  <div class="row">
                    <div class="span12" style="width: 96.5% !important;">
                        <div class="alert alert-block">
                          <img class="pull-left" style="margin-top: -8px" src="img/test/drudgesiren.gif" width="80">
                          <h4 class="alert-heading">Be patient...</h4>
                          <p>Results may take up to 2 minutes to display.</p>
                        </div>
                    </div>
                  </div>
                
                  <center><img src="img/tor.gif" style="width:20%; padding:4%;"></center>
                </div>

              <section id="tables">

                <?php

                /*ini_set('display_startup_errors', 1);
                ini_set('display_errors', 1);
                error_reporting(-1);
                */

                if (isset($_POST['submit_company'])){

                  $domain_company= $_POST['domain_company'];
                  $key_api_value_breach = $_POST['key'];

                  //salimos por TOR para que no baneen la ip
                  $run_tor = 'kalitorify -t ';
                  exec($run_tor);

                  sleep(5);

                  //ejecutamos el comando para encontrar información
                  $theHarvester_command = "theHarvester -d ".$domain_company." -b anubis,baidu,bing,binaryedge,bingapi,bufferoverun,censys,certspotter,crtsh,dnsdumpster,duckduckgo,fullhunt,github-code,google,hackertarget,hunter,intelx,linkedin,linkedin_links,n45ht,omnisint,otx,pentesttools,projectdiscovery,qwant,rapiddns,rocketreach,securityTrails,spyse,sublist3r,threatcrowd,threatminer,trello,twitter,urlscan,virustotal,yahoo,zoomeye -g -f /var/www/html/D4ta-hunter/theHarvester_results/report_th";
                  exec($theHarvester_command." 2>&1");

                  $clear_tor = 'kalitorify -c ';
                  exec($clear_tor);

                  //se comprueba si se ha hecho ya una busqueda a ese dominio
                  $archivo = "/var/www/html/D4ta-hunter/theHarvester_results/report_th.xml";
                  $archivo_busqueda = simplexml_load_file($archivo);

                  //guardamos resultado de archivo en una variable
                  $last_th = fopen($archivo, "r");
                  while (!feof($last_th)){
                      $escaneo_hecho = fgets($last_th);
                  }

                  //mostramos tabla con los correos encontrados
                  echo '
                      <table class="table table-bordered table-striped table-hover">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>E-MAILS FOUND</th>
                              <th>VIEW PASSWORD</th>
                            </tr>
                          </thead>
                          <tbody>';

                  $contador=0;
                  foreach($archivo_busqueda as $etiqueta){

                    if (strpos($etiqueta, '@') !== false) {

                      echo '
                        <tr>
                          <td>'.$contador.'</td>
                          <td>'.$etiqueta.'</td>
                          <td><a href="http://localhost/D4ta-hunter/D4ta-hunter.php" target="_blank">*******</a></td>
                        </tr>';

                        $contador ++;

                        foreach($etiqueta as $etiqueta2){

                          echo '
                            <tr>
                              <td>'.$contador.'</td>
                              <td>'.$etiqueta2.'</td>
                              <td><a href="http://localhost/D4ta-hunter/D4ta-hunter.php" target="_blank">*******</a></td>
                            </tr>';
                        }
                    }
                  }

                  //mostramos tabla con los dominios encontrados
                  echo '
                      <table class="table table-bordered table-striped table-hover">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>DOMAINS ANS IP`S</th>
                            </tr>
                          </thead>
                          <tbody>';

                  $contador=0;
                  foreach($archivo_busqueda as $etiqueta){

                    if (strpos($etiqueta, '@') !== false) {
                      
                    }else{

                        echo '
                        <tr>
                          <td>'.$contador.'</td>
                          <td>'.$etiqueta.'</td>
                        </tr>';

                        $contador ++;

                        foreach($etiqueta as $etiqueta2){

                          if ($etiqueta2 > ''){
                            echo '
                            <tr>
                              <td>'.$contador.'</td>
                              <td>'.$etiqueta2.'</td>
                            </tr>';

                            $contador ++;
                          }
                        }
                    }
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

<?php 
if (isset($_POST['submit_company'])){
}else{
  echo '<br><br><br><br><br><br><hr>
  <footer class="footer">
    <p class="pull-left" style="margin-top: -14px"><a href="https://microjoan.com/" target="_blank"><img src="img/microjoan.jpg" style="width: 222px;"></a></p>
    <p class="pull-right" style="margin-top: -14px"><img src="img/test/hacker.gif">&nbsp; Programmed by <a href="https://www.linkedin.com/in/joan-moya-torremocha/">Joan Moya (MicroJoan)</a></p>
  </footer>
  <center><a href="https://darkhacking.es/" target="_blank"><img src="img/darkhacking.jpg" style="margin-top: -12px; width: 200px;"></a></center>
</div>';
}
?>



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

    <script>
    $(document).ready(function(){
      $('.submit_company').click(function(){
          $('.tor-browser').show();
      });
    });
  </script>

  </body>
</html>


