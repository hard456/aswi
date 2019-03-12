<?php
require_once("./functions/dictionary.php");
if (!Empty($_GET['akce']) && $_GET['akce'] == "odhlasit") {
  odhlasit();
  $hlaska = lang("Byl jste odhlasen!!!");
}
if (!Empty($_GET['set_lang'])) {
  session_register("LaId");
  $LaId = $_GET['set_lang'];
}
if (!Empty($_POST['n']) && !Empty($_POST['p'])) {
	if(prihlasit($_POST['n'], $_POST['p'])) {
        session_register('ses_pref_dist');
        $_SESSION['ses_pref_dist'] = 'arabic';
		 if ( !empty($_REQUEST['action']) && $_REQUEST['action'] == 'select_lection')
              Header ("Location: examination.php?nav_id=new_exam&action=select_lection&source=".urlencode($_REQUEST['source'])."&lection=".urlencode($_REQUEST['lection']));
            else
              //p_g($_SESSION);
              Header ("Location: examination.php?poprve=$poprve");
            exit;
	}
	else {
		$hlaska = lang("Heslo nebo login jsou nesprávně!!!");
	}
}
elseif(Empty($_POST['send']) || $_POST['send'] != lang("Přihlásit")) {
   $hlaska = "";
}
else {
   $hlaska = lang("Nebyl vyplněn celý formulář!!!");
}

$language = 1;//arabic

// PROGRAM
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
    <link rel="stylesheet" type="text/css" href="css/arabic.css" />
    <script src="functions/popup.js" type="text/javascript"></script>
  </head>
  <body style="text-align: center">
    <h1>
      <?php echo lang("Arabsko - anglicko - český studijní slovník 2005-2008");?></h1>
    <h3 class="nadpis2">
      <?php echo lang("Katedra blízkovýchodních studií FF ZČU v Plzni");?></h3>

              <a href="hebrew">
                <?php echo lang("Hebrejský slovník") ?></a>

    <div id="page">
      <div id="contenti">
        <div id="lefti">
          <h2 class="nadpis2">
            <?php echo lang("Antologie arabských textů"); ?></h2>
          <div style="text-align:right">
            <?php echo get_short_table_of_article(1); ?>
          </div>
          <br />
          <br />
          <?php if(!empty($_REQUEST['view_article'])): ?>
            <a href="?direction=<?php echo $_REQUEST['direction']?>"><?php echo lang("Volné hledání ve slovníčku"); ?></a>
          <?php endif;?>
        </div>
        <!-- end of lefit -->
        <div id="envelope">
          <div id="main">

      <?php if(empty($_REQUEST['view_article'])): ?>


<?php
if (Empty($_REQUEST['direction']))
  $_REQUEST['direction'] = 'ar';
switch ($_REQUEST['direction']) {
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
    $_REQUEST['direction'] = "ar";
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
           if ( $_REQUEST['direction'] != "cz" )  echo "<a href=\"?direction=cz\">&raquo;$pomocna&laquo;</a>&nbsp;&nbsp;\n";
           else                      echo "&raquo; $pomocna &laquo;&nbsp;&nbsp;\n";

            $pomocna = lang("z angličtiny");
           if ( $_REQUEST['direction'] != "en" )  echo "<a href=\"?direction=en\">&raquo;$pomocna&laquo;</a>&nbsp;&nbsp;\n";
           else                      echo "&raquo; $pomocna &laquo;&nbsp;&nbsp;\n";

            $pomocna = lang("z arabštiny");
           if ( $_REQUEST['direction'] != "ar" )  echo "<a href=\"?direction=ar\">&raquo;$pomocna&laquo;</a>&nbsp;&nbsp;\n";
           else                      echo "&raquo; $pomocna &laquo;&nbsp;&nbsp;\n";
                    ?>
                  </td>
                </tr>
              </table>
              </center>
<?php
if (!Empty($actione) && $actione == "translate") {
  require_once("./functions/dictionary.php");
  print_translation($text1, $_REQUEST['direction']);
}
switch ($_REQUEST['direction']) {
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

              <form name="translate_form" action="arabic" method="post">
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
                        <input type="hidden" name="direction" value="<?php echo $direction?>" />
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
			<?php include("inc/pravy-prihlaseni.php");?>
			<?php insert_picture("orazekuvod"); ?>
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
    <?php //pr($_SESSION); ?>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-4912419-5");
pageTracker._trackPageview();
</script>
  </body>
</html>
