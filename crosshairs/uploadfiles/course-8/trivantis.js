/**************************************************
Trivantis (http://www.trivantis.com)
**************************************************/

/* 
** If you want to enable a Debug Window that will show you status
** and debugging information for your HTML published content, 
** copy the file "trivantisdebug.html" from your Support Files directory
** (typically C:\Program Files\Trivantis\(Product Name)\Support Files
** and place in the root folder of your published content (next to this file)
** and then change the value of the trivDebug variable from 0 to 1
** (don't forget to save the modified file).
**
*/

var trivDebug      = 0;
var bDisplayErr    = true;
var trivAddMsgFunc = null;
var trivDebugWnd   = '';
var trivSaveMsg    = '';

function trivLogMsg( msg ) {
  if( !trivDebug ) return;
  var topWnd = findTrivLogMsg( window, true );
  if( topWnd.trivDebug ) {
    if( topWnd.trivDebugWnd && !topWnd.trivDebugWnd.closed && topWnd.trivDebugWnd.location ) {
      if( msg ) {
        if( topWnd.trivSaveMsg.length ) topWnd.trivSaveMsg += '<br />';
        topWnd.trivSaveMsg += msg;
      }
      if( topWnd.trivAddMsgFunc ) {
        msg = topWnd.trivSaveMsg;
        topWnd.trivSaveMsg = '';
        topWnd.trivAddMsgFunc( msg );
      }
    }
    else {
      topWnd.trivSaveMsg    = msg;
      topWnd.trivDebugWnd   = topWnd.open( 'trivantisdebug.html', 'TrivantisDebug', 'width=400,height=400,scrollbars=0,resizable=1,menubar=0,toolbar=0,location=0,status=0' )
      if( topWnd.trivDebugWnd ) {
        topWnd.trivDebugWnd.focus()
        setTimeout( "trivLogMsg()", 1000 );
      }
    }
  }
}

function findTrivLogMsg( win, bCheckOpener ) {

   if( bCheckOpener && win.opener && win.opener.trivLogMsg ) {
     return findTrivLogMsg( win.opener, false )
   }
   
   while( win ) {
     if( win.parent && win.parent != win && win.parent.trivLogMsg ) win = win.parent;
     else break;
   }
   return win;
}

function ObjLayer(id,pref,frame) {
  if (!ObjLayer.bInit && !frame) InitObjLayers()
  this.frame = frame || self
  if (is.ns) {
    if (is.ns5) {
      this.ele = this.event = document.getElementById(id)
      this.styObj = this.ele.style
      this.doc = document
      this.x = this.ele.offsetLeft
      this.y = this.ele.offsetTop
      this.w = this.ele.offsetWidth
      this.h = this.ele.offsetHeight
    }
    else if (is.ns4) {
      if (!frame) {
        if (!pref) var pref = ObjLayer.arrPref[id]
        this.styObj = (pref)? eval("document."+pref+".document."+id) : document.layers[id]
      }
      else this.styObj = (pref) ? eval("frame.document."+pref+".document."+id) : frame.document.layers[id]
      this.ele = this.event = this.styObj
      this.doc = this.styObj.document
      this.x = this.styObj.left
      this.y = this.styObj.top
      this.w = this.styObj.clip.width
      this.h = this.styObj.clip.height
    }
  }
  else if (is.ie) {
    this.ele = this.event = this.frame.document.all[id]
    this.styObj = this.frame.document.all[id].style
    this.doc = document
    this.x = this.ele.offsetLeft
    this.y = this.ele.offsetTop
    this.w = this.ele.offsetWidth
    this.h = this.ele.offsetHeight
  }
  if( this.styObj ) this.styObj.visibility = (is.ns4)? "hide" : "hidden"
  this.id = id
  this.unique = 1;
  this.pref = pref
  this.obj = id + "ObjLayer"
  eval(this.obj + "=this")
  this.hasMoved = false;
  this.newX = null;
  this.newY = null;
}

