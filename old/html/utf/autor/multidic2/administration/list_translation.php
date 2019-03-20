<?php

require_once("./administration/translation.php");

if (!IsSet($translation_lang_id)) {
  echo "<p>Vyberte jazyk:</p>\n  <p>";
  echo "<form method=\"post\">";
  echo get_translation_chooser();
  echo "<input type=\"submit\" value=\"Dál\" />\n     </form>";
}
else {
  if (!Empty($serad)) {
    print_table_of_translation($translation_lang_id, $order, $od, $limit);
  }
  else {
    print_table_of_translation($translation_lang_id);
  }
}
?>
