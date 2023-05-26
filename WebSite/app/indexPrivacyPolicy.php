<?php
session_start();
if( !isset( $_GET['lang'] ) ) {
  if( !isset( $_SESSION['lang'] ) ) {
    $_SESSION['lang'] = 'it';
  }
} else {
  $_SESSION['lang'] = $_GET['lang'];
}
ob_start();
?>
<!DOCTYPE html>
  <html>
    <!--HEADER-->
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>
        <?php 
          if( $_SESSION['lang'] == 'it' ) { echo "Privacy Policy - Intersection"; }
          if( $_SESSION['lang'] == 'en' ) { echo "Privacy Policy - Intersection"; }
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
                  <li><a class="dropdown-item" href=" <?php echo 'indexUtenti.php?lang=it&uid=' . $_GET['uid'] . '&sa=' . $_GET['sa'] ?> ">Italiano</a></li>
                  <li><a class="dropdown-item" href=" <?php echo 'indexUtenti.php?lang=en&uid=' . $_GET['uid'] . '&sa=' . $_GET['sa'] ?> ">English</a></li>
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
                      <li><a class="dropdown-item" href=" <?php echo 'indexUtenti.php?lang=it&uid=' . $_GET['uid'] . '&sa=' . $_GET['sa'] ?> ">Italiano</a></li>
                      <li><a class="dropdown-item" href=" <?php echo 'indexUtenti.php?lang=en&uid=' . $_GET['uid'] . '&sa=' . $_GET['sa'] ?> ">English</a></li>
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
                      <li><a class="dropdown-item" href=" <?php echo 'indexUtenti.php?lang=it&uid=' . $_GET['uid'] . '&sa=' . $_GET['sa'] ?> ">Italiano</a></li>
                      <li><a class="dropdown-item" href=" <?php echo 'indexUtenti.php?lang=en&uid=' . $_GET['uid'] . '&sa=' . $_GET['sa'] ?> ">English</a></li>
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
                  <li><a class="dropdown-item" href=" <?php echo 'indexUtenti.php?lang=it&uid=' . $_GET['uid'] . '&sa=' . $_GET['sa'] ?> ">Italiano</a></li>
                  <li><a class="dropdown-item" href=" <?php echo 'indexUtenti.php?lang=en&uid=' . $_GET['uid'] . '&sa=' . $_GET['sa'] ?> ">English</a></li>
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
                      <li><a class="dropdown-item" href=" <?php echo 'indexUtenti.php?lang=it&uid=' . $_GET['uid'] . '&sa=' . $_GET['sa'] ?> ">Italiano</a></li>
                      <li><a class="dropdown-item" href=" <?php echo 'indexUtenti.php?lang=en&uid=' . $_GET['uid'] . '&sa=' . $_GET['sa'] ?> ">English</a></li>
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
                      <li><a class="dropdown-item" href=" <?php echo 'indexUtenti.php?lang=it&uid=' . $_GET['uid'] . '&sa=' . $_GET['sa'] ?> ">Italiano</a></li>
                      <li><a class="dropdown-item" href=" <?php echo 'indexUtenti.php?lang=en&uid=' . $_GET['uid'] . '&sa=' . $_GET['sa'] ?> ">English</a></li>
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
                <h1 class="text-color-2 fw-bold">Privacy Policy</h1>
                <div>
                    <p>In Intersection, accessibile da https://intersection.up.railway.app, una delle nostre principali priorità è la privacy dei nostri visitatori. Questo documento sulla politica sulla privacy contiene i tipi di informazioni raccolte e registrate da Intersection e il modo in cui le utilizziamo.</p>

                    <p>Se hai ulteriori domande o hai bisogno di ulteriori informazioni sulla nostra Privacy Policy, non esitare a contattarci.</p>
                    <p>La presente Privacy Policy si applica solo alle nostre attività online ed è valida per i visitatori del nostro sito Web per quanto riguarda le informazioni che hanno condiviso e/o raccolto in Intersection. Questa politica non è applicabile alle informazioni raccolte offline o tramite canali diversi da questo sito web.</p>

                    <h4>Consenso</h4>
                    <p>Utilizzando il nostro sito Web, acconsenti alla nostra Privacy Policy e ne accetti i termini.</p>

                    <h4>Informazioni che raccogliamo</h4>
                    <p>Le informazioni personali che ti viene chiesto di fornire e i motivi per cui ti viene chiesto di fornirle ti saranno chiariti nel momento in cui ti chiediamo di fornire le tue informazioni personali.</p>
                    <p>Se ci contatti direttamente, potremmo ricevere ulteriori informazioni su di te come nome, indirizzo e-mail, numero di telefono, il contenuto del messaggio e/o degli allegati che potresti inviarci e qualsiasi altra informazione che potresti scegliere di fornire .</p>
                    <p>Quando ti registri per un Account, potremmo richiedere le tue informazioni di contatto, inclusi elementi come nome, ragione sociale, indirizzo, indirizzo e-mail e numero di telefono.</p>

                    <h4>Come utilizziamo le tue informazioni</h4>
                    <p>Utilizziamo le informazioni che raccogliamo in vari modi, tra cui per:</p>
                    <ul>
                        <li>Fornire, gestire e mantenere il nostro sito web</li>
                        <li>Migliorare, personalizzare ed espandere il nostro sito web</li>
                        <li>Comprendere e analizzare come utilizzi il nostro sito web</li>
                        <li>Sviluppare nuovi prodotti, servizi, caratteristiche e funzionalità</li>
                        <li>Comunicare con te, direttamente o tramite uno dei nostri partner, anche per il servizio clienti, per fornirti aggiornamenti e altre informazioni relative al sito Web e per scopi di marketing e promozionali</li>
                        <li>Inviarti email</li>
                        <li>Trovare e prevenire le frodi</li>
                    </ul>

                    <h4>File di log</h4>
                    <p>Intersection segue una procedura standard di utilizzo dei file di registro. Questi file registrano i visitatori quando visitano i siti web. Tutte le società di hosting fanno questo e una parte dell'analisi dei servizi di hosting. Le informazioni raccolte dai file di registro includono indirizzi IP (Internet Protocol), tipo di browser, provider di servizi Internet (ISP), data e ora, pagine di riferimento/uscita ed eventualmente il numero di clic. Questi non sono collegati ad alcuna informazione di identificazione personale. Lo scopo delle informazioni è analizzare le tendenze, amministrare il sito, monitorare il movimento degli utenti sul sito Web e raccogliere informazioni demografiche.</p>

                    <h4>Norme sulla privacy dei partner pubblicitari</h4>
                    <p>Puoi consultare questo elenco per trovare l'Privacy Policy per ciascuno dei partner pubblicitari di Intersection.</p>
                    <p>Gli ad server o le reti pubblicitarie di terze parti utilizzano tecnologie come cookie, JavaScript o Web Beacon utilizzati nei rispettivi annunci pubblicitari e collegamenti visualizzati su Intersection, che vengono inviati direttamente al browser degli utenti. Ricevono automaticamente il tuo indirizzo IP quando ciò si verifica. Queste tecnologie vengono utilizzate per misurare l'efficacia delle loro campagne pubblicitarie e/o per personalizzare i contenuti pubblicitari che vedi sui siti web che visiti.</p>
                    <p>Tieni presente che Intersection non ha accesso o controllo su questi cookie utilizzati da inserzionisti di terze parti.</p>

                    <h4>Norme sulla privacy di terze parti</h4>
                    <p>L'Privacy Policy di Intersection non si applica ad altri inserzionisti o siti web. Pertanto, ti consigliamo di consultare le rispettive Informative sulla privacy di questi ad server di terze parti per informazioni più dettagliate. Può includere le loro pratiche e istruzioni su come rinunciare a determinate opzioni. </p>
                    <p>Puoi scegliere di disabilitare i cookie attraverso le singole opzioni del tuo browser. Per conoscere informazioni più dettagliate sulla gestione dei cookie con browser Web specifici, è possibile trovarle sui rispettivi siti Web dei browser.</p>

                    <h4>Diritti sulla privacy CCPA (Non vendere le mie informazioni personali)</h4>
                    <p>In base al CCPA, tra gli altri diritti, i consumatori della California hanno diritto a:</p>
                    <p>Richiedere che un'azienda che raccoglie i dati personali di un consumatore divulghi le categorie e i dati personali specifici che un'azienda ha raccolto sui consumatori.</p>
                    <p>Richiedere che un'azienda elimini tutti i dati personali sul consumatore raccolti da un'azienda.</p>
                    <p>Richiedere che un'azienda che vende i dati personali di un consumatore non venda i dati personali del consumatore.</p>
                    <p>Se fai una richiesta, abbiamo un mese per risponderti. Se desideri esercitare uno di questi diritti, contattaci.</p>

                    <h4>Diritti alla protezione dei dati del GDPR</h4>
                    <p>Vorremmo assicurarci che tu sia pienamente consapevole di tutti i tuoi diritti alla protezione dei dati. Ogni utente ha diritto a quanto segue:</p>
                    <p>Diritto di accesso: hai il diritto di richiedere copie dei tuoi dati personali. Potremmo addebitarti una piccola commissione per questo servizio.</p>
                    <p>Il diritto alla rettifica: hai il diritto di richiedere la correzione di qualsiasi informazione che ritieni inesatta. Hai anche il diritto di richiedere che completiamo le informazioni che ritieni incomplete.</p>
                    <p>Il diritto alla cancellazione: hai il diritto di richiedere la cancellazione dei tuoi dati personali, a determinate condizioni.</p>
                    <p>Il diritto di limitare il trattamento: hai il diritto di richiedere che limitiamo il trattamento dei tuoi dati personali, a determinate condizioni.</p>
                    <p>Il diritto di opporsi al trattamento: hai il diritto di opporti al nostro trattamento dei tuoi dati personali, a determinate condizioni.</p>
                    <p>Diritto alla portabilità dei dati: hai il diritto di richiedere il trasferimento dei dati che abbiamo raccolto a un'altra organizzazione o direttamente a te, a determinate condizioni.</p>
                    <p>Se fai una richiesta, abbiamo un mese per risponderti. Se desideri esercitare uno di questi diritti, contattaci.</p>

                    <h4>Modifiche alla presente Privacy Policy</h4>
                    <p>Possiamo aggiornare periodicamente la nostra Privacy Policy. Pertanto, ti consigliamo di rivedere periodicamente questa pagina per eventuali modifiche. Ti informeremo di eventuali modifiche pubblicando la nuova Privacy Policy in questa pagina. Queste modifiche entrano in vigore immediatamente, dopo essere state pubblicate su questa pagina.</p>

                    <h4>Contattaci</h4>
                    <p>Se hai domande o suggerimenti sulla nostra Privacy Policy, non esitare a contattarci.</p>
                </div>
            </div>
          </div>
        </section>

      </div>
      <?php endif; ?>

      <?php if( $_SESSION['lang'] == 'en' ): ?>
      <!-- Page content EN -->
      <div class="page-content">

        <section id="main">
          <div class="container px-3" style="padding: 60px 0 120px;">
            <div class="col-md-8 mx-auto d-flex flex-column gap-5">
                <h1 class="text-color-2 fw-bold">Privacy Policy</h1>
                <div>
                    <p>At Intersection, accessible from https://intersection.up.railway.app, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by Intersection and how we use it.</p>

                    <p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</p>
                    <p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in Intersection. This policy is not applicable to any information collected offline or via channels other than this website.</p>

                    <h4>Consent</h4>
                    <p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>

                    <h4>Information we collect</h4>
                    <p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</p>
                    <p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</p>
                    <p>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</p>

                    <h4>How we use your information</h4>
                    <p>We use the information we collect in various ways, including to:</p>
                    <ul>
                        <li>Provide, operate, and maintain our website</li>
                        <li>Improve, personalize, and expand our website</li>
                        <li>Understand and analyze how you use our website</li>
                        <li>Develop new products, services, features, and functionality</li>
                        <li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes</li>
                        <li>Send you emails</li>
                        <li>Find and prevent fraud</li>
                    </ul>

                    <h4>Log Files</h4>
                    <p>Intersection follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users' movement on the website, and gathering demographic information.</p>

                    <h4>Advertising Partners Privacy Policies</h4>
                    <p>You may consult this list to find the Privacy Policy for each of the advertising partners of Intersection.</p>
                    <p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on Intersection, which are sent directly to users' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.</p>
                    <p>Note that Intersection has no access to or control over these cookies that are used by third-party advertisers.</p>

                    <h4>Third Party Privacy Policies</h4>
                    <p>Intersection's Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options. </p>
                    <p>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers' respective websites.</p>

                    <h4>CCPA Privacy Rights (Do Not Sell My Personal Information)</h4>
                    <p>Under the CCPA, among other rights, California consumers have the right to:</p>
                    <p>Request that a business that collects a consumer's personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</p>
                    <p>Request that a business delete any personal data about the consumer that a business has collected.</p>
                    <p>Request that a business that sells a consumer's personal data, not sell the consumer's personal data.</p>
                    <p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>

                    <h4>GDPR Data Protection Rights</h4>
                    <p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>
                    <p>The right to access – You have the right to request copies of your personal data. We may charge you a small fee for this service.</p>
                    <p>The right to rectification – You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.</p>
                    <p>The right to erasure – You have the right to request that we erase your personal data, under certain conditions.</p>
                    <p>The right to restrict processing – You have the right to request that we restrict the processing of your personal data, under certain conditions.</p>
                    <p>The right to object to processing – You have the right to object to our processing of your personal data, under certain conditions.</p>
                    <p>The right to data portability – You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</p>
                    <p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>

                    <h4>Changes to This Privacy Policy</h4>
                    <p>We may update our Privacy Policy from time to time. Thus, we advise you to review this page periodically for any changes. We will notify you of any changes by posting the new Privacy Policy on this page. These changes are effective immediately, after they are posted on this page.</p>

                    <h4>Contact Us</h4>
                    <p>If you have any questions or suggestions about our Privacy Policy, do not hesitate to contact us.</p>
                </div>
            </div>
          </div>
        </section>

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
              <a href="/privacy-policy.html" class="text-decoration-none text-color-5 fw-bold">Privacy Policy</a>
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
              <a href="/privacy-policy.html" class="text-decoration-none text-color-5 fw-bold">Privacy Policy</a>
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
