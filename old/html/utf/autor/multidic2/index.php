<?php
session_start();
require_once("./functions/dictionary.php");
if (!Empty($_GET['akce']) && $_GET['akce'] == "odhlasit") {
  $hlaska = lang("Byl jste odhlasen!!!");
  $ses_nick = NULL;
  $ses_name = NULL;
  $ses_surname = NULL;
  $ses_privileges = NULL;
  $ses_date_last_visit = NULL;
  $ses_IDuser = NULL;
  $pomoc = $LaId;
    //$echo = $LaId;
  session_unset();
    //$echo .= " - ".$pomoc;
  session_start();
  session_register("LaId");
  $LaId = $pomoc;
    //$echo .= " - ".$LaId;
}
if (!Empty($_GET['set_lang'])) {
  session_register("LaId");
  $LaId = $_GET['set_lang'];
}
//session_unset();
$ses_privileges = NULL;
if (!Empty($_POST['n']) && !Empty($_POST['p'])):
  require_once("./classes/db.php");
  $spojeni = new DB_Sql();
  $dotaz = "SELECT * 
             FROM \"user\"
             WHERE nick LIKE '".$_POST['n']."'";
  $spojeni->query($dotaz);
  
      
    if ($spojeni->num_rows() == 1):
      $spojeni->next_record();
        //p_g($spojeni->Record);
         if ($_POST['p'] != $spojeni->Record["pass"]) {
            $hlaska = lang("Heslo je nesprávné!!!");
            $p = "";
         }
         else {
            
            session_start();
            
            $_SESSION["ses_nick"] = $spojeni->Record["nick"];
            $_SESSION["ses_name"] = $spojeni->Record["name"];
            $_SESSION["ses_surname"] = $spojeni->Record["surname"];
            $_SESSION["ses_privileges"] = $spojeni->Record["privileges"];
            $_SESSION["ses_date_last_visit"] = time();
            $_SESSION["ses_IDuser"] = $spojeni->Record["IDuser"];
            
            $number_of_usage = $spojeni->Record["number_of_usage"];
            $number_of_usage++;
             
            //$NOW = Date("Y-m-d H:i:s+02");
            $dotaz = "UPDATE \"user\" SET date_last_visit = now(),
                                      number_of_usage = '$number_of_usage'
                            WHERE \"IDuser\" = ".$_SESSION["ses_IDuser"];
            $spojeni->query($dotaz);
            
            clean_old_examinations($ses_IDuser);
            if ( !empty($_REQUEST['action']) && $_REQUEST['action'] == 'select_lection')
              Header ("Location: examination.php?nav_id=new_exam&action=select_lection&source=".urlencode($_REQUEST['source'])."&lection=".urlencode($_REQUEST['lection']));
            else
              //p_g($_SESSION);
              Header ("Location: examination.php?poprve=$poprve");
            exit;
         }
      else:
         $hlaska = lang("Nick neexistuje !!!");
         $p = "";
         $n = "";
      endif;
elseif(Empty($_POST['send']) || $_POST['send'] != lang("Přihlásit")):
   $hlaska = "";
    ;
else:
   $hlaska = lang("Nebyl vyplněn celý formulář!!!");
