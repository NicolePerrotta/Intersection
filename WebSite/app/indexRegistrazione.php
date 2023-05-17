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
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="generator" content="Visual Studio Code">

        <title>Intersection</title>
        <link rel="icon" href="Images/favicon.jpg" type="favicon">

        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> <!--BOOTSTRAP CI SERVE?-->
        <link rel="stylesheet" type="text/css" href="Registrazione/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css"> <!--FONTAWESOME CI SERVE?-->

        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script> <!--BOOTSTRAP CI SERVE?-->

        <!--Titles font-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@500&display=swap" rel="stylesheet">

        <!--PER LA REGISTRAZIONE--> 
        <script type="application/javascript" src="reveal.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
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
  <script>
    $(document).ready(function()
    {
        $("#erroreEmail").hide();
        $("#errorePassword").hide();
        $("#erroreEta").hide();
        $("#erroreEta2").hide();
    })
 
    //Registrazione
    function validaRegistrazione()
    {   
        var b=true;
        if(document.formRegistrazione.emailR.value!=document.formRegistrazione.emailR2.value)
        {
            $("#erroreEmail").show();
            location.href = "#emailR";
            b=false;
        }
        else
        {
            $("#erroreEmail").hide();
        }
        if(document.formRegistrazione.passwordR.value!=document.formRegistrazione.passwordR2.value)
        {
            $("#errorePassword").show();
            if(b==true) location.href = "#passwordR";
            b=false;
        }
        else
        {
            $("#errorePassword").hide();
        }
        const datanascita = document.formRegistrazione.dataDiNascita.value;
        const years = calcAge(datanascita);
        if(years<18)
        {
            $("#erroreEta").show();
            if(b==true) location.href = "#dataDiNascita";
            b=false;
        }
        else
        {
            $("#erroreEta").hide();
        }
        if(years>150)
        {
            $("#erroreEta2").show();
            if(b==true) location.href = "#dataDiNascita";
            b=false;
        }
        else
        {
            $("#erroreEta2").hide();
        }
        return b;
    }

    function calcAge (birthday)
    {
        var today = new Date();
        var birthDate = new Date(birthday);
        var years = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate()))
        {
            years--;
        }
        return years;
    }
 </script> 

    <div id="content">
    <form action="RegistrazioneUtente.php" class="form-signin bg-light" method="POST" name="formRegistrazione" id="form-registrazione" onSubmit="return validaRegistrazione()" enctype="multipart/form-data">
      <h4 id="log" class="mb-3 text-uppercase gold-text text-bold">Crea Nuovo Account</h4>
    <div>
        <label for="nome">Nome*</label> <br>
        <input type="text" id="nome" name="nome" placeholder="Inserisci il tuo nome*" minlength="2" maxlength="30" required>
    </div>
    <br>
    <div>
        <label for="cognome">Cognome*</label> <br>
        <input type="text" id="cognome" name="cognome" placeholder="Inserisci il tuo cognome*" minlength="2" maxlength="60" required>
    </div>
    <br>
    <div>
        <label for="username">Nome utente*</label> <br>
        <input type="text" id="username" name="username" placeholder="Inserisci il tuo username*" minlength="2" maxlength="30" required>
    </div>
    <br> 
    <div>
        <label for="emailR">Email*</label> <br>
        <input type="text" id="emailR" name="emailR" placeholder="Inserisci la tua email*" maxlength="60"  pattern="*[a-z]@*[a-z]" required>
    </div>
    <br>
    <div>
        <label for="emailR2">Conferma email*</label> <br>
        <input type="text" id="emailR2" name="emailR2" placeholder="Conferma la tua email*" maxlength="60" pattern="*[a-z]@*[a-z]" required>
    </div>
    <div id="erroreEmail" class="error-msg"><i class="fa-solid fa-triangle-exclamation"></i> Email di conferma errata</div>
    <br>
    <span>
        <label for="passwordR">Password*</label> <br>
        <input type="text" id="passwordR" name="passwordR" placeholder="Inserisci la tua password*" minlength="8" maxlength="32" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
    </span>
    <div id="end">La password deve essere di almeno 8 caratteri (fino a 32) e contenere almeno un numero, una lettera minuscola e una lettera maiuscola.</div>
    <br>
    <div>
        <label for="passwordR2">Conferma password*</label> <br>
        <input type="text" id="passwordR2" name="passwordR2" placeholder="Conferma la tua password*" minlength="8" maxlength="32" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
    </div>
    <div id="errorePassword" class="error-msg"><i class="fa-solid fa-triangle-exclamation"></i> Password di conferma errata</div>
    <br>
    <span>
        <label for="dataDiNascita">Data di nascita*</label> <br>
        <input type="text" id="dataDiNascita" name="dataDiNascita" placeholder="Inserisci la tua data di nascita* (gg/mm/aaaa)" minlength="5" maxlength="11" pattern="[0-9]{2,}/[0-9]{2}/[0-9]{4,}" required>
    </span>
    <div id="end">L'età minima per effettuare l'iscrizione è di 18 anni.</div>
    <div id="erroreEta" class="error-msg"><i class="fa-solid fa-triangle-exclamation"></i>Età inferiore ai 18 anni</div>
    <div id="erroreEta2" class="error-msg"><i class="fa-solid fa-triangle-exclamation"></i>Età errata</div>
    <div>
        <label for="indirizzo">Indirizzo</label> <br>
        <input type="text" id="indirizzo" name="indirizzo" placeholder="Inserisci il tuo indirizzo" minlength="5" maxlength="60">
    </div>
    <div>
        <label for="città">Città</label> <br>
        <input type="text" id="città" name="città" placeholder="Inserisci città" minlenght="2" maxlength="30">
    </div>
    <div>
        <label for="nazione">Nazione</label> <br>
        <select id="nazione" name="nazione">
            <option value="nessuna" selected></option></option>
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
    <div class="col-md-12 mt-3">
        <label class="mb-3 mr-1" for="gender">Genere*</label> <br>
            <input type="radio" class="btn-check" name="genere" id="maschio" value="Maschio" onClick="genere=this.value;" autocomplete="off" require>
            <label class="btn btn-sm btn-outline-secondary" for="maschio">Maschio</label>
            <input type="radio" class="btn-check" name="genere" id="femmina" value="Femmina" onClick="genere=this.value;" autocomplete="off" required>
            <label class="btn btn-sm btn-outline-secondary" for="femmina">Femmina</label>
            <input type="radio" class="btn-check" name="genere" id="altro" value="Altro" onClick="genere=this.value;" autocomplete="off" required>
            <label class="btn btn-sm btn-outline-secondary" for="altro">Altro</label>
            <div class="valid-feedback mv-up">Hai selezionato un genere!</div>
            <div class="invalid-feedback mv-up">Per favore seleziona un genere!</div>
    </div>
    <br> 
    <div>
        <label for="emailC">Email di contatto*</label> <br>
        <input type="text" id="emailC" name="emailC" placeholder="Inserisci la tua email di contatto*" maxlength="60"  pattern="*[a-z]@*[a-z].*[a-z]" required>
    </div>
    <br>
    <div>
        <label for="telefono">Numero di telefono</label> <br>
        <input type="text" id="telefono" name="telefono" placeholder="Inserisci il tuo numero di telefono" maxlength="60"  pattern="*[0-9]">
    </div>
    <br>
    <div>
        <label for="curriculum">Curriculum*</label> <br>
        <input type="file" id="curriculum" name="curriculum" class="custom-file-upload" required>
    </div>
    <br>
    <div>
        <label for="picture">Foto profilo</label> <br>
        <input type="file" id="picture" name="picture" class="custom-file-upload">
    </div>
    <div class="text-center">
      <button type="submit" name="registrationButton" class="btn-lg" id="register-button">Invia</button>
    </div>
    <br>
    <div id="end">I campi contrassegnati con * sono obbligatori</div>
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
          &copy;2023 Intersection <br><img src="Images/favicon.jpg" id="favi">
        </div>
      </footer>
    </body>
</html>