<HTML>
<HEAD>
<TITLE>P�id�n� nov�ho zam�tnance</TITLE>
</HEAD>
<BODY bgcolor="Silver">

<CENTER>
<H1>P�id�n� nov�ho zam�stnance</H1>
</CENTER>
<FORM ACTION="insert.php" METHOD=POST>

<FIELDSET>
    <LEGEND align="center" ><b><i>Osobn� �daje</i></b></LEGEND>    

<TABLE  width="100%"  cellspacing="5"  >
<TR><TD><b>Osobn� ��slo:</b></TD><TD colspan="3" align="left"><INPUT NAME=OsobniCislo VALUE="<?echo $OC?>" SIZE=4></TD></TR>
<TR><TD><b>Jm�no:</b></TD><TD><INPUT NAME=PracJmeno SIZE=25 maxlength="25"></TD>
<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>P��jmen�:</b></TD><TD><INPUT NAME=PracPrijmeni SIZE=25 maxlength="25"></TD></TR>
<TR><TD colspan="3" align="right" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rodn� p��jmen�:</TD><TD><INPUT NAME=RodPrijmeni SIZE=25 maxlength="25"></TD></TR>
</TABLE>
<TABLE    cellspacing="5"  >
<TR><TD>Titul 1:</TD><TD colspan=3  align="justify"><INPUT NAME=Titul1 maxlength="20" SIZE=10></TD>
<TD align=right colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Titul 2:<TD><INPUT NAME=Titul1 maxlength="15" SIZE=5></TD></TR>

</TABLE>

<TABLE cellspacing="5"  >
<TD align="right"><b>Datum narozen�</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
<TD align="right" ><b>den:</b>&nbsp;&nbsp;<INPUT  name=NarDen maxlength="2" SIZE=2 ></TD>
<TD align="left"><b>m�s�c:</b>&nbsp;&nbsp;<INPUT  name=NarMesic maxlength="2" SIZE=2 ></TD>
<TD align="left"><b>rok:</b>&nbsp;&nbsp;<INPUT  name=NarRok maxlength="4" SIZE=4 ></TD>
<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Rodn� ��slo:</b>&nbsp;&nbsp;<INPUT NAME=Rodn1 maxlength="6" SIZE=6>&nbsp;&nbsp;/&nbsp;&nbsp;<INPUT NAME=Rodn2 maxlength="4" SIZE=4>

<TR><TD>M�sto narozen�:</TD><TD colspan="10" ><INPUT NAME=MistoNar maxlength="50" SIZE=40>
</TABLE>
</FIELDSET>

<br>
<FIELDSET>
    <LEGEND align="center" ><b><i>Adresa bydli�t�</i></b></LEGEND>    
	<TABLE cellspacing="5"  >
	<TR><TD>Ulice :</TD><TD><INPUT name=BydlUlice maxlength="50" SIZE=50 ></TD>
	<TD>��slo :</TD><TD><INPUT name=BydlCislo maxlength="5" SIZE=5 ></TD></TR>
	<TR><TD>M�sto :</TD><TD><INPUT name=BydlMesto maxlength="50" SIZE=50 ></TD></TR>
	<TR><TD>PS� :</TD><TD><INPUT name=BydlPSC maxlength="6" SIZE=6 ></TD></TR>
   </TABLE>
	<TABLE    cellspacing="5"  >
	
    <TR><TD>Telefon :</TD><TD align="right" ><INPUT NAME=BydlTel1 maxlength="4" SIZE=4></TD><TD>/</TD><TD align="left" ><INPUT NAME=BydlTel12 maxlength="11" SIZE=11></TD>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Zobrazit tel. : </TD><TD><INPUT type="Checkbox" name="T1Zobrazit" value="a">

   </TABLE>

</FIELDSET>
<br>
<FIELDSET>
    <LEGEND align="center" ><i>Adresa zam�stn�n�</i></LEGEND>    
	<TABLE    cellspacing="5"  >
	<TR><TD>N�zev firmy :</TD><TD><INPUT name=ZamHlavni maxlength="70" SIZE=70 ></TD>
	<TR><TD>Ulice :</TD><TD><INPUT name=ZamUlice maxlength="50" SIZE=50 ></TD>
	<TD>��slo :</TD><TD><INPUT name=ZamCislo maxlength="5" SIZE=5 ></TD></TR>
	<TR><TD>M�sto :</TD><TD><INPUT name=ZamMesto maxlength="50" SIZE=50 ></TD></TR>
	<TR><TD>PS� :</TD><TD><INPUT name=ZamPSC maxlength="6" SIZE=6 ></TD></TR>
   </TABLE>
	<TABLE cellspacing="5"  >
	
    <TR><TD>Telefon :</TD><TD align="right" ><INPUT NAME=ZamTel1 maxlength="4" SIZE=4></TD><TD>/</TD><TD align="left" ><INPUT NAME=ZamTel12 maxlength="11" SIZE=11></TD>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Zobrazit tel. : <INPUT type="Checkbox" name="T2Zobrazit" value="a">

   </TABLE>

</FIELDSET>
<br>
<FIELDSET>
    <LEGEND align="center" ><b><i>Ostatn� �daje</i></b></LEGEND>    
	<TABLE  cellspacing="5"  >
    <TR><TD>Mobil :</TD><TD align="right" ><INPUT NAME=Mobil1 maxlength="4" SIZE=4>&nbsp;&nbsp;/&nbsp;&nbsp;<INPUT NAME=Mobil2 maxlength="11" SIZE=11></TD>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Zobrazit tel. : <INPUT type="Checkbox" name="M1Zobrazit" value="a">

    <TR><TD>��slo ��tu :</TD><TD><INPUT NAME=CisUctu SIZE=15 maxlength="15"></TD>
	<TD>K�d banky :</TD><TD align=left ><INPUT NAME=KodBanky SIZE=4 maxlength="4"></TD></TR>
    <TR><TD>Zdravotn� poji��ovna:</TD><TD><INPUT NAME=ZdravPoj SIZE=30 maxlength="30"></TD></TR>
    <TR><TD>D�chod :</TD>    
		 <TD><INPUT TYPE=RADIO NAME=MaDuchod VALUE="zadny" 
                   <?echo $MaDuchod=="zadny" ? " CHECKED" : ""?>>��dn�
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <INPUT TYPE=RADIO NAME=MaDuchod VALUE="castecny invalidni"
                   <?echo $MaDuchod=="castecny invalidni" ? " CHECKED" : ""?>>��ste�n� invalidn�
		   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <INPUT TYPE=RADIO NAME=MaDuchod VALUE="plny invalidni"
                   <?echo $MaDuchod=="plny invalidni" ? " CHECKED" : ""?>>pln� invalidn�
		   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <INPUT TYPE=RADIO NAME=MaDuchod VALUE="starobni"
                   <?echo $MaDuchod=="starobni" ? " CHECKED" : ""?>>starobn�
     </TD></TR>
     <TR><TD>Rozsah t�d. prac. doby :</TD>    
	 <TD><INPUT NAME=RozsahTydPracDoby SIZE=5 maxlength="5"></TD></TR>
	<TR>
	 <TD>Typ prac. vztahu :</TD>
           <TD><INPUT TYPE=RADIO NAME=TypPracVztahu VALUE="h"
                   <?echo $TypPracVztahu=="h" ? " CHECKED" : ""?>>hlavn�
		   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <INPUT TYPE=RADIO NAME=TypPracVztahu VALUE="v"
                   <?echo $TypPracVztahu=="v" ? " CHECKED" : ""?>>vedlej��
     </TD>
	 </TR>
     <TR><TD>Pracovn� za�azen� :</TD>    
	 <TD><INPUT NAME=Zarazeni SIZE=50 maxlength="50"></TD></TR>
	 <TR><TD>Odborn� zam��en� :</TD>    
	 <TD><Textarea name="OdbZamereni" rows="8" cols="60"></textarea></TD>    
	 <TR><TD>M�stnost :</TD><TD><INPUT NAME=PracMistnost SIZE=12 maxlength="12"></TD></TR>
	 </TABLE>
<br>
<hr>

     <TABLE  cellspacing="5" width="100%"  >
	 <TR><TD>�daje jsou ov��en� :&nbsp;<INPUT  type="Checkbox" name="PracHotovo" hspace="5" value="a"></TD> 
	  <TD><INPUT TYPE=SUBMIT VALUE="Ulo�it">
	  </FORM></TD> 
	 <TD><FORM ACTION="index.php">
	 <INPUT TYPE=SUBMIT VALUE="Zp�t">
	 </FORM>
	</TR>
	 </TABLE>
</FIELDSET>

</BODY>
</HTML>