<?php
session_start();
?>
<!DOCTYPE html>
  <html>
    <!--HEADER-->
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Errore - Intersection</title>
      <link rel="icon" href="images/favi-1.png" type="favicon">
      <link rel="stylesheet" href="css/style.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@100;200;400;600;800&display=swap" rel="stylesheet">
    </head>

    <body>

      <!-- Header -->
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
                  <li><a class="dropdown-item" href="#">Italiano</a></li>
                  <li><a class="dropdown-item" href="#">English</a></li>
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
                      <li><a class="dropdown-item" href="#">Italiano</a></li>
                      <li><a class="dropdown-item" href="#">English</a></li>
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
                            $picture_filename = "image_$usernameWorker.png";
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
                      <li><a class="dropdown-item" href="#">Italiano</a></li>
                      <li><a class="dropdown-item" href="#">English</a></li>
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
                            $logo_filename = "image_$usernameCompany.png";
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
                      <li><a class="dropdown-item" href="Logout.php">Logout</a></li>
                    </ul>
                </div>
              </div>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </header>

      <!-- Page content -->
      <div class="page-content">
        <section id="login">
          <div class="container px-3" style="padding: 120px 0;">
            <div class="col-md-8 mx-auto d-flex flex-column align-items-center gap-5">
              <?php 
                if( !isset( $_GET['er'] ) ) {
                  $err_msg = "Qualcosa non è andato a buon fine, stiamo lavorando per risolvere il problema.";
                } else {
                  switch( $_GET['er'] ) {
                    case 1:
                      $err_msg = "La tua email risulta essere già associata a un utente registrato.";
                      break;
                    case 2:
                      $err_msg = "Il tuo nome utente risulta essere già associato a un utente registrato.";
                      break;
                    case 3:
                      $err_msg = "La tua password risulta essere già associata a un utente registrato.";
                      break;
                    case 4:
                      $err_msg = "La tua partita IVA risulta essere già associata a un utente registrato.";
                      break;
                    case 8:
                      $err_msg = "La tua email non risulta essere associata a un utente registrato.";
                      break;
                    case 9:
                      $err_msg = "La tua password risulta essere errata.";
                      break;
                    default:
                      $err_msg = "Qualcosa è andato storto, stiamo lavorando per risolverlo.";
                      break;
                  }
                }
              ?>
              <div class="text-center bg-warning-subtle border border-warning p-5 rounded"><?php echo $err_msg ?></div>
              <a href="index.php" class="btn btn-secondary">Torna alla home</a>
            </div>
          </div>
        </section>
      </div>

      <!-- Footer -->
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

    </body>
  </html>
