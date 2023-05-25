<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
  <html>
    <!--HEADER-->
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Offerta di lavoro - Intersection</title>
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

      <!-- Page content -->
    <div class="page-content">

      <section id="main">
        <div class="container px-3" style="padding: 60px 0 120px;">
          <div class="col-md-8 mx-auto d-flex flex-column gap-5">
            <?php 
              if( !isset( $_GET["sa"] ) || !isset( $_GET["uid"] )) :
                header( "Location: indexErrore.php?er=100" );
              else :
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
                $dbconn = pg_connect("host=$PGHOST port=$PGPORT dbname=$PGDATABASE user=$PGUSER password=$PGPASSWORD")  or header( "Location: indexErrore.php?er=100" );
                $uid=$_GET['uid'];

                if( $_GET["sa"] == 0 ) :

                  $query = "SELECT * FROM worker where worker_id=$1";
                  $result = pg_query_params( $dbconn, $query, array($uid) );
                  if( pg_num_rows( $result ) == 0 ) {
                    echo '<div class="text-center bg-warning-subtle border border-warning p-5 rounded">Utente non trovato</div>';
                  } else {
                    $line = pg_fetch_assoc( $result );
                    $nome = $line["name"];
                    $cognome = $line["surname"];
                    $username = $line["username"];
                    $datanascita = $line["birth_date"];
                    $indirizzo = $line["address"];
                    $citta = $line["city"];
                    $nazione = $line["country"];
                    switch( $nazione ) {
                      case 'US': 
                        $nazione = "United States";
                        break;
                      case 'CA': 
                        $nazione = "Canada";
                        break;
                      case 'AF': 
                        $nazione = "Afghanistan";
                        break;
                      case 'AL': 
                        $nazione = "Albania";
                        break;
                      case 'DZ': 
                        $nazione = "Algeria";
                        break;
                      case 'AS': 
                        $nazione = "American Samoa";
                        break;
                      case 'AD': 
                        $nazione = "Andorra";
                        break;
                      case 'AO': 
                        $nazione = "Angola";
                        break;
                      case 'AI': 
                        $nazione = "Anguilla";
                        break;
                      case 'AQ': 
                        $nazione = "Antarctica";
                        break;
                      case 'AG': 
                        $nazione = "Antigua and Barbuda";
                        break;
                      case 'AR': 
                        $nazione = "Argentina";
                        break;
                      case 'AM': 
                        $nazione = "Armenia";
                        break;
                      case 'AW': 
                        $nazione = "Aruba";
                        break;
                      case 'AU': 
                        $nazione = "Australia";
                        break;
                      case 'AT': 
                        $nazione = "Austria";
                        break;
                      case 'AZ': 
                        $nazione = "Azerbaijan";
                        break;
                      case 'BS': 
                        $nazione = "Bahamas";
                        break;
                      case 'BH': 
                        $nazione = "Bahrain";
                        break;
                      case 'BD': 
                        $nazione = "Bangladesh";
                        break;
                      case 'BB': 
                        $nazione = "Barbados";
                        break;
                      case 'BY': 
                        $nazione = "Belarus";
                        break;
                      case 'BE': 
                        $nazione = "Belgium";
                        break;
                      case 'BZ': 
                        $nazione = "Belize";
                        break;
                      case 'BJ': 
                        $nazione = "Benin";
                        break;
                      case 'BM': 
                        $nazione = "Bermuda";
                        break;
                      case 'BT': 
                        $nazione = "Bhutan";
                        break;
                      case 'BO': 
                        $nazione = "Bolivia";
                        break;
                      case 'BA': 
                        $nazione = "Bosnia and Herzegovina";
                        break;
                      case 'BW': 
                        $nazione = "Botswana";
                        break;
                      case 'BV': 
                        $nazione = "Bouvet Island";
                        break;
                      case 'BR': 
                        $nazione = "Brazil";
                        break;
                      case 'IO': 
                        $nazione = "British Indian Ocean Territory";
                        break;
                      case 'BN': 
                        $nazione = "Brunei Darussalam";
                        break;
                      case 'BG': 
                        $nazione = "Bulgaria";
                        break;
                      case 'BF': 
                        $nazione = "Burkina Faso";
                        break;
                      case 'BI': 
                        $nazione = "Burundi";
                        break;
                      case 'KH': 
                        $nazione = "Cambodia";
                        break;
                      case 'CM': 
                        $nazione = "Cameroon";
                        break;
                      case 'CV': 
                        $nazione = "Cape Verde";
                        break;
                      case 'KY': 
                        $nazione = "Cayman Islands";
                        break;
                      case 'CF': 
                        $nazione = "Central African Republic";
                        break;
                      case 'TD': 
                        $nazione = "Chad";
                        break;
                      case 'CL': 
                        $nazione = "Chile";
                        break;
                      case 'CN': 
                        $nazione = "China";
                        break;
                      case 'CX': 
                        $nazione = "Christmas Island";
                        break;
                      case 'CC': 
                        $nazione = "Cocos (Keeling) Islands";
                        break;
                      case 'CO': 
                        $nazione = "Colombia";
                        break;
                      case 'KM': 
                        $nazione = "Comoros";
                        break;
                      case 'CG': 
                        $nazione = "Congo";
                        break;
                      case 'CD': 
                        $nazione = "Congo (Democratic Republic)";
                        break;
                      case 'CK': 
                        $nazione = "Cook Islands";
                        break;
                      case 'CR': 
                        $nazione = "Costa Rica";
                        break;
                      case 'HR': 
                        $nazione = "Croatia";
                        break;
                      case 'CU': 
                        $nazione = "Cuba";
                        break;
                      case 'CY': 
                        $nazione = "Cyprus";
                        break;
                      case 'CZ': 
                        $nazione = "Czech Republic";
                        break;
                      case 'DK': 
                        $nazione = "Denmark";
                        break;
                      case 'DJ': 
                        $nazione = "Djibouti";
                        break;
                      case 'DM': 
                        $nazione = "Dominica";
                        break;
                      case 'DO': 
                        $nazione = "Dominican Republic";
                        break;
                      case 'TP': 
                        $nazione = "East Timor";
                        break;
                      case 'EC': 
                        $nazione = "Ecuador";
                        break;
                      case 'EG': 
                        $nazione = "Egypt";
                        break;
                      case 'SV': 
                        $nazione = "El Salvador";
                        break;
                      case 'GQ': 
                        $nazione = "Equatorial Guinea";
                        break;
                      case 'ER': 
                        $nazione = "Eritrea";
                        break;
                      case 'EE': 
                        $nazione = "Estonia";
                        break;
                      case 'ET': 
                        $nazione = "Ethiopia";
                        break;
                      case 'FK': 
                        $nazione = "Falkland Islands";
                        break;
                      case 'FO': 
                        $nazione = "Faroe Islands";
                        break;
                      case 'FJ': 
                        $nazione = "Fiji";
                        break;
                      case 'FI': 
                        $nazione = "Finland";
                        break;
                      case 'FR': 
                        $nazione = "France";
                        break;
                      case 'FX': 
                        $nazione = "France (European Territory)";
                        break;
                      case 'GF': 
                        $nazione = "French Guiana";
                        break;
                      case 'TF': 
                        $nazione = "French Southern Territories";
                        break;
                      case 'GA': 
                        $nazione = "Gabon";
                        break;
                      case 'GM': 
                        $nazione = "Gambia";
                        break;
                      case 'GE': 
                        $nazione = "Georgia";
                        break;
                      case 'DE': 
                        $nazione = "Germany";
                        break;
                      case 'GH': 
                        $nazione = "Ghana";
                        break;
                      case 'GI': 
                        $nazione = "Gibraltar";
                        break;
                      case 'GR': 
                        $nazione = "Greece";
                        break;
                      case 'GL': 
                        $nazione = "Greenland";
                        break;
                      case 'GD': 
                        $nazione = "Grenada";
                        break;
                      case 'GP': 
                        $nazione = "Guadeloupe";
                        break;
                      case 'GU': 
                        $nazione = "Guam";
                        break;
                      case 'GT': 
                        $nazione = "Guatemala";
                        break;
                      case 'GN': 
                        $nazione = "Guinea";
                        break;
                      case 'GW': 
                        $nazione = "Guinea Bissau";
                        break;
                      case 'GY': 
                        $nazione = "Guyana";
                        break;
                      case 'HT': 
                        $nazione = "Haiti";
                        break;
                      case 'HM': 
                        $nazione = "Heard and McDonald Islands";
                        break;
                      case 'VA': 
                        $nazione = "Holy See (Vatican)";
                        break;
                      case 'HN': 
                        $nazione = "Honduras";
                        break;
                      case 'HK': 
                        $nazione = "Hong Kong";
                        break;
                      case 'HU': 
                        $nazione = "Hungary";
                        break;
                      case 'IS': 
                        $nazione = "Iceland";
                        break;
                      case 'IN': 
                        $nazione = "India";
                        break;
                      case 'ID': 
                        $nazione = "Indonesia";
                        break;
                      case 'IR': 
                        $nazione = "Iran";
                        break;
                      case 'IQ': 
                        $nazione = "Iraq";
                        break;
                      case 'IE': 
                        $nazione = "Ireland";
                        break;
                      case 'IL': 
                        $nazione = "Israel";
                        break;
                      case 'IT': 
                        $nazione = "Italy";
                        break;
                      case 'CI': 
                        $nazione = "Cote D'Ivoire";
                        break;
                      case 'JM': 
                        $nazione = "Jamaica";
                        break;
                      case 'JP': 
                        $nazione = "Japan";
                        break;
                      case 'JO': 
                        $nazione = "Jordan";
                        break;
                      case 'KZ': 
                        $nazione = "Kazakhstan";
                        break;
                      case 'KE': 
                        $nazione = "Kenya";
                        break;
                      case 'KI': 
                        $nazione = "Kiribati";
                        break;
                      case 'KW': 
                        $nazione = "Kuwait";
                        break;
                      case 'KG': 
                        $nazione = "Kyrgyzstan";
                        break;
                      case 'LA': 
                        $nazione = "Laos";
                        break;
                      case 'LV': 
                        $nazione = "Latvia";
                        break;
                      case 'LB': 
                        $nazione = "Lebanon";
                        break;
                      case 'LS': 
                        $nazione = "Lesotho";
                        break;
                      case 'LR': 
                        $nazione = "Liberia";
                        break;
                      case 'LY': 
                        $nazione = "Libya";
                        break;
                      case 'LI': 
                        $nazione = "Liechtenstein";
                        break;
                      case 'LT': 
                        $nazione = "Lithuania";
                        break;
                      case 'LU': 
                        $nazione = "Luxembourg";
                        break;
                      case 'MO': 
                        $nazione = "Macau";
                        break;
                      case 'MK': 
                        $nazione = "Macedonia";
                        break;
                      case 'MG': 
                        $nazione = "Madagascar";
                        break;
                      case 'MW': 
                        $nazione = "Malawi";
                        break;
                      case 'MY': 
                        $nazione = "Malaysia";
                        break;
                      case 'MV': 
                        $nazione = "Maldives";
                        break;
                      case 'ML': 
                        $nazione = "Mali";
                        break;
                      case 'MT': 
                        $nazione = "Malta";
                        break;
                      case 'MH': 
                        $nazione = "Marshall Islands";
                        break;
                      case 'MQ': 
                        $nazione = "Martinique";
                        break;
                      case 'MR': 
                        $nazione = "Mauritania";
                        break;
                      case 'MU': 
                        $nazione = "Mauritius";
                        break;
                      case 'YT': 
                        $nazione = "Mayotte";
                        break;
                      case 'MX': 
                        $nazione = "Mexico";
                        break;
                      case 'FM': 
                        $nazione = "Micronesia";
                        break;
                      case 'MD': 
                        $nazione = "Moldova";
                        break;
                      case 'MC': 
                        $nazione = "Monaco";
                        break;
                      case 'MN': 
                        $nazione = "Mongolia";
                        break;
                      case 'ME': 
                        $nazione = "Montenegro";
                        break;
                      case 'MS': 
                        $nazione = "Montserrat";
                        break;
                      case 'MA': 
                        $nazione = "Morocco";
                        break;
                      case 'MZ': 
                        $nazione = "Mozambique";
                        break;
                      case 'MM': 
                        $nazione = "Myanmar";
                        break;
                      case 'NA': 
                        $nazione = "Namibia";
                        break;
                      case 'NR': 
                        $nazione = "Nauru";
                        break;
                      case 'NP': 
                        $nazione = "Nepal";
                        break;
                      case 'NL': 
                        $nazione = "Netherlands";
                        break;
                      case 'AN': 
                        $nazione = "Netherlands Antilles";
                        break;
                      case 'NC': 
                        $nazione = "New Caledonia";
                        break;
                      case 'NZ': 
                        $nazione = "New Zealand";
                        break;
                      case 'NI': 
                        $nazione = "Nicaragua";
                        break;
                      case 'NE': 
                        $nazione = "Niger";
                        break;
                      case 'NG': 
                        $nazione = "Nigeria";
                        break;
                      case 'NU': 
                        $nazione = "Niue";
                        break;
                      case 'NF': 
                        $nazione = "Norfolk Island";
                        break;
                      case 'KP': 
                        $nazione = "North Korea";
                        break;
                      case 'MP': 
                        $nazione = "Northern Mariana Islands";
                        break;
                      case 'NO': 
                        $nazione = "Norway";
                        break;
                      case 'OM': 
                        $nazione = "Oman";
                        break;
                      case 'PK': 
                        $nazione = "Pakistan";
                        break;
                      case 'PW': 
                        $nazione = "Palau";
                        break;
                      case 'PS': 
                        $nazione = "Palestinian Territory";
                        break;
                      case 'PA': 
                        $nazione = "Panama";
                        break;
                      case 'PG': 
                        $nazione = "Papua New Guinea";
                        break;
                      case 'PY': 
                        $nazione = "Paraguay";
                        break;
                      case 'PE': 
                        $nazione = "Peru";
                        break;
                      case 'PH': 
                        $nazione = "Philippines";
                        break;
                      case 'PN': 
                        $nazione = "Pitcairn";
                        break;
                      case 'PL': 
                        $nazione = "Poland";
                        break;
                      case 'PF': 
                        $nazione = "Polynesia";
                        break;
                      case 'PT': 
                        $nazione = "Portugal";
                        break;
                      case 'PR': 
                        $nazione = "Puerto Rico";
                        break;
                      case 'QA': 
                        $nazione = "Qatar";
                        break;
                      case 'RE': 
                        $nazione = "Reunion";
                        break;
                      case 'RO': 
                        $nazione = "Romania";
                        break;
                      case 'RU': 
                        $nazione = "Russian Federation";
                        break;
                      case 'RW': 
                        $nazione = "Rwanda";
                        break;
                      case 'GS': 
                        $nazione = "S. Georgia &amp; S. Sandwich Isls.";
                        break;
                      case 'SH': 
                        $nazione = "Saint Helena";
                        break;
                      case 'KN': 
                        $nazione = "Saint Kitts &amp; Nevis Anguilla";
                        break;
                      case 'LC': 
                        $nazione = "Saint Lucia";
                        break;
                      case 'PM': 
                        $nazione = "Saint Pierre and Miquelon";
                        break;
                      case 'VC': 
                        $nazione = "Saint Vincent &amp; Grenadines";
                        break;
                      case 'WS': 
                        $nazione = "Samoa";
                        break;
                      case 'SM': 
                        $nazione = "San Marino";
                        break;
                      case 'ST': 
                        $nazione = "Sao Tome and Principe";
                        break;
                      case 'SA': 
                        $nazione = "Saudi Arabia";
                        break;
                      case 'SN': 
                        $nazione = "Senegal";
                        break;
                      case 'RS': 
                        $nazione = "Serbia";
                        break;
                      case 'SC': 
                        $nazione = "Seychelles";
                        break;
                      case 'SL': 
                        $nazione = "Sierra Leone";
                        break;
                      case 'SG': 
                        $nazione = "Singapore";
                        break;
                      case 'SK': 
                        $nazione = "Slovakia";
                        break;
                      case 'SI': 
                        $nazione = "Slovenia";
                        break;
                      case 'SB': 
                        $nazione = "Solomon Islands";
                        break;
                      case 'SO': 
                        $nazione = "Somalia";
                        break;
                      case 'ZA': 
                        $nazione = "South Africa";
                        break;
                      case 'KR': 
                        $nazione = "South Korea";
                        break;
                      case 'ES': 
                        $nazione = "Spain";
                        break;
                      case 'LK': 
                        $nazione = "Sri Lanka";
                        break;
                      case 'SD': 
                        $nazione = "Sudan";
                        break;
                      case 'SR': 
                        $nazione = "Suriname";
                        break;
                      case 'SZ': 
                        $nazione = "Swaziland";
                        break;
                      case 'SE': 
                        $nazione = "Sweden";
                        break;
                      case 'CH': 
                        $nazione = "Switzerland";
                        break;
                      case 'SY': 
                        $nazione = "Syrian Arab Republic";
                        break;
                      case 'TW': 
                        $nazione = "Taiwan";
                        break;
                      case 'TJ': 
                        $nazione = "Tajikistan";
                        break;
                      case 'TZ': 
                        $nazione = "Tanzania";
                        break;
                      case 'TH': 
                        $nazione = "Thailand";
                        break;
                      case 'TG': 
                        $nazione = "Togo";
                        break;
                      case 'TK': 
                        $nazione = "Tokelau";
                        break;
                      case 'TO': 
                        $nazione = "Tonga";
                        break;
                      case 'TT': 
                        $nazione = "Trinidad and Tobago";
                        break;
                      case 'TN': 
                        $nazione = "Tunisia";
                        break;
                      case 'TR': 
                        $nazione = "Turkey";
                        break;
                      case 'TM': 
                        $nazione = "Turkmenistan";
                        break;
                      case 'TC': 
                        $nazione = "Turks and Caicos Islands";
                        break;
                      case 'TV': 
                        $nazione = "Tuvalu";
                        break;
                      case 'UG': 
                        $nazione = "Uganda";
                        break;
                      case 'UA': 
                        $nazione = "Ukraine";
                        break;
                      case 'AE': 
                        $nazione = "United Arab Emirates";
                        break;
                      case 'GB': 
                        $nazione = "United Kingdom";
                        break;
                      case 'UY': 
                        $nazione = "Uruguay";
                        break;
                      case 'UM': 
                        $nazione = "USA Minor Outlying Islands";
                        break;
                      case 'UZ': 
                        $nazione = "Uzbekistan";
                        break;
                      case 'VU': 
                        $nazione = "Vanuatu";
                        break;
                      case 'VE': 
                        $nazione = "Venezuela";
                        break;
                      case 'VN': 
                        $nazione = "Vietnam";
                        break;
                      case 'VG': 
                        $nazione = "Virgin Islands (British)";
                        break;
                      case 'VI': 
                        $nazione = "Virgin Islands (USA)";
                        break;
                      case 'WF': 
                        $nazione = "Wallis and Futuna Islands";
                        break;
                      case 'EH': 
                        $nazione = "Western Sahara";
                        break;
                      case 'YE': 
                        $nazione = "Yemen";
                        break;
                      case 'ZR': 
                        $nazione = "Zaire";
                        break;
                      case 'ZM': 
                        $nazione = "Zambia";
                        break;
                      case 'ZW': 
                        $nazione = "Zimbabwe";
                        break;
                      default:
                        $nazione = "Ciao";
                        break;
                    }
                    $genere = $line["genre"];
                    $date = date( 'd/m/Y', strtotime( $datanascita ) );
                    $contact_email = $line["contact_email"];
                    $telephone_number = $line["telephone_number"];
                    $curriculum = $line["curriculum"];
                    $picture = $line["picture"];
                    if( isset( $picture ) ) {
                      $picture = pg_unescape_bytea( $picture );
                      $filename_picture = "storage/image_$username.png";
                      file_put_contents($filename_picture, $picture);
                    } else {
                      $filename_picture = "images/default-profile.png";
                    }
                    if( isset( $curriculum ) ) {
                      $curriculum = pg_unescape_bytea( $curriculum );
                      $filename_curriculum = "storage/cv_$username.pdf";
                      file_put_contents($filename_curriculum, $curriculum);
                    }
                    ?>
                    <div>
                      <img src=" <?php echo $filename_picture ?> " class="img-fluid rounded mb-4" style="width: 150px; height: 150px; object-fit: cover;">
                      <h1 class="text-color-2 fw-bold"><?php echo $nome . ' ' . $cognome ?></h1>
                    </div>
                    <div class="d-flex flex-column gap-4">
                      <div class="dettagli-professionista">
                        <div class="fw-bold fs-5 mb-2">Dettagli</div>
                        <div class="user-birthday"><span class="fw-bold">Data di nascita:</span> <span><?php echo $date ?></span></div>
                        <div class="user-gender"><span class="fw-bold">Genere:</span> <span><?php echo $genere ?></span></div>
                        <div class="user-address"><span class="fw-bold">Indirizzo:</span> <span><?php echo $indirizzo ?></span></div>
                        <div class="user-city"><span class="fw-bold">Città:</span> <span><?php echo $citta ?></span></div>
                        <div class="user-country"><span class="fw-bold">Nazione:</span> <span><?php echo $nazione ?></span></div>
                        <div class="user-email"><span class="fw-bold">Indirizzo email:</span> <span><a href=" <?php echo 'mailto:' . $contact_email ?> " class="text-decoration-none text-color-1 fw-bold"><?php echo $contact_email ?></a></span></div>
                        <div class="user-phone"><span class="fw-bold">Numero di telefono:</span> <span><a href=" <?php echo 'tel:' . $telephone_number ?> " class="text-decoration-none text-color-1 fw-bold"><?php echo $telephone_number ?></a></span></div>
                      </div>
                      <div class="curriculum">
                        <div class="fw-bold fs-5 mb-2">Curriculum Vitae</div>
                        <object data=" <?php echo $filename_curriculum ?> " type="application/pdf" width="100%" height="600px" class="rounded">
                          <p>Impossibile mostrare il file PDF direttamente nel browser. <a href=" <?php echo $filename_curriculum ?> ">Scarica</a> il file.</p>
                        </object>
                      </div>
                    </div>
                    <?php 
                  }

                elseif( $_GET["sa"] == 1 ):

                  $query = "SELECT * FROM company where company_id=$1";
                  $result = pg_query_params( $dbconn, $query, array($uid) );
                  if( pg_num_rows( $result ) == 0 ) {
                    echo '<div class="text-center bg-warning-subtle border border-warning p-5 rounded">Utente non trovato</div>';
                  } else {
                    $line = pg_fetch_assoc( $result );
                    $company_name = $line["company_name"];
                    $username = $line["username"];
                    $vat_number = $line["vat_number"];
                    $address = $line["address"];
                    $city = $line["city"];
                    $country = $line["country"];
                    switch( $country ) {
                      case 'US': 
                        $country = "United States";
                        break;
                      case 'CA': 
                        $country = "Canada";
                        break;
                      case 'AF': 
                        $country = "Afghanistan";
                        break;
                      case 'AL': 
                        $country = "Albania";
                        break;
                      case 'DZ': 
                        $country = "Algeria";
                        break;
                      case 'AS': 
                        $country = "American Samoa";
                        break;
                      case 'AD': 
                        $country = "Andorra";
                        break;
                      case 'AO': 
                        $country = "Angola";
                        break;
                      case 'AI': 
                        $country = "Anguilla";
                        break;
                      case 'AQ': 
                        $country = "Antarctica";
                        break;
                      case 'AG': 
                        $country = "Antigua and Barbuda";
                        break;
                      case 'AR': 
                        $country = "Argentina";
                        break;
                      case 'AM': 
                        $country = "Armenia";
                        break;
                      case 'AW': 
                        $country = "Aruba";
                        break;
                      case 'AU': 
                        $country = "Australia";
                        break;
                      case 'AT': 
                        $country = "Austria";
                        break;
                      case 'AZ': 
                        $country = "Azerbaijan";
                        break;
                      case 'BS': 
                        $country = "Bahamas";
                        break;
                      case 'BH': 
                        $country = "Bahrain";
                        break;
                      case 'BD': 
                        $country = "Bangladesh";
                        break;
                      case 'BB': 
                        $country = "Barbados";
                        break;
                      case 'BY': 
                        $country = "Belarus";
                        break;
                      case 'BE': 
                        $country = "Belgium";
                        break;
                      case 'BZ': 
                        $country = "Belize";
                        break;
                      case 'BJ': 
                        $country = "Benin";
                        break;
                      case 'BM': 
                        $country = "Bermuda";
                        break;
                      case 'BT': 
                        $country = "Bhutan";
                        break;
                      case 'BO': 
                        $country = "Bolivia";
                        break;
                      case 'BA': 
                        $country = "Bosnia and Herzegovina";
                        break;
                      case 'BW': 
                        $country = "Botswana";
                        break;
                      case 'BV': 
                        $country = "Bouvet Island";
                        break;
                      case 'BR': 
                        $country = "Brazil";
                        break;
                      case 'IO': 
                        $country = "British Indian Ocean Territory";
                        break;
                      case 'BN': 
                        $country = "Brunei Darussalam";
                        break;
                      case 'BG': 
                        $country = "Bulgaria";
                        break;
                      case 'BF': 
                        $country = "Burkina Faso";
                        break;
                      case 'BI': 
                        $country = "Burundi";
                        break;
                      case 'KH': 
                        $country = "Cambodia";
                        break;
                      case 'CM': 
                        $country = "Cameroon";
                        break;
                      case 'CV': 
                        $country = "Cape Verde";
                        break;
                      case 'KY': 
                        $country = "Cayman Islands";
                        break;
                      case 'CF': 
                        $country = "Central African Republic";
                        break;
                      case 'TD': 
                        $country = "Chad";
                        break;
                      case 'CL': 
                        $country = "Chile";
                        break;
                      case 'CN': 
                        $country = "China";
                        break;
                      case 'CX': 
                        $country = "Christmas Island";
                        break;
                      case 'CC': 
                        $country = "Cocos (Keeling) Islands";
                        break;
                      case 'CO': 
                        $country = "Colombia";
                        break;
                      case 'KM': 
                        $country = "Comoros";
                        break;
                      case 'CG': 
                        $country = "Congo";
                        break;
                      case 'CD': 
                        $country = "Congo (Democratic Republic)";
                        break;
                      case 'CK': 
                        $country = "Cook Islands";
                        break;
                      case 'CR': 
                        $country = "Costa Rica";
                        break;
                      case 'HR': 
                        $country = "Croatia";
                        break;
                      case 'CU': 
                        $country = "Cuba";
                        break;
                      case 'CY': 
                        $country = "Cyprus";
                        break;
                      case 'CZ': 
                        $country = "Czech Republic";
                        break;
                      case 'DK': 
                        $country = "Denmark";
                        break;
                      case 'DJ': 
                        $country = "Djibouti";
                        break;
                      case 'DM': 
                        $country = "Dominica";
                        break;
                      case 'DO': 
                        $country = "Dominican Republic";
                        break;
                      case 'TP': 
                        $country = "East Timor";
                        break;
                      case 'EC': 
                        $country = "Ecuador";
                        break;
                      case 'EG': 
                        $country = "Egypt";
                        break;
                      case 'SV': 
                        $country = "El Salvador";
                        break;
                      case 'GQ': 
                        $country = "Equatorial Guinea";
                        break;
                      case 'ER': 
                        $country = "Eritrea";
                        break;
                      case 'EE': 
                        $country = "Estonia";
                        break;
                      case 'ET': 
                        $country = "Ethiopia";
                        break;
                      case 'FK': 
                        $country = "Falkland Islands";
                        break;
                      case 'FO': 
                        $country = "Faroe Islands";
                        break;
                      case 'FJ': 
                        $country = "Fiji";
                        break;
                      case 'FI': 
                        $country = "Finland";
                        break;
                      case 'FR': 
                        $country = "France";
                        break;
                      case 'FX': 
                        $country = "France (European Territory)";
                        break;
                      case 'GF': 
                        $country = "French Guiana";
                        break;
                      case 'TF': 
                        $country = "French Southern Territories";
                        break;
                      case 'GA': 
                        $country = "Gabon";
                        break;
                      case 'GM': 
                        $country = "Gambia";
                        break;
                      case 'GE': 
                        $country = "Georgia";
                        break;
                      case 'DE': 
                        $country = "Germany";
                        break;
                      case 'GH': 
                        $country = "Ghana";
                        break;
                      case 'GI': 
                        $country = "Gibraltar";
                        break;
                      case 'GR': 
                        $country = "Greece";
                        break;
                      case 'GL': 
                        $country = "Greenland";
                        break;
                      case 'GD': 
                        $country = "Grenada";
                        break;
                      case 'GP': 
                        $country = "Guadeloupe";
                        break;
                      case 'GU': 
                        $country = "Guam";
                        break;
                      case 'GT': 
                        $country = "Guatemala";
                        break;
                      case 'GN': 
                        $country = "Guinea";
                        break;
                      case 'GW': 
                        $country = "Guinea Bissau";
                        break;
                      case 'GY': 
                        $country = "Guyana";
                        break;
                      case 'HT': 
                        $country = "Haiti";
                        break;
                      case 'HM': 
                        $country = "Heard and McDonald Islands";
                        break;
                      case 'VA': 
                        $country = "Holy See (Vatican)";
                        break;
                      case 'HN': 
                        $country = "Honduras";
                        break;
                      case 'HK': 
                        $country = "Hong Kong";
                        break;
                      case 'HU': 
                        $country = "Hungary";
                        break;
                      case 'IS': 
                        $country = "Iceland";
                        break;
                      case 'IN': 
                        $country = "India";
                        break;
                      case 'ID': 
                        $country = "Indonesia";
                        break;
                      case 'IR': 
                        $country = "Iran";
                        break;
                      case 'IQ': 
                        $country = "Iraq";
                        break;
                      case 'IE': 
                        $country = "Ireland";
                        break;
                      case 'IL': 
                        $country = "Israel";
                        break;
                      case 'IT': 
                        $country = "Italy";
                        break;
                      case 'CI': 
                        $country = "Cote D'Ivoire";
                        break;
                      case 'JM': 
                        $country = "Jamaica";
                        break;
                      case 'JP': 
                        $country = "Japan";
                        break;
                      case 'JO': 
                        $country = "Jordan";
                        break;
                      case 'KZ': 
                        $country = "Kazakhstan";
                        break;
                      case 'KE': 
                        $country = "Kenya";
                        break;
                      case 'KI': 
                        $country = "Kiribati";
                        break;
                      case 'KW': 
                        $country = "Kuwait";
                        break;
                      case 'KG': 
                        $country = "Kyrgyzstan";
                        break;
                      case 'LA': 
                        $country = "Laos";
                        break;
                      case 'LV': 
                        $country = "Latvia";
                        break;
                      case 'LB': 
                        $country = "Lebanon";
                        break;
                      case 'LS': 
                        $country = "Lesotho";
                        break;
                      case 'LR': 
                        $country = "Liberia";
                        break;
                      case 'LY': 
                        $country = "Libya";
                        break;
                      case 'LI': 
                        $country = "Liechtenstein";
                        break;
                      case 'LT': 
                        $country = "Lithuania";
                        break;
                      case 'LU': 
                        $country = "Luxembourg";
                        break;
                      case 'MO': 
                        $country = "Macau";
                        break;
                      case 'MK': 
                        $country = "Macedonia";
                        break;
                      case 'MG': 
                        $country = "Madagascar";
                        break;
                      case 'MW': 
                        $country = "Malawi";
                        break;
                      case 'MY': 
                        $country = "Malaysia";
                        break;
                      case 'MV': 
                        $country = "Maldives";
                        break;
                      case 'ML': 
                        $country = "Mali";
                        break;
                      case 'MT': 
                        $country = "Malta";
                        break;
                      case 'MH': 
                        $country = "Marshall Islands";
                        break;
                      case 'MQ': 
                        $country = "Martinique";
                        break;
                      case 'MR': 
                        $country = "Mauritania";
                        break;
                      case 'MU': 
                        $country = "Mauritius";
                        break;
                      case 'YT': 
                        $country = "Mayotte";
                        break;
                      case 'MX': 
                        $country = "Mexico";
                        break;
                      case 'FM': 
                        $country = "Micronesia";
                        break;
                      case 'MD': 
                        $country = "Moldova";
                        break;
                      case 'MC': 
                        $country = "Monaco";
                        break;
                      case 'MN': 
                        $country = "Mongolia";
                        break;
                      case 'ME': 
                        $country = "Montenegro";
                        break;
                      case 'MS': 
                        $country = "Montserrat";
                        break;
                      case 'MA': 
                        $country = "Morocco";
                        break;
                      case 'MZ': 
                        $country = "Mozambique";
                        break;
                      case 'MM': 
                        $country = "Myanmar";
                        break;
                      case 'NA': 
                        $country = "Namibia";
                        break;
                      case 'NR': 
                        $country = "Nauru";
                        break;
                      case 'NP': 
                        $country = "Nepal";
                        break;
                      case 'NL': 
                        $country = "Netherlands";
                        break;
                      case 'AN': 
                        $country = "Netherlands Antilles";
                        break;
                      case 'NC': 
                        $country = "New Caledonia";
                        break;
                      case 'NZ': 
                        $country = "New Zealand";
                        break;
                      case 'NI': 
                        $country = "Nicaragua";
                        break;
                      case 'NE': 
                        $country = "Niger";
                        break;
                      case 'NG': 
                        $country = "Nigeria";
                        break;
                      case 'NU': 
                        $country = "Niue";
                        break;
                      case 'NF': 
                        $country = "Norfolk Island";
                        break;
                      case 'KP': 
                        $country = "North Korea";
                        break;
                      case 'MP': 
                        $country = "Northern Mariana Islands";
                        break;
                      case 'NO': 
                        $country = "Norway";
                        break;
                      case 'OM': 
                        $country = "Oman";
                        break;
                      case 'PK': 
                        $country = "Pakistan";
                        break;
                      case 'PW': 
                        $country = "Palau";
                        break;
                      case 'PS': 
                        $country = "Palestinian Territory";
                        break;
                      case 'PA': 
                        $country = "Panama";
                        break;
                      case 'PG': 
                        $country = "Papua New Guinea";
                        break;
                      case 'PY': 
                        $country = "Paraguay";
                        break;
                      case 'PE': 
                        $country = "Peru";
                        break;
                      case 'PH': 
                        $country = "Philippines";
                        break;
                      case 'PN': 
                        $country = "Pitcairn";
                        break;
                      case 'PL': 
                        $country = "Poland";
                        break;
                      case 'PF': 
                        $country = "Polynesia";
                        break;
                      case 'PT': 
                        $country = "Portugal";
                        break;
                      case 'PR': 
                        $country = "Puerto Rico";
                        break;
                      case 'QA': 
                        $country = "Qatar";
                        break;
                      case 'RE': 
                        $country = "Reunion";
                        break;
                      case 'RO': 
                        $country = "Romania";
                        break;
                      case 'RU': 
                        $country = "Russian Federation";
                        break;
                      case 'RW': 
                        $country = "Rwanda";
                        break;
                      case 'GS': 
                        $country = "S. Georgia &amp; S. Sandwich Isls.";
                        break;
                      case 'SH': 
                        $country = "Saint Helena";
                        break;
                      case 'KN': 
                        $country = "Saint Kitts &amp; Nevis Anguilla";
                        break;
                      case 'LC': 
                        $country = "Saint Lucia";
                        break;
                      case 'PM': 
                        $country = "Saint Pierre and Miquelon";
                        break;
                      case 'VC': 
                        $country = "Saint Vincent &amp; Grenadines";
                        break;
                      case 'WS': 
                        $country = "Samoa";
                        break;
                      case 'SM': 
                        $country = "San Marino";
                        break;
                      case 'ST': 
                        $country = "Sao Tome and Principe";
                        break;
                      case 'SA': 
                        $country = "Saudi Arabia";
                        break;
                      case 'SN': 
                        $country = "Senegal";
                        break;
                      case 'RS': 
                        $country = "Serbia";
                        break;
                      case 'SC': 
                        $country = "Seychelles";
                        break;
                      case 'SL': 
                        $country = "Sierra Leone";
                        break;
                      case 'SG': 
                        $country = "Singapore";
                        break;
                      case 'SK': 
                        $country = "Slovakia";
                        break;
                      case 'SI': 
                        $country = "Slovenia";
                        break;
                      case 'SB': 
                        $country = "Solomon Islands";
                        break;
                      case 'SO': 
                        $country = "Somalia";
                        break;
                      case 'ZA': 
                        $country = "South Africa";
                        break;
                      case 'KR': 
                        $country = "South Korea";
                        break;
                      case 'ES': 
                        $country = "Spain";
                        break;
                      case 'LK': 
                        $country = "Sri Lanka";
                        break;
                      case 'SD': 
                        $country = "Sudan";
                        break;
                      case 'SR': 
                        $country = "Suriname";
                        break;
                      case 'SZ': 
                        $country = "Swaziland";
                        break;
                      case 'SE': 
                        $country = "Sweden";
                        break;
                      case 'CH': 
                        $country = "Switzerland";
                        break;
                      case 'SY': 
                        $country = "Syrian Arab Republic";
                        break;
                      case 'TW': 
                        $country = "Taiwan";
                        break;
                      case 'TJ': 
                        $country = "Tajikistan";
                        break;
                      case 'TZ': 
                        $country = "Tanzania";
                        break;
                      case 'TH': 
                        $country = "Thailand";
                        break;
                      case 'TG': 
                        $country = "Togo";
                        break;
                      case 'TK': 
                        $country = "Tokelau";
                        break;
                      case 'TO': 
                        $country = "Tonga";
                        break;
                      case 'TT': 
                        $country = "Trinidad and Tobago";
                        break;
                      case 'TN': 
                        $country = "Tunisia";
                        break;
                      case 'TR': 
                        $country = "Turkey";
                        break;
                      case 'TM': 
                        $country = "Turkmenistan";
                        break;
                      case 'TC': 
                        $country = "Turks and Caicos Islands";
                        break;
                      case 'TV': 
                        $country = "Tuvalu";
                        break;
                      case 'UG': 
                        $country = "Uganda";
                        break;
                      case 'UA': 
                        $country = "Ukraine";
                        break;
                      case 'AE': 
                        $country = "United Arab Emirates";
                        break;
                      case 'GB': 
                        $country = "United Kingdom";
                        break;
                      case 'UY': 
                        $country = "Uruguay";
                        break;
                      case 'UM': 
                        $country = "USA Minor Outlying Islands";
                        break;
                      case 'UZ': 
                        $country = "Uzbekistan";
                        break;
                      case 'VU': 
                        $country = "Vanuatu";
                        break;
                      case 'VE': 
                        $country = "Venezuela";
                        break;
                      case 'VN': 
                        $country = "Vietnam";
                        break;
                      case 'VG': 
                        $country = "Virgin Islands (British)";
                        break;
                      case 'VI': 
                        $country = "Virgin Islands (USA)";
                        break;
                      case 'WF': 
                        $country = "Wallis and Futuna Islands";
                        break;
                      case 'EH': 
                        $country = "Western Sahara";
                        break;
                      case 'YE': 
                        $country = "Yemen";
                        break;
                      case 'ZR': 
                        $country = "Zaire";
                        break;
                      case 'ZM': 
                        $country = "Zambia";
                        break;
                      case 'ZW': 
                        $country = "Zimbabwe";
                        break;
                      default:
                        $country = "Ciao";
                        break;
                    }
                    $description = $line["description"];
                    $contact_email = $line["contact_email"];
                    $telephone_number = $line["telephone_number"];
                    $logo = $line["logo"];
                    if( isset( $logo ) ) {
                      $logo = pg_unescape_bytea( $logo );
                      $filename_logo = "storage/image_$username.png";
                      file_put_contents($filename_logo, $logo);
                    } else {
                      $filename_logo = "images/default-profile.png";
                    }
                    ?>
                    <div>
                      <img src=" <?php echo $filename_logo ?> " class="img-fluid rounded mb-4" style="width: 150px; height: 150px; object-fit: cover;">
                      <h1 class="text-color-2 fw-bold"><?php echo $company_name ?></h1>
                      <div class="text-color-5"><?php echo $description ?></div>
                    </div>
                    <div class="d-flex flex-column gap-4">
                      <div class="dettagli-professionista">
                        <div class="fw-bold fs-5 mb-2">Dettagli</div>
                        <div class="user-birthday"><span class="fw-bold">Partita IVA:</span> <span><?php echo $vat_number ?></span></div>
                        <div class="user-address"><span class="fw-bold">Indirizzo:</span> <span><?php echo $address ?></span></div>
                        <div class="user-city"><span class="fw-bold">Città:</span> <span><?php echo $city ?></span></div>
                        <div class="user-country"><span class="fw-bold">Nazione:</span> <span><?php echo $country ?></span></div>
                        <div class="user-email"><span class="fw-bold">Indirizzo email:</span> <span><a href=" <?php echo 'mailto:' . $contact_email ?> " class="text-decoration-none text-color-1 fw-bold"><?php echo $contact_email ?></a></span></div>
                        <div class="user-phone"><span class="fw-bold">Numero di telefono:</span> <span><a href=" <?php echo 'tel:' . $telephone_number ?> " class="text-decoration-none text-color-1 fw-bold"><?php echo $telephone_number ?></a></span></div>
                      </div>
                    </div>
                    <?php 
                  }

                endif;

                pg_free_result($result);
                pg_close($dbconn);

              endif;
            ?>
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
