<?php

require_once("./administration/duplicity.php");

if (!Empty($serad)) {
    print_table_of_duplicity($order, $od, $limit);
}
else {
  print_table_of_duplicity();
}
  

?>
