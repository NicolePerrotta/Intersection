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
        <link rel="stylesheet" type="text/css" href="Errore/style.css">
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
    <div class="container error-container">
    <?php
                if(!isset($_GET['er']) || $_GET['er']==0)
                {
                    echo "<h1> Qualcosa non è andato a buon fine, stiamo lavorando per risolvere il problema! <i class='fa-solid fa-person-digging'></i></h1>";
                }
                else if( $_GET['er']==1)
                {
                    echo "<h1><i class='fa-solid fa-triangle-exclamation'></i> La tua email risulta essere già associata a un utente registrato</h1>";
                }
                else if( $_GET['er']==2)
                {
                    echo "<h1><i class='fa-solid fa-triangle-exclamation'></i> Il tuo nome utente risulta essere già associato a un utente registrato</h1>";
                }
                else if( $_GET['er']==3)
                {
                    echo "<h1><i class='fa-solid fa-triangle-exclamation'></i> La tua password risulta essere già associata a un utente registrato</h1>";
                }
                else if( $_GET['er']==4)
                {
                    echo "<h1><i class='fa-solid fa-triangle-exclamation'></i> La tua partita IVA risulta essere già associata a un utente registrato</h1>";
                }
                else if( $_GET['er']==8)
                {
                    echo "<h1><i class='fa-solid fa-triangle-exclamation'></i> La tua email non risulta essere associata a un utente registrato </h1>";
                }
                else if( $_GET['er']==9)
                {
                    echo "<h1><i class='fa-solid fa-triangle-exclamation'></i> La tua password risulta essere errata </h1>";
                }
                else
                {
                    echo "<h1> Qualcosa è andato storto, stiamo lavorando per risolverlo! <i class='fa-solid fa-person-digging'></i></h1>";
                }
                
                
    ?>
    <a id="back-home" href="index.php"><button id="tornaHome">Torna alla home</button></a>
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
