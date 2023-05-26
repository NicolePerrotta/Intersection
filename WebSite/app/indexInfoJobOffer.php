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
      <title>Lista offerte di lavoro - Intersection</title>
      <title>
        <?php 
          if( $_SESSION['lang'] == 'it' ) { echo "Offerta di lavoro - Intersection"; }
          if( $_SESSION['lang'] == 'en' ) { echo "Job offer - Intersection"; }
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
                  <li><a class="dropdown-item" href=" <?php echo 'indexInfoJobOffer.php?lang=it&offer_id=' . $_GET['offer_id'] ?> ">Italiano</a></li>
                  <li><a class="dropdown-item" href=" <?php echo 'indexInfoJobOffer.php?lang=en&offer_id=' . $_GET['offer_id'] ?> ">English</a></li>
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
                      <li><a class="dropdown-item" href=" <?php echo 'indexInfoJobOffer.php?lang=it&offer_id=' . $_GET['offer_id'] ?> ">Italiano</a></li>
                      <li><a class="dropdown-item" href=" <?php echo 'indexInfoJobOffer.php?lang=en&offer_id=' . $_GET['offer_id'] ?> ">English</a></li>
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
                      <li><a class="dropdown-item" href=" <?php echo 'indexInfoJobOffer.php?lang=it&offer_id=' . $_GET['offer_id'] ?> ">Italiano</a></li>
                      <li><a class="dropdown-item" href=" <?php echo 'indexInfoJobOffer.php?lang=en&offer_id=' . $_GET['offer_id'] ?> ">English</a></li>
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
                  <li><a class="dropdown-item" href=" <?php echo 'indexInfoJobOffer.php?lang=it&offer_id=' . $_GET['offer_id'] ?> ">Italiano</a></li>
                  <li><a class="dropdown-item" href=" <?php echo 'indexInfoJobOffer.php?lang=en&offer_id=' . $_GET['offer_id'] ?> ">English</a></li>
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
                      <li><a class="dropdown-item" href=" <?php echo 'indexInfoJobOffer.php?lang=it&offer_id=' . $_GET['offer_id'] ?> ">Italiano</a></li>
                      <li><a class="dropdown-item" href=" <?php echo 'indexInfoJobOffer.php?lang=en&offer_id=' . $_GET['offer_id'] ?> ">English</a></li>
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
                      <li><a class="dropdown-item" href=" <?php echo 'indexInfoJobOffer.php?lang=it&offer_id=' . $_GET['offer_id'] ?> ">Italiano</a></li>
                      <li><a class="dropdown-item" href=" <?php echo 'indexInfoJobOffer.php?lang=en&offer_id=' . $_GET['offer_id'] ?> ">English</a></li>
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

                $dbconn = pg_connect( "host=$PGHOST port=$PGPORT dbname=$PGDATABASE user=$PGUSER password=$PGPASSWORD" )  or header( "Location: indexErrore.php?er=100" );  
                $offer_id = $_GET['offer_id'];
                $query = "SELECT * FROM job_offer WHERE offer_id=$1";
                $result = pg_query_params( $dbconn, $query, array($offer_id) );
                while( $line = pg_fetch_array( $result, null, PGSQL_ASSOC ) ) :
                  $title = $line['title'];
                  $description = $line['description'];
                  $salary = $line['salary'];
                  $period = $line['period'];
                  ?>
                    <div>
                      <h1 class="text-color-2 fw-bold"><?php echo $title ?></h1>
                      <?php 
                        $q3 = "SELECT * FROM company WHERE company_id=$1";
                        $result4 = pg_query_params( $dbconn, $q3, array( $line['company_id'] ) );
                        $line4 = pg_fetch_assoc( $result4 );
                          ?>
                            <div class="text-color-5">Offerta di lavoro da <span class="fw-bold"><?php echo $line4['company_name'] ?></span>.</div>
                          <?php 
                      ?>
                    </div>
                    <div class="d-flex flex-column gap-4">
                      <div class="dettagli-offerta">
                        <div class="fw-bold fs-5 mb-2">Dettagli offerta</div>
                        <div class="offer-remuneration"><span class="fw-bold">Retribuzione:</span> <?php echo $salary ?></div>
                        <div class="offer-duration"><span class="fw-bold">Durata:</span> <?php echo $period ?></div>
                      </div>
                      <div class="descrizione-offerta">
                        <div class="fw-bold fs-5 mb-2">Descrizione</div>
                        <p class="mb-0"><?php echo $description ?></p>
                      </div>
                    </div>
                  <?php
                  if( isset( $_SESSION['uid'] ) && $_SESSION['sa'] == 1 ) :
                    ?>
                    <div class="d-flex flex-column gap-3">
                      <h4 class="fw-bold">Candidati</h4>
                      <div class="d-flex flex-column gap-3">
                    <?php 

                    $url = "https://algorithm-api-production.up.railway.app/ranking/$offer_id";
                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));
                    $response = curl_exec($curl);
                    $response = json_decode($response);
                    curl_close($curl);
                    if($response === false)
                    {
                      echo "Error: API not found";
                    }
                    else if($response==NULL)
                    {
                        echo "Error: there aren't yet job offers!";
                    }
                    else
                    {
                      $i = 0;
                      while($i<sizeof($response->ids) && $i<10) {
                        $worker_id = ($response->ids)[$i];
                        $relevance = round( ($response->relevance)[$i], 2 ) * 100;
                        $i = $i + 1;
                        $q2 = "SELECT * FROM worker WHERE worker_id=$1";
                        $result3 = pg_query_params( $dbconn, $q2, array($worker_id) );
                        $line3 = pg_fetch_assoc( $result3 );
                        $nome = $line3['name'];
                        $cognome = $line3['surname'];
                        $username = $line3['username'];
                        $datanascita = $line3['birth_date'];
                        $date = date( 'd/m/Y', strtotime( $datanascita ) );
                        $contact_email = $line3['contact_email'];
                        $picture = $line3['picture'];
                        if( isset( $picture ) ) {
                          $picture = pg_unescape_bytea( $picture );
                          $filename = "storage/image_$username.png";
                          file_put_contents($filename, $picture);
                        } else {
                          $filename = "images/default-profile.png";
                        }
                      ?>
                        <div class="candidato d-flex flex-column gap-4 p-4 bg-light border border-3 rounded" style="border-color: var(--intersection-color-5) !important;">
                          <div class="d-flex flex-column flex-md-row align-items-md-center gap-4">
                            <img src=" <?php echo $filename ?> " class="img-fluid rounded" style="width: 110px; height: 110px; object-fit: cover;">
                            <div>
                              <div class="fw-bold fs-5"><?php echo $nome . ' '. $cognome ?></div>
                              <div>Data di nascita: <?php echo $date ?></div>
                              <div>Contatto: <a href=" <?php echo 'mailto:' . $contact_email ?>" class="text-decoration-none text-color-3"><?php echo $contact_email ?></a></div>
                              <div>Compatibilità: <?php echo $relevance . ' %' ?></div>
                            </div>
                          </div>
                          <a href=" <?php echo 'indexUtenti.php?uid=' . $worker_id . '&sa=0' ?> " class="btn btn-primary" style="--bs-btn-bg: var(--intersection-color-3); --bs-btn-hover-bg: var(--intersection-color-2)">Dettagli</a>
                        </div>
                      <?php 
                      }
                    }
                  elseif( isset( $_SESSION['uid'] ) && $_SESSION['sa'] == 0 ) :
                    ?>
                      <form action="application.php" class="form-signin" method="POST" name="formPartecipazione" id="form-partecipazione">
                        <input type="hidden" id="eid" name="eid" value=" <?php echo $offer_id ?> ">
                        <?php 
                          $q29 = "SELECT * FROM applies_to WHERE worker_id=$1 AND offer_id=$2 LIMIT 10";
                          $result29 = pg_query_params( $dbconn, $q29, array($_SESSION['uid'], $offer_id));
                          if( pg_num_rows( $result29 ) > 0 ) {
                            echo '<button name="partecipazione" type="submit" class="btn btn-warning w-full">Cancella candidatura</button>';
                          } else {
                            echo '<button name="partecipazione" type="submit" class="btn btn-success w-full">Candidati</button>';
                          }
                        ?>
                      </form>
                    <?php
                  endif;
                endwhile;

                if( isset( $result ) ) pg_free_result( $result );
                if( isset( $result2 ) ) pg_free_result( $result2 );
                if( isset( $result3 ) ) pg_free_result( $result3 );
                if( isset( $result4 ) ) pg_free_result( $result4 );
                if( isset( $result20 ) ) pg_free_result( $result20 );
                if( isset( $result29 ) ) pg_free_result( $result29 );
                pg_close( $dbconn );
              ?>
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

                $dbconn = pg_connect( "host=$PGHOST port=$PGPORT dbname=$PGDATABASE user=$PGUSER password=$PGPASSWORD" )  or header( "Location: indexErrore.php?er=100" );  
                $offer_id = $_GET['offer_id'];
                $query = "SELECT * FROM job_offer WHERE offer_id=$1";
                $result = pg_query_params( $dbconn, $query, array($offer_id) );
                while( $line = pg_fetch_array( $result, null, PGSQL_ASSOC ) ) :
                  $title = $line['title'];
                  $description = $line['description'];
                  $salary = $line['salary'];
                  $period = $line['period'];
                  ?>
                    <div>
                      <h1 class="text-color-2 fw-bold"><?php echo $title ?></h1>
                      <?php 
                        $q3 = "SELECT * FROM company WHERE company_id=$1";
                        $result4 = pg_query_params( $dbconn, $q3, array( $line['company_id'] ) );
                        $line4 = pg_fetch_assoc( $result4 );
                          ?>
                            <div class="text-color-5">Job offer from <span class="fw-bold"><?php echo $line4['company_name'] ?></span>.</div>
                          <?php 
                      ?>
                    </div>
                    <div class="d-flex flex-column gap-4">
                      <div class="dettagli-offerta">
                        <div class="fw-bold fs-5 mb-2">Offer details</div>
                        <div class="offer-remuneration"><span class="fw-bold">Salary:</span> <?php echo $salary ?></div>
                        <div class="offer-duration"><span class="fw-bold">Period:</span> <?php echo $period ?></div>
                      </div>
                      <div class="descrizione-offerta">
                        <div class="fw-bold fs-5 mb-2">Description</div>
                        <p class="mb-0"><?php echo $description ?></p>
                      </div>
                    </div>
                  <?php
                  if( isset( $_SESSION['uid'] ) && $_SESSION['sa'] == 1 ) :
                    ?>
                    <div class="d-flex flex-column gap-3">
                      <h4 class="fw-bold">Apply</h4>
                      <div class="d-flex flex-column gap-3">
                    <?php 

                    $url = "https://algorithm-api-production.up.railway.app/ranking/$offer_id";
                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));
                    $response = curl_exec($curl);
                    $response = json_decode($response);
                    curl_close($curl);
                    if($response === false)
                    {
                      echo "Error: API not found";
                    }
                    else if($response==NULL)
                    {
                        echo "Error: there aren't yet job offers!";
                    }
                    else
                    {
                      $i = 0;
                      while($i<sizeof($response->ids) && $i<10) {
                        $worker_id = ($response->ids)[$i];
                        $relevance = round( ($response->relevance)[$i], 2 ) * 100;
                        $i = $i + 1;
                        $q2 = "SELECT * FROM worker WHERE worker_id=$1";
                        $result3 = pg_query_params( $dbconn, $q2, array($worker_id) );
                        $line3 = pg_fetch_assoc( $result3 );
                        $nome = $line3['name'];
                        $cognome = $line3['surname'];
                        $username = $line3['username'];
                        $datanascita = $line3['birth_date'];
                        $date = date( 'd/m/Y', strtotime( $datanascita ) );
                        $contact_email = $line3['contact_email'];
                        $picture = $line3['picture'];
                        if( isset( $picture ) ) {
                          $picture = pg_unescape_bytea( $picture );
                          $filename = "storage/image_$username.png";
                          file_put_contents($filename, $picture);
                        } else {
                          $filename = "images/default-profile.png";
                        }
                      ?>
                        <div class="candidato d-flex flex-column gap-4 p-4 bg-light border border-3 rounded" style="border-color: var(--intersection-color-5) !important;">
                          <div class="d-flex flex-column flex-md-row align-items-md-center gap-4">
                            <img src=" <?php echo $filename ?> " class="img-fluid rounded" style="width: 110px; height: 110px; object-fit: cover;">
                            <div>
                              <div class="fw-bold fs-5"><?php echo $nome . ' '. $cognome ?></div>
                              <div>Date of birth: <?php echo $date ?></div>
                              <div>Contact: <a href=" <?php echo 'mailto:' . $contact_email ?>" class="text-decoration-none text-color-3"><?php echo $contact_email ?></a></div>
                              <div>Compatibility: <?php echo $relevance . ' %' ?></div>
                            </div>
                          </div>
                          <a href=" <?php echo 'indexUtenti.php?uid=' . $worker_id . '&sa=0' ?> " class="btn btn-primary" style="--bs-btn-bg: var(--intersection-color-3); --bs-btn-hover-bg: var(--intersection-color-2)">Details</a>
                        </div>
                      <?php 
                      }
                    }
                  elseif( isset( $_SESSION['uid'] ) && $_SESSION['sa'] == 0 ) :
                    ?>
                      <form action="application.php" class="form-signin" method="POST" name="formPartecipazione" id="form-partecipazione">
                        <input type="hidden" id="eid" name="eid" value=" <?php echo $offer_id ?> ">
                        <?php 
                          $q29 = "SELECT * FROM applies_to WHERE worker_id=$1 AND offer_id=$2 LIMIT 10";
                          $result29 = pg_query_params( $dbconn, $q29, array($_SESSION['uid'], $offer_id));
                          if( pg_num_rows( $result29 ) > 0 ) {
                            echo '<button name="partecipazione" type="submit" class="btn btn-warning w-full">Cancel application</button>';
                          } else {
                            echo '<button name="partecipazione" type="submit" class="btn btn-success w-full">Apply</button>';
                          }
                        ?>
                      </form>
                    <?php
                  endif;
                endwhile;

                if( isset( $result ) ) pg_free_result( $result );
                if( isset( $result2 ) ) pg_free_result( $result2 );
                if( isset( $result3 ) ) pg_free_result( $result3 );
                if( isset( $result4 ) ) pg_free_result( $result4 );
                if( isset( $result20 ) ) pg_free_result( $result20 );
                if( isset( $result29 ) ) pg_free_result( $result29 );
                pg_close( $dbconn );
              ?>
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
