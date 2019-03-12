

function createElement(element) {
  if (typeof document.createElementNS != 'undefined') {
    return document.createElementNS('http://www.w3.org/1999/xhtml', element);
  }
  if (typeof document.createElement != 'undefined') {
    return document.createElement(element);
  }
  return false;
}

function mySplit(string, char) {
  var position = string.indexOf(char);
  if (position == -1) {
    return string;
  }
  else {
    var value = new Array(2);
    value[0] = string.substring( 0,position );
    value[1] = string.substring( position+1 );
    return value;
  }
}

function clearElement(element) {
  var toRemove = element.firstChild;

  try {
    while(element.firstChild) {
      element.removeChild(element.firstChild);
    }
  } 
  catch (e) { // IE hack
    toRemove.ParentNode.removeChild(toRemove); 
  }
}

function insertNode(place, node) {

  clearElement(place);

  place.appendChild(node);

}

function getOption(value, text) {
  var option = createElement('option');
  option.value = value;
  option.appendChild(document.createTextNode(text));
  
  return option;
}

function getSelect(selectCode) {
  var select = createElement('select');
  
  var options = selectCode.split('/');
  for(i=0; i < options.length; i++){
    select.appendChild(getOption(options[i], options[i]));
  }
  
  select.setAttribute("class", "arabic");
  
  //alert('yeahhh');
  return select;
}

function createNl2Br(inputText) {
  var parentNode = createElement('span');
  var tokens = inputText.split('\n');
  
  for(var i = 0; i < tokens.length; i++){
  	if(i != 0) {
  	  parentNode.appendChild(createElement('br'));
  	}
    parentNode.appendChild(document.createTextNode(tokens[i]));
  }
  return parentNode;
}

function createTree(code) {

  var currentText = code;
  
  var parent = createElement('div');

  while (currentText.indexOf('{') != -1) {
    
    prvniDeleni = mySplit( currentText, '{' );
    druheDeleni = mySplit( prvniDeleni[1], '}' );

    pretext = prvniDeleni[0];
    selectCode = druheDeleni[0];
    currentText = druheDeleni[1];
    
    parent.appendChild(createNl2Br( pretext ));
    parent.appendChild(getSelect( selectCode ));
    
  }
  
  parent.appendChild(createNl2Br( currentText ));
  return parent;
}

function render(fromName, toName) {
  //alert(objekt);
  to = document.getElementById(toName);
  from = document.getElementById(fromName);
  insertNode(to, createTree(from.value));
  //document.getElementById('platno');
}

function doGetCaretPosition (ctrl) {
  var CaretPos = 0;
  // IE Support
  if (document.selection) {
    ctrl.focus ();
    var Sel = document.selection.createRange ();
    Sel.moveStart ('character', -ctrl.value.length);
    CaretPos = Sel.text.length;
  }
  // Firefox support
  else if (ctrl.selectionStart || ctrl.selectionStart == '0') {
    CaretPos = ctrl.selectionStart;
  }
  return (CaretPos);
}

function insertAtCaret (textArea, text) {
  var caretPos = doGetCaretPosition(textArea);
  textArea.value = textArea.value.substring(0, caretPos) + text + textArea.value.substring( caretPos);
}

function addSelect(kam) {
  var textarea = document.getElementById(kam);
  var text = '{right/x/y}';
  insertAtCaret(textarea, text);
  textarea.focus();
  render(kam, 'platno');
}
