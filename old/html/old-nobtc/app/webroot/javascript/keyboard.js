
var keyboard = {

  listener:'nobody',
  
  setListenerThis:function() 
  {
    top.keyboard.setListener(this);
    //alert('focus'+this);
    return false;
  },
  
  setListener:function(object) 
  {
    top.keyboard.listener = object;
    //ne !!!top.keyboard.listener.focus();
    //alert('focus'+this);
    return false;
  },
  
  press:function (str)
  {
    if (top.keyboard.listener == 'nobody') 
      return false;
    top.keyboard.listener.value+=str;
    top.keyboard.listener.focus();
  },
  
  showHidden:function()
  {
    top.utils.showHidden('keyboard-div');
    return false;
  }
  
};



