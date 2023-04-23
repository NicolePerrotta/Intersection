<?php
    $env = parse_ini_file('.env');
    $PGHOST = $env['PGHOST'];
    $PGPORT = $env['PGPORT'];
    $PGDATABASE = $env['PGDATABASE'];
    $PGUSER = $env['PGUSER'];
    $PGPASSWORD = $env['PGPASSWORD'];
session_start();
$dbconn = pg_connect("host=$PGHOST port=$PGPORT dbname=$PGDATABASE user=$PGUSER password=$PGPASSWORD")  or header("Location: ../app/indexErrore.php?er=100");
?>

<html>
    <head></head>
<body>
    <?php 
    if(!(isset($_POST["registrationButton"])))
    {
        header("Location: ../app/index.php");
    }
    else
    {
        $email=$_POST['emailR'];
        $q1="select * from azienda where email=$1";
        $result=pg_query_params($dbconn,$q1,array($email));
        $q2="select * from utente where email=$1";
        $r=pg_query_params($dbconn,$q2,array($email));
        if(($line=pg_fetch_array($result,null,PGSQL_ASSOC)) || ($line=pg_fetch_array($r,null,PGSQL_ASSOC)))
        {
          header("Location: ../app/indexErrore.php?er=1");
        }
        else
        {
            $user=$_POST['username'];
            $q3="select * from azienda where username=$1";
            $result1=pg_query_params($dbconn,$q3,array($user));
            $q4="select * from utente where username=$1";
            $r1=pg_query_params($dbconn,$q4,array($user));
            if(($line=pg_fetch_array($result1,null,PGSQL_ASSOC)) || ($line=pg_fetch_array($r1,null,PGSQL_ASSOC)))
            {
              header("Location: ../app/indexErrore.php?er=2");
            }  
            else
            {
                $password=md5($_POST['passwordR']);
                $q5="select * from azienda where pwd=$1";
                $result2=pg_query_params($dbconn,$q5,array($password));
                $q6="select * from utente where pwd=$1";
                $r2=pg_query_params($dbconn,$q6,array($password));
                if(($line=pg_fetch_array($result2,null,PGSQL_ASSOC)) || ($line=pg_fetch_array($r2,null,PGSQL_ASSOC)))
                {
                  header("Location: ../app/indexErrore.php?er=3");
                }
                else
                { 
                    $nome=$_POST['nome'];
                    $cognome=$_POST['cognome'];
                    $indirizzo=$_POST['indirizzo'];
                    $citta=$_POST['città'];
                    $nascita=$_POST['dataDiNascita'];
                    $nazione=$_POST['nazione'];
                    $genere=$_POST['genere'];
                    $emailC=$_POST['emailC'];
                    $telefono=$_POST['telefono'];
                    $curriculum=$_POST['curriculum'];



                    $filename = $_POST['curriculum'];
                    $handler = fopen($filename, 'rb');
                    if (false === $handler) {
                        printf('Impossibile aprire il file %s', $filename);
                        exit;
                    }
                    fclose($handler);




                    $picture=$_POST['picture']; 


                    $filename = $_POST['picture'];
                    $handler = fopen($filename, 'rb');
                    if (false === $handler) {
                        printf('Impossibile aprire il file %s', $filename);
                        exit;
                    }
                    fclose($handler);



                    $q7="insert into utente values (DEFAULT,$1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14)";
                    $data=pg_query_params($dbconn,$q7,array($nome,$cognome,$user,$email,$password,$nascita,$indirizzo,$citta,$nazione,$genere,$emailC,$telefono,$curriculum,$picture));
                    if($data)
                    {
                      if(isset($r)) pg_free_result($r);
                      if(isset($result)) pg_free_result($result);
                      if(isset($result1)) pg_free_result($result1);
                      if(isset($r1)) pg_free_result($r1);
                      if(isset($result2)) pg_free_result($result2);
                      if(isset($r2)) pg_free_result($r2);
                      if(isset($data)) pg_free_result($data);
                      pg_close($dbconn); 
                      header("Location: ../app/indexLogin.php");
                    }
                }
            }
        }
    }    
    ?>
    </body>
</html>
