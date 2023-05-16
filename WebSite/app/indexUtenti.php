<?php
session_start();
ob_start();
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
        <script>
          $(document).ready(function()
          {
            var a = document.getElementById("indirizzo");
            var ind = a.textContent;
            if(ind=='')
            {
              $("#indirizzo").empty();
            }
            if(ind=='')
            {
              $("#indirizzo2").empty();
            }
            var b = document.getElementById("citta");
            var citta = b.textContent;
            if(citta=='')
            {
              $("#citta").empty();
            }
            if(citta=='')
            {
              $("#citta2").empty();
            }
            var c = document.getElementById("nazione");
            var nazione = c.textContent;
            if(nazione=='nessuna')
            {
              $("#nazione").empty();
            }
            if(nazione=='nessuna')
            {
              $("#nazione2").empty();
            }
            if(nazione=='US') c.textContent=("United States");
            if(nazione=="CA") c.textContent=("Canada");
            if(nazione=="AF") c.textContent=("Afghanistan");
            if(nazione=="AL") c.textContent=("Albania");
            if(nazione=="DZ") c.textContent=("Algeria");
            if(nazione=="AS") c.textContent=("American Samoa");
            if(nazione=="AD") c.textContent=("Andorra");
            if(nazione=="AO") c.textContent=("Angola");
            if(nazione=="AI") c.textContent=("Anguilla");
            if(nazione=="AQ") c.textContent=("Antarctica");
            if(nazione=="AG") c.textContent=("Antigua and Barbuda");
            if(nazione=="AR") c.textContent=("Argentina");
            if(nazione=="AM") c.textContent=("Armenia");
            if(nazione=="AW") c.textContent=("Aruba");
            if(nazione=="AU") c.textContent=("Australia");
            if(nazione=="AT") c.textContent=("Austria");
            if(nazione=="AZ") c.textContent=("Azerbaijan");
            if(nazione=="BS") c.textContent=("Bahamas");
            if(nazione=="BH") c.textContent=("Bahrain");
            if(nazione=="BD") c.textContent=("Bangladesh");
            if(nazione=="BB") c.textContent=("Barbados");
            if(nazione=="BY") c.textContent=("Belarus");
            if(nazione=="BE") c.textContent=("Belgium");
            if(nazione=="BZ") c.textContent=("Belize");
            if(nazione=="BJ") c.textContent=("Benin");
            if(nazione=="BM") c.textContent=("Bermuda");
            if(nazione=="BT") c.textContent=("Bhutan");
            if(nazione=="BO") c.textContent=("Bolivia");
            if(nazione=="BA") c.textContent=("Bosnia and Herzegovina");
            if(nazione=="BW") c.textContent=("Botswana");
            if(nazione=="BV") c.textContent=("Bouvet Island");
            if(nazione=="BR") c.textContent=("Brazil");
            if(nazione=="IO") c.textContent=("British Indian Ocean Territory");
            if(nazione=="BN") c.textContent=("Brunei Darussalam");
            if(nazione=="BG") c.textContent=("Bulgaria");
            if(nazione=="BF") c.textContent=("Burkina Faso");
            if(nazione=="BI") c.textContent=("Burundi");
            if(nazione=="KH") c.textContent=("Cambodia");
            if(nazione=="CM") c.textContent=("Cameroon");
            if(nazione=="CV") c.textContent=("Cape Verde");
            if(nazione=="KY") c.textContent=("Cayman Islands");
            if(nazione=="CF") c.textContent=("Central African Republic");
            if(nazione=="TD") c.textContent=("Chad");
            if(nazione=="CL") c.textContent=("Chile");
            if(nazione=="CN") c.textContent=("China");
            if(nazione=="CX") c.textContent=("Christmas Island");
            if(nazione=="CC") c.textContent=("Cocos (Keeling) Islands");
            if(nazione=="CO") c.textContent=("Colombia");
            if(nazione=="KM") c.textContent=("Comoros");
            if(nazione=="CG") c.textContent=("Congo");
            if(nazione=="CD") c.textContent=("Congo (Democratic Republic)");
            if(nazione=="CK") c.textContent=("Cook Islands");
            if(nazione=="CR") c.textContent=("Costa Rica");
            if(nazione=="HR") c.textContent=("Croatia");
            if(nazione=="CU") c.textContent=("Cuba");
            if(nazione=="CY") c.textContent=("Cyprus");
            if(nazione=="CZ") c.textContent=("Czech Republic");
            if(nazione=="DK") c.textContent=("Denmark");
            if(nazione=="DJ") c.textContent=("Djibouti");
            if(nazione=="DM") c.textContent=("Dominica");
            if(nazione=="DO") c.textContent=("Dominican Republic");
            if(nazione=="TP") c.textContent=("East Timor");
            if(nazione=="EC") c.textContent=("Ecuador");
            if(nazione=="EG") c.textContent=("Egypt");
            if(nazione=="SV") c.textContent=("El Salvador");
            if(nazione=="GQ") c.textContent=("Equatorial Guinea");
            if(nazione=="ER") c.textContent=("Eritrea");
            if(nazione=="EE") c.textContent=("Estonia");
            if(nazione=="ET") c.textContent=("Ethiopia");
            if(nazione=="FK") c.textContent=("Falkland Islands");
            if(nazione=="FO") c.textContent=("Faroe Islands");
            if(nazione=="FJ") c.textContent=("Fiji");
            if(nazione=="FI") c.textContent=("Finland");
            if(nazione=="FR") c.textContent=("France");
            if(nazione=="FX") c.textContent=("France (European Territory)");
            if(nazione=="GF") c.textContent=("French Guiana");
            if(nazione=="TF") c.textContent=("French Southern Territories");
            if(nazione=="GA") c.textContent=("Gabon");
            if(nazione=="GM") c.textContent=("Gambia");
            if(nazione=="GE") c.textContent=("Georgia");
            if(nazione=="DE") c.textContent=("Germany");
            if(nazione=="GH") c.textContent=("Ghana");
            if(nazione=="GI") c.textContent=("Gibraltar");
            if(nazione=="GR") c.textContent=("Greece");
            if(nazione=="GL") c.textContent=("Greenland");
            if(nazione=="GD") c.textContent=("Grenada");
            if(nazione=="GP") c.textContent=("Guadeloupe");
            if(nazione=="GU") c.textContent=("Guam");
            if(nazione=="GT") c.textContent=("Guatemala");
            if(nazione=="GN") c.textContent=("Guinea");
            if(nazione=="GW") c.textContent=("Guinea Bissau");
            if(nazione=="GY") c.textContent=("Guyana");
            if(nazione=="HT") c.textContent=("Haiti");
            if(nazione=="HM") c.textContent=("Heard and McDonald Islands");
            if(nazione=="VA") c.textContent=("Holy See (Vatican)");
            if(nazione=="HN") c.textContent=("Honduras");
            if(nazione=="HK") c.textContent=("Hong Kong");
            if(nazione=="HU") c.textContent=("Hungary");
            if(nazione=="IS") c.textContent=("Iceland");
            if(nazione=="IN") c.textContent=("India");
            if(nazione=="ID") c.textContent=("Indonesia");
            if(nazione=="IR") c.textContent=("Iran");
            if(nazione=="IQ") c.textContent=("Iraq");
            if(nazione=="IE") c.textContent=("Ireland");
            if(nazione=="IL") c.textContent=("Israel");
            if(nazione=="IT") c.textContent=("Italy");
            if(nazione=="CI") c.textContent=("Cote D&rsquo;Ivoire");
            if(nazione=="JM") c.textContent=("Jamaica");
            if(nazione=="JP") c.textContent=("Japan");
            if(nazione=="JO") c.textContent=("Jordan");
            if(nazione=="KZ") c.textContent=("Kazakhstan");
            if(nazione=="KE") c.textContent=("Kenya");
            if(nazione=="KI") c.textContent=("Kiribati");
            if(nazione=="KW") c.textContent=("Kuwait");
            if(nazione=="KG") c.textContent=("Kyrgyzstan");
            if(nazione=="LA") c.textContent=("Laos");
            if(nazione=="LV") c.textContent=("Latvia");
            if(nazione=="LB") c.textContent=("Lebanon");
            if(nazione=="LS") c.textContent=("Lesotho");
            if(nazione=="LR") c.textContent=("Liberia");
            if(nazione=="LY") c.textContent=("Libya");
            if(nazione=="LI") c.textContent=("Liechtenstein");
            if(nazione=="LT") c.textContent=("Lithuania");
            if(nazione=="LU") c.textContent=("Luxembourg");
            if(nazione=="MO") c.textContent=("Macau");
            if(nazione=="MK") c.textContent=("Macedonia");
            if(nazione=="MG") c.textContent=("Madagascar");
            if(nazione=="MW") c.textContent=("Malawi");
            if(nazione=="MY") c.textContent=("Malaysia");
            if(nazione=="MV") c.textContent=("Maldives");
            if(nazione=="ML") c.textContent=("Mali");
            if(nazione=="MT") c.textContent=("Malta");
            if(nazione=="MH") c.textContent=("Marshall Islands");
            if(nazione=="MQ") c.textContent=("Martinique");
            if(nazione=="MR") c.textContent=("Mauritania");
            if(nazione=="MU") c.textContent=("Mauritius");
            if(nazione=="YT") c.textContent=("Mayotte");
            if(nazione=="MX") c.textContent=("Mexico");
            if(nazione=="FM") c.textContent=("Micronesia");
            if(nazione=="MD") c.textContent=("Moldova");
            if(nazione=="MC") c.textContent=("Monaco");
            if(nazione=="MN") c.textContent=("Mongolia");
            if(nazione=="ME") c.textContent=("Montenegro");
            if(nazione=="MS") c.textContent=("Montserrat");
            if(nazione=="MA") c.textContent=("Morocco");
            if(nazione=="MZ") c.textContent=("Mozambique");
            if(nazione=="MM") c.textContent=("Myanmar");
            if(nazione=="NA") c.textContent=("Namibia");
            if(nazione=="NR") c.textContent=("Nauru");
            if(nazione=="NP") c.textContent=("Nepal");
            if(nazione=="NL") c.textContent=("Netherlands");
            if(nazione=="AN") c.textContent=("Netherlands Antilles");
            if(nazione=="NC") c.textContent=("New Caledonia");
            if(nazione=="NZ") c.textContent=("New Zealand");
            if(nazione=="NI") c.textContent=("Nicaragua");
            if(nazione=="NE") c.textContent=("Niger");
            if(nazione=="NG") c.textContent=("Nigeria");
            if(nazione=="NU") c.textContent=("Niue");
            if(nazione=="NF") c.textContent=("Norfolk Island");
            if(nazione=="KP") c.textContent=("North Korea");
            if(nazione=="MP") c.textContent=("Northern Mariana Islands");
            if(nazione=="NO") c.textContent=("Norway");
            if(nazione=="OM") c.textContent=("Oman");
            if(nazione=="PK") c.textContent=("Pakistan");
            if(nazione=="PW") c.textContent=("Palau");
            if(nazione=="PS") c.textContent=("Palestinian Territory");
            if(nazione=="PA") c.textContent=("Panama");
            if(nazione=="PG") c.textContent=("Papua New Guinea");
            if(nazione=="PY") c.textContent=("Paraguay");
            if(nazione=="PE") c.textContent=("Peru");
            if(nazione=="PH") c.textContent=("Philippines");
            if(nazione=="PN") c.textContent=("Pitcairn");
            if(nazione=="PL") c.textContent=("Poland");
            if(nazione=="PF") c.textContent=("Polynesia");
            if(nazione=="PT") c.textContent=("Portugal");
            if(nazione=="PR") c.textContent=("Puerto Rico");
            if(nazione=="QA") c.textContent=("Qatar");
            if(nazione=="RE") c.textContent=("Reunion");
            if(nazione=="RO") c.textContent=("Romania");
            if(nazione=="RU") c.textContent=("Russian Federation");
            if(nazione=="RW") c.textContent=("Rwanda");
            if(nazione=="GS") c.textContent=("S. Georgia &amp; S. Sandwich Isls.");
            if(nazione=="SH") c.textContent=("Saint Helena");
            if(nazione=="KN") c.textContent=("Saint Kitts &amp; Nevis Anguilla");
            if(nazione=="LC") c.textContent=("Saint Lucia");
            if(nazione=="PM") c.textContent=("Saint Pierre and Miquelon");
            if(nazione=="VC") c.textContent=("Saint Vincent &amp; Grenadines");
            if(nazione=="WS") c.textContent=("Samoa");
            if(nazione=="SM") c.textContent=("San Marino");
            if(nazione=="ST") c.textContent=("Sao Tome and Principe");
            if(nazione=="SA") c.textContent=("Saudi Arabia");
            if(nazione=="SN") c.textContent=("Senegal");
            if(nazione=="RS") c.textContent=("Serbia");
            if(nazione=="SC") c.textContent=("Seychelles");
            if(nazione=="SL") c.textContent=("Sierra Leone");
            if(nazione=="SG") c.textContent=("Singapore");
            if(nazione=="SK") c.textContent=("Slovakia");
            if(nazione=="SI") c.textContent=("Slovenia");
            if(nazione=="SB") c.textContent=("Solomon Islands");
            if(nazione=="SO") c.textContent=("Somalia");
            if(nazione=="ZA") c.textContent=("South Africa");
            if(nazione=="KR") c.textContent=("South Korea");
            if(nazione=="ES") c.textContent=("Spain");
            if(nazione=="LK") c.textContent=("Sri Lanka");
            if(nazione=="SD") c.textContent=("Sudan");
            if(nazione=="SR") c.textContent=("Suriname");
            if(nazione=="SZ") c.textContent=("Swaziland");
            if(nazione=="SE") c.textContent=("Sweden");
            if(nazione=="CH") c.textContent=("Switzerland");
            if(nazione=="SY") c.textContent=("Syrian Arab Republic");
            if(nazione=="TW") c.textContent=("Taiwan");
            if(nazione=="TJ") c.textContent=("Tajikistan");
            if(nazione=="TZ") c.textContent=("Tanzania");
            if(nazione=="TH") c.textContent=("Thailand");
            if(nazione=="TG") c.textContent=("Togo");
            if(nazione=="TK") c.textContent=("Tokelau");
            if(nazione=="TO") c.textContent=("Tonga");
            if(nazione=="TT") c.textContent=("Trinidad and Tobago");
            if(nazione=="TN") c.textContent=("Tunisia");
            if(nazione=="TR") c.textContent=("Turkey");
            if(nazione=="TM") c.textContent=("Turkmenistan");
            if(nazione=="TC") c.textContent=("Turks and Caicos Islands");
            if(nazione=="TV") c.textContent=("Tuvalu");
            if(nazione=="UG") c.textContent=("Uganda");
            if(nazione=="UA") c.textContent=("Ukraine");
            if(nazione=="AE") c.textContent=("United Arab Emirates");
            if(nazione=="GB") c.textContent=("United Kingdom");
            if(nazione=="UY") c.textContent=("Uruguay");
            if(nazione=="UM") c.textContent=("USA Minor Outlying Islands");
            if(nazione=="UZ") c.textContent=("Uzbekistan");
            if(nazione=="VU") c.textContent=("Vanuatu");
            if(nazione=="VE") c.textContent=("Venezuela");
            if(nazione=="VN") c.textContent=("Vietnam");
            if(nazione=="VG") c.textContent=("Virgin Islands (British)");
            if(nazione=="VI") c.textContent=("Virgin Islands (USA)");
            if(nazione=="WF") c.textContent=("Wallis and Futuna Islands");
            if(nazione=="EH") c.textContent=("Western Sahara");
            if(nazione=="YE") c.textContent=("Yemen");
            if(nazione=="ZR") c.textContent=("Zaire");
            if(nazione=="ZM") c.textContent=("Zambia");
            if(nazione=="ZW") c.textContent=("Zimbabwe");
            var a = document.getElementById("telephone_number");
            var ind = a.textContent;
            if(ind=='')
            {
              $("#telephone_number").empty();
            }
            if(ind=='')
            {
              $("#telephone_number2").empty();
            }
          });
          </script>
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
              
              $line=pg_fetch_assoc($result);
              $nome=$line["name"];
              $cognome=$line["surname"];
              $username=$line["username"];
              $datanascita=$line["birth_date"];
              $indirizzo=$line["address"];
              $citta=$line["city"];
              $nazione=$line["country"];
              $genere=$line["genre"];
              $date = date('d/m/Y',strtotime($datanascita));
              $contact_email = $line["contact_email"];
              $telephone_number = $line["telephone_number"];
              $curriculum = $line["curriculum"];
              $picture = $line["picture"];

              if(isset($picture))
              {
                $picture = pg_unescape_bytea($picture);
                $filename = "image_$username.png";
                file_put_contents($filename, $picture);
              }
              else
              {
                $filename = "Images/pictureStandard.png";
              }

              echo "
              <div class='grid'>
              <div class='row'>
                  <div class='col-sm-4 my-auto text-left m-3'>

                        <div id='corpoprofilo'> 
                        <h2 class='text-uppercase spaced mb-5' id='title'>Profilo utente</h2> 
                        <img src=$filename id='picture2' class='rounded-circle avatar-lg img-thumbnail' alt='profile-image'>
                        <div class='mt-3' align='left'>
                            <p class='mb-2'><span class='grassetto' id='username2'>Username: </span> <span class='testo-grigio'>$username</span></p>
                            <p class='mb-2'><span class='grassetto'>Nome: </span><span class='testo-grigio'>$nome</span></p>
                            <p class='mb-2'><span class='grassetto'>Cognome: </span> <span class='testo-grigio'>$cognome</span></p>
                            <p class='mb-2'><span class='grassetto'>Genere: </span> <span class='testo-grigio' id='genere'>$genere</span></p>
                            <p class='mb-2'><span class='grassetto'>Data di nascita: </span> <span class='testo-grigio'>$date</span></p>
                            <p class='mb-2'><span class='grassetto' id='indirizzo2'>Indirizzo: </span> <span class='testo-grigio' id='indirizzo' name='nomeNazione'>$indirizzo</span></p>
                            <p class='mb-2'><span class='grassetto' id='citta2'>Città: </span> <span class='testo-grigio' id='citta'>$citta</span></p>
                            <p class='mb-2'><span class='grassetto' id='nazione2'>Nazione: </span> <span class='testo-grigio' id='nazione'>$nazione</span></p>
                            <p class='mb-2'><span class='grassetto'>Contact mail: </span> <span class='testo-grigio' id='contact_email'>$contact_email</span></p>
                            <p class='mb-2'><span class='grassetto' id='telephone_number2'>Telephone number: </span> <span class='testo-grigio' id='telephone_number'>$telephone_number</span></p>
                        </div>
                        </div>
                  </div>";
                echo  "</div>";
                $curriculum = pg_unescape_bytea($curriculum);
                $filename = "storage/$username.pdf";
                file_put_contents($filename, $curriculum);
                echo '
                <object data="'.$username.'.pdf" type="application/pdf" width="100%" height="1000px">
                  <p>Unable to display PDF file.
                  <a href="'.$username.'.pdf">Download</a> instead.</p>
                </object>';

              pg_free_result($result);
              pg_close($dbconn);
              $uida=$_SESSION['uid'];
              if(isset($_SESSION['uid']) && $uida==$uid)
              {
                echo "<div class='group-bottoni'><a href='Logout.php'><button class='btn gold-button shadow-none'><i class='fa-solid fa-right-from-bracket'></i> Logout</button></a></div>";
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
              $company_id=$_GET['uid'];
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
              $logo=$line["logo"];

              if(isset($picture))
              {
                $logo = pg_unescape_bytea($logo);
                $filename = "image_$username.png";
                file_put_contents($filename, $logo);
              }
              else
              {
                $filename = "Images/logoStandard.png";
              }

              echo " <div class='grid'>
              <div class='row'>
                  <div class='col-sm-4 my-auto text-left m-3'>
              
                    <div id='corpoprofilo'> 
                          <h2 class='text-uppercase spaced mb-5' id='title'>Profilo azienda</h2> 
                            <img src=$filename id='logo' class='rounded-circle avatar-lg img-thumbnail' alt='profile-image'>
                            <div class='mt-3'>
                                <p class='mb-2'><span class='grassetto' id='username2'>Username: </span> <span class='testo-grigio'>$username</span></p>
                                <p class='mb-2'><span class='grassetto'>Ragione sociale: </span><span class='testo-grigio'>$company_name</span></p>
                                <p class='mb-2'><span class='grassetto'>Partita IVA: </span> <span class='testo-grigio'>$vat_number</span></p>
                                <p class='mb-2'><span class='grassetto' id='indirizzo2'>Indirizzo: </span> <span class='testo-grigio' id='indirizzo' name='nomeNazione'>$address</span></p>
                                <p class='mb-2'><span class='grassetto' id='citta2'>Città: </span> <span class='testo-grigio' id='citta'>$city</span></p>
                                <p class='mb-2'><span class='grassetto' id='nazione2'>Nazione: </span> <span class='testo-grigio' id='nazione'>$country</span></p>
                                <p class='mb-2'><span class='grassetto'>Descrizione: </span> <span class='testo-grigio'>$description</span></p>
                                <p class='mb-2'><span class='grassetto'>Contact email: </span> <span class='testo-grigio'>$contact_email</span></p>
                                <p class='mb-2'><span class='grassetto' id='telephone_number2'>Telephone number: </span> <span class='testo-grigio' id='telephone_number'>$telephone_number</span></p>
                            </div>
                    </div>
                    </div>";
                echo  "</h6></div></div>";
              pg_free_result($result);
              pg_close($dbconn);
              $uida=$_SESSION['uid'];
              if(isset($_SESSION['uid']) && $uida==$company_id)
              {
                echo "<a href='Logout.php'><button class='btn gold-button shadow-none'><i class='fa-solid fa-right-from-bracket'></i> Logout</button></a></div>";
              }
              else
              {
              }
            }
          }
        ob_end_flush();
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
