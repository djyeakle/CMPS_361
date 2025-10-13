<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$port = "5432";
$dbname = "stats";
$user = "postgres";
$password = "vbnmrno4";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if ($conn) {
    echo "<h3>✅ Connection to PostgreSQL successful!</h3>";
    $result = pg_query($conn, "SELECT version();");
    $row = pg_fetch_row($result);
    echo "<p>PostgreSQL version: $row[0]</p>";
    pg_close($conn);
} else {
    echo "<h3>❌ Connection failed:</h3>";
    echo pg_last_error();
}
?>
