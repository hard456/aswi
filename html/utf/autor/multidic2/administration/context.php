<?php 
//NOVE2504 cely soubor
require_once("./functions/dictionary.php");


function link_context($context_id, $word_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  
  $dotaz = "UPDATE dict SET context = '".AddSlashes($context_id)."'
                        WHERE \"IDdict\" = '".AddSlashes($word_id)."'";
  $spojeni->query($dotaz);
  
  if ($spojeni->Errno != 0) {
    print_hlasku("Bohužel, vybraný kontext se nepodařilo připojit.");
    echo_zpet_do_slovniku();
    return false;
  }
  print_hlasku ("Kontext připojen..");
  echo_zpet_do_slovniku();
  return true;  
}


function insert_context($cz_context, $en_context, $org_context, $word_id, $source_id, $isVoice){
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  
  $pomoc = ($isVoice)? 1 : 0;
  $dotaz = "INSERT INTO context (cz_context, 
                                 en_context,
                                 orig_context, 
                                 source, 
                                 voice)
                    VALUES ('$cz_context', 
                            '$en_context',
                            '$org_context', 
                            '$source_id', 
                            '$pomoc')";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Bohužel, kontext '$cz_context - $en_context' se nepodařilo přidat.");
    echo_zpet_do_slovniku();
    return false;
  }
  $dotaz = "SELECT \"IDcontext\" FROM context WHERE 
                              cz_context LIKE '$cz_context' AND
                              en_context LIKE '$en_context' AND
                              orig_context LIKE '$org_context'";
  $spojeni->query($dotaz);
  $spojeni->next_record();
  $context_id = $spojeni->Record[0];
  
  $dotaz = "UPDATE dict SET context = '".AddSlashes($context_id)."'
                        WHERE \"IDdict\" = '".AddSlashes($word_id)."'";
  $spojeni->query($dotaz);
  
  print_hlasku ("Kontext přidán..");
  echo_zpet_do_slovniku();
  return true;
}

function delete_context($context_id, $word_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  
  /*$dotaz = "DELETE FROM context WHERE IDcontext LIKE $context_id";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    return false;
  }*/
  $dotaz = "UPDATE dict SET context = '0'
                        WHERE \"IDdict\" = '".AddSlashes($word_id)."'";
  $spojeni->query($dotaz);
  return true;
  
}

function update_context($cz_context, $en_context, $org_context, $context_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();

  $dotaz = "UPDATE context SET cz_context = '".AddSlashes($cz_context)."', 
                            en_context = '".AddSlashes($en_context)."',
                            orig_context = '".AddSlashes($org_context)."'
                            WHERE \"IDcontext\" = '".AddSlashes($context_id)."'";
  $spojeni->query($dotaz);
  if ($spojeni->Errno != 0) {
    print_hlasku("Kontext se nepodařilo upravit.");
  }
  print_hlasku("Kontext změněn.");
  echo_zpet_do_slovniku();
}

function get_context($context_id) {
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * FROM context WHERE \"IDcontext\" LIKE '$context_id'";
  $radky = $spojeni->query($dotaz);
  $spojeni->next_record();

  if ($spojeni->Errno != 0) {
    print_hlasku("Kontext se nepodařilo načíst.");
  }

  return $spojeni->Record;
}

?>