function ObjLayerMoveTo(x,y) {
  if (x!=null) {
    this.x = x
    if( this.styObj ) this.styObj.left = this.x
  }
  if (y!=null) {
    this.y = y
    if( this.styObj ) this.styObj.top = this.y
  }
}

function ObjLayerMoveBy(x,y) {
  this.moveTo(this.x+x,this.y+y)
}

function ObjLayerClipInit(t,r,b,l) {
  if (!is.ns4) {
    if (arguments.length==4) this.clipTo(t,r,b,l)
    else this.clipTo(0,this.ele.offsetWidth,this.ele.offsetHeight,0)
  }
}

function ObjLayerClipTo(t,r,b,l) {
  if( !this.styObj ) return;
  if (is.ns4) {
    this.styObj.clip.top = t
    this.styObj.clip.right = r
    this.styObj.clip.bottom = b
    this.styObj.clip.left = l
  }
  else this.styObj.clip = "rect("+t+"px "+r+"px "+b+"px "+l+"px)"
}

function ObjLayerShow() {
  if( this.styObj ) this.styObj.visibility = "inherit"
}

function ObjLayerHide() {
  if( this.styObj ) this.styObj.visibility = (is.ns4)? "hide" : "hidden"
}

function ObjLayerActionGoTo( destURL, destFrame, subFrame, bFeed ) {
  var targWind = null
  var bFeedback = bFeed != null ? bFeed : true
  if( destFrame ) {
    if( destFrame == "opener" ) targWind = parent.opener;
    else if( destFrame == "_top" ) targWind = eval( "parent" ) 
    else if(destFrame == "NewWindow" ) targWind = open( destURL, 'NewWindow' )
    else {
      var parWind = eval( "parent" )
      var index=0
      while( index < parWind.length ) {
        if( parWind.frames[index].name == destFrame ) {
          targWind = parWind.frames[index]
          break;
        }
        index++;
      }
      if( subFrame ) {
        index=0
        parWind = targWind
        while( index < parWind.length ) {
          if( parWind.frames[index].name == subFrame ) {
            targWind = parWind.frames[index]
            break;
          }
          index++;
        }
      }
      try
      {
        if( !targWind.closed && targWind.trivExitPage ) {
          targWind.trivExitPage( destURL, bFeedback )
          return
        }
      }catch(e){}      
    }
  }
  if( !targWind ) targWind = window
  try
  {
    if( !targWind.closed ) targWind.location.href = destURL;
  }catch(e){}      
}

function ObjLayerActionGoToNewWindow( destURL, name, props ) {
  var targWind
  if ((props.indexOf('left=') == -1) && (props.indexOf('top=') == -1)) props += GetNewWindXAndYPos( props );
  targWind = window.open( destURL, name, props, false )
  if( targWind ) targWind.focus()
  return targWind
}

function GetNewWindXAndYPos( props ) {
  var countOfW = 'width='.length
  var idxW = props.indexOf('width=');
  var wndW = GetMiddleString( props, countOfW + idxW, ',' )
  var countOfH = 'height='.length
  var idxH = props.indexOf('height=');
  var wndH = GetMiddleString( props, countOfH + idxH, ',' )  
  var wndX = (screen.width - wndW) / 2;
  var wndY = (screen.height - wndH) / 2;	
  return ',left=' + wndX + ',top=' + wndY;
}

function GetMiddleString( str, startIndex, endChar ) {
  var midStr = '';
  for (strIndex = startIndex; str.charAt(strIndex) != endChar; strIndex++) {
    midStr += str.charAt(strIndex);
  }  
  return midStr;
}

function ObjLayerActionPlay( ) {
}

function ObjLayerActionStop( ) {
}

function ObjLayerActionShow( ) {
    this.show();
}

function ObjLayerActionHide( ) {
    this.hide();
}

function ObjLayerActionLaunch( ) {
}

function ObjLayerActionExit( ) {
    window.top.close()
}

function ObjLayerActionChangeContents( ) {
}

