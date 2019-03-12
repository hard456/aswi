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
        $_SESSION['ses_pref_dist'] = 'hebrew';
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

$language = 2;//hebrew

// PROGRAM
require_once("./examination/article.php");

/*<?xml version="1.0" encoding="utf8"?>*/

?>
<!DOCTYPE html 
	PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"	 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
  
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <title><?php echo lang("Hebrejsko - česko - anglický slovník"); ?></title>
   <link rel="stylesheet" type="text/css" media="all" href="css/hebrewindex.css" />
   <!--[if IE ]> 
	<link rel="stylesheet" type="text/css" media="all" href="css/cssie.css" /> 
   <![endif]-->
</head>
  
<body>    
<div id="all">
  <div id="center">
    <div id="header">
      <div id="navig">
        <h1><?php echo lang("Hebrejský slovník"); ?></h1>
          <div id="menu"> 
            <ul>
              <li><a href="hebrew" title="online preklad - Hebrejsko - česko - anglický slovník">Online překlad</a></li>
              <li><a href="arabic" title="Arabský slovník">Arabský slovník</a></li>
              <?php if (kontrola_pristupu()):?>
              <?php if(kontrola_pristupu(1))
	   		       echo" <li><a href=\"examination.php\">Zkoušení</a></li>";
	   		  ?>
	   		  <?php if(kontrola_pristupu(2))
	   		       echo" <li><a href=\"administration.php\">Admin</a></li>";
	   		  ?>
              <?php else: ?>
              <!--li><a href="new_registration.php"><?php echo lang("Registrace") ?></a></li-->
              <?php endif; ?>
            </ul>
          </div><!-- konec menu -->
      </div><!-- konec navig -->
      <div id="login">
        <?php require('inc/prihlaseni-nove.php'); ?>
      </div><!-- konec login -->
    </div><!-- konec header -->
    
<?php
if (Empty($_REQUEST['direction'])) {
	$_REQUEST['direction'] = 'he';
}
switch ($_REQUEST['direction']) {
  case("cz"):
    $vyzva = lang("Zadejte slovo v češtině:");
    $klavesnice = false;
  break;
  case("en"):
    $vyzva = lang("Zadejte slovo v angličtině:");
    $klavesnice = false;
  break;
  case("he"):
  default:
    $vyzva = lang("Zadejte slovo v hebrejštině:");
    $klavesnice = true;
  break;
}
$pomocna = lang("z češtiny");
if ( $_REQUEST['direction'] != "cz" ) {
	$odkazcz = "<a href=\"?direction=cz\">$pomocna</a>\n";
	$tridacz = '';
}
else {
	$odkazcz = " $pomocna \n";
	$tridacz = ' class="chosen"';
}

$pomocna = lang("z angličtiny");
if ( $_REQUEST['direction'] != "en" ) {
	$odkazen = "<a href=\"?direction=en\">$pomocna</a>\n";
	$tridaen = '';
}
else {
	$odkazen = " $pomocna \n";
	$tridaen = ' class="chosen"';
}

$pomocna = lang("z hebrejštiny");
if ( $_REQUEST['direction'] != "he" ) {
	$odkaztr = "<a href=\"?direction=he\">$pomocna</a>\n";
	$tridatr = '';
}
else {
	$odkaztr = " $pomocna \n";
	$tridatr = ' class="chosen"';
}
                   
?>
    
    <div id="desk">
      <div id="flags">
        <ul>
          <li<?php echo $tridacz ?>><span><?php echo $odkazcz ?></span></li>
          <li<?php echo $tridaen ?>><span><?php echo $odkazen ?></span></li>
          <li<?php echo $tridatr ?>><span><?php echo $odkaztr ?></span></li>
        </ul>
      </div><!-- konec flags -->
      <div id="card" class="rounded">
        <form id="translate_form" name="translate_form" action="hebrew" method="post">
          <div class="sokrajem sinnerokrajem">
            <input type="text" class="big<?php if($klavesnice) echo ' arabic' ?>" name="text1" id="text1" title="hledane slovo" />
            <input type="submit" value="<?php echo lang("Přelož") ?>" />
            <input type="hidden" name="direction" value="<?php echo $direction?>" />
            <input type="hidden" name="actione" value="translate" />
            
            <?php
  					if($klavesnice) {
					  require("./functions/keyboard.php");
					  insert_keyboard("translate_form.text1");
  					}
  					
					if (!Empty($actione) && $actione == "translate") {
					  require_once("./functions/dictionary.php");
					  print_translation($text1, $_REQUEST['direction'], $language);
					}
                ?>
                
                
          </div>
        </form>
        <div class="copyright" style="border-top:solid 1px #aaa;font-size:10px;margin:15px 0pt 0pt;padding:2px;valign:middle">
        	<img src="pict/zcu_logo.png" 
        		alt="Západočeská univerzita v Plzni - logo" 
        		 />
            Copyright &copy; 2007 
        	<a href="http://www.zcu.cz" title="Západočeská univerzita v Plzni">Západočeská univerzita</a>
        	<a href="http://www.kbs.zcu.cz/" title="Centrum blízkovýchodních studií">Centrum blízkovýchodních studií</a>
        	</span>
        </div>
        <div style="">
        
        	<span>
        </div>
      </div><!-- konec card -->
    </div>
  </div><!-- konec center -->
</div><!-- konec all -->

<?php //pr( $_SESSION ) ?>

    <script type="text/javascript">
    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
    try {
    var pageTracker = _gat._getTracker("UA-4912419-6");
    pageTracker._trackPageview();
    } catch(err) {}</script>

</body>

</html>