endif;
// PROGRAM
require_once("./functions/dictionary.php");
require_once("./examination/article.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="cs" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <title>
      <?php echo lang("Vstup do slovníku katedry blízkovýchoních studií"); ?>
    </title>
    <link rel="stylesheet" type="text/css" href="css/kbs.css" />
    <script src="functions/popup.js" type="text/javascript"></script>
  </head>
  <body style="text-align: center">
    <h1>
      <?php echo lang("Arabsko - anglicko - český studijní slovník 2005-2006");?></h1>
    <h3 class="nadpis2">
      <?php echo lang("Katedra blízkovýchodních studíí FF ZČU v Plzni");?></h3>
    <div id="page">
      <div id="contenti">
        <div id="lefti">
          <h2 class="nadpis2">
            <?php echo lang("Antologie arabských textů"); ?></h2>
          <div style="text-align:right">
            <?php echo get_short_table_of_article(); ?>
          </div>
          <br />
          <br />
          <?php if(!empty($_REQUEST['view_article'])): ?>
            <a href="?language=<?php echo $_REQUEST['language']?>"><?php echo lang("Volné hledání ve slovníčku"); ?></a> 
          <?php endif;?>
        </div>
        <!-- end of lefit -->
        <div id="envelope">
          <div id="main">     
          
      <?php if(empty($_REQUEST['view_article'])): ?>
      
                        
<?php
if (Empty($_REQUEST['language']))
  $_REQUEST['language'] = 'ar';
switch ($_REQUEST['language']) {
  case("cz"):
    $vyzva = lang("Zadejte slovo v češtině:");
    $klavesnice = false;
  break;    
  case("en"):
    $vyzva = lang("Zadejte slovo v angličtině:");
    $klavesnice = false;
  break;
  case("ar"):
  default:  
    $vyzva = lang("Zadejte slovo v arabštině:");
    $klavesnice = true;    
    $_REQUEST['language'] = "ar";    
  break;
}
            ?>
                        
            <h2 class="nadpis2">
              <?php echo lang("Volné hledání ve slovníčku"); ?></h2>
              
              <center>
              <table style="text-align: center">
                <tr>
                  <td class="akt">
<?php 
            $pomocna = lang("z češtiny");  
           if ( $_REQUEST['language'] != "cz" )  echo "<a href=\"?language=cz\">&raquo;$pomocna&laquo;</a>&nbsp;&nbsp;\n"; 
           else                      echo "&raquo; $pomocna &laquo;&nbsp;&nbsp;\n";
           
            $pomocna = lang("z angličtiny");  
           if ( $_REQUEST['language'] != "en" )  echo "<a href=\"?language=en\">&raquo;$pomocna&laquo;</a>&nbsp;&nbsp;\n"; 
           else                      echo "&raquo; $pomocna &laquo;&nbsp;&nbsp;\n";
           
            $pomocna = lang("z arabštiny");  
           if ( $_REQUEST['language'] != "ar" )  echo "<a href=\"?language=ar\">&raquo;$pomocna&laquo;</a>&nbsp;&nbsp;\n"; 
           else                      echo "&raquo; $pomocna &laquo;&nbsp;&nbsp;\n";
                    ?>
                  </td>
                </tr>
              </table>
              </center>
<?php
if (!Empty($actione) && $actione == "translate") {
  require_once("./functions/dictionary.php");
  print_translation($text1, $_REQUEST['language']);
}
switch ($_REQUEST['language']) {
  case("en"):
    $vyzva = lang("Zadejte slovo v angličtině:");
    $klavesnice = false;
  break;
  case("ar"):
    $vyzva = lang("Zadejte slovo v arabštině:");
    $klavesnice = true;    
  break;
  case("cz"):
    $vyzva = lang("Zadejte slovo v češtině:");
    $klavesnice = false;
}
            ?>

              <form name="translate_form" action="index.php" method="post">
               <center>
                <table style="text-align: center">
                  <tr class="akt">
                    <!--td class="akt">
                    <?php
                    echo $vyzva;
                    ?>
                    </td-->
                    <td<?php if($klavesnice) echo' dir="rtl"';?>>
                      <input type="text" name="text1" <?php                  if($klavesnice) echo ' class="arabic" size="19"';         else            echo ' size="45"';         ?> />
                      </td>
                      <td>
                        <input type="submit" value="<?php echo lang("Přelož") ?>" />
                        <input type="hidden" name="language" value="<?php echo $language?>" />
                        <input type="hidden" name="actione" value="translate" />
                      </td>
                  </tr>
                </table>
                
<?php 
  if($klavesnice) {
    require("./functions/keyboard.php");
    insert_keyboard("translate_form.text1");
  }
                ?>
                </center>
                <?php translation_chooser(); ?>
                <h6>
                  <a href="about-us.php">
                    <?php echo lang("O autorech a sponzorech"); ?></a>
                </h6>
                </form>
                <?php else: // if ( !empty($_REQUEST['view_article']) ): ?>
                
                <?php
                $article = get_article($_REQUEST['view_article']);
                //print_r($article);
                ?>
    <div class="articlecard">
       <h2 class="arabic"> <?php echo $article["title"]?> </h2>
       <p class="arabic">&nbsp;&nbsp;&nbsp;<?php echo $article["body"]?></p>
       <p>&nbsp;&nbsp;&nbsp; <b>zdroj:</b> <?php echo $article["source"]?></p>
       <p>&nbsp;&nbsp;&nbsp; <b>lekce:</b> <?php echo $article["lection"]?></p>
       <p>&nbsp;&nbsp;&nbsp;
       <?php    if (!Empty($article["article_voice"])) 
               echo '<a href="'.CESTA_CLANKU.$article['IDarticle'].PRIPONA.'"> '. lang('Přehrát zvuk').' </a>'; 
    ?></p>
    
    <p>&nbsp;&nbsp;&nbsp; <a href="article_print.php?view_article=<?php echo $_REQUEST['view_article']; ?>" 
                             onclick="OpenPopUp('article_print.php?view_article=<?php echo $_REQUEST['view_article']; ?>', 800, 750); return false" 
                             target="_blank">tisk</a></p>
    </div>            
                
                <?php endif; // ( empty($_REQUEST['view_article']) )?>
                <br />
                <a href="http://www.rozhlas.cz/plzen/portal/">
                  <img src="pict/cr.gif" alt="logo Cesky Rozhlas" />
                </a>                                   
          </div>
          <!-- end of main -->
          <div id="righti">                                                
            <form action="index.php" method="post" name="login_form">
              <h3 class="nadpis2">
                <?php 
                if ( !empty($_REQUEST['view_article']) )
                  echo lang("Zkoušení slovíček k vybranému článku");
                else
                  echo lang("Vstup do studijního slovníku"); ?>
              </h3>
              <?php if (!Empty($hlaska)) print_hlasku($hlaska) ?>
              <div style="text-align: center">
                <center>
                  <table style="text-align: center" width="160">
                    <tr class="akt">
                      <td width="50%" align="right">
                        <?php echo lang("Login:") ?>
                      </td>
                      <td width="50%"  align="left">
                        <input type="text" name="n" value="<?php echo $n ?>" size="11" />
                      </td>
                    </tr>
                    <tr class="akt">
                      <td width="50%" align="right">
                        <?php echo lang("Heslo:") ?>
                      </td>
                      <td width="50%"  align="left">
                        <input type="password"  name="p" value="<?php echo $p ?>" size="11" />
                      </td>
                    </tr>
                    <tr class="nadpis_sekce">
                      <td width="50%" align="right">
                        &nbsp;
                      </td>
                      <td width="50%"  align="left">
                        <input type="submit"  name="send" value="<?php echo lang("Přihlásit") ?>"  />
                        <?php if( !empty($_REQUEST['view_article']) ): ?>
                          <input type="hidden" name="action" value="select_lection" />
                          <input type="hidden" name="source" value="<?php echo $article['IDsource']?>" />
                          <input type="hidden" name="lection" value="<?php echo $article['lection']?>" />
                        <?php endif; ?>
                      </td>
                    </tr>
                  </table>
                </center>
              </div>
            </form>
            <h6>
              <a href="new_registration.php">
                <?php echo lang("Registrace nového uživatele") ?></a>
            </h6>
            <h6>
              <a href="index_to_admin.php">
                <?php echo lang("Vstup do administrace") ?></a>
            </h6>
            <?php insert_picture("orazekuvod"); ?>
<script language="javascript" type="text/javascript">
<!--
var uname = document.login_form.n;
var pword = document.login_form.p;
if (uname.value == "") {
uname.focus();
} else {
pword.focus();
}
-->
</script>                                    
          </div>
          <!-- end of righti -->
        </div>
        <!-- end of envelope -->
      </div>
      <!-- end of contenti -->
      <div style="clear: both;">
      </div>
      <div id="foot">        &nbsp;
      </div>
      <!-- end of foot -->
    </div>
    <!-- end of page -->
  </body>
</html>
