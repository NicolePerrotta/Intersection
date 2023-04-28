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
        <meta name="viewport" content="width=device-width, intial-scale=1.0"/>
        <meta name="generator" content="Visual Studio Code">

        <title>Intersection</title>
        <link rel="icon" href="Images/favicon.jpg" type="favicon">

        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> <!--BOOTSTRAP CI SERVE?-->
        <link rel="stylesheet" type="text/css" href="Utenti/style.css">
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
      <section id="section1">
        <div class="container">
          <div id="content">
          <?php
            if(!(isset($_GET["sa"])) || !(isset($_GET["uid"])))
            {
              
            }
            else if($_GET["sa"]==0) //PROFILO UTENTE
            {
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
              $uid=$_GET['uid'];
              $query= "SELECT * FROM worker where worker_id=$1";
              $result=pg_query_params($dbconn,$query,array($uid));
              if(pg_num_rows($result)==0)
              {
                echo "<h1>Profilo non trovato!</h1>
                <br>";
              }
              else
              {
              echo "\n";
              $line=pg_fetch_assoc($result);
              $nome=$line["nome"];
              $cognome=$line["cognome"];
              $username=$line["username"];
              $datanascita=$line["datanascita"];
              $indirizzo=$line["indirizzo"];
              $citta=$line["citta"];
              $nazione=$line["nazione"];
              $genere=$line["genere"];
              $date = date('d/m/Y',strtotime($datanascita));
              echo "

              <div class='grid'>
              <div class='row'>
                  <div class='col-sm-4 my-auto text-left m-3'>

                        <div id='corpoprofilo'> 
                        <h2 class='text-uppercase spaced mb-5' id='title'>Profilo utente</h2> 
                        <img src='' id='foto' class='rounded-circle avatar-lg img-thumbnail' alt='profile-image'>
                        <div class='mt-3' align='left'>
                            <p class='mb-2'><span class='grassetto' id='username2'>Username: </span> <span class='testo-grigio'>$username</span></p>
                            <p class='mb-2'><span class='grassetto'>Nome: </span><span class='testo-grigio'>$nome</span></p>
                            <p class='mb-2'><span class='grassetto'>Cognome: </span> <span class='testo-grigio'>$cognome</span></p>
                            <p class='mb-2'><span class='grassetto'>Genere: </span> <span class='testo-grigio' id='genere'>$genere</span></p>
                            <p class='mb-2'><span class='grassetto'>Data di nascita: </span> <span class='testo-grigio'>$date</span></p>
                            <p id='datanascita'>$datanascita</p>
                            <p class='mb-2'><span class='grassetto' id='indirizzo2'>Indirizzo: </span> <span class='testo-grigio' id='indirizzo' name='nomeNazione'>$indirizzo</span></p>
                            <p class='mb-2'><span class='grassetto' id='citta2'>Città: </span> <span class='testo-grigio' id='citta'>$citta</span></p>
                            <p class='mb-2'><span class='grassetto' id='nazione2'>Nazione: </span> <span class='testo-grigio' id='nazione'>$nazione</span></p>
                        </div>
                        </div>
                  </div>";
                echo  "</div>";
              pg_free_result($result);
              pg_close($dbconn);
              $uida=$_SESSION['uid'];
              if(isset($_SESSION['uid']) && $uida==$uid)
              {
                echo "<div class='group-bottoni'><a href='logout.php'><button class='btn gold-button shadow-none'><i class='fa-solid fa-right-from-bracket'></i> Logout</button></a></div>";
              }
              else {

              }
            }
          }
            else //PROFILO AZIENDA
            {
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
              $company_id=$_SESSION['uid'];
              $query="SELECT * FROM company where company_id=$1";
              $result=pg_query_params($dbconn,$query,array($company_id));
              if(pg_num_rows($result)==0)
              {
                echo "<h1>Profilo non trovato!</h1>
                <br>";
              }
              else
              {
              echo "\n";
              $line=pg_fetch_assoc($result);
              $company_name=$line["company_name"];
              $username=$line["username"];
              $vat_number=$line["vat_number"];
              $address=$line["address"];
              $city=$line["city"];
              $country=$line["country"];
              $description=$line["description"];
              $contact_email=$line["contact_email"];
              $telephone_number=$line["telephone_number"];
              echo " <div class='grid'>
              <div class='row'>
                  <div class='col-sm-4 my-auto text-left m-3'>
              
                    <div id='corpoprofilo'> 
                          <h2 class='text-uppercase spaced mb-5' id='title'>Profilo azienda</h2> 
                            <img src='Images/azienda.jpg' id='foto' class='rounded-circle avatar-lg img-thumbnail' alt='profile-image'>
                            <div class='mt-3'>
                                <p class='mb-2'><span class='grassetto' id='username2'>Username: </span> <span class='testo-grigio'>$username</span></p>
                                <p class='mb-2'><span class='grassetto'>Ragione sociale: </span><span class='testo-grigio'>$company_name</span></p>
                                <p class='mb-2'><span class='grassetto'>Partita IVA: </span> <span class='testo-grigio'>$vat_number</span></p>
                                <p class='mb-2'><span class='grassetto' id='indirizzo2'>Indirizzo: </span> <span class='testo-grigio' id='indirizzo' name='nomeNazione'>$address</span></p>
                                <p class='mb-2'><span class='grassetto' id='citta2'>Città: </span> <span class='testo-grigio' id='citta'>$city</span></p>
                                <p class='mb-2'><span class='grassetto' id='nazione2'>Nazione: </span> <span class='testo-grigio' id='nazione'>$country</span></p>
                                <p class='mb-2'><span class='grassetto'>Descrizione: </span> <span class='testo-grigio'>$description</span></p>
                                <p class='mb-2'><span class='grassetto'>Contact email: </span> <span class='testo-grigio'>$contact_email</span></p>
                                <p class='mb-2'><span class='grassetto'>Telephone number: </span> <span class='testo-grigio'>$telephone_number</span></p>
                            </div>
                    </div>
                    </div>";
                echo  "</h6></div></div>";
              pg_free_result($result);
              pg_close($dbconn);
              $uida=$_SESSION['uid'];
                    if(isset($_SESSION['uid']) && $uida==$uid)
                    {
                      echo "<a href='logout.php'><button class='btn gold-button shadow-none'><i class='fa-solid fa-right-from-bracket'></i> Logout</button></a></div>";
                    }
                    else {

                    }
            }
          }
        ?>
        </div>
          <br>
        </div>
      </section>
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
