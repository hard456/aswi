<?
  @$connection = Pg_Connect ("user=dbowner dbname=books");
  if (!$connection):
    echo "Impossible to connect to the SQL database!";
    break;
  endif;
?>
