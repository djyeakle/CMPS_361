<?php 

function logActivity($userId, $activityType, $activityDescription) {

    //Create a db connection
    $host = 'localhost';
    $db = 'stats';
    $user = 'postgres';
    $pass = 'vbnmrno4';
    $port = '5432';

    $conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pass");

    //Validate the connection works
    if(!$conn) {
        die("connection failed: " . pg_last_error());
    }

    //capture IP addresses
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    //add tracking information to the database
    $sql = "insert into user_activity_logging(user_id,activity_type,activity_description,ip_address,user_agent) values($1, $2, $3, $4, $5)";

    //execute the SQL for the insert to the table
    $result = pg_query_params($conn, $sql, array($userId, $activityType, $activityDescription, $ipAddress, $userAgent));

    if(!$result) {
        echo "Error in query execution " . pg_last_error($conn);
    } else {
        echo "Activity logged successfully";
    }

    //close the connection to the database
    pg_close($conn);

}

?>