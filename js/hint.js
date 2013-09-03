function heFocus ()
{
   if (this.value == this.getAttribute("hint"))
   {
      this.value = "";
      this.className = this.className.replace(/\s?hinted\s?/gi, "");
      return true;
   }
}
function heBlur ()
{
   if (this.value == "")
   {
      this.value = this.getAttribute("hint");
      this.className += " hinted";
      return true;
   }
}

   function getElementsByAttribute (attribute)
   {
     var matchingElements = [];
     var allElements = document.getElementsByTagName('*');
     for (var i = 0; i < allElements.length; i++)
     {
       if (allElements[i].getAttribute(attribute))
       {
         // Element exists with attribute. Add to array.
         matchingElements.push(allElements[i]);
       }
     }
     return matchingElements;
   }
   function addEvent(elem, event, func ) {
       if (elem.addEventListener) {
           elem.addEventListener(event, func, false);
       }
       else
       if (elem.attachEvent) {
           elem.attachEvent('on' + event, func);
       }
       else
       {
         elem["on"+event] = func;
       }
   }


var hinted_elements = getElementsByAttribute("hint");

var i;
for (i=0; i<hinted_elements.length; i++)
{
   var elem = hinted_elements[i];

   addEvent(elem, 'focus', heFocus);
   addEvent(elem, 'blur', heBlur);
}