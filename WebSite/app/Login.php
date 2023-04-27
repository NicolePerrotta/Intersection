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
    if(!(isset($_POST["loginButton"])))
    {
        header("Location: indexLogin.php");
    }
    else
    {
        $email=$_POST['email'];
        $q1= "select * from company where email=$1";
        $result=pg_query_params($dbconn,$q1,array($email));
        $q2="select * from worker where email=$1";
        $r=pg_query_params($dbconn,$q2,array($email));
        if(!(($line=pg_fetch_array($result,null,PGSQL_ASSOC)) || ($line=pg_fetch_array($r,null,PGSQL_ASSOC))))
        { 
          header("Location: indexErrore.php?er=8");
        }
        else
        {
            $password=md5($_POST['password']);
                $q5= "select * from company where password=$1";
                $result2=pg_query_params($dbconn,$q5,array($password));
                $q6="select * from worker where password=$1";
                $r2=pg_query_params($dbconn,$q6,array($password));
            if(!(($array=pg_fetch_array($result2,null,PGSQL_ASSOC)) || ($line=pg_fetch_array($r2,null,PGSQL_ASSOC))))
            {
              header("Location: indexErrore.php?er=9");
            }
            else
            {
                
                $q7= "select * from company where email=$1";
                $result3=pg_query_params($dbconn,$q7,array($email));
                if(!($c=pg_fetch_array($result3,null,PGSQL_ASSOC)))
                {
                    $_SESSION["sa"]=0;
                    $_SESSION["uid"]=$line['worker_id'];
                    $_SESSION["user"]=$line['username'];
                }
                else
                {
                    $_SESSION["sa"]=1;
                    $_SESSION["uid"]=$array['company_id'];
                    $_SESSION["user"]=$array['username'];
                }
                if(isset($r)) pg_free_result($r);
                if(isset($result)) pg_free_result($result);
                if(isset($result2)) pg_free_result($result2);
                if(isset($r2)) pg_free_result($r2);
                if(isset($result3)) pg_free_result($result3);
                pg_close($dbconn); 
                header("Location: index.php");      
            } 
        }    
    }
    ob_end_flush();
    ?>
    </body>
</html>