<?php
$autori = new Autori();
?>
<form method="post" name="form1" action="index.php">
<table class="desk">
 <tr><td height="30"><p align=center class="title"><?php echo $hlaska ?>&nbsp;</p></td></tr>
 <tr><td>
  <table cellpadding="1" cellspacing="0" align="center">
   <colgroup align="right"><colgroup width="200"><colgroup align="right"><colgroup>
   <tr>
	<td>1st author</td>
    <td>
      <?php echo $autori->menuAutor('idauthor[0]', $REQUEST['idauthor'][0]); ?>
      <font size="4" color="#FF0000"><b>*</b></font>
    </td>
	  <td colspan="2" align="right">
      <input 
        type="button" 
        value="New Author" 
        class="tlacitko" 
        onClick="javascript:window.open('author_new.php','add','width=450,height=350,left=10,top=10,resizable,scrollbars')" />
    </td>
   </tr>
   
   <tr>
	<td>2nd author</td>
	<td>
      <?php echo $autori->menuAutor('idauthor[1]', $REQUEST['idauthor'][1]); ?>
	</td>
	<td>4th author</td>
	<td>
      <?php echo $autori->menuAutor('idauthor[3]', $REQUEST['idauthor'][3]); ?>
	</td>
   </tr>
   <tr>
	<td>3rd author</td>
	<td>
      <?php echo $autori->menuAutor('idauthor[2]', $REQUEST['idauthor'][2]); ?>
	</td>
	<td>5th author</td>
	<td>
      <?php echo $autori->menuAutor('idauthor[4]', $REQUEST['idauthor'][4]); ?>
	</td>
   </tr>
  </table>
 </td></tr>
 <tr><td><hr /></td></tr>
 <tr><td>
  <table cellpadding="1" cellspacing="0" align="center">
   <tr>
	<td>title</td>
	<td><input type="text" class="vstup" size="60" maxlength="255" name="title" value="<?php echo $REQUEST['title']?>" />
      <font size="4" color="#FF0000"><b>*</b></font></td>
   </tr>
   <tr>
	<td>subtitle</td>
	<td><input type="text" class="vstup" size="60" maxlength="255" name="subtitle" value="<?php echo $REQUEST['subtitle']?>" /></td>
   </tr>
   <tr>
	<td>volume (rada n. casopis)</td>
	<td><input type="text" class="vstup" size="60" maxlength="255" name="volume" value="<?php echo $REQUEST['volume']?>" /></td>
   </tr>
  </table>
 </td></tr>
 <tr><td><hr /></td></tr>
 <tr><td>
  <table cellpadding="1" cellspacing="0" align="center">
   <tr><td>
    <table cellpadding="1" align="center">
    <colgroup align="right"><colgroup width="200"><colgroup align="right"><colgroup>
	 <tr>
	 <td class="title">1st subject</td>
	 <td class="subj" colspan="2">
	 
   <?php echo $autori->menuSubject('idsubject[0]', $REQUEST['idsubject'][0]); ?>
   
   <font size="4" color="#FF0000"><b>*</b></font>
	 </td>
	 <td class="title">3rd subject</td>
	 <td class="subj" colspan="2">
	 
	 <?php echo $autori->menuSubject('idsubject[2]', $REQUEST['idsubject'][2]); ?>
	 
	</td>
	</tr>
	 <tr>
	 <td class="title">2nd subject</td>
	 <td class="subj" colspan="2">
	 
	 <?php echo $autori->menuSubject('idsubject[1]', $REQUEST['idsubject'][1]); ?>
	 
	 </td>
	 <td class="title">4th subject</td>
	 <td class="subj" colspan="2">
	 
	 <?php echo $autori->menuSubject('idsubject[3]', $REQUEST['idsubject'][3]); ?>
	 
	</td>
	</tr></td>
   </tr>
  </table>	
 </td></tr>
 <tr><td>
  <table cellpadding="1" cellspacing="0" align="center">
   <colgroup align="right"><colgroup><colgroup align="right"><colgroup><colgroup align="right"><colgroup>
    <tr>
     <td class=akt>publication's type</td>
	 <td class=akt>
	 
	  <?php echo $autori->menuType('type', $REQUEST['type']); ?>
    
    <font size="4" color="#FF0000"><b>*</b></font>
	 </td>
     <td>number/subnumber</td>
	 <td>
	  <input type="text" class="vstup" size="15" maxlength="20" name="number" value="<?php echo $REQUEST['number']?>" />  /
	  <input type="text" class="vstup" size="4" maxlength="5" name="volumesubnumber" value="<?php echo $REQUEST['volumesubnumber']?>" />
	 </td>
	</tr>
    <tr>
	 <td>publisher</td>
	 <td><input type="text" class="vstup" size="22" maxlength="255" name="publisher" value="<?php echo $REQUEST['publisher']?>" /></td>
	 <td>total pages / tables</td>
	 <td><input type="text" class="vstup" size="22" maxlength="15" name="pageframe" value="<?php echo $REQUEST['pageframe']?>" /></td>
	</tr>
	<tr>
	 <td>place</td>
	 <td><input type="text" class="vstup" size="25" maxlength="100" name="place" value="<?php echo $REQUEST['place']?>" /></td>
	 <td>year</td>
	 <td><input type="text" class="vstup" size="12" maxlength="20" name="year" value="<?php echo $REQUEST['year']?>" /></td>
	</tr>
	<tr>
     <td>ISBN :</td>
     <td>
		 <?php 
		   list($isbn_1, $isbn_2, $isbn_3, $isbn_4) = split('-', $REQUEST['isbn'], 4);
		 ?>
      <input type="text" class="vstup" size="2" name="isbn_1" value="<?php echo $isbn_1;?>" /> -
      <input type="text" class="vstup" size="2" name="isbn_2" value="<?php echo $isbn_2;?>" /> -
      <input type="text" class="vstup" size="2" name="isbn_3" value="<?php echo $isbn_3;?>" /> -
      <input type="text" class="vstup" size="2" name="isbn_4" value="<?php echo $isbn_4;?>" />
     </td>
	 <td>ISSN</td>
	 <td><input type="text" class="vstup" size="12" maxlength="10" name="issn" value="<?php echo $REQUEST['issn']?>" /></td>
	</tr>
	<tr>
	 <td>signature</td>
	 <td><input type="text" class="vstup" size="25" maxlength="50" name="signature" value="<?php echo $REQUEST['signature']?>" /></td>
	 <td>increase number</td>
	 <td colspan="3">
	 <input type="text" class="vstup" size="5" maxlength="10" name="increasenumber1" value="<?php echo $REQUEST['increasenumber1']?>" /> / 
	 <input type="text" class="vstup" size="5" maxlength="10" name="increasenumber2" value="<?php echo $REQUEST['increasenumber2']?>" />
	 </td>
	</tr>
	<tr>
	 <td>note</td>
	 <td colspan="4"><input type="text" class="vstup" size="80" name="note" value="<?php echo $REQUEST['note']?>" /></td>
	</tr>
  </table>
 </td></tr>
 <tr><td><hr /><font size="4" color="#FF0000"><b>*</b></font> - required field</td></tr>
 <tr><td align="center" height="50">
	<?php if($add-edit == 'edit'):?>
	 <input type="hidden" name="akce" value="edit-book-save" />
	 <input type="hidden" name="idbook" value="<?php echo $REQUEST['idbook']?>" />
  <?php else:?>
   <input type="hidden" name="akce" value="add-book" />
  <?php endif;?>
   
   <input class="tlacitko2" type="Submit" value="<?php echo (($add-edit == 'edit')? 'Save' : 'Add')?> biography record">
 </td></tr>
</table>

</form>
<?php //p_g($REQUEST);?>
