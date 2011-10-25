var isIE = (document.all) ? true : false;
var isNS6 = (document.getElementById) ? true : false;
var isNav = (document.layers) ? true : false;

function getDiv(divName) {
  var theDiv;
  //find the div
  if (isIE) {
    theDiv = eval('document.all.' + divName + '.style');
  } else if (isNS6) {
    theDiv = eval('document.getElementById("' + divName + '").style'); 
  } else if (isNav) {
    theDiv = eval('document.' + divName);
  }

  return theDiv;
}

if (document.layers) {

  visible = 'show';

  hidden = 'hide';

} else if (document.all || document.getElementById ) {

  visible = 'visible';

  hidden = 'hidden';

}


function showRoll(roll, origin) {
	
  getDiv(roll).visibility = visible;
  getDiv(origin).visibility = hidden;
}

function closeRoll(roll, origin) {
  getDiv(roll).visibility = hidden;
  getDiv(origin).visibility = visible;
}

function backRoll(x){
	var theElement = document.getElementById(x);
	theElement.className = "tableSubHeader";
}

function backRollOff(x){
	var theElement = document.getElementById(x);
	//alert(theElement.id);
	theElement.className = "tableColumnHeader";
}


