function LTrim_pole(element)
{	
  mezera=element.value.indexOf(" ")
  while(mezera==0&element.value.length!=0)
  {
    element.value=element.value.substring(1,element.value.length)
	mezera=element.value.indexOf(" ")
  }
}

function RTrim_pole (element)
{	
  mezera=element.value.lastIndexOf(" ")
  while(mezera==0&mezera==element.value.length-1&element.length!=0)
  {
  element.value=element.value.substring(0,element.value.length-1)
  mezera=element.value.lastIndexOf(" ")
  }
}

function Trim_pole (element)
{	
  LTrim_pole (element)
  RTrim_pole (element)
}

function check_author ()
{
  chyba = ''
   	if (form1.name.value == '') chyba = chyba + 'N a m e \n'
   	if (form1.surname.value == '') chyba = chyba + 'S u r n a m e \n'
  	if (chyba != '')
   	  {
   	  alert ('POVINNE POLOZKY:\n============\n\n' + chyba) 
	  }
	  else
	  {
	  document.form1.submit()
	  }
}  