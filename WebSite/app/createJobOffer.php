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
    if(!(isset($_POST["creationButton"])))
    {
        header("Location: index.php");
    }
    else
    {
        if(!isset($_SESSION['uid']) || (isset($_SESSION['sa']) && $_SESSION['sa']==0))
        {
            header("Location: index.php");
        }
        else
        {
            $company_id=$_POST['uid'];
            $title=$_POST['title'];
            $description=$_POST['description'];
            $salary=$_POST['salary'];
            $period=$_POST['period'];
     
            $data = array('text' => $description);  
            $data = json_encode($data);                 
            $url = "https://algorithm-api-production.up.railway.app/convert/string";
            $curl = curl_init($url);
            $headers = array(
                "Content-Type: application/json"
            );
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($curl);
            curl_close($curl);
            if($response === false)
            {
                echo "Error: API not found";
            }
            else if($response == NULL)
            {
                echo "Error: response=null";
            }
            else
            {
                $response = json_decode($response);   
                $embedding = ($response->embedding);
            }
            $formatted = pg_escape_string(implode(',',$embedding));

            $q1="insert into job_offer values (DEFAULT,$1,$2,$3,$4,$5,$6)";
            $line=pg_query_params($dbconn,$q1,array($company_id,$title,$description,$salary,$period, "{{$formatted}}"));
            if($line)
            {           
                header("Location: indexJobOffer.php?uid=".$company_id."&sa=1");
            }
            else
            {
                header("Location: indexErrore.php?er=7");
            }
    }
    if(isset($line)) pg_free_result($line);  
    pg_close($dbconn); 
    ob_end_flush(); 
    }  
    ?>
    </body>
</html>