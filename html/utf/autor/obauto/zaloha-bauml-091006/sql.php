<?php
 $db = "books"; 
 @$connection = Pg_Connect ("user=dbowner dbname=$db");
  if (!$connection):
    echo "Impossible to connect to the SQL database!";
    break;
  endif;
