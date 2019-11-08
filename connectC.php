<?php
//  define ("DB_HOST", "localhost"); // set database host

//  define ("DB_USER", "root"); // set database user

//  define ("DB_PASS",""); // set database password

//  define ("DB_NAME","ada_art"); // set database name

//  $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS,DB_NAME) or die("Couldn't make connection.");


define ("DB_HOST", "remotemysql.com"); // set database host

define ("DB_USER", "MW9hCGSJuv"); // set database user

define ("DB_PASS","G5uWzmqnKg"); // set database password

define ("DB_NAME","MW9hCGSJuv"); // set database name

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Couldn't make connection.");

 
 
?>