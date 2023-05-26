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
                    <p>At Intersection, accessible from https://intersection.up.railway.app, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by Intersection and how we use it.</p>

                    <p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</p>
                    <p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in Intersection. This policy is not applicable to any information collected offline or via channels other than this website.</p>

                    <h2>Consent</h2>
                    <p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>

                    <h2>Information we collect</h2>
                    <p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</p>
                    <p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</p>
                    <p>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</p>

                    <h2>How we use your information</h2>
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

                    <h2>Log Files</h2>
                    <p>Intersection follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users' movement on the website, and gathering demographic information.</p>

                    <h2>Advertising Partners Privacy Policies</h2>
                    <p>You may consult this list to find the Privacy Policy for each of the advertising partners of Intersection.</p>
                    <p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on Intersection, which are sent directly to users' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.</p>
                    <p>Note that Intersection has no access to or control over these cookies that are used by third-party advertisers.</p>

                    <h2>Third Party Privacy Policies</h2>
                    <p>Intersection's Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options. </p>
                    <p>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers' respective websites.</p>

                    <h2>CCPA Privacy Rights (Do Not Sell My Personal Information)</h2>
                    <p>Under the CCPA, among other rights, California consumers have the right to:</p>
                    <p>Request that a business that collects a consumer's personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</p>
                    <p>Request that a business delete any personal data about the consumer that a business has collected.</p>
                    <p>Request that a business that sells a consumer's personal data, not sell the consumer's personal data.</p>
                    <p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>

                    <h2>GDPR Data Protection Rights</h2>
                    <p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>
                    <p>The right to access – You have the right to request copies of your personal data. We may charge you a small fee for this service.</p>
                    <p>The right to rectification – You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.</p>
                    <p>The right to erasure – You have the right to request that we erase your personal data, under certain conditions.</p>
                    <p>The right to restrict processing – You have the right to request that we restrict the processing of your personal data, under certain conditions.</p>
                    <p>The right to object to processing – You have the right to object to our processing of your personal data, under certain conditions.</p>
                    <p>The right to data portability – You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</p>
                    <p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>

                    <h2>Children's Information</h2>
                    <p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.</p>
                    <p>Intersection does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>

                    <h2>Changes to This Privacy Policy</h2>
                    <p>We may update our Privacy Policy from time to time. Thus, we advise you to review this page periodically for any changes. We will notify you of any changes by posting the new Privacy Policy on this page. These changes are effective immediately, after they are posted on this page.</p>

                    <h2>Contact Us</h2>
                    <p>If you have any questions or suggestions about our Privacy Policy, do not hesitate to contact us.</p>
                </div>
            </div>
          </div>
        </section>

        <script>
          document.addEventListener('DOMContentLoaded', ()=>{
            let workerDetails = document.querySelectorAll('.dettagli-professionista > div:not(:first-child)');
            workerDetails.forEach((workerDetail)=>{
              if(workerDetail.querySelector('span:not(.fw-bold)').textContent == "") {
                workerDetail.setAttribute('style', 'display: none !important');
              }
            });
          });
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
