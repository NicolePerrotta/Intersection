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
        <link rel="stylesheet" type="text/css" href="CreateJobOffer/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css"> <!--FONTAWESOME CI SERVE?-->

        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script> <!--BOOTSTRAP CI SERVE?-->
        <script>
          window.onload = function() {
            var textarea = document.getElementsByClassName("extensible");
            var limit = 500;

            textarea[0].oninput = function() {
              textarea[0].style.height = "";
              textarea[0].style.height = Math.min(textarea[0].scrollHeight, limit) + "px";
            }

            textarea[1].oninput = function() {
              textarea[1].style.height = "";
              textarea[1].style.height = Math.min(textarea[1].scrollHeight, limit) + "px";
            }
          }
        </script>

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
      <form action="createJobOffer.php" class="form-signin bg-light" method="POST" name="formCreazione">
        <h4 class="mb-3 text-uppercase gold-text">Crea Nuova Offerta di lavoro</h4>
        <div class="form-floating mb-3">
            <input type="text" class="form-control form-field" id="title" name="title" placeholder="." minlength="2" maxlength="100" size="100" required>
            <label for="title">Title*</label>
        </div>
        <div class="form-floating mb-3">
          <textarea class="form-control form-field extensible" id="description" name="description" placeholder="," rows="5" cols="75" maxlength="2000"></textarea>
          <label for="description">Description*</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control form-field" id="salary" name="salary" placeholder="," minlength="3" maxlength="100" size="100" required>
            <label for="salary">Salary*</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control form-field" id="period" name="period" placeholder="," minlength="3" maxlength="100" size="100" required>
            <label for="period">Period*</label>
        </div>
        <br>  
        <h2 id="end">I campi contrassegnati con * sono obbligatori</h2>
        <div class="text-center">
        <?php
          if(!isset($_SESSION['uid']) || ($_SESSION['sa']==0))
          {
           echo '<div id="errore" class="mt-3"><i class="fa-solid fa-triangle-exclamation"></i> Login come Company per creare una job offer</div>';
          }
          else
          {
           echo '<div>
           <input type="hidden" class="form-control form-field" id="uid" name="uid" value="'.$_SESSION["uid"].'">
           </div>
           <button type="submit" name="creationButton" class="btn-lg round-button">Send</button>';
          }
      ?>
        </div>
        <br>
      </form>
      
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