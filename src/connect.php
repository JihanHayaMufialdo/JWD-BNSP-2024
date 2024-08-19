<?php
/**
 * Trying to connect
 * HOST='localhost'
 * USER='ROOT'
 * PASSWORD=''
 * DATABASE='hotel_jwd'
 **/

// Create connection
$conn = new mysqli('localhost', 'root', '', 'hotel_jwd');

// Check connection
if (!$conn) {
  die(mysqli_error($conn));
} 
?>