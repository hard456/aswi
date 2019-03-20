<?php

function get_count_lines() {
  @$connection = Pg_Connect ("user=dbowner dbname=obtc");
    if (!$connection) {
      return "85 000";
    }
    else {
      $lines = pg_query($connection, "select count(*) from line");
      List($count) = pg_fetch_row($lines, 0, PGSQL_NUM);
      return $count;
    }
}


?>
