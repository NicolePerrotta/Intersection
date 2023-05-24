<?php
session_start();
?>
<!DOCTYPE html>
  <html>
    <!--HEADER-->
    <head>
        <meta charset="UTF-8"/>
        <meta name="description" content="Intersection between professionals and companies site"/>
        <meta name="keywords" content="HTML, CSS, JavaScript, PHP">
        <meta name="authors" content="Alberto Pirillo, Nicole Perrotta, Andrea Sinisi"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="generator" content="Visual Studio Code">

        <title>Intersection</title>
        <link rel="icon" href="Images/favicon.jpg" type="favicon">

        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> <!--BOOTSTRAP CI SERVE?-->
        <link rel="stylesheet" type="text/css" href="Login/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css"> <!--FONTAWESOME CI SERVE?-->

        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script> <!--BOOTSTRAP CI SERVE?-->

        <!--Titles font-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@500&display=swap" rel="stylesheet">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> <!-- JQUERY CI SERVE?-->
    </head>
    <body>
      <div class=" container fixed-top" id="navbar">
      <nav class="navbar navbar-dark navbar-expand-md py-1" id="upper-nav">
        <div class="container-fluid">
          <a class="navbar-brand me-auto" href="index.php" id="titolo">
                 <img src="Images/logo.jpg" id="logae">
              INTERSECTION
          </a>
          
          <div class="navbar-nav ms-auto">
            <div class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenu" role="button" 
                data-bs-toggle="dropdown" aria-expanded="false">
                  IT
              </a>
              <ul id="lang-menu" class="dropdown-menu" aria-labelledby="navbarDropdownMenu">
                <li><a class="dropdown-item" href="indexErrore.php?er=0">EN</a></li>
              </ul>
            </div>
          </div> 
          <div>
          <ul class="navbar-nav mb-2 mb-md-0 justify-content-between ms-auto"> 
                <li class="nav-item">
                <?php
                if(!isset($_SESSION['uid']))
                {
                  $logged="<a class='nav-link text-uppercase text-black' href='indexLogin.php'><i class='fa-solid fa-user'></i> Login</a>";
                }
                else
                {
                  $uid=$_SESSION['uid'];
                  $sa=$_SESSION['sa'];
                  $username=$_SESSION['user'];
                  $logged="<a class='nav-link text-uppercase text-black' href='indexUtenti.php?uid=".$uid."&sa=".$sa."'><i class='fa-solid fa-user'></i> ".$username."</a>";
                }
                echo $logged;
                ?>   
                </li>
              </ul>
          </div>

        </div>
      </nav>
    </div>

<!--BODY-->
<div class="container main">
          <?php 
            if(file_exists('.env')) {
              // per il sito in locale
              $env = parse_ini_file('.env');
          
              $PGHOST = $env['PGHOST'];
              $PGPORT = $env['PGPORT'];
              $PGDATABASE = $env['PGDATABASE'];
              $PGUSER = $env['PGUSER'];
              $PGPASSWORD = $env['PGPASSWORD'];
          } else {
              // per il sito deployato
              $PGHOST = getenv('PGHOST');
              $PGPORT = getenv('PGPORT');
              $PGDATABASE = getenv('PGDATABASE');
              $PGUSER = getenv('PGUSER');
              $PGPASSWORD = getenv('PGPASSWORD');
          }
            $dbconn = pg_connect("host=$PGHOST port=$PGPORT dbname=$PGDATABASE user=$PGUSER password=$PGPASSWORD")  or header("Location: indexErrore.php?er=100");
            
            $offer_id=$_GET['offer_id'];
            $query = "SELECT * FROM job_offer WHERE offer_id=$1 ORDER BY title";
            $result=pg_query_params($dbconn,$query,array($offer_id));
            echo '<form><input type="hidden" id="ciao" value="1"></input></form>';
            echo ' <div class="main container"> ';
            while ($line=pg_fetch_array($result, null, PGSQL_ASSOC)) 
            {
              $title=$line['title'];
              $description=$line['description'];
              $salary=$line['salary'];
              $period=$line['period'];
              echo"
                            <div class='col-lg m-3 text-center'>
                                <div class='jobOffer' id='jobOffer'>
                                      <h2 class='text-uppercase spaced' id='list'>$title</h2>';
                                      <span class='description'>$description</span>
                                      <br>
                                      <span class='salary'>$salary</span>
                                      <br>
                                      <span class='period'>$period</span>
                                      <br>
                                ";
              echo"     <br>        
                        <h2 class='text-uppercase spaced' id='list'>Candidati</h2>";
                        $q19="select * from applies_to where offer_id=$1";
                        $result2=pg_query_params($dbconn,$q19,array($offer_id));
                        while ($line2=pg_fetch_array($result2, null, PGSQL_ASSOC)) 
                        {
                            $worker_id=$line2['worker_id'];
                            $q2="select * from worker where worker_id=$1";
                            $result3=pg_query_params($dbconn,$q2,array($worker_id));
                            $line3=pg_fetch_assoc($result3);
                            $nome=$line3["name"];
                            $cognome=$line3["surname"];
                            $username=$line3["username"];
                            $datanascita=$line3["birth_date"];
                            $date = date('d/m/Y',strtotime($datanascita));
                            $contact_email = $line3["contact_email"];
                            $picture = $line3["picture"];
                            if(isset($picture))
                            {
                              $picture = pg_unescape_bytea($picture);
                              $filename = "image_$username.png";
                              file_put_contents($filename, $picture);
                            }
                            else
                            {
                              $filename = "Images/pictureStandard.png";
                            }
                            echo"
                              <div>
                                <img src=$filename id='picture2' class='rounded-circle avatar-lg img-thumbnail' alt='profile-image'>
                                <div class='mt-3' align='left'>
                                  <p class='mb-2'><span class='grassetto' id='username2'>Username: </span> <span class='testo-grigio'>$username</span></p>
                                  <p class='mb-2'><span class='grassetto'>Nome: </span><span class='testo-grigio'>$nome</span></p>
                                  <p class='mb-2'><span class='grassetto'>Cognome: </span> <span class='testo-grigio'>$cognome</span></p>
                                  <p class='mb-2'><span class='grassetto'>Data di nascita: </span> <span class='testo-grigio'>$date</span></p>
                                  <p class='mb-2'><span class='grassetto'>Contact mail: </span> <span class='testo-grigio' id='contact_email'>$contact_email</span></p>
                                </div>
                              </div>";
                          
                        }
                       echo      '
                  </div> <br>';
                        
            }
            echo '</div>';
            if(isset($result)) pg_free_result($result);
            if(isset($result19)) pg_free_result($result19);
            if(isset($result20)) pg_free_result($result20);
            if(isset($result29)) pg_free_result($result29);
            pg_close($dbconn);
        ?>
  </div>

<!--FOOTER-->
      <footer class="text-center text-white">
        <div class="grid" id="footer-grid">
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4">
              <h5 class="text-uppercase">About</h5>
              <p id="about">Intersection è un sito web per la creazione e la ricerca di posti di lavori finalizzata a trovare il matching perfetto tra professionista-impiego ricercato.</p>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
              <h5 class="text-uppercase">Nome compagnia</h5>
              <p id ="developers">
                Dati aziendali [...]
                <br>
                Informazioni legali [...]
              </p>
            </div>
            <div class="col-md-1"></div>
          </div>
        </div>
        <div class="text-center p-2" id="copyright">
          &copy;2023 Intersection <br><img src="Images/favicon.jpg" id="favi">
        </div>
      </footer>
    </body>
</html>
