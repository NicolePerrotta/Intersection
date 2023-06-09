<?php
session_start();
if( !isset( $_GET['lang'] ) ) {
  if( !isset( $_SESSION['lang'] ) ) {
    $_SESSION['lang'] = 'it';
  }
} else {
  $_SESSION['lang'] = $_GET['lang'];
}
?>
<!DOCTYPE html>
  <html>
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>
        <?php 
          if( $_SESSION['lang'] == 'it' ) { echo "Registrazione Professionista - Intersection"; }
          if( $_SESSION['lang'] == 'en' ) { echo "Professional Sign-up - Intersection"; }
        ?>
      </title>
      <link rel="icon" href="images/favi-1.png" type="favicon">
      <link rel="stylesheet" href="css/style.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@100;200;400;600;800&display=swap" rel="stylesheet">
    </head>

    <body>

      <?php if( $_SESSION['lang'] == 'it' ): ?>
      <!-- Header IT -->
      <header class="top-0 w-100">
        <div class="container px-2 d-flex flex-column flex-md-row justify-content-between align-items-center gap-5 py-4">
          <div class="logo-container">
            <a href="index.php">
              <img src="images/logo-1.png" alt="Intersection" style="height: 30px;">
            </a>
          </div>
          <?php if( !isset( $_SESSION['uid'] ) ) : ?>
          <div class="menu-container d-flex align-items-center gap-4">
            <div class="dropdown">
              <button class="btn dropdown-toggle fw-bold" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">IT</button>
                <ul class="dropdown-menu dropdown-menu-end" style="--bs-dropdown-min-width: 10px; --bs-dropdown-bg: #F9FBFE; --bs-dropdown-link-hover-color: var(--intersection-color-3); --bs-dropdown-link-active-color: var(--intersection-color-3); --bs-dropdown-link-active-bg: transparent; transition: none;">
                  <li><div class="dropdown-header">Seleziona lingua</div></li>
                  <li><a class="dropdown-item" href="indexRegistrazione.php?lang=it">Italiano</a></li>
                  <li><a class="dropdown-item" href="indexRegistrazione.php?lang=en">English</a></li>
                </ul>
            </div>
            <a href="indexLogin.php" class="text-decoration-none text-color-2 fw-bold">Accedi</a>
            <div class="dropdown">
              <button class="btn dropdown-toggle fw-bold py-2 px-3 border border-2 rounded" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-color: var(--intersection-color-3) !important; color: var(--intersection-color-3)">Registrati</button>
              <ul class="dropdown-menu dropdown-menu-end" style="--bs-dropdown-min-width: 10px; --bs-dropdown-bg: #F9FBFE; --bs-dropdown-link-hover-color: var(--intersection-color-3); --bs-dropdown-link-active-color: var(--intersection-color-3); --bs-dropdown-link-active-bg: transparent; transition: none;">
                <li><div class="dropdown-header">Registrati come</div></li>
                <li><a class="dropdown-item" href="indexRegistrazioneAziendale.php">Azienda</a></li>
                <li><a class="dropdown-item" href="indexRegistrazione.php">Professionista</a></li>
              </ul>
            </div>
          </div>
          <?php else : ?>
            <?php if( $_SESSION['sa'] == 0 ) : ?>
              <div class="menu-container d-flex align-items-center gap-4">
                <div class="dropdown">
                    <button class="btn dropdown-toggle fw-bold" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">IT</button>
                    <ul class="dropdown-menu dropdown-menu-end" style="--bs-dropdown-min-width: 10px; --bs-dropdown-bg: #F9FBFE; --bs-dropdown-link-hover-color: var(--intersection-color-3); --bs-dropdown-link-active-color: var(--intersection-color-3); --bs-dropdown-link-active-bg: transparent; transition: none;">
                      <li><div class="dropdown-header">Seleziona lingua</div></li>
                      <li><a class="dropdown-item" href="indexRegistrazione.php?lang=it">Italiano</a></li>
                      <li><a class="dropdown-item" href="indexRegistrazione.php?lang=en">English</a></li>
                    </ul>
                </div>
                <a href=" <?php echo 'indexListJobs.php?uid=' . $_SESSION['uid'] . '&sa=' . $_SESSION['sa'] ?> " class="btn fw-bold py-2 px-3 border border-2 rounded" style="border-color: var(--intersection-color-3) !important; color: var(--intersection-color-3) !important;">Lista lavori</a>
                <div class="dropdown">
                    <button class="btn dropdown-toggle fw-bold d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
                      <?php 
                        if( file_exists('.env') ) {
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
                        $dbconn = pg_connect( "host=$PGHOST port=$PGPORT dbname=$PGDATABASE user=$PGUSER password=$PGPASSWORD" ) or header( "Location: indexErrore.php?er=100" );
                        $q19 = "SELECT * FROM worker WHERE worker_id=$1 LIMIT 1";
                        $result19 = pg_query_params( $dbconn, $q19, array($_SESSION['uid']) );
                        if( pg_num_rows( $result19 ) > 0) {
                          $co=pg_fetch_assoc($result19);  
                          if( isset( $co['picture'] ) ) {
                            $propic = $co['picture'];
                            $usernameWorker = $co['username'];
                            $profile_picture = pg_unescape_bytea($propic);
                            $picture_filename = "storage/image_$usernameWorker.png";
                            file_put_contents($picture_filename, $profile_picture);
                            echo '<img src="' . $picture_filename . '" class="img-fluid rounded" style="width: 30px; aspect-ratio: 1; object-fit: cover;">';
                            } else {
                            echo '<img src="images/default-profile.png" class="img-fluid rounded" style="width: 30px; aspect-ratio: 1; object-fit: cover;">';
                            }
                        } else {
                          echo '<img src="images/default-profile.png" class="img-fluid rounded" style="width: 30px; aspect-ratio: 1; object-fit: cover;">';
                        }
                        if(isset($result19)) pg_free_result($result19);
                        pg_close($dbconn);
                        ?>
                      <div><?php echo $_SESSION['user'] ?></div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" style="--bs-dropdown-min-width: 10px; --bs-dropdown-bg: #F9FBFE; --bs-dropdown-link-hover-color: var(--intersection-color-3); --bs-dropdown-link-active-color: var(--intersection-color-3); --bs-dropdown-link-active-bg: transparent; transition: none;">
                      <li><div class="dropdown-header">Azioni</div></li>
                      <li><a class="dropdown-item" href=" <?php echo 'indexUtenti.php?uid=' . $_SESSION['uid'] . '&sa=' . $_SESSION['sa'] ?> ">Profilo</a></li>
                      <li><a class="dropdown-item" href="Logout.php">Logout</a></li>
                    </ul>
                </div>
              </div>
            <?php elseif( $_SESSION['sa'] == 1 ) : ?>
              <div class="menu-container d-flex align-items-center gap-4">
                <div class="dropdown">
                    <button class="btn dropdown-toggle fw-bold" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">IT</button>
                    <ul class="dropdown-menu dropdown-menu-end" style="--bs-dropdown-min-width: 10px; --bs-dropdown-bg: #F9FBFE; --bs-dropdown-link-hover-color: var(--intersection-color-3); --bs-dropdown-link-active-color: var(--intersection-color-3); --bs-dropdown-link-active-bg: transparent; transition: none;">
                      <li><div class="dropdown-header">Seleziona lingua</div></li>
                      <li><a class="dropdown-item" href="indexRegistrazione.php?lang=it">Italiano</a></li>
                      <li><a class="dropdown-item" href="indexRegistrazione.php?lang=en">English</a></li>
                    </ul>
                </div>
                <a href=" <?php echo 'indexJobOffers.php?uid=' . $_SESSION['uid'] . '&sa=' . $_SESSION['sa'] ?> " class="btn fw-bold py-2 px-3 border border-2 rounded" style="border-color: var(--intersection-color-3) !important; color: var(--intersection-color-3) !important;">Lista offerte</a>
                <div class="dropdown">
                    <button class="btn dropdown-toggle fw-bold d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
                      <?php 
                        if( file_exists('.env') ) {
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
                        $dbconn = pg_connect( "host=$PGHOST port=$PGPORT dbname=$PGDATABASE user=$PGUSER password=$PGPASSWORD" ) or header( "Location: indexErrore.php?er=100" );
                        $q19 = "SELECT * FROM company WHERE company_id=$1 LIMIT 1";
                        $result19 = pg_query_params( $dbconn, $q19, array($_SESSION['uid']) );
                        if( pg_num_rows( $result19 ) > 0) {
                          $co=pg_fetch_assoc($result19);  
                          if( isset( $co['logo'] ) ) {
                            $logo = $co['logo'];
                            $usernameCompany = $co['username'];
                            $logo = pg_unescape_bytea($logo);
                            $logo_filename = "storage/image_$usernameCompany.png";
                            file_put_contents($logo_filename, $logo);
                            echo '<img src="' . $logo_filename . '" class="img-fluid rounded" style="width: 30px; aspect-ratio: 1; object-fit: cover;">';
                          } else {
                            echo '<img src="images/default-profile.png" class="img-fluid rounded" style="width: 30px; aspect-ratio: 1; object-fit: cover;">';
                          }
                        } else {
                          echo '<img src="images/default-profile.png" class="img-fluid rounded" style="width: 30px; aspect-ratio: 1; object-fit: cover;">';
                        }
                        if(isset($result19)) pg_free_result($result19);
                        pg_close($dbconn);
                      ?>
                      <div><?php echo $_SESSION['user'] ?></div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" style="--bs-dropdown-min-width: 10px; --bs-dropdown-bg: #F9FBFE; --bs-dropdown-link-hover-color: var(--intersection-color-3); --bs-dropdown-link-active-color: var(--intersection-color-3); --bs-dropdown-link-active-bg: transparent; transition: none;">
                      <li><div class="dropdown-header">Azioni</div></li>
                      <li><a class="dropdown-item" href=" <?php echo 'indexUtenti.php?uid=' . $_SESSION['uid'] . '&sa=' . $_SESSION['sa'] ?> ">Profilo</a></li>
                      <li><a class="dropdown-item" href="Logout.php">Logout</a></li>
                    </ul>
                </div>
              </div>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </header>
      <?php endif; ?>

      <?php if( $_SESSION['lang'] == 'en' ): ?>
      <!-- Header EN -->
      <header class="top-0 w-100">
        <div class="container px-2 d-flex flex-column flex-md-row justify-content-between align-items-center gap-5 py-4">
          <div class="logo-container">
            <a href="index.php">
              <img src="images/logo-1.png" alt="Intersection" style="height: 30px;">
            </a>
          </div>
          <?php if( !isset( $_SESSION['uid'] ) ) : ?>
          <div class="menu-container d-flex align-items-center gap-4">
            <div class="dropdown">
              <button class="btn dropdown-toggle fw-bold" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">EN</button>
                <ul class="dropdown-menu dropdown-menu-end" style="--bs-dropdown-min-width: 10px; --bs-dropdown-bg: #F9FBFE; --bs-dropdown-link-hover-color: var(--intersection-color-3); --bs-dropdown-link-active-color: var(--intersection-color-3); --bs-dropdown-link-active-bg: transparent; transition: none;">
                  <li><div class="dropdown-header">Select language</div></li>
                  <li><a class="dropdown-item" href="indexRegistrazione.php?lang=it">Italiano</a></li>
                  <li><a class="dropdown-item" href="indexRegistrazione.php?lang=en">English</a></li>
                </ul>
            </div>
            <a href="indexLogin.php" class="text-decoration-none text-color-2 fw-bold">Login</a>
            <div class="dropdown">
              <button class="btn dropdown-toggle fw-bold py-2 px-3 border border-2 rounded" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-color: var(--intersection-color-3) !important; color: var(--intersection-color-3)">Sign up</button>
              <ul class="dropdown-menu dropdown-menu-end" style="--bs-dropdown-min-width: 10px; --bs-dropdown-bg: #F9FBFE; --bs-dropdown-link-hover-color: var(--intersection-color-3); --bs-dropdown-link-active-color: var(--intersection-color-3); --bs-dropdown-link-active-bg: transparent; transition: none;">
                <li><div class="dropdown-header">Sign up as</div></li>
                <li><a class="dropdown-item" href="indexRegistrazioneAziendale.php">Company</a></li>
                <li><a class="dropdown-item" href="indexRegistrazione.php">Professional</a></li>
              </ul>
            </div>
          </div>
          <?php else : ?>
            <?php if( $_SESSION['sa'] == 0 ) : ?>
              <div class="menu-container d-flex align-items-center gap-4">
                <div class="dropdown">
                    <button class="btn dropdown-toggle fw-bold" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">EN</button>
                    <ul class="dropdown-menu dropdown-menu-end" style="--bs-dropdown-min-width: 10px; --bs-dropdown-bg: #F9FBFE; --bs-dropdown-link-hover-color: var(--intersection-color-3); --bs-dropdown-link-active-color: var(--intersection-color-3); --bs-dropdown-link-active-bg: transparent; transition: none;">
                      <li><div class="dropdown-header">Select language</div></li>
                      <li><a class="dropdown-item" href="indexRegistrazione.php?lang=it">Italiano</a></li>
                      <li><a class="dropdown-item" href="indexRegistrazione.php?lang=en">English</a></li>
                    </ul>
                </div>
                <a href=" <?php echo 'indexListJobs.php?uid=' . $_SESSION['uid'] . '&sa=' . $_SESSION['sa'] ?> " class="btn fw-bold py-2 px-3 border border-2 rounded" style="border-color: var(--intersection-color-3) !important; color: var(--intersection-color-3) !important;">Jobs list</a>
                <div class="dropdown">
                    <button class="btn dropdown-toggle fw-bold d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
                      <?php 
                        if( file_exists('.env') ) {
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
                        $dbconn = pg_connect( "host=$PGHOST port=$PGPORT dbname=$PGDATABASE user=$PGUSER password=$PGPASSWORD" ) or header( "Location: indexErrore.php?er=100" );
                        $q19 = "SELECT * FROM worker WHERE worker_id=$1 LIMIT 1";
                        $result19 = pg_query_params( $dbconn, $q19, array($_SESSION['uid']) );
                        if( pg_num_rows( $result19 ) > 0) {
                          $co=pg_fetch_assoc($result19);  
                          if( isset( $co['picture'] ) ) {
                            $propic = $co['picture'];
                            $usernameWorker = $co['username'];
                            $profile_picture = pg_unescape_bytea($propic);
                            $picture_filename = "storage/image_$usernameWorker.png";
                            file_put_contents($picture_filename, $profile_picture);
                            echo '<img src="' . $picture_filename . '" class="img-fluid rounded" style="width: 30px; aspect-ratio: 1; object-fit: cover;">';
                            } else {
                            echo '<img src="images/default-profile.png" class="img-fluid rounded" style="width: 30px; aspect-ratio: 1; object-fit: cover;">';
                            }
                        } else {
                          echo '<img src="images/default-profile.png" class="img-fluid rounded" style="width: 30px; aspect-ratio: 1; object-fit: cover;">';
                        }
                        if(isset($result19)) pg_free_result($result19);
                        pg_close($dbconn);
                        ?>
                      <div><?php echo $_SESSION['user'] ?></div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" style="--bs-dropdown-min-width: 10px; --bs-dropdown-bg: #F9FBFE; --bs-dropdown-link-hover-color: var(--intersection-color-3); --bs-dropdown-link-active-color: var(--intersection-color-3); --bs-dropdown-link-active-bg: transparent; transition: none;">
                      <li><div class="dropdown-header">Actions</div></li>
                      <li><a class="dropdown-item" href=" <?php echo 'indexUtenti.php?uid=' . $_SESSION['uid'] . '&sa=' . $_SESSION['sa'] ?> ">Profile</a></li>
                      <li><a class="dropdown-item" href="Logout.php">Logout</a></li>
                    </ul>
                </div>
              </div>
            <?php elseif( $_SESSION['sa'] == 1 ) : ?>
              <div class="menu-container d-flex align-items-center gap-4">
                <div class="dropdown">
                    <button class="btn dropdown-toggle fw-bold" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">EN</button>
                    <ul class="dropdown-menu dropdown-menu-end" style="--bs-dropdown-min-width: 10px; --bs-dropdown-bg: #F9FBFE; --bs-dropdown-link-hover-color: var(--intersection-color-3); --bs-dropdown-link-active-color: var(--intersection-color-3); --bs-dropdown-link-active-bg: transparent; transition: none;">
                      <li><div class="dropdown-header">Select language</div></li>
                      <li><a class="dropdown-item" href="indexRegistrazione.php?lang=it">Italiano</a></li>
                      <li><a class="dropdown-item" href="indexRegistrazione.php?lang=en">English</a></li>
                    </ul>
                </div>
                <a href=" <?php echo 'indexJobOffers.php?uid=' . $_SESSION['uid'] . '&sa=' . $_SESSION['sa'] ?> " class="btn fw-bold py-2 px-3 border border-2 rounded" style="border-color: var(--intersection-color-3) !important; color: var(--intersection-color-3) !important;">Offers list</a>
                <div class="dropdown">
                    <button class="btn dropdown-toggle fw-bold d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
                      <?php 
                        if( file_exists('.env') ) {
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
                        $dbconn = pg_connect( "host=$PGHOST port=$PGPORT dbname=$PGDATABASE user=$PGUSER password=$PGPASSWORD" ) or header( "Location: indexErrore.php?er=100" );
                        $q19 = "SELECT * FROM company WHERE company_id=$1 LIMIT 1";
                        $result19 = pg_query_params( $dbconn, $q19, array($_SESSION['uid']) );
                        if( pg_num_rows( $result19 ) > 0) {
                          $co=pg_fetch_assoc($result19);  
                          if( isset( $co['logo'] ) ) {
                            $logo = $co['logo'];
                            $usernameCompany = $co['username'];
                            $logo = pg_unescape_bytea($logo);
                            $logo_filename = "storage/image_$usernameCompany.png";
                            file_put_contents($logo_filename, $logo);
                            echo '<img src="' . $logo_filename . '" class="img-fluid rounded" style="width: 30px; aspect-ratio: 1; object-fit: cover;">';
                          } else {
                            echo '<img src="images/default-profile.png" class="img-fluid rounded" style="width: 30px; aspect-ratio: 1; object-fit: cover;">';
                          }
                        } else {
                          echo '<img src="images/default-profile.png" class="img-fluid rounded" style="width: 30px; aspect-ratio: 1; object-fit: cover;">';
                        }
                        if(isset($result19)) pg_free_result($result19);
                        pg_close($dbconn);
                      ?>
                      <div><?php echo $_SESSION['user'] ?></div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" style="--bs-dropdown-min-width: 10px; --bs-dropdown-bg: #F9FBFE; --bs-dropdown-link-hover-color: var(--intersection-color-3); --bs-dropdown-link-active-color: var(--intersection-color-3); --bs-dropdown-link-active-bg: transparent; transition: none;">
                      <li><div class="dropdown-header">Actions</div></li>
                      <li><a class="dropdown-item" href=" <?php echo 'indexUtenti.php?uid=' . $_SESSION['uid'] . '&sa=' . $_SESSION['sa'] ?> ">Profile</a></li>
                      <li><a class="dropdown-item" href="Logout.php">Logout</a></li>
                    </ul>
                </div>
              </div>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </header>
      <?php endif; ?>

      <?php if( $_SESSION['lang'] == 'it' ): ?>
      <!-- Page content IT -->
      <div class="page-content">

        <section id="main">
          <div class="container px-3" style="padding: 60px 0 120px;">
            <div class="col-md-8 mx-auto d-flex flex-column gap-5">
              <div>
                <h1 class="text-color-2 fw-bold">Nuovo professionista</h1>
                <div class="text-color-5">Registrati come professionista e penseremo noi a tutto il resto.</div>
              </div>
              <div class="d-flex flex-column gap-3">
                <form action="RegistrazioneUtente.php" method="POST" name="formRegistrazione" id="form-registrazione" onSubmit="return validaRegistrazione()" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="nome" class="form-label">Nome *</label>
                    <input type="text" class="form-control" name="nome" id="nome" required>
                  </div>
                  <div class="mb-3">
                    <label for="cognome" class="form-label">Cognome *</label>
                    <input type="text" class="form-control" name="cognome" id="cognome" required>
                  </div>
                  <div class="mb-3">
                    <label for="dataDiNascita" class="form-label">Data di nascita *</label>
                    <input type="date" class="form-control" name="dataDiNascita" id="dataDiNascita" required>
                    <div class="text-color-5 mt-1" style="font-size: 80%;">L'età minima per effettuare l'iscrizione è di 18 anni.</div>
                    <div id="erroreEta" class="d-none text-danger mt-1">Età inferiore ai 18 anni</div>
                    <div id="erroreEta2" class="d-none text-danger mt-1">Età errata</div>
                  </div>
                  <div class="mb-3">
                    <label for="gender" class="form-label">Genere *</label>
                    <div class="d-flex gap-4">
                      <input class="btn-check" type="radio" name="genere" id="maschio" value="Maschio" required>
                      <label class="btn btn-sm btn-outline-secondary" for="maschio">Maschio</label>
                      <input class="btn-check" type="radio" name="genere" id="femmina" value="Femmina">
                      <label class="btn btn-sm btn-outline-secondary" for="femmina">Femmina</label>
                      <input class="btn-check" type="radio" name="genere" id="altro" value="Altro">
                      <label class="btn btn-sm btn-outline-secondary" for="altro">Altro</label>
                      <div class="invalid-feedback">Per favore seleziona un genere</div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="indirizzo" class="form-label">Indirizzo</label>
                    <input type="text" class="form-control" name="indirizzo" id="indirizzo">
                  </div>
                  <div class="mb-3">
                    <label for="città" class="form-label">Città</label>
                    <input type="text" class="form-control" name="città" id="città">
                  </div>
                  <div class="mb-3">
                    <label for="nazione" class="form-label">Nazione</label>
                    <select id="nazione" name="nazione" class="form-select">
                      <option value="nessuna" selected></option>
                      <option value="US">United States</option>
                      <option value="CA">Canada</option>
                      <option value="AF">Afghanistan</option>
                      <option value="AL">Albania</option>
                      <option value="DZ">Algeria</option>
                      <option value="AS">American Samoa</option>
                      <option value="AD">Andorra</option>
                      <option value="AO">Angola</option>
                      <option value="AI">Anguilla</option>
                      <option value="AQ">Antarctica</option>
                      <option value="AG">Antigua and Barbuda</option>
                      <option value="AR">Argentina</option>
                      <option value="AM">Armenia</option>
                      <option value="AW">Aruba</option>
                      <option value="AU">Australia</option>
                      <option value="AT">Austria</option>
                      <option value="AZ">Azerbaijan</option>
                      <option value="BS">Bahamas</option>
                      <option value="BH">Bahrain</option>
                      <option value="BD">Bangladesh</option>
                      <option value="BB">Barbados</option>
                      <option value="BY">Belarus</option>
                      <option value="BE">Belgium</option>
                      <option value="BZ">Belize</option>
                      <option value="BJ">Benin</option>
                      <option value="BM">Bermuda</option>
                      <option value="BT">Bhutan</option>
                      <option value="BO">Bolivia</option>
                      <option value="BA">Bosnia and Herzegovina</option>
                      <option value="BW">Botswana</option>
                      <option value="BV">Bouvet Island</option>
                      <option value="BR">Brazil</option>
                      <option value="IO">British Indian Ocean Territory</option>
                      <option value="BN">Brunei Darussalam</option>
                      <option value="BG">Bulgaria</option>
                      <option value="BF">Burkina Faso</option>
                      <option value="BI">Burundi</option>
                      <option value="KH">Cambodia</option>
                      <option value="CM">Cameroon</option>
                      <option value="CV">Cape Verde</option>
                      <option value="KY">Cayman Islands</option>
                      <option value="CF">Central African Republic</option>
                      <option value="TD">Chad</option>
                      <option value="CL">Chile</option>
                      <option value="CN">China</option>
                      <option value="CX">Christmas Island</option>
                      <option value="CC">Cocos (Keeling) Islands</option>
                      <option value="CO">Colombia</option>
                      <option value="KM">Comoros</option>
                      <option value="CG">Congo</option>
                      <option value="CD">Congo (Democratic Republic)</option>
                      <option value="CK">Cook Islands</option>
                      <option value="CR">Costa Rica</option>
                      <option value="HR">Croatia</option>
                      <option value="CU">Cuba</option>
                      <option value="CY">Cyprus</option>
                      <option value="CZ">Czech Republic</option>
                      <option value="DK">Denmark</option>
                      <option value="DJ">Djibouti</option>
                      <option value="DM">Dominica</option>
                      <option value="DO">Dominican Republic</option>
                      <option value="TP">East Timor</option>
                      <option value="EC">Ecuador</option>
                      <option value="EG">Egypt</option>
                      <option value="SV">El Salvador</option>
                      <option value="GQ">Equatorial Guinea</option>
                      <option value="ER">Eritrea</option>
                      <option value="EE">Estonia</option>
                      <option value="ET">Ethiopia</option>
                      <option value="FK">Falkland Islands</option>
                      <option value="FO">Faroe Islands</option>
                      <option value="FJ">Fiji</option>
                      <option value="FI">Finland</option>
                      <option value="FR">France</option>
                      <option value="FX">France (European Territory)</option>
                      <option value="GF">French Guiana</option>
                      <option value="TF">French Southern Territories</option>
                      <option value="GA">Gabon</option>
                      <option value="GM">Gambia</option>
                      <option value="GE">Georgia</option>
                      <option value="DE">Germany</option>
                      <option value="GH">Ghana</option>
                      <option value="GI">Gibraltar</option>
                      <option value="GR">Greece</option>
                      <option value="GL">Greenland</option>
                      <option value="GD">Grenada</option>
                      <option value="GP">Guadeloupe</option>
                      <option value="GU">Guam</option>
                      <option value="GT">Guatemala</option>
                      <option value="GN">Guinea</option>
                      <option value="GW">Guinea Bissau</option>
                      <option value="GY">Guyana</option>
                      <option value="HT">Haiti</option>
                      <option value="HM">Heard and McDonald Islands</option>
                      <option value="VA">Holy See (Vatican)</option>
                      <option value="HN">Honduras</option>
                      <option value="HK">Hong Kong</option>
                      <option value="HU">Hungary</option>
                      <option value="IS">Iceland</option>
                      <option value="IN">India</option>
                      <option value="ID">Indonesia</option>
                      <option value="IR">Iran</option>
                      <option value="IQ">Iraq</option>
                      <option value="IE">Ireland</option>
                      <option value="IL">Israel</option>
                      <option value="IT">Italy</option>
                      <option value="CI">Cote D&rsquo;Ivoire</option>
                      <option value="JM">Jamaica</option>
                      <option value="JP">Japan</option>
                      <option value="JO">Jordan</option>
                      <option value="KZ">Kazakhstan</option>
                      <option value="KE">Kenya</option>
                      <option value="KI">Kiribati</option>
                      <option value="KW">Kuwait</option>
                      <option value="KG">Kyrgyzstan</option>
                      <option value="LA">Laos</option>
                      <option value="LV">Latvia</option>
                      <option value="LB">Lebanon</option>
                      <option value="LS">Lesotho</option>
                      <option value="LR">Liberia</option>
                      <option value="LY">Libya</option>
                      <option value="LI">Liechtenstein</option>
                      <option value="LT">Lithuania</option>
                      <option value="LU">Luxembourg</option>
                      <option value="MO">Macau</option>
                      <option value="MK">Macedonia</option>
                      <option value="MG">Madagascar</option>
                      <option value="MW">Malawi</option>
                      <option value="MY">Malaysia</option>
                      <option value="MV">Maldives</option>
                      <option value="ML">Mali</option>
                      <option value="MT">Malta</option>
                      <option value="MH">Marshall Islands</option>
                      <option value="MQ">Martinique</option>
                      <option value="MR">Mauritania</option>
                      <option value="MU">Mauritius</option>
                      <option value="YT">Mayotte</option>
                      <option value="MX">Mexico</option>
                      <option value="FM">Micronesia</option>
                      <option value="MD">Moldova</option>
                      <option value="MC">Monaco</option>
                      <option value="MN">Mongolia</option>
                      <option value="ME">Montenegro</option>
                      <option value="MS">Montserrat</option>
                      <option value="MA">Morocco</option>
                      <option value="MZ">Mozambique</option>
                      <option value="MM">Myanmar</option>
                      <option value="NA">Namibia</option>
                      <option value="NR">Nauru</option>
                      <option value="NP">Nepal</option>
                      <option value="NL">Netherlands</option>
                      <option value="AN">Netherlands Antilles</option>
                      <option value="NC">New Caledonia</option>
                      <option value="NZ">New Zealand</option>
                      <option value="NI">Nicaragua</option>
                      <option value="NE">Niger</option>
                      <option value="NG">Nigeria</option>
                      <option value="NU">Niue</option>
                      <option value="NF">Norfolk Island</option>
                      <option value="KP">North Korea</option>
                      <option value="MP">Northern Mariana Islands</option>
                      <option value="NO">Norway</option>
                      <option value="OM">Oman</option>
                      <option value="PK">Pakistan</option>
                      <option value="PW">Palau</option>
                      <option value="PS">Palestinian Territory</option>
                      <option value="PA">Panama</option>
                      <option value="PG">Papua New Guinea</option>
                      <option value="PY">Paraguay</option>
                      <option value="PE">Peru</option>
                      <option value="PH">Philippines</option>
                      <option value="PN">Pitcairn</option>
                      <option value="PL">Poland</option>
                      <option value="PF">Polynesia</option>
                      <option value="PT">Portugal</option>
                      <option value="PR">Puerto Rico</option>
                      <option value="QA">Qatar</option>
                      <option value="RE">Reunion</option>
                      <option value="RO">Romania</option>
                      <option value="RU">Russian Federation</option>
                      <option value="RW">Rwanda</option>
                      <option value="GS">S. Georgia &amp; S. Sandwich Isls.</option>
                      <option value="SH">Saint Helena</option>
                      <option value="KN">Saint Kitts &amp; Nevis Anguilla</option>
                      <option value="LC">Saint Lucia</option>
                      <option value="PM">Saint Pierre and Miquelon</option>
                      <option value="VC">Saint Vincent &amp; Grenadines</option>
                      <option value="WS">Samoa</option>
                      <option value="SM">San Marino</option>
                      <option value="ST">Sao Tome and Principe</option>
                      <option value="SA">Saudi Arabia</option>
                      <option value="SN">Senegal</option>
                      <option value="RS">Serbia</option>
                      <option value="SC">Seychelles</option>
                      <option value="SL">Sierra Leone</option>
                      <option value="SG">Singapore</option>
                      <option value="SK">Slovakia</option>
                      <option value="SI">Slovenia</option>
                      <option value="SB">Solomon Islands</option>
                      <option value="SO">Somalia</option>
                      <option value="ZA">South Africa</option>
                      <option value="KR">South Korea</option>
                      <option value="ES">Spain</option>
                      <option value="LK">Sri Lanka</option>
                      <option value="SD">Sudan</option>
                      <option value="SR">Suriname</option>
                      <option value="SZ">Swaziland</option>
                      <option value="SE">Sweden</option>
                      <option value="CH">Switzerland</option>
                      <option value="SY">Syrian Arab Republic</option>
                      <option value="TW">Taiwan</option>
                      <option value="TJ">Tajikistan</option>
                      <option value="TZ">Tanzania</option>
                      <option value="TH">Thailand</option>
                      <option value="TG">Togo</option>
                      <option value="TK">Tokelau</option>
                      <option value="TO">Tonga</option>
                      <option value="TT">Trinidad and Tobago</option>
                      <option value="TN">Tunisia</option>
                      <option value="TR">Turkey</option>
                      <option value="TM">Turkmenistan</option>
                      <option value="TC">Turks and Caicos Islands</option>
                      <option value="TV">Tuvalu</option>
                      <option value="UG">Uganda</option>
                      <option value="UA">Ukraine</option>
                      <option value="AE">United Arab Emirates</option>
                      <option value="GB">United Kingdom</option>
                      <option value="UY">Uruguay</option>
                      <option value="UM">USA Minor Outlying Islands</option>
                      <option value="UZ">Uzbekistan</option>
                      <option value="VU">Vanuatu</option>
                      <option value="VE">Venezuela</option>
                      <option value="VN">Vietnam</option>
                      <option value="VG">Virgin Islands (British)</option>
                      <option value="VI">Virgin Islands (USA)</option>
                      <option value="WF">Wallis and Futuna Islands</option>
                      <option value="EH">Western Sahara</option>
                      <option value="YE">Yemen</option>
                      <option value="ZR">Zaire</option>
                      <option value="ZM">Zambia</option>
                      <option value="ZW">Zimbabwe</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="emailC" class="form-label">Email di contatto *</label>
                    <input type="email" class="form-control" name="emailC" id="emailC" required>
                  </div>
                  <div class="mb-3">
                    <label for="telefono" class="form-label">Numero di telefono</label>
                    <input type="tel" class="form-control" name="telefono" id="telefono">
                  </div>
                  <div class="mb-3">
                    <label for="picture" class="form-label">Foto profilo</label>
                    <input type="file" class="form-control" name="picture" id="picture">
                  </div>
                  <div class="mt-5 mb-5">
                    <label for="curriculum" class="form-label">Carica il tuo Curriculum Vitae *</label>
                    <input type="file" class="form-control" name="curriculum" id="curriculum" required>
                  </div>
                  <div class="mb-3">
                    <label for="username" class="form-label">Nome utente *</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                  </div>
                  <div class="mb-3">
                    <label for="emailR" class="form-label">Email *</label>
                    <input type="email" class="form-control" name="emailR" id="emailR" required>
                  </div>
                  <div class="mb-3">
                    <label for="emailR2" class="form-label">Conferma Email *</label>
                    <input type="email" class="form-control" name="emailR2" id="emailR2" required>
                    <div id="erroreEmail" class="d-none text-danger mt-1">Email di conferma errata</div>
                  </div>
                  <div class="mb-3">
                    <label for="passwordR" class="form-label">Password *</label>
                    <input type="password" class="form-control" name="passwordR" id="passwordR" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                    <div class="text-color-5 mt-1" style="font-size: 80%;">La password deve essere di almeno 8 caratteri (fino a 32) e contenere almeno un numero, una lettera minuscola e una lettera maiuscola.</div>
                  </div>
                  <div class="mb-4">
                    <label for="passwordR2" class="form-label">Conferma Password *</label>
                    <input type="password" class="form-control" name="passwordR2" id="passwordR2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                    <div id="errorePassword" class="d-none text-danger mt-1">Password di conferma errata</div>
                  </div>
                  <button type="submit" name="registrationButton" class="btn btn-primary w-100 fw-bold" style="--bs-btn-bg: var(--intersection-color-3); --bs-btn-hover-bg: var(--intersection-color-2)">Registrati</button>
                </form>
                <div class="text-color-5 text-center">Cliccando su <span class="fw-semibold">Registrati</span> accetti che i tuoi dati vengano utilizzati secondo quanto riportato nella <a href="indexPrivacyPolicy.php" class="text-decoration-none text-color-2 fw-bold">Privacy Policy</a>.</div>
              </div>
            </div>
          </div>
        </section>

        <script>
          function validaRegistrazione() {

            let b = true;
            if( document.formRegistrazione.emailR.value != document.formRegistrazione.emailR2.value ) {
              document.querySelector('#erroreEmail').setAttribute('style', 'display: block !important');
              location.href = "#emailR";
              b = false;
            } else {
              document.querySelector('#erroreEmail').setAttribute('style', 'display: none !important');
            }
            if( document.formRegistrazione.passwordR.value != document.formRegistrazione.passwordR2.value ) {
              document.querySelector('#errorePassword').setAttribute('style', 'display: block !important');
              if( b == true ) { location.href = '#passwordR'; }
              b = false;
            } else {
              document.querySelector('#errorePassword').setAttribute('style', 'display: none !important');
            }

            let dataDiNascita = document.formRegistrazione.dataDiNascita.value;
            let years = calcAge( dataDiNascita );
            if( years < 18 ) {
              document.querySelector('#erroreEta').setAttribute('style', 'display: block !important');
              if( b == true ) { location.href = '#dataDiNascita'; }
              b = false;
            } else {
              document.querySelector('#erroreEta').setAttribute('style', 'display: none !important');
            }
            if( years > 150 ) {
              document.querySelector('#erroreEta2').setAttribute('style', 'display: block !important');
              if( b == true ) { location.href = '#dataDiNascita'; }
              b = false;
            } else {
              document.querySelector('#erroreEta2').setAttribute('style', 'display: none !important');
            }

            return b;

          }

          function calcAge (birthday) {

            let today = new Date();
            let birthDate = new Date(birthday);
            let years = today.getFullYear() - birthDate.getFullYear();
            let m = today.getMonth() - birthDate.getMonth();

            if( m < 0 || ( m === 0 && today.getDate() < birthDate.getDate() ) ) {
              years--;
            }
            return years;

          }
        </script>

      </div>
      <?php endif; ?>

      <?php if( $_SESSION['lang'] == 'en' ): ?>
      <!-- Page content EN -->
      <div class="page-content">

        <section id="main">
          <div class="container px-3" style="padding: 60px 0 120px;">
            <div class="col-md-8 mx-auto d-flex flex-column gap-5">
              <div>
                <h1 class="text-color-2 fw-bold">New professional</h1>
                <div class="text-color-5">Register as a professional and we will take care of the rest.</div>
              </div>
              <div class="d-flex flex-column gap-3">
                <form action="RegistrazioneUtente.php" method="POST" name="formRegistrazione" id="form-registrazione" onSubmit="return validaRegistrazione()" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="nome" class="form-label">First name *</label>
                    <input type="text" class="form-control" name="nome" id="nome" required>
                  </div>
                  <div class="mb-3">
                    <label for="cognome" class="form-label">Last name *</label>
                    <input type="text" class="form-control" name="cognome" id="cognome" required>
                  </div>
                  <div class="mb-3">
                    <label for="dataDiNascita" class="form-label">Date of birth *</label>
                    <input type="date" class="form-control" name="dataDiNascita" id="dataDiNascita" required>
                    <div class="text-color-5 mt-1" style="font-size: 80%;">The minimum age to register is 18 years.</div>
                    <div id="erroreEta" class="d-none text-danger mt-1">Under the age of 18</div>
                    <div id="erroreEta2" class="d-none text-danger mt-1">Wrong age</div>
                  </div>
                  <div class="mb-3">
                    <label for="gender" class="form-label">Gender *</label>
                    <div class="d-flex gap-4">
                      <input class="btn-check" type="radio" name="genere" id="maschio" value="Maschio" required>
                      <label class="btn btn-sm btn-outline-secondary" for="maschio">Male</label>
                      <input class="btn-check" type="radio" name="genere" id="femmina" value="Femmina">
                      <label class="btn btn-sm btn-outline-secondary" for="femmina">Female</label>
                      <input class="btn-check" type="radio" name="genere" id="altro" value="Altro">
                      <label class="btn btn-sm btn-outline-secondary" for="altro">Other</label>
                      <div class="invalid-feedback">Please select a gender</div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="indirizzo" class="form-label">Address</label>
                    <input type="text" class="form-control" name="indirizzo" id="indirizzo">
                  </div>
                  <div class="mb-3">
                    <label for="città" class="form-label">City</label>
                    <input type="text" class="form-control" name="città" id="città">
                  </div>
                  <div class="mb-3">
                    <label for="nazione" class="form-label">Country</label>
                    <select id="nazione" name="nazione" class="form-select">
                      <option value="nessuna" selected></option>
                      <option value="US">United States</option>
                      <option value="CA">Canada</option>
                      <option value="AF">Afghanistan</option>
                      <option value="AL">Albania</option>
                      <option value="DZ">Algeria</option>
                      <option value="AS">American Samoa</option>
                      <option value="AD">Andorra</option>
                      <option value="AO">Angola</option>
                      <option value="AI">Anguilla</option>
                      <option value="AQ">Antarctica</option>
                      <option value="AG">Antigua and Barbuda</option>
                      <option value="AR">Argentina</option>
                      <option value="AM">Armenia</option>
                      <option value="AW">Aruba</option>
                      <option value="AU">Australia</option>
                      <option value="AT">Austria</option>
                      <option value="AZ">Azerbaijan</option>
                      <option value="BS">Bahamas</option>
                      <option value="BH">Bahrain</option>
                      <option value="BD">Bangladesh</option>
                      <option value="BB">Barbados</option>
                      <option value="BY">Belarus</option>
                      <option value="BE">Belgium</option>
                      <option value="BZ">Belize</option>
                      <option value="BJ">Benin</option>
                      <option value="BM">Bermuda</option>
                      <option value="BT">Bhutan</option>
                      <option value="BO">Bolivia</option>
                      <option value="BA">Bosnia and Herzegovina</option>
                      <option value="BW">Botswana</option>
                      <option value="BV">Bouvet Island</option>
                      <option value="BR">Brazil</option>
                      <option value="IO">British Indian Ocean Territory</option>
                      <option value="BN">Brunei Darussalam</option>
                      <option value="BG">Bulgaria</option>
                      <option value="BF">Burkina Faso</option>
                      <option value="BI">Burundi</option>
                      <option value="KH">Cambodia</option>
                      <option value="CM">Cameroon</option>
                      <option value="CV">Cape Verde</option>
                      <option value="KY">Cayman Islands</option>
                      <option value="CF">Central African Republic</option>
                      <option value="TD">Chad</option>
                      <option value="CL">Chile</option>
                      <option value="CN">China</option>
                      <option value="CX">Christmas Island</option>
                      <option value="CC">Cocos (Keeling) Islands</option>
                      <option value="CO">Colombia</option>
                      <option value="KM">Comoros</option>
                      <option value="CG">Congo</option>
                      <option value="CD">Congo (Democratic Republic)</option>
                      <option value="CK">Cook Islands</option>
                      <option value="CR">Costa Rica</option>
                      <option value="HR">Croatia</option>
                      <option value="CU">Cuba</option>
                      <option value="CY">Cyprus</option>
                      <option value="CZ">Czech Republic</option>
                      <option value="DK">Denmark</option>
                      <option value="DJ">Djibouti</option>
                      <option value="DM">Dominica</option>
                      <option value="DO">Dominican Republic</option>
                      <option value="TP">East Timor</option>
                      <option value="EC">Ecuador</option>
                      <option value="EG">Egypt</option>
                      <option value="SV">El Salvador</option>
                      <option value="GQ">Equatorial Guinea</option>
                      <option value="ER">Eritrea</option>
                      <option value="EE">Estonia</option>
                      <option value="ET">Ethiopia</option>
                      <option value="FK">Falkland Islands</option>
                      <option value="FO">Faroe Islands</option>
                      <option value="FJ">Fiji</option>
                      <option value="FI">Finland</option>
                      <option value="FR">France</option>
                      <option value="FX">France (European Territory)</option>
                      <option value="GF">French Guiana</option>
                      <option value="TF">French Southern Territories</option>
                      <option value="GA">Gabon</option>
                      <option value="GM">Gambia</option>
                      <option value="GE">Georgia</option>
                      <option value="DE">Germany</option>
                      <option value="GH">Ghana</option>
                      <option value="GI">Gibraltar</option>
                      <option value="GR">Greece</option>
                      <option value="GL">Greenland</option>
                      <option value="GD">Grenada</option>
                      <option value="GP">Guadeloupe</option>
                      <option value="GU">Guam</option>
                      <option value="GT">Guatemala</option>
                      <option value="GN">Guinea</option>
                      <option value="GW">Guinea Bissau</option>
                      <option value="GY">Guyana</option>
                      <option value="HT">Haiti</option>
                      <option value="HM">Heard and McDonald Islands</option>
                      <option value="VA">Holy See (Vatican)</option>
                      <option value="HN">Honduras</option>
                      <option value="HK">Hong Kong</option>
                      <option value="HU">Hungary</option>
                      <option value="IS">Iceland</option>
                      <option value="IN">India</option>
                      <option value="ID">Indonesia</option>
                      <option value="IR">Iran</option>
                      <option value="IQ">Iraq</option>
                      <option value="IE">Ireland</option>
                      <option value="IL">Israel</option>
                      <option value="IT">Italy</option>
                      <option value="CI">Cote D&rsquo;Ivoire</option>
                      <option value="JM">Jamaica</option>
                      <option value="JP">Japan</option>
                      <option value="JO">Jordan</option>
                      <option value="KZ">Kazakhstan</option>
                      <option value="KE">Kenya</option>
                      <option value="KI">Kiribati</option>
                      <option value="KW">Kuwait</option>
                      <option value="KG">Kyrgyzstan</option>
                      <option value="LA">Laos</option>
                      <option value="LV">Latvia</option>
                      <option value="LB">Lebanon</option>
                      <option value="LS">Lesotho</option>
                      <option value="LR">Liberia</option>
                      <option value="LY">Libya</option>
                      <option value="LI">Liechtenstein</option>
                      <option value="LT">Lithuania</option>
                      <option value="LU">Luxembourg</option>
                      <option value="MO">Macau</option>
                      <option value="MK">Macedonia</option>
                      <option value="MG">Madagascar</option>
                      <option value="MW">Malawi</option>
                      <option value="MY">Malaysia</option>
                      <option value="MV">Maldives</option>
                      <option value="ML">Mali</option>
                      <option value="MT">Malta</option>
                      <option value="MH">Marshall Islands</option>
                      <option value="MQ">Martinique</option>
                      <option value="MR">Mauritania</option>
                      <option value="MU">Mauritius</option>
                      <option value="YT">Mayotte</option>
                      <option value="MX">Mexico</option>
                      <option value="FM">Micronesia</option>
                      <option value="MD">Moldova</option>
                      <option value="MC">Monaco</option>
                      <option value="MN">Mongolia</option>
                      <option value="ME">Montenegro</option>
                      <option value="MS">Montserrat</option>
                      <option value="MA">Morocco</option>
                      <option value="MZ">Mozambique</option>
                      <option value="MM">Myanmar</option>
                      <option value="NA">Namibia</option>
                      <option value="NR">Nauru</option>
                      <option value="NP">Nepal</option>
                      <option value="NL">Netherlands</option>
                      <option value="AN">Netherlands Antilles</option>
                      <option value="NC">New Caledonia</option>
                      <option value="NZ">New Zealand</option>
                      <option value="NI">Nicaragua</option>
                      <option value="NE">Niger</option>
                      <option value="NG">Nigeria</option>
                      <option value="NU">Niue</option>
                      <option value="NF">Norfolk Island</option>
                      <option value="KP">North Korea</option>
                      <option value="MP">Northern Mariana Islands</option>
                      <option value="NO">Norway</option>
                      <option value="OM">Oman</option>
                      <option value="PK">Pakistan</option>
                      <option value="PW">Palau</option>
                      <option value="PS">Palestinian Territory</option>
                      <option value="PA">Panama</option>
                      <option value="PG">Papua New Guinea</option>
                      <option value="PY">Paraguay</option>
                      <option value="PE">Peru</option>
                      <option value="PH">Philippines</option>
                      <option value="PN">Pitcairn</option>
                      <option value="PL">Poland</option>
                      <option value="PF">Polynesia</option>
                      <option value="PT">Portugal</option>
                      <option value="PR">Puerto Rico</option>
                      <option value="QA">Qatar</option>
                      <option value="RE">Reunion</option>
                      <option value="RO">Romania</option>
                      <option value="RU">Russian Federation</option>
                      <option value="RW">Rwanda</option>
                      <option value="GS">S. Georgia &amp; S. Sandwich Isls.</option>
                      <option value="SH">Saint Helena</option>
                      <option value="KN">Saint Kitts &amp; Nevis Anguilla</option>
                      <option value="LC">Saint Lucia</option>
                      <option value="PM">Saint Pierre and Miquelon</option>
                      <option value="VC">Saint Vincent &amp; Grenadines</option>
                      <option value="WS">Samoa</option>
                      <option value="SM">San Marino</option>
                      <option value="ST">Sao Tome and Principe</option>
                      <option value="SA">Saudi Arabia</option>
                      <option value="SN">Senegal</option>
                      <option value="RS">Serbia</option>
                      <option value="SC">Seychelles</option>
                      <option value="SL">Sierra Leone</option>
                      <option value="SG">Singapore</option>
                      <option value="SK">Slovakia</option>
                      <option value="SI">Slovenia</option>
                      <option value="SB">Solomon Islands</option>
                      <option value="SO">Somalia</option>
                      <option value="ZA">South Africa</option>
                      <option value="KR">South Korea</option>
                      <option value="ES">Spain</option>
                      <option value="LK">Sri Lanka</option>
                      <option value="SD">Sudan</option>
                      <option value="SR">Suriname</option>
                      <option value="SZ">Swaziland</option>
                      <option value="SE">Sweden</option>
                      <option value="CH">Switzerland</option>
                      <option value="SY">Syrian Arab Republic</option>
                      <option value="TW">Taiwan</option>
                      <option value="TJ">Tajikistan</option>
                      <option value="TZ">Tanzania</option>
                      <option value="TH">Thailand</option>
                      <option value="TG">Togo</option>
                      <option value="TK">Tokelau</option>
                      <option value="TO">Tonga</option>
                      <option value="TT">Trinidad and Tobago</option>
                      <option value="TN">Tunisia</option>
                      <option value="TR">Turkey</option>
                      <option value="TM">Turkmenistan</option>
                      <option value="TC">Turks and Caicos Islands</option>
                      <option value="TV">Tuvalu</option>
                      <option value="UG">Uganda</option>
                      <option value="UA">Ukraine</option>
                      <option value="AE">United Arab Emirates</option>
                      <option value="GB">United Kingdom</option>
                      <option value="UY">Uruguay</option>
                      <option value="UM">USA Minor Outlying Islands</option>
                      <option value="UZ">Uzbekistan</option>
                      <option value="VU">Vanuatu</option>
                      <option value="VE">Venezuela</option>
                      <option value="VN">Vietnam</option>
                      <option value="VG">Virgin Islands (British)</option>
                      <option value="VI">Virgin Islands (USA)</option>
                      <option value="WF">Wallis and Futuna Islands</option>
                      <option value="EH">Western Sahara</option>
                      <option value="YE">Yemen</option>
                      <option value="ZR">Zaire</option>
                      <option value="ZM">Zambia</option>
                      <option value="ZW">Zimbabwe</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="emailC" class="form-label">Contact Email *</label>
                    <input type="email" class="form-control" name="emailC" id="emailC" required>
                  </div>
                  <div class="mb-3">
                    <label for="telefono" class="form-label">Phone number</label>
                    <input type="tel" class="form-control" name="telefono" id="telefono">
                  </div>
                  <div class="mb-3">
                    <label for="picture" class="form-label">Profile picture</label>
                    <input type="file" class="form-control" name="picture" id="picture">
                  </div>
                  <div class="mt-5 mb-5">
                    <label for="curriculum" class="form-label">Upload your CV *</label>
                    <input type="file" class="form-control" name="curriculum" id="curriculum" required>
                  </div>
                  <div class="mb-3">
                    <label for="username" class="form-label">Username *</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                  </div>
                  <div class="mb-3">
                    <label for="emailR" class="form-label">Email *</label>
                    <input type="email" class="form-control" name="emailR" id="emailR" required>
                  </div>
                  <div class="mb-3">
                    <label for="emailR2" class="form-label">Confirm Email *</label>
                    <input type="email" class="form-control" name="emailR2" id="emailR2" required>
                    <div id="erroreEmail" class="d-none text-danger mt-1">Wrong confirmation email</div>
                  </div>
                  <div class="mb-3">
                    <label for="passwordR" class="form-label">Password *</label>
                    <input type="password" class="form-control" name="passwordR" id="passwordR" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                    <div class="text-color-5 mt-1" style="font-size: 80%;">The password must be at least 8 characters (up to 32) and contain at least one number, one lowercase letter and one uppercase letter.</div>
                  </div>
                  <div class="mb-4">
                    <label for="passwordR2" class="form-label">Confirm Password *</label>
                    <input type="password" class="form-control" name="passwordR2" id="passwordR2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                    <div id="errorePassword" class="d-none text-danger mt-1">Wrong confirmation password</div>
                  </div>
                  <button type="submit" name="registrationButton" class="btn btn-primary w-100 fw-bold" style="--bs-btn-bg: var(--intersection-color-3); --bs-btn-hover-bg: var(--intersection-color-2)">Sign up</button>
                </form>
                <div class="text-color-5 text-center">By clicking on <span class="fw-semibold">Sign up</span> you accept that your data will be used as reported in the <a href="indexPrivacyPolicy.php" class="text-decoration-none text-color-2 fw-bold">Privacy Policy</a>.</div>
              </div>
            </div>
          </div>
        </section>

        <script>
          function validaRegistrazione() {

            let b = true;
            if( document.formRegistrazione.emailR.value != document.formRegistrazione.emailR2.value ) {
              document.querySelector('#erroreEmail').setAttribute('style', 'display: block !important');
              location.href = "#emailR";
              b = false;
            } else {
              document.querySelector('#erroreEmail').setAttribute('style', 'display: none !important');
            }
            if( document.formRegistrazione.passwordR.value != document.formRegistrazione.passwordR2.value ) {
              document.querySelector('#errorePassword').setAttribute('style', 'display: block !important');
              if( b == true ) { location.href = '#passwordR'; }
              b = false;
            } else {
              document.querySelector('#errorePassword').setAttribute('style', 'display: none !important');
            }

            let dataDiNascita = document.formRegistrazione.dataDiNascita.value;
            let years = calcAge( dataDiNascita );
            if( years < 18 ) {
              document.querySelector('#erroreEta').setAttribute('style', 'display: block !important');
              if( b == true ) { location.href = '#dataDiNascita'; }
              b = false;
            } else {
              document.querySelector('#erroreEta').setAttribute('style', 'display: none !important');
            }
            if( years > 150 ) {
              document.querySelector('#erroreEta2').setAttribute('style', 'display: block !important');
              if( b == true ) { location.href = '#dataDiNascita'; }
              b = false;
            } else {
              document.querySelector('#erroreEta2').setAttribute('style', 'display: none !important');
            }

            return b;

          }

          function calcAge (birthday) {

            let today = new Date();
            let birthDate = new Date(birthday);
            let years = today.getFullYear() - birthDate.getFullYear();
            let m = today.getMonth() - birthDate.getMonth();

            if( m < 0 || ( m === 0 && today.getDate() < birthDate.getDate() ) ) {
              years--;
            }
            return years;

          }
        </script>

      </div>
      <?php endif; ?>

      <?php if( $_SESSION['lang'] == 'it' ): ?>
      <!-- Footer IT -->
      <footer class="bg-color-4">
        <div class="container px-2 d-flex flex-column gap-5 py-5 text-color-5">
          <div class="footer-top d-flex flex-column flex-lg-row align-items-center gap-5">
            <div class="w-50 d-flex flex-column flex-lg-row gap-5 align-items-center">
              <a href="index.php">
                <img src="images/logo-1-white.png" alt="Intersection" style="height: 30px;">
              </a>
              <div class="text-center text-lg-start">Il primo sito che aiuta a trovare lavoro con l'intelligenza artificiale.</div>
            </div>
            <div class="w-50 d-flex flex-column flex-md-row justify-content-center justify-content-lg-end align-items-center gap-4">
              <a href="mailto:info@intersection.test" class="text-decoration-none text-color-5 fw-bold">Contattaci</a>
              <a href="indexPrivacyPolicy.php" class="text-decoration-none text-color-5 fw-bold">Privacy Policy</a>
            </div>
          </div>
          <div class="footer-bottom d-flex flex-column align-items-center gap-3">
            <a href="index.php">
              <img src="images/favi-1.png" style="width: 30px;">
            </a>
            <div>Copyright &copy; 2023. All rights reserved.</div>
          </div>
        </div>
      </footer>
      <?php endif; ?>

      <?php if( $_SESSION['lang'] == 'en' ): ?>
      <!-- Footer EN -->
      <footer class="bg-color-4">
        <div class="container px-2 d-flex flex-column gap-5 py-5 text-color-5">
          <div class="footer-top d-flex flex-column flex-lg-row align-items-center gap-5">
            <div class="w-50 d-flex flex-column flex-lg-row gap-5 align-items-center">
              <a href="index.php">
                <img src="images/logo-1-white.png" alt="Intersection" style="height: 30px;">
              </a>
              <div class="text-center text-lg-start">The first website that helps you find your next job with artificial intelligence.</div>
            </div>
            <div class="w-50 d-flex flex-column flex-md-row justify-content-center justify-content-lg-end align-items-center gap-4">
              <a href="mailto:info@intersection.test" class="text-decoration-none text-color-5 fw-bold">Contact us</a>
              <a href="indexPrivacyPolicy.php" class="text-decoration-none text-color-5 fw-bold">Privacy Policy</a>
            </div>
          </div>
          <div class="footer-bottom d-flex flex-column align-items-center gap-3">
            <a href="index.php">
              <img src="images/favi-1.png" style="width: 30px;">
            </a>
            <div>Copyright &copy; 2023. All rights reserved.</div>
          </div>
        </div>
      </footer>
      <?php endif; ?>

    </body>
</html>
