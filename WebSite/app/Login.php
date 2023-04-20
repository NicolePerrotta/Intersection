<?php
session_start();
$dbconn = pg_connect("host=containers-us-west-28.railway.app port=5622 dbname=railway user=postgres password=4jydJNhTKikgVEnDhUlv")  or header("Location: ../app/indexErrore.php?er=100");
?>
<html>
    <head></head>
<body>
    <?php
    if(!(isset($_POST["loginButton"])))
    {
        header("Location: ../app/indexLogin.php");
    }
    else
    {
        $email=$_POST['email'];
        $q1="select * from azienda where email=$1";
        $result=pg_query_params($dbconn,$q1,array($email));
        $q2="select * from utente where email=$1";
        $r=pg_query_params($dbconn,$q2,array($email));
        if(!(($line=pg_fetch_array($result,null,PGSQL_ASSOC)) || ($line=pg_fetch_array($r,null,PGSQL_ASSOC))))
        { 
          header("Location: ../app/indexErrore.php?er=8");
        }
        else
        {
            $password=md5($_POST['password']);
                $q5="select * from azienda where pwd=$1";
                $result2=pg_query_params($dbconn,$q5,array($password));
                $q6="select * from utente where pwd=$1";
                $r2=pg_query_params($dbconn,$q6,array($password));
            if(!(($array=pg_fetch_array($result2,null,PGSQL_ASSOC)) || ($line=pg_fetch_array($r2,null,PGSQL_ASSOC))))
            {
              header("Location: ../app/indexErrore.php?er=9");
            }
            else
            {
                
                $q7="select * from azienda where email=$1";
                $result3=pg_query_params($dbconn,$q7,array($email));
                if(!($c=pg_fetch_array($result3,null,PGSQL_ASSOC)))
                {
                    $_SESSION["sa"]=0;
                    $_SESSION["uid"]=$line['id_user'];
                    $_SESSION["user"]=$line['username'];
                }
                else
                {
                    $_SESSION["sa"]=1;
                    $_SESSION["uid"]=$array['id_azienda'];
                    $_SESSION["user"]=$array['username'];
                }
                if(isset($r)) pg_free_result($r);
                if(isset($result)) pg_free_result($result);
                if(isset($result2)) pg_free_result($result2);
                if(isset($r2)) pg_free_result($r2);
                if(isset($result3)) pg_free_result($result3);
                pg_close($dbconn); 
                header("Location: ../app/index.php");      
            } 
        }    
    }
    ?>
    </body>
</html>