<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
<meta http-equiv="Content-Language" content="cs" />
<title>Slovník katedry blízkovýchoních studií</title>
<link rel="stylesheet" type="text/css" href="css/ksa.css"> 
</head>
<body bgcolor=#B5B5B5 style="scrollbar-face-color:#3D4E5E;scrollbar-shadow-color:#3D4E5E;scrollbar-highlight-color:#FFFF99;scrollbar-3dlight-color:#3D4E5E;scrollbar-darkshadow-color:#FFFF99;scrollbar-track-color:#9A9A9A;scrollbar-arrow-color:#FFFF99">

<script language=JavaScript>
function schovejKlavesnice() {
 // global document;
   document.getElementById("key_present").style.display = "none";
   document.getElementById("key_past").style.display = "none";
   document.getElementById("key_valence").style.display = "none";
   document.getElementById("key_root").style.display = "none";

 /* eval('window.document.all["key_present"].style.visibility="hidden"');
  eval('window.document.all["key_past"].style.visibility="hidden"');
  eval('window.document.all["key_valence"].style.visibility="hidden"');
  eval('window.document.all["key_root"].style.visibility="hidden"');*/
}

function ukazKlavesnici(x){
  schovejKlavesnice();
       document.getElementById("key_"+x).style.display = "block";
	//eval('document.all["key_'+x+'"].style.visibility="visible"');
}

 schovejKlavesnice();
</script>

<?php

if (!Empty($action) && $action == "insert_new_word") {
  require_once("./functions/dictionary.php");
  $user = 0;
  
  insert_word($czech,$english,$word_category,$verbal_class,$present,$past,$valence,$root, field,$language,$user,$word_voice);
}


require_once("./functions/keyboard.php");?>
<center>
  <table>
    <thead align="center"> Vlož nové slovo </thead>
    <tbody>
    <form action="" method="POST" name="new_word_form">
      <table border="0">
      <tr>
        <td class="akt">česky</td>
        <td><input type="text" name="czech"  size="50" /></td>
      </tr>
      <tr>
        <td class="akt">anglicky</td>
        <td><input type="text" name="english"  size="50" /></td>
      </tr>
      <tr>
        <td class="akt">druh slova</td>
        <td><input type="text" name="word_category"  size="50" /></td>
      </tr>
      <tr>
        <td class="akt">slovesná třída</td>
        <td><input type="text" name="verbal_class"  size="50" /></td>
      </tr>
      <tr>
        <td class="akt">přítomný čas</td>
        <td dir="rtl"><input type="text" name="present"  size="50" onfocus="ukazKlavesnici('present')" /></td>
      </tr>
      <tr>
        <td class="akt">minulý čas</td>
        <td dir="rtl"><input type="text" name="past"  size="50" onfocus="ukazKlavesnici('past')" /></td>
      </tr>
      <tr>
        <td class="akt">rekce</td>
        <td dir="rtl"><input type="text" name="valence"  size="50" onfocus="ukazKlavesnici('valence')" /></td>
      </tr>
      <tr>
        <td class="akt">kořen</td>
        <td dir="rtl"><input type="text" name="root"  size="50" onfocus="ukazKlavesnici('root')" /></td>
      </tr>
      <tr>
        <td class="akt">obor</td>
        <td>
          <select name="field">
            <option value="1"> obor1 </option>
            <option value="2"> obor2 </option>
            <option value="3"> obor3 </option>
          </select>
        </td>
      </tr>
      <tr>
        <td class="akt">jazyk</td>
        <td>
          <select name="language">
            <option value="1"> arabština </option>
            <option value="2"> hebrejština </option>
            <option value="3"> ivrit </option>
          </select>
        </td>
      </tr>
      <tr>
        <td class="akt">zvukový soubor</td>
        <td><input type="file" name="word_voice"/></td>
      </tr>
      <tr>
        <td>
          <input type="hidden" name="action" value="insert_new_word">
        </td>
        <td><input type="submit" value="Vlož"></td>
      </tr>
    </form>
    </tbody>
  </table>
</center>
<div id="key_present" style="z-index: 1; left: 220px; position: absolute; top: 400px">
  <?php insert_keyboard("new_word_form.present"); ?>
</div>
<div id="key_past" style="z-index: 2; left: 220px; position: absolute; top: 400px">
  <?php insert_keyboard("new_word_form.past"); ?>
</div>
<div id="key_valence" style="z-index: 3; left: 220px;; position: absolute; top: 400px">
  <?php insert_keyboard("new_word_form.valence"); ?>
</div>
<div id="key_root" style="z-index: 4; left: 220px; position: absolute; top: 400px">
  <?php insert_keyboard("new_word_form.root"); ?>
</div>
</body>
</html>

