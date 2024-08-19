<?php
/**
 * Trying to connect
 * HOST='localhost'
 * USER='ROOT'
 * PASSWORD=''
 * DATABASE='hotal_jwd'
 **/

// Create connection
$conn = new mysqli('localhost', 'root', '', 'hotal_jwd');

// Check connection
if (!$conn) {
  die(mysqli_error($conn));
} 
?>