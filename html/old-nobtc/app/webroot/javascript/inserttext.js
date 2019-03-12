
var utils = {

  gEI:function(obj)
  {
    return document.getElementById(obj);
  },

  showHidden:function(obj) {
    var o=top.utils.gEI(obj);
    if(o.style.display=='none') {
      o.style.display='block';
    }
    else {
      o.style.display='none';
    }
    return false;
  },
  
  showHidden2:function(obj) {
    var o=top.utils.gEI(obj);
    if(o.style.display=='none') {
      o.style.display='inline';
    }
    else {
      o.style.display='none';
    }
    return false;
  },
  
  show:function(obj) {
    var o=top.utils.gEI(obj);
    o.style.display='block';
  },
  
  hide:function(obj) {
    var o=top.utils.gEI(obj);
    o.style.display='none';
  },
  
  createElementInput:function(type, name, value, size, maxsize, title) {
    var input = document.createElement('input');
    input.type = type;
    input.name = name;
    input.value = value;
    input.size = size;
    input.maxlength = maxsize;
    input.title = title;
    return input;
  },
  
  createElementImg:function(src) {
    var img = document.createElement('img');
    img.src = src;
    return img
  }
  
};

var book = {
  isAddNotSelect:true,
  
  changeAddOrSelect:function(text){
    if (text == 'add') {
      top.utils.show('book-info-add');
      top.utils.hide('book-info-select');
    }
    else {
      top.utils.hide('book-info-add');
      top.utils.show('book-info-select');
    }
    return false;
  }
};

var references = {
  count:0,
    
  maxCount:30,
  
  addReference:function(series, number, page, deleteText) {
    if(top.references.count < top.references.maxCount) {
      var where=top.utils.gEI('references-row');
      var cont = top.references.createRefLine(series, number, page, deleteText);
      
      where.appendChild(cont);
      
      top.references.count++;
    }
    return false;
  },
  
  createRefLine:function(series, number, page, deleteText) {
    var cont=document.createElement('div');
      
    var inputSeries=top.utils.createElementInput('text', 'series[]', series, '20', '50', 'Series');
    var inputNumber=top.utils.createElementInput('text', 'number[]', number, '20', '50', 'Number');
    var inputPlate=top.utils.createElementInput('text', 'page[]', page, '20', '20', 'Plate/Page');
      
    var linkDelete = document.createElement('a');
    linkDelete.href='#'
    linkDelete.className='input-del';
    linkDelete.onclick=top.references.deleteReference;
    var linkDeleteText=document.createTextNode(deleteText);
    var sepText1=document.createTextNode(', ');
    var sepText2=document.createTextNode(', ');
    
    linkDelete.appendChild(linkDeleteText);
    cont.appendChild(inputSeries);
    cont.appendChild(sepText1);
    cont.appendChild(inputNumber);
    cont.appendChild(sepText2);
    cont.appendChild(inputPlate);
    cont.appendChild(linkDelete);
    
    return cont;
  },
  
  deleteReference:function() {
    var cont=this.parentNode;
    while(cont.hasChildNodes()) {
      cont.removeChild(cont.childNodes[0])
    }
    top.references.count--;
    
    return false
  }
};

var transliteration = {
  
  plus:'./img/plus.gif',
  
  minus:'./img/minus.gif',
  
  line:'./img/line.gif',
  
  addLine:function (whereName, lineNo, line, delText, brokenChecked) {
    //lert('Pridat: '+line);
    var where = top.utils.gEI(whereName+'-div');
    var elemCount = top.utils.gEI(whereName+'-count');
    var pomocna = elemCount.value;
    //elemCount.value++;
    //alert('haloooo');
    if (lineNo == '' || lineNo == null) 
      lineNo = ++pomocna;
    var cont = top.transliteration.createLine(whereName, lineNo, line, delText, brokenChecked);
    elemCount.value++;
    where.appendChild(cont);
    
    return false;
  },
  
  createLine:function(whereName, lineNo, line, delText, brokenChecked) {
    var cont=document.createElement('div');
    cont.name = whereName;
    var elemCount = top.utils.gEI(whereName+'-count');
    
    var img1 = top.utils.createElementImg(top.transliteration.line);
    var img2 = top.utils.createElementImg(top.transliteration.line);
    var lineInput = top.utils.createElementInput('text', whereName + '-line['+(elemCount.value)+']', line, '70', '400', 'Line');
    lineInput.onfocus = top.keyboard.setListenerThis;
    top.keyboard.setListener(lineInput);
    //checkbox - now not used
    var chkbox = document.createElement('input');
    chkbox.type = 'checkbox';
    chkbox.name = whereName + '-line-broken['+(elemCount.value)+']';
    chkbox.title = 'Broken line';
    //alert(brokenChecked);
    if (brokenChecked == 'on')
      chkbox.checked = 'checked';
    //
    var linkDelete = document.createElement('a');
    var separator = document.createTextNode(' ');
    
    var lineNoInput = top.utils.createElementInput('text', whereName + '-line-no['+(elemCount.value)+']', lineNo, '2', '4', 'Line number');
    
    linkDelete.href='#';
    linkDelete.className='input-del-line';
    linkDelete.onclick=top.transliteration.deleteLine;
    var linkDeleteText=document.createTextNode(delText);
    linkDelete.appendChild(linkDeleteText);
    cont.appendChild(img1);
    cont.appendChild(separator);
    cont.appendChild(img2);
    //cont.appendChild(chkbox);
    cont.appendChild(lineNoInput);
    cont.appendChild(lineInput);
    cont.appendChild(linkDelete);
    
    return cont;
  },
  
  showTree:function(obj) {
    top.utils.showHidden2(obj+'-div');
    var img = top.utils.gEI(obj+'-img');
    if (img.title == 'minus') {
      img.src = top.transliteration.plus;
      img.title = 'plus';
    }
    else {
      img.src = top.transliteration.minus;
      img.title = 'minus';
    }
    
    return false;
  },
  
  deleteLine:function() {
    var cont=this.parentNode;
    var whereName = cont.name;
    
    while(cont.hasChildNodes()) {
      cont.removeChild(cont.childNodes[0])
    } 
    var elemCount = top.utils.gEI(whereName+'-count');
    elemCount.value--;
    //alert(elemCount.value);
    return false
  }
  
};

var tablet = {
  
};
  
var sealing = {
  
};
  
var envelope = {
  
};
  

