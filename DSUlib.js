/**mensaje.js**/
var mensaje= function(msg, typeM){
    if(typeM==='alert'){
        alert(msg);
    }
    if(typeM==='prompt'){
        prompt(msg);
    }
    if(typeM==='confirm'){
        confirm(msg);
    }
};

//mensaje('Hello World!','prompt');

/**toggle visibility
shows/hides visibility of an element, via click or hover.
It chages an element disblay status between 'block' and 'none'
**/

function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
	
	function toggle_hover_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
	
/*
Ex:
<button type="button" title="Show/Hide" onclick="toggle_visibility('menu_categories')"> Categories </button>

<div id="menu_categories" style="display:block;">
	...Content...
</div>
	
<h1><strong><a onmouseover="toggle_hover_visibility('subcategories')"  href="...source...">Text</a> </strong></h1>
<ul id="subcategories" style="display:none;">
	<li></li>
</ul>
*/