function ObjLayerActionTogglePlay( ) {
}

function ObjLayerIsVisible() {
  if( !this.styObj || this.styObj.visibility == "hide" || this.styObj.visibility == "hidden" ) return false;
  else return true;
}

{ // Setup prototypes
var p=ObjLayer.prototype
p.moveTo = ObjLayerMoveTo
p.moveBy = ObjLayerMoveBy
p.clipInit = ObjLayerClipInit
p.clipTo = ObjLayerClipTo
p.show = ObjLayerShow
p.hide = ObjLayerHide
p.actionGoTo = ObjLayerActionGoTo
p.actionGoToNewWindow = ObjLayerActionGoToNewWindow
p.actionPlay = ObjLayerActionPlay
p.actionStop = ObjLayerActionStop
p.actionShow = ObjLayerActionShow
p.actionHide = ObjLayerActionHide
p.actionLaunch = ObjLayerActionLaunch
p.actionExit = ObjLayerActionExit
p.actionChangeContents = ObjLayerActionChangeContents
p.actionTogglePlay = ObjLayerActionTogglePlay
p.isVisible = ObjLayerIsVisible
p.write = ObjLayerWrite
p.hackForNS4 = ObjLayerHackForNS4
}

// InitObjLayers Function
function InitObjLayers(pref) {
  if (!ObjLayer.bInit) ObjLayer.bInit = true
  if (is.ns) {
    if (pref) ref = eval('document.'+pref+'.document')
    else {
      pref = ''
      if( is.ns5 ) {
        document.layers = document.getElementsByTagName("*")
        ref = document
      }
      else ref = document
    }
    for (var i=0; i<ref.layers.length; i++) {
      var divname
      if( is.ns5 ) {
        if( ref.layers[i] ) divname = ref.layers[i].tagName
        else divname = null
      }
      else divname = ref.layers[i].name
      if( divname ) {
        ObjLayer.arrPref[divname] = pref
        if (!is.ns5 && ref.layers[i].document.layers.length > 0) {
          ObjLayer.arrRef[ObjLayer.arrRef.length] = (pref=='')? ref.layers[i].name : pref+'.document.'+ref.layers[i].name
        }
      }
    }
    if (ObjLayer.arrRef.i < ObjLayer.arrRef.length) {
      InitObjLayers(ObjLayer.arrRef[ObjLayer.arrRef.i++])
    }
  }
  return true
}

ObjLayer.arrPref = new Array()
ObjLayer.arrRef = new Array()
ObjLayer.arrRef.i = 0
ObjLayer.bInit = false

function ObjLayerSlideEnd() {
  this.tTrans = -1;
  if( is.ns4 ) setTimeout( this.obj+".hackForNS4()", 10 )
}

function ObjLayerHackForNS4() {
  if( this.isVisible() )
  {
    this.hide()
    setTimeout( this.obj+".show()", 10 )
  }
}

function ObjLayerWrite(html) {
  if (is.ns4) {
    this.doc.open()
    this.doc.write(html)
    this.doc.close()
  }
  else this.event.innerHTML = html
}

