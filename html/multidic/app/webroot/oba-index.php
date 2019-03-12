<?php
$do_slovniku = "Do slovníku";

$do_administrace = "Do administrace";

if (!Empty($n) && !Empty($p)):
  if (!Empty($send) && $send == $do_slovniku) {
    Header ("Location: index_to_exam.php?n=$n&p=$p");
  }
  if (!Empty($send) && $send == $do_administrace) {
    Header ("Location: index_to_admin.php?n=$n&p=$p");
  }
endif;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
<meta http-equiv="Content-Language" content="cs" />
<title>Slovník katedry blízkovýchoních studií</title>
<link rel="stylesheet" type="text/css" href="css/kbs.css"> 
</head>

<body>
<div id="telickonejakystihly">
<form method="post">
<h3 class="nadpis2">Slovník katedry blízkovýchodních studií</h3>
<table  width="200">
  <tbody>
    <tr class="akt">
        <td width="40%" align="right">Nick:</td>
        <td width="60%"  align="left">
        <input type="text" name="n" value="<?php echo $n ?>" /></td>
    </tr>
    <tr class="akt">
        <td width="40%" align="right">Heslo:</td>
        <td width="60%"  align="left">
        <input type="password"  name="p" value="<?php echo $p ?>"  /></td>
    </tr>
  <!--/tbody>
</table>
<table  width="200">
  <tbody-->
    <tr class="nadpis_sekce">
        <td width="50%" align="right">
          <input type="submit"  name="send" value="<?php echo $do_slovniku?>"  /></td>
        <td width="50%"  align="right">
          <input type="submit"  name="send" value="<?php echo $do_administrace?>"  /></td>
    </tr>
  
    <!--tr> 
    <td  width="100%" class="akt">
    <a href="index_to_exam.php">Vstup do studijního slovníku</a>
    ||
    <a href="index_to_admin.php">Vstup do administrace</a>
    
    </td>
     </tr-->
  </tbody>
</table>
<h6><a href="new_registration.php">Registrace nového uživatele</a></h6>
</form>
</div>
  <div id = "right">
    <img src = "./pictures/scan0001.jpg" 
         title = "OREL" /><br />
    <h6>
      6575676t
    </h6>
  </div>
</body>
</html>
