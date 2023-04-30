<?php
    ob_start();
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
session_start();
$dbconn = pg_connect("host=$PGHOST port=$PGPORT dbname=$PGDATABASE user=$PGUSER password=$PGPASSWORD")  or header("Location: indexErrore.php?er=100");
?>
<html>
    <head></head>
<body>
    <?php 
    if(!(isset($_POST["registrationButton"])))
    {
        header("Location: index.php");
    }
    else
    {
        $email=$_POST['emailRA'];
        $q1="select * from company where email=$1";
        $result=pg_query_params($dbconn,$q1,array($email));
        $q2="select * from worker where email=$1";
        $r=pg_query_params($dbconn,$q2,array($email));
        if(($line=pg_fetch_array($result,null,PGSQL_ASSOC)) || ($line=pg_fetch_array($r,null,PGSQL_ASSOC)))
        {
          header("Location: indexErrore.php?er=1");
        }
        else
        {
            $user=$_POST['username'];
            $q3="select * from company where username=$1";
            $result1=pg_query_params($dbconn,$q3,array($user));
            $q4="select * from worker where username=$1";
            $r1=pg_query_params($dbconn,$q4,array($user));
            if(($line=pg_fetch_array($result1,null,PGSQL_ASSOC)) || ($line=pg_fetch_array($r1,null,PGSQL_ASSOC)))
            {
              header("Location: indexErrore.php?er=2");
            }  
            else
            {
                $password=md5($_POST['passwordRA']);
                $q5="select * from company where password=$1";
                $result2=pg_query_params($dbconn,$q5,array($password));
                $q6="select * from worker where password=$1";
                $r2=pg_query_params($dbconn,$q6,array($password));
                if(($line=pg_fetch_array($result2,null,PGSQL_ASSOC)) || ($line=pg_fetch_array($r2,null,PGSQL_ASSOC)))
                {
                  header("Location: indexErrore.php?er=3");
                }
                else
                {
                  $iva=$_POST['partitaIva'];
                  $q7="select * from company where vat_number=$1";
                  $result7=pg_query_params($dbconn,$q7,array($iva));
                  if(($line=pg_fetch_array($result7,null,PGSQL_ASSOC)))
                  {
                    header("Location: indexErrore.php?er=4");
                  }
                  else
                  {
                    $ragione=$_POST['ragsociale'];
                    $indirizzo=$_POST['indirizzo'];
                    $citta=$_POST['città'];
                    $nazione=$_POST['nazione'];
                    $des=$_POST['descrizione'];
                    $iva=$_POST['partitaIva'];
                    $emailC=$_POST['emailC'];
                    $telefono=$_POST['telefono'];
                    $logo=$_POST['logo'];

                    if(isset($_FILES['logo'])&&$_FILES['logo']['size']>0){
                      $fi =  $_FILES['logo']['tmp_name'];
                      $p=fopen($fi,'rb');
                      $data=fread($p,filesize($fi));
                      $logo= pg_escape_bytea($data);
                    }

                    $q7="insert into company values (DEFAULT,$1,$2,$3,$4,$5,$6,$7,$8,$9, $10, $11, $12)";
                    $data=pg_query_params($dbconn,$q7,array($ragione,$user,$email,$password,$iva,$indirizzo,$citta,$nazione,$des, $emailC, $telefono, $logo));
                    if($data)
                    {
                      if(isset($r)) pg_free_result($r);
                      if(isset($result)) pg_free_result($result);
                      if(isset($result1)) pg_free_result($result1);
                      if(isset($r1)) pg_free_result($r1);
                      if(isset($result2)) pg_free_result($result2);
                      if(isset($r2)) pg_free_result($r2);
                      if(isset($result7)) pg_free_result($result7);
                      if(isset($data)) pg_free_result($data);
                      pg_close($dbconn); 
                      header("Location: indexLogin.php");
                    }
                    }
                }
            }
        }
    }
    ob_end_flush();   
    ?>
    </body>
</html>