function BrowserProps() {
  var name = navigator.appName
  
  if (name=="Netscape") name = "ns"
  else if (name=="Microsoft Internet Explorer") name = "ie"
  
  this.v = parseInt(navigator.appVersion,10)
  this.ns = (name=="ns" && this.v>=4)
  this.ns4 = (this.ns && this.v==4)
  this.ns5 = (this.ns && this.v==5)
  this.nsMac = (this.ns && navigator.platform.indexOf("Mac") >= 0 )
  this.ie = (name=="ie" && this.v>=4)
  this.ie4 = (this.ie && navigator.appVersion.indexOf('MSIE 4')>0)
  this.ie5 = (this.ie && navigator.appVersion.indexOf('MSIE 5')>0)
  this.ieMac = (this.ie && navigator.platform.indexOf("Mac") >= 0 )
  this.op = navigator.userAgent.indexOf("Opera")!=-1
  this.min = (this.ns||this.ie)
  this.Mac = (navigator.platform.indexOf("Mac") >= 0)
  this.activeX = ( this.ie ) ? true : false; 
  this.wmpVersion = 6; // default version number we only support 7 and up
  var player = null;
  try 
  {
    if(window.ActiveXObject)
      player = new ActiveXObject("WMPlayer.OCX.7");
    else if (window.GeckoActiveXObject)
      player = new GeckoActiveXObject("WMPlayer.OCX.7");
    else
      player = navigator.mimeTypes["application/x-mplayer2"].enabledPlugin;		
  }
  catch(e)
  {
    // Handle error only if title has wmp-- no WMP control
 
  }
  
  if( player && player.versionInfo ) {
    this.wmpVersion = player.versionInfo.slice(0,player.versionInfo.indexOf('.'));
  }
}

is = new BrowserProps()

// CSS Function
function buildCSS(id,left,top,width,height,visible,zorder,color,other) {
  var str = (left!=null && top!=null)? '#'+id+' {position:absolute; left:'+left+'px; top:'+top+'px;' : '#'+id+' {position:relative;'
  if (arguments.length>=4 && width!=null) str += ' width:'+width+'px;'
  if (arguments.length>=5 && height!=null) {
    str += ' height:'+height+'px;'
    if (arguments.length<9 || other.indexOf('clip')==-1) str += ' clip:rect(0px '+width+'px '+height+'px 0px);'
  }
  if (arguments.length>=6 && visible!=null) str += ' visibility:'+ ( (visible)? 'inherit' : ( (is.ns4)? 'hide' : 'hidden' ) ) +';'
  if (arguments.length>=7 && zorder!=null) str += ' z-index:'+zorder+';'
  if (arguments.length>=8 && color!=null) str += (is.ns4)? ' layer-background-color:'+color+';' : ' background:'+color+';'
  if (arguments.length==9 && other!=null) str += ' '+other
  str += '}\n'
  return str
}

function writeStyleSheets(str) {
  cssStr = '<style type="text/css">\n'
  cssStr += str
  cssStr += '</style>'
  document.write(cssStr)
}

function preload() {
  if (!document.images) return;
  var ar = new Array();
  for (var i = 0; i < arguments.length; i++) {
    ar[i] = new Image();
    ar[i].src = arguments[i];
  }
}

function getHTTP(dest, method, parms)
{
    var httpReq;
    if( method == 'GET' ) { 
        if( parms ) {
        dest += '?' + parms;
        parms = null;
        }
    }
    
    var msg = 'Issuing ' + method + ' to ' + dest;
    if( parms ) msg += ' for [' + parms + ']';
    trivLogMsg( msg );
    
    var requestSent = 0;
    try { 
        // branch for native XMLHttpRequest object
        if (window.XMLHttpRequest) {
            httpReq = new XMLHttpRequest();
            httpReq.open(method, dest, false);
            httpReq.onreadystatechange = null;
            if( method == 'POST' ) {
              httpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            }
            httpReq.send(parms); 
            requestSent = 1;
        } 
    }
    catch(e){}
    
    // branch for IE/Windows ActiveX version
    if (!requestSent && window.ActiveXObject) {
        httpReq = new ActiveXObject("Microsoft.XMLHTTP");
        if (httpReq) {
            httpReq.open(method, dest, false);
            if( method == 'POST' ) {
              httpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            }
            httpReq.send(parms);
        }
    }
    trivLogMsg( 'ReturnCode = ' + httpReq.status + ' Received Data [' + httpReq.responseText + ']' );
    return httpReq;
}

function GenRand( min, max )
{
  return Math.floor( Math.random() * ( max - min + 1 ) + min );
}

function UniEscape( s )
{
  return( unescape( escape( s ).replace(/%u/g, '\\u') ) );
}

function UniUnescape( s )
{
  return( unescape( s.replace(/\\u/g, '%u') ) );
}