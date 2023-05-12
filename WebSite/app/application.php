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
    $eid=$_POST['eid'];
    if(!(isset($_POST["partecipazione"])))
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    else
    {
        if(!isset($_SESSION['uid']) || (isset($_SESSION['sa']) && $_SESSION['sa']==1))
        {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        else
        {
            
            $uid=$_SESSION['uid'];
            $q2="select * from applies_to where worker_id =$1 and offer_id=$2 Limit 10";
            $result2=pg_query_params($dbconn,$q2,array($uid,$eid));
            if(pg_num_rows($result2)>0)
            {
                $q1="delete from applies_to where worker_id=$1 and offer_id=$2";
                $res1=pg_query_params($dbconn,$q1,array($uid,$eid));
                if(isset($res1)) pg_free_result($res1);
                if(isset($result2)) pg_free_result($result2);
                pg_close($dbconn);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
            else 
            {
              $q1="insert into applies_to values ($1,$2)";
              $res1=pg_query_params($dbconn,$q1,array($eid,$uid));
              if(isset($res1)) pg_free_result($res1);
              if(isset($result2)) pg_free_result($result2);
              pg_close($dbconn);
              header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }
    ob_end_flush();    
    ?>
    </body>
</html>