<?php
session_start();
$dbconn = pg_connect("host=localhost port=5432 dbname=Intersection user=postgres password=BIAR")  or header("Location: ../app/indexE.php?er=100");
?>

<html>
    <head></head>
<body>
    <?php 
    if(!(isset($_POST["registrationButton"])))
    {
        header("Location: ../app/indexH.php");
    }
    else
    {
        $email=$_POST['emailRA'];
        $q1="select * from azienda where email=$1";
        $result=pg_query_params($dbconn,$q1,array($email));
        $q2="select * from utente where email=$1";
        $r=pg_query_params($dbconn,$q2,array($email));
        if(($line=pg_fetch_array($result,null,PGSQL_ASSOC)) || ($line=pg_fetch_array($r,null,PGSQL_ASSOC)))
        {
          header("Location: ../app/indexE.php?er=1");
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
              header("Location: ../app/indexE.php?er=2");
            }  
            else
            {
                $password=md5($_POST['passwordRA']);
                $q5="select * from azienda where pwd=$1";
                $result2=pg_query_params($dbconn,$q5,array($password));
                $q6="select * from utente where pwd=$1";
                $r2=pg_query_params($dbconn,$q6,array($password));
                if(($line=pg_fetch_array($result2,null,PGSQL_ASSOC)) || ($line=pg_fetch_array($r2,null,PGSQL_ASSOC)))
                {
                  header("Location: ../app/indexE.php?er=3");
                }
                else
                {
                  $iva=$_POST['partitaIva'];
                  $q7="select * from azienda where partita_iva=$1";
                  $result7=pg_query_params($dbconn,$q7,array($iva));
                  if(($line=pg_fetch_array($result7,null,PGSQL_ASSOC)))
                  {
                    header("Location: ../app/indexE.php?er=4");
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
                    $q7="insert into azienda values (DEFAULT,$1,$2,$3,$4,$5,$6,$7,$8,$9, $10, $11)";
                    $data=pg_query_params($dbconn,$q7,array($ragione,$user,$email,$password,$iva,$indirizzo,$citta,$nazione,$des, $emailC, $telefono));
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
                      header("Location: ../app/indexL.php");
                    }
                    }
                }
            }
        }
    }    
    ?>
    </body>
</html>