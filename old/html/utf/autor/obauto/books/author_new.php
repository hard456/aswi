<html>
<head>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--<link rel="StyleSheet" href="http://www.klinopis.cz/utf/obtc1.css" type="text/css" media="screen, print">-->
<LINK REL=StyleSheet HREF="main.css" TYPE="text/css" MEDIA="screen, print">
<title>--- KBS - Insert new author ---</title>
</head>
<body>
<script language="JavaScript" src="check.js"></script>
<table cellpadding="3" align="center">
 <colgroup align="right"><colgroup>
 <tr><td class=akt colspan="2" align="center" height="30" valign="top">New Author</td></tr>
 <form method="post" name="form1" action="author_search.php">
 <tr>
  <td>title before</td>
  <td><input type="text" name="titlebefore" id="titlebefore" size="20" maxlength="20"></td>
 </tr>
 <tr>
  <td>name</td>
  <td><input type="text" name="name" id="name" size="40" maxlength="50"><font size="4" color="#FF0000"><b>*</b></font></td>
 </tr>
 <tr>
  <td>surname</td>
  <td><input type="text" name="surname" id="surname" size="40" maxlength="50"><font size="4" color="#FF0000"><b>*</b></font></td>
 </tr>
 <tr>
  <td>title after</td>
  <td><input type="text" name="titleafter" id="titleafter" size="20" maxlength="20"></td>
 </tr>
 <tr><td colspan="2" align="center" height="50" valign="bottom"><input type="button" value="Add new author" class="tlacitko2" onClick="check_author()"></td></tr>
 </form>
</table>
</body>
</html>
