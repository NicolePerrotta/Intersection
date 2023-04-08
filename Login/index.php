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
        <link rel="icon" href="../Images/favicon.jpg" type="favicon">

        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> <!--BOOTSTRAP CI SERVE?-->
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css"> <!--FONTAWESOME CI SERVE?-->

        <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script> <!--BOOTSTRAP CI SERVE?-->

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
          <a class="navbar-brand me-auto" href="../Home/index.php" id="titolo">
                 <img src="../Images/logo.jpg" id="logae">
              INTERSECTION
          </a>
          
          <div class="navbar-nav ms-auto">
            <div class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenu" role="button" 
                data-bs-toggle="dropdown" aria-expanded="false">
                  IT
              </a>
              <ul id="lang-menu" class="dropdown-menu" aria-labelledby="navbarDropdownMenu">
                <li><a class="dropdown-item" href="../Errore/index.php?er=0">EN</a></li>
              </ul>
            </div>
          </div> 
          <div>
          <ul class="navbar-nav mb-2 mb-md-0 justify-content-between ms-auto"> 
                <li class="nav-item">
                <?php
                if(!isset($_SESSION['uid']))
                {
                  $logged="<a class='nav-link text-uppercase text-black' href='../Login/index.php'><i class='fa-solid fa-user'></i> Login</a>";
                }
                else
                {
                  $uid=$_SESSION['uid'];
                  $sa=$_SESSION['sa'];
                  $username=$_SESSION['user'];
                  $logged="<a class='nav-link text-uppercase text-black' href='../Utenti/index.php?uid=".$uid."&sa=".$sa."'><i class='fa-solid fa-user'></i> ".$username."</a>";
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
      <div id="content">
        <form name="formLogin" action="../PHP/Login.php" method="POST" class="form-signin bg-light">
          <div class="container m-3">
            <h4 class="text-uppercase gold-text mb-3">Benvenuti</h4>         
            <div>
              <label for="email">Email</label> <br>
              <input type="text" id="email" name="email" placeholder="Inserisci la tua email" maxlength="30" size="30">
            </div>
            <br>
            <div>
              <label for="password">Password</label> <br>
              <input type="text" id="password" name="password" placeholder="Password" maxlength="30" size="30">
            </div>
            <br><br>
            <div>
              <a class="bg-sm" href="../Registrazione/registrazione.php">Crea Nuovo Account</a>
              <br> 
              <a class="bg-sm" href="../Registrazione/registrazioneAziendale.php">Crea Nuovo Account Aziendale</a>
            </div>
            <h4><button id="login-button" name="loginButton" type="submit" class="btn-lg" >Login</button></h4>
          </div>
        </form>
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
          &copy;2023 Intersection <br><img src="../Images/favicon.jpg" id="favi">
        </div>
      </footer>
    </body>
</html>