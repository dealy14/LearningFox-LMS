/*************************************************************************/
/* SPAGHETTILEARNING - E-Learning System                                 */
/* ============================================                          */
/*                                                                       */
/* Copyright (c) 2007 by Emanuele Sandri (emanuele@docebo.com)           */
/*                                                                       */
/* This program is free software. You can redistribute it and/or modify  */
/* it under the terms of the GNU General Public License as published by  */
/* the Free Software Foundation; either version 2 of the License.        */
/*************************************************************************/
/*
 * @module ScormApi.js
 * javascript SCORM API 1.2
 * @author Emanuele Sandri
 * @date	09/11/2007
 * @revision 1.1
 *	this revision is based on SOAP protocol specs.
 * @revision 1.2
 *	added event block during communication in geko
 *	added dialog box during communication on IE
 * @revision 1.3
 *  only initialize and commit execute server connection
 *  set & get work on a local xml
 * @version $Id: ScormApi.js 1002 2007-03-24 11:55:51Z fabio $
 */

 /**
  * class ScormAPI
  * @param baseurl the url to be used to contact the soap interface
  *	@param serviceid the service id to map correct service (hostname:port#SOAPLMS)
  *	@param userid the id of the user
  *	@param scormid id of scorm object
  */
 function ScormApi(host, baseurl, serviceid, idUser, idReference, idscorm_organization) {
 	this.id = "";
	this.idscorm_item = "";
	this.idUser = idUser || "";
	this.idReference = idReference || "";
	this.idscorm_organization = idscorm_organization || "";
	this.xmldoc = null;
	this.errorCode = "0";
	this.diagnostic = "";
	this.setErrorCodes;
	this.baseurl = baseurl || "";
	this.host = host || "";
	this.serviceid = serviceid || "";
	this.initialize_cb = null;
	this.finish_cb = null;
	this.getvalue_cb = null;
	this.setvalue_cb = null;
	this.commit_cb = null;
	this.transmission_start_cb = null;
	this.transmission_end_cb = null;
	this.dbgLevel = 0;
	this.dbgOut = null;
	this.initialized = false;
	this.basepath = this.baseurl.substring(0, this.baseurl.lastIndexOf( "/" ));

	this.scoStatus = ScormApi.UNINITIALIZED;
	this.toUseWD = true; 					// use wait dialog

	if( this.host != '' )
		loadFromXml( this.basepath + '/scormItemTrackData-1.2.xml', null, this );
	
 }
 
ScormApi.prototype.feelThePresence = function(  ) {
	alert('Yes executor ?');
	return true;
}

ScormApi.UNINITIALIZED = 0;
ScormApi.INITIALIZED = 1;
ScormApi.FINISHED = 2;
 
ScormApi.prototype.useWaitDialog = function( toUse ) {
	this.toUseWD = toUse;
}
 
 ScormApi.prototype.setXmlDocument = function( xmldoc ) {
 	this.tomTemplate = xmldoc;
 }
 
 ScormApi.prototype.setTom = function( tom ) {
 	this.tom = CreateXmlDocument();
 	var rootelem = importAllNode( this.tom, this.tomTemplate.documentElement, true );
 	this.tom.appendChild( rootelem );
	// trasforma il tracciamento dell'utente nel tracciamento template
 	// esegue la navigazione in tutti i nodi di tom e per ogni valore trovato
 	// lo imposta in this.tom
 	rootelem = tom.selectSingleNode('//cmi');
 	this.parseXML( rootelem, '/' , this, this.setTomParam );
 }
 
 ScormApi.prototype.setTomParam = function( elem, basequery ) {
 	var index = elem.getAttribute('index');
 	var item = elem.getAttribute('item');
	var query = basequery + elem.tagName;
	var elemContainer = this.tom.selectSingleNode(query);
	var value = elem.hasChildNodes()?elem.firstChild.nodeValue:'';
	
 	if( index != null && index.isInteger() ) {
 		elemContainer.setAttribute('isset','1'); 	
 		// elemento da creare nel this.tom
 		var elemIndex = this.tom.selectSingleNode(query + '/index' );
 		// clono index in un index_entry
 		var index_entry = this.tom.createElement('index_entry');
 		elemContainer.appendChild(index_entry);
 		index_entry.setAttribute( "index", index );
 		for( var iChild = 0; iChild < elemIndex.childNodes.length; iChild++ ) {
			index_entry.appendChild(elemIndex.childNodes.item(iChild).cloneNode(true));
		}
 		index_entry.setAttribute('isset','1');		
		basequery = query + '/index_entry[@index="' + index + '"]/';
		return basequery;
 	} else if( item == 'yes') {
 		elemContainer.setAttribute('isset','1');
 		if( elemContainer.hasChildNodes() )
			elemContainer.firstChild.nodeValue = value;
		else
			elemContainer.appendChild( this.tom.createTextNode(value) );
		basequery = query + '/';
 	} else {
 		elemContainer.setAttribute('isset','1');
 		basequery = query + '/';
 	}
 	return basequery;
 }
 
 ScormApi.prototype.parseXML = function( elem, basequery, obj, func ) {
 	basequery = func.call( obj, elem, basequery );
 	if( basequery === false ) return;
 	var childs = elem.childNodes;
 	for( var i = 0; i < childs.length; i++ ) {
 		if( childs.item(i).nodeType == 1 ) // solo sugli elementi
	 		this.parseXML( childs.item(i), basequery, obj, func );
 	}
 }
 
 ScormApi.prototype.getStrTom = function() {
 	this.track = CreateXmlDocument();
 	var rootelem = this.track.createElement('trackobj');
 	this.track.appendChild(rootelem);
 	
 	this.parseXML( this.tom.documentElement, '/trackobj' , this, this.setTrack );
 	
 	var tmpelem = this.track.createElement('remove');
 	var idUser = this.track.createElement('idUser');
 	var idReference = this.track.createElement('idReference');
 	var idscorm_item = this.track.createElement('idscorm_item'); 	 	

	idUser.appendChild(this.track.createTextNode(this.idUser));
	idReference.appendChild(this.track.createTextNode(this.idReference));
	idscorm_item.appendChild(this.track.createTextNode(this.idscorm_item));

	tmpelem.appendChild(idUser);
	tmpelem.appendChild(idReference);
	tmpelem.appendChild(idscorm_item);		
 	
 	rootelem.appendChild(tmpelem);
 	
 	return SerializeXML( this.track );
 }
 
 ScormApi.prototype.setTrack = function( elem, basequery ) {
	var isset = elem.getAttribute('isset');
	if( isset == null || isset == '0' ) return false;
  	var index = elem.getAttribute('index');
 	var item = elem.getAttribute('item');
	var query = basequery;
	var elemContainer = this.track.selectSingleNode(query);
	var value = elem.hasChildNodes()?elem.firstChild.nodeValue:'';
 
 	if( index != null && index == 'yes' ) {
 		// do nothing!
 	} else if( index != null && index.isInteger() ) {
 		var te = this.track.createElement( elem.parentNode.tagName );
 		elemContainer.appendChild(te);
 		te.setAttribute('index',index);
 		te.setAttribute('item',item);
 		basequery += '/' + te.tagName + '[@index="' + index + '"]';
 	} else if( item == 'yes' ) {
 		var te = importAllNode(this.track, elem, false);
 		elemContainer.appendChild(te);
 		te.appendChild(this.track.createTextNode(value));
 		basequery += '/' + te.tagName;
 	} else {
 		var te = importAllNode(this.track, elem, false);
 		elemContainer.appendChild(te);
 		basequery += '/' + te.tagName; 		
 	}
 	return basequery;
 }
 
 ScormApi.prototype.setIdscorm_item = function( idscorm_item ) {
 	this.idscorm_item = idscorm_item;
 }
 
ScormApi.prototype.getIdscorm_item = function() {
 	return this.idscorm_item;
}
 
 ScormApi.prototype.setIdscorm_organization = function( idscorm_organization ) {
 	this.idscorm_organization = idscorm_organization;
 }
 /*
  * This function indicates to the API Adapter that the SCO is
  * going to communicate with the LMS. It allows the LMS to handle LMS
  * specific initialization issues. It is a requirement of the SCO that
  * it call this function before calling any other API functions.
  */
 ScormApi.prototype.LMSInitialize = function( param ) {
 	this.initialized = true;
 	// @todo: test the connection with LMS and the prerequisites
	if( this.dbgLevel > 0 ) {
		this.dbgPrint( '+LMSInitialize( "' + param + '" );' );
		this.dbgPrint( '-LMSInitialize:"true"' );
	}
	this.commonLMSInitialize();
	if( this.initialize_cb != null ) {
		try {
			this.initialize_cb(this);
		} catch( ex ) {};
	}
	return new String("true");
 }
 
 ScormApi.prototype.LMSFinish = function( param ) {
 	this.initialized = false;
 	// nothing to do
	if( this.dbgLevel > 0 ) 
		this.dbgPrint( '+LMSFinish("' + param + '"); [' + this.idUser + ',' + this.idReference + ',' + this.idscorm_item + ']' );
 	
 	this.resetError();
	var result = "";
	if( this.transmission_start_cb != null )
		this.transmission_start_cb();
	result = this.commonLMSFinish(); 
	if( this.transmission_end_cb != null )
		this.transmission_end_cb();
	
	if( this.dbgLevel > 0 ) 
		this.dbgPrint( '-LMSFinish:"' + result + '"' );
	
	if( this.finish_cb != null ) 
		this.finish_cb( this );
	return result;
 }
 
 ScormApi.prototype.LMSCommit = function( param ) {
 	// nothing to do
	if( this.dbgLevel > 0 ) 
		this.dbgPrint( '+LMSCommit("' + param + '"); [' + this.idUser + ',' + this.idReference + ',' + this.idscorm_item + ']' );
 	
 	this.resetError();
	var result = "";
	if( this.transmission_start_cb != null )
		this.transmission_start_cb();
	result = this.commonLMSCommit(); 
	if( this.transmission_end_cb != null )
		this.transmission_end_cb();
	
	if( this.dbgLevel > 0 ) 
		this.dbgPrint( '-LMSCommit:"' + result + '"' );
	
	if( this.commit_cb != null ) 
		this.commit_cb( this );
	return result;
 }
 
 ScormApi.prototype.LMSGetLastError = function() {
	if( this.dbgLevel > 0 ) {
		this.dbgPrint( '+LMSGetLastError();' );
		this.dbgPrint( '-LMSGetLastError:"' + this.errorCode + '"' );
	}
 	return this.errorCode;
 }

 ScormApi.prototype.LMSGetErrorString = function( ecode ) {
	if( this.dbgLevel > 0 ) 
		this.dbgPrint( '+LMSGetErrorString("' + ecode + '");' );
		
 	var result = "";
 	if( this.errorTable[ecode] != null ) {
		result = this.errorTable[ecode];
	} 
	if( this.dbgLevel > 0 ) {
		this.dbgPrint( '-LMSGetErrorString:diagnostic"' + this.diagnostic + '"' );
		this.dbgPrint( '-LMSGetErrorString:"' + result + '"' );
	}
	return result;

 }
 
 ScormApi.prototype.LMSGetDiagnostic = function( ecode ) {
	if( this.dbgLevel > 0 ) {
		this.dbgPrint( '+LMSGetDiagnostic("' + ecode + '");' );
		this.dbgPrint( '+LMSGetDiagnostic:"' + this.diagnostic + '"' );
	}
	
 	return this.diagnostic;
 }
 
 ScormApi.prototype.LMSGetValue = function( param ) {
	if( this.dbgLevel > 0 ) 
		this.dbgPrint( '+LMSGetValue("' + param + '"); [' + this.idUser + ',' + this.idReference + ',' + this.idscorm_item + ']' );
 	
 	this.resetError();
	var result = "";
	if( this.transmission_start_cb != null )
		this.transmission_start_cb();
	result = this.commonLMSGetValue( param );
	if( this.transmission_end_cb != null )
		this.transmission_end_cb();
	
	if( this.dbgLevel > 0 ) 
		this.dbgPrint( '-LMSGetValue:"' + result + '"' );
	if(result == null) result = "";
	return result;
 }

ScormApi.prototype.LMSSetValue = function( param, data ) {
	if( this.dbgLevel > 0 )
		this.dbgPrint( '+LMSSetValue("' + param + '", "' + data + '");' );

 	this.resetError();
	var result = "";
	if( this.transmission_start_cb != null )
		this.transmission_start_cb();
	result = this.commonLMSSetValue( param, data );
	if( this.transmission_end_cb != null )
		this.transmission_end_cb();
	
	if( this.dbgLevel > 0 ) 
		this.dbgPrint( '-LMSSetValue:"' + result + '"' );
	
	if(result == null) return new String("false");
	else return new String("true");
}
  
 // =========== Private functions ============================
ScormApi.prototype.commonLMSInitialize = function() {
    if( this['xmlhttp'] == null ) {
		this.xmlhttp = this.CreateXmlHttpRequest();
	}
	var xmlhttp = this.xmlhttp;
	
	xmlhttp.open("POST", this.baseurl + '?op=Initialize', false);
	
	xmlhttp.setRequestHeader("Man", "POST " + this.baseurl + " HTTP/1.1");
	xmlhttp.setRequestHeader("Host", this.host );
	xmlhttp.setRequestHeader("Content-type", "text/xml; charset=utf-8");
	xmlhttp.setRequestHeader("SOAPAction", this.serviceid + "Initialize" );

	strSoap = '<?xml version="1.0" encoding="utf-8"?>' 
			+ '<env:Envelope xmlns:env="http://schemas.xmlsoap.org/soap/envelope/"'
			+ ' xmlns:enc="http://schemas.xmlsoap.org/soap/encoding/"' 
			+ ' env:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"'
			+ ' xmlns:xs="http://www.w3.org/1999/XMLSchema"'
			+ ' xmlns:xsi="http://www.w3.org/1999/XMLSchema-instance">'
			+	'<env:Header/>'
			+	'<env:Body>'
			+		'<a0:Initialize xmlns:a0="' + this.serviceid + '">'
			+			'<idUser xsi:type="xs:string">' + this.idUser + '</idUser>'
			+			'<idReference xsi:type="xs:string">' + this.idReference + '</idReference>'
			+			'<idscorm_item xsi:type="xs:string">' + this.idscorm_item + '</idscorm_item>'
			+		'</a0:Initialize>'
			+	'</env:Body>'
			+ '</env:Envelope>';
	
	xmlhttp.send(strSoap);
	
	if( xmlhttp.status == 200 ) {
		try {
			this.setTom( xmlhttp.responseXML );
			this.scoStatus = ScormApi.INITIALIZED;
		} catch (ex) {
			w = window.open('#', 'debug');
			w.document.open();
			w.document.write( xmlhttp.responseText );
			w.document.close();
   			alert( ex );
			alert( xmlhttp.responseText );
		}
	} else {
		this.setError("101");
		this.diagnostic = xmlhttp.responseText;
		alert( this.diagnostic );
	}
	return new String("true");
}

ScormApi.prototype.commonLMSFinish = function() {
    if( this['xmlhttp'] == null ) {
		this.xmlhttp = this.CreateXmlHttpRequest();
	}
	var xmlhttp = this.xmlhttp;
	
	xmlhttp.open("POST", this.baseurl + '?op=Finish', false);
	
	xmlhttp.setRequestHeader("Man", "POST " + this.baseurl + " HTTP/1.1");
	xmlhttp.setRequestHeader("Host", this.host );
	xmlhttp.setRequestHeader("Content-type", "text/xml; charset=utf-8");

	strSoap = this.getStrTom();

	xmlhttp.send(strSoap);
	
	if( xmlhttp.status == 200 ) {
		try {
			var xmldoc = xmlhttp.responseXML;		
			var status = xmldoc.getElementsByTagName("status").item(0).firstChild;
			var errorCode = xmldoc.getElementsByTagName("error").item(0).firstChild;
			var errorText = xmldoc.getElementsByTagName("errorString").item(0).firstChild;
			if( status.nodeValue == "success" ) {
				return "true";
			} else {
				this.setError(errorCode == null ? "102":errorCode.nodeValue);
				this.diagnostic = errorText == null ? "":errorText.nodeValue;
				return "false";
			}	
			this.scoStatus = ScormApi.UNINITIALIZED;
		} catch (ex) {
			w = window.open('#', 'debug');
			w.document.open();
			w.document.write( xmlhttp.responseText );
			w.document.close();
   			alert( ex );
			return "false"
		}
	} else {
		this.setError("101");
		this.diagnostic = xmlhttp.responseText;
		return "false"
	}
	return new String("true");
}

ScormApi.prototype.commonLMSGetValue = function( param ) {
	var pi = new ScormParamInfo();
	pi.Initialize( param, this.tom, ScormCache.DSCORM_METHOD_GET, null );
	return pi.getParamValue();
}

ScormApi.prototype.commonLMSSetValue = function( param, value ) {
	var pi = new ScormParamInfo();
	pi.Initialize( param, this.tom, ScormCache.DSCORM_METHOD_SET, value );
	return pi.setParamValue(value);
} 

ScormApi.prototype.commonLMSCommit = function( param ) {
    if( this['xmlhttp'] == null ) {
		this.xmlhttp = this.CreateXmlHttpRequest();
	}
	var xmlhttp = this.xmlhttp;
	
	xmlhttp.open("POST", this.baseurl + '?op=Commit', false);
	xmlhttp.setRequestHeader("Man", "POST " + this.baseurl + " HTTP/1.1");
	xmlhttp.setRequestHeader("Host", this.host );
	xmlhttp.setRequestHeader("Content-Type", "text/xml; charset=utf-8");
	xmlhttp.setRequestHeader("SOAPAction", this.serviceid + "Commit" );	
	
	strSoap = this.getStrTom();

	xmlhttp.send(strSoap);
	
	if( xmlhttp.status == 200 ) {
		try {
			var xmldoc = xmlhttp.responseXML;		
			var status = xmldoc.getElementsByTagName("status").item(0).firstChild;
			var errorCode = xmldoc.getElementsByTagName("error").item(0).firstChild;
			var errorText = xmldoc.getElementsByTagName("errorString").item(0).firstChild;
			if( status.nodeValue == "success" ) {
				return "true";
			} else {
				this.setError(errorCode == null ? "102":errorCode.nodeValue);
				this.diagnostic = errorText == null ? "":errorText.nodeValue;
				return "false";
			}	
		} catch (ex) {
			w = window.open('#', 'debug');
			w.document.open();
			w.document.write( xmlhttp.responseText );
			w.document.close();
   			alert( ex );
			return "false"
		}
	} else {
		this.setError("101");
		this.diagnostic = xmlhttp.responseText;
		return "false"
	}
	return new String("true");
}

ScormApi.prototype.CreateXmlHttpRequest = function() {
	// try first IE
	var xmlhttp = false;
	var actXArray = new Array( 	"MSXML4.XmlHttp", "MSXML3.XmlHttp", "MSXML2.XmlHttp", 
								"MSXML.XmlHttp", "Microsoft.XmlHttp" );
	var created = false;
	
	try {
		xmlhttp = new XMLHttpRequest();
	} catch (e) {
		xmlhttp=false;
	}
	if (!xmlhttp) {
		
		for( var i = 0; i < actXArray.length && !created; i++ ) {
			try {
				xmlhttp=new ActiveXObject(actXArray[i]);
				created = true;
			} catch (e) {
				// do nothing
			}
		}
	}
	if( !xmlhttp ) 
		alert( "This browser don't support required functionalities for scorm" );
	return xmlhttp;
}
 
 /**
  *	@internal
  * Set the error code 
  * @param string ecode error code
  * @return null
  */
 ScormApi.prototype.setError = function(ecode) {
 	this.errorCode = ecode;
 }
 
  /**
  *	@internal
  * Reset the error code 
  * @return null
  */
 ScormApi.prototype.resetError = function() {
 	this.errorCode = "0";
 }

 /**
  * @interal
  *	Error table
  */
 ScormApi.prototype.SCORM_STATUS_SUCCESS = "Success";
 ScormApi.prototype.SCORM_STATUS_ERROR = "Error";
 ScormApi.prototype.errorTable = new Object();
 ScormApi.prototype.errorTable["0"] = "No error";
 ScormApi.prototype.errorTable["101"] = "General exception";
 ScormApi.prototype.errorTable["201"] = "Invalid argument error";
 ScormApi.prototype.errorTable["202"] = "Elemet cannot have children";
 ScormApi.prototype.errorTable["203"] = "Elemet not an array - cannot have count";
 ScormApi.prototype.errorTable["301"] = "Not initialized";
 ScormApi.prototype.errorTable["401"] = "Not implemented error";
 ScormApi.prototype.errorTable["402"] = "Invalid set value, element is a keyword";
 ScormApi.prototype.errorTable["403"] = "Element is read only";
 ScormApi.prototype.errorTable["404"] = "Element is write only";
 ScormApi.prototype.errorTable["405"] = "Incorrect data type";

 /**
  *	@internal
  * Scorm LMS path
  */
 ScormApi.prototype.LMSUrl = "";
 
 
 /**
  * @internal
  * Debug print out function
  */
ScormApi.prototype.dbgPrint = function( text ) {
	var doc = this.dbgOut.ownerDocument;
	var outelem = doc.createTextNode('[' + this.userid + ',' + this.scoid + ',' + this.idscormpackage + '] ' + text);
	var crelem = doc.createElement("BR");
	this.dbgOut.appendChild(outelem);
	this.dbgOut.appendChild(crelem);
}

function ScormApiUI( host, baseurl, serviceid, idUser, idReference, idscorm_organization ) {
	this.base = ScormApi;
	this.base(host, baseurl, serviceid, idUser, idReference, idscorm_organization);
	this.slEventCap = 0;
	this.sStyle = "dialogHeight:100px;dialogWidth:150px";
}

ScormApiUI.prototype = new ScormApi;
 
ScormApi.prototype.LMSInitialize = function( param ) {
	this.initialized = false;
	
	// nothing to do
	if( this.dbgLevel > 0 ) 
		this.dbgPrint( '+LMSInitialize("' + param + '"); [' + this.idUser + ',' + this.idReference + ',' + this.idscorm_item + ']' );
 	
	this.resetError();
	var result = "";
	if( this.transmission_start_cb != null )
		this.transmission_start_cb();
	
	if( window.document.all && this.toUseWD) {	//IE
		// compute page position
		var args = new Object();
		args.sapi = this;
		args.func = "Initialize";
		args.param = param;
		result = showModalDialog( this.basepath + "/dialog.php", args, this.sStyle );
	} else {
		slStopEvents(window.top);
		result = this.commonLMSInitialize();
		window.setTimeout(	function restartEvents() { 
							slStartEvents(window.top); 
						}, 
						300 
					);
	}
	if( this.transmission_end_cb != null )
		this.transmission_end_cb();
	
	if( this.dbgLevel > 0 ) 
		this.dbgPrint( '-LMSInitialize:"' + result + '"' );
	
	if( this.initialize_cb != null ) 
		this.initialize_cb( param );
	
	return String(result);
} 
 
ScormApi.prototype.LMSFinish = function( param ) {
	this.initialized = false;
	// nothing to do
	if( this.dbgLevel > 0 ) 
		this.dbgPrint( '+LMSFinish("' + param + '"); [' + this.idUser + ',' + this.idReference + ',' + this.idscorm_item + ']' );
 	
	this.resetError();
	var result = "";
	if( this.transmission_start_cb != null )
		this.transmission_start_cb();
	
	if( window.document.all && this.toUseWD) {	//IE
		// compute page position
		var args = new Object();
		args.sapi = this;
		args.func = "Finish";
		args.param = param;
		result = showModalDialog( this.basepath + "/dialog.php", args, this.sStyle );
	} else {
		slStopEvents(window.top);
		result = this.commonLMSFinish();
		window.setTimeout(	function restartEvents() { 
							slStartEvents(window.top); 
						}, 
						300 
					);
	}
	if( this.transmission_end_cb != null )
		this.transmission_end_cb();
	
	if( this.dbgLevel > 0 ) 
		this.dbgPrint( '-LMSFinish:"' + result + '"' );
	
	if( this.finish_cb != null ) 
		this.finish_cb( param );
	return result;
}
 
ScormApi.prototype.LMSCommit = function( param ) {
 	this.initialized = false;
 	// nothing to do
	if( this.dbgLevel > 0 ) 
		this.dbgPrint( '+LMSCommit("' + param + '"); [' + this.idUser + ',' + this.idReference + ',' + this.idscorm_item + ']' );
 	
 	this.resetError();
	var result = "";
	if( this.transmission_start_cb != null )
		this.transmission_start_cb();
	
	if( window.document.all && this.toUseWD ) {	//IE
		// compute page position
		var args = new Object();
		args.sapi = this;
		args.func = "Commit";
		args.param = param;
		result = showModalDialog( this.basepath + "/dialog.php", args, this.sStyle );
	} else {
		slStopEvents(window.top);
		result = this.commonLMSCommit();
		window.setTimeout(	function restartEvents() { 
							slStartEvents(window.top); 
						}, 
						300 
					);
	}
	if( this.transmission_end_cb != null )
		this.transmission_end_cb();
	
	if( this.dbgLevel > 0 ) 
		this.dbgPrint( '-LMSCommit:"' + result + '"' );
	
	if( this.commit_cb != null ) 
		this.commit_cb( param );
	return result;
}
 
 function eventCanceller(ev) {
	if (!ev) var ev = window.event;
	//alert( ev );
	if( ev.stopPropagation ) {
		ev.preventDefault();        //DOM
		ev.stopPropagation();
	} else {
		ev.cancelBubble = true; //IE
		//alert( ev );
	}
	
	return false;
}

var slEventCap = 0;
// capture some window's events
function capwin(w) {
	if( w.document.attachEvent ) { //IE 5+
		w.document.attachEvent( "onclick",eventCanceller );
		w.document.attachEvent( "onmousedown",eventCanceller );
		w.document.attachEvent( "onfocus",eventCanceller );
	} else if( w.document.all ) { // IE 4
		w.onclick = eventCanceller;
		w.onmousedown = eventCanceller;
		w.onfocus = eventCanceller;
	} else { // geko
		w.addEventListener("click", eventCanceller, true);
		w.addEventListener("mousedown", eventCanceller, true);
		w.addEventListener("focus", eventCanceller, true);
	}
}

// release the captured events
function relwin(w) {
	try {
		if( w.document.attachEvent ) { //IE 5+
			w.document.detachEvent( "onclick", eventCanceller );
			w.document.detachEvent( "onmousedown", eventCanceller );
			w.document.detachEvent( "onfocus", eventCanceller );
		} else if( w.document.all ) { // IE 4
			w.onclick = null;
			w.onmousedown = null;
			w.onfocus = null;
		} else {
			w.removeEventListener("focus", eventCanceller, true);
			w.removeEventListener("mousedown", eventCanceller, true);
			w.removeEventListener("click", eventCanceller, true);
		}
	} catch( ex ) {
		// do nothing
	}
}


function slStopEvents(win) {
	slEventCap++;
	if( slEventCap > 1 ) 
		return;
	capwin(win);
	// capture other frames
	for (var i = 0; i < window.frames.length; capwin(window.frames[i++]));  
}

function slStartEvents(win) {
	slEventCap--;
	if( slEventCap > 0 ) 
		return;
	relwin(win);
	// release other frames
	for (var i = 0; i < window.frames.length; relwin(window.frames[i++])); 
}

function loadFromXml(xml_file, renderer, obj_ref) {
	
	if(window.ActiveXObject) {
		
		// browser is IE
		var xmldom = new ActiveXObject("Microsoft.XMLDOM");
		xmldom.async = false;
		xmldom.load(xml_file);
		
		if( xmldom.parseError.errorCode != 0 ) {
			alert( "xml parser error:"
					+ "\n code = " + xmldom.parseError.errorCode 
					+ "\n reason = " + xmldom.parseError.reason
					+ "\n line = " + xmldom.parseError.line
					+ "\n srcText = " + xmldom.parseError.srcText
					+ "\n xml_file = " + xml_file );
			return false;
		}
		xmldom.setProperty("SelectionLanguage", "XPath");
		
		if( renderer == null ) obj_ref.setXmlDocument(xmldom);
		else renderer(xmldom);
		
		return true;
	} else { 
		
		// load with xmlhttp, ema like this way ...
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET", xml_file, false);
		xmlhttp.send(null);
		
		if( xmlhttp.status == 200 ) {
			try {
				
				if( renderer == null ) obj_ref.setXmlDocument(xmlhttp.responseXML);
				else renderer(xmlhttp.responseXML);
			} catch (ex) {
				
				alert( xmlhttp.responseText );
			}
		} else {
			alert( xmlhttp.responseText );
		}
	}
  	return false;
}

function CreateXmlDocument() {
	var xdoc;
	if( window.ActiveXObject && /Win/.test(navigator.userAgent) ) {
		xdoc = new ActiveXObject("Microsoft.XMLDOM");
	} else if( document.implementation && document.implementation.createDocument ) {
		xdoc = document.implementation.createDocument("", "", null);
	} else {
		xdoc = false;
	}
	return xdoc;
}
 
function SerializeXML( domxml ) {
	try {
		var serializer = new XMLSerializer();
		return serializer.serializeToString(domxml);
	} catch(ex) {
		return domxml.xml;
	}
}

/** 
 * function importAllNode - IE don't implemente the W3C standard DOMDocument method
 * importNode. We use this function to walk around the MS hole.
 * @param Document xmldoc targhet of the import
 * @param Node node the node to copy in xmldoc
 * @param boolean bImportChildren if it's true the function import oNode and all
 *								it's childrens and descendants
 * @return Node the imported node in the xmldoc context
 **/ 
function importAllNode(xmldoc, oNode, bImportChildren){

	if( window.ActiveXObject && /Win/.test(navigator.userAgent) ) {
	
		var oNew;
	
		if(oNode.nodeType == 1){
			oNew = xmldoc.createElement(oNode.nodeName);
			for(var i = 0; i < oNode.attributes.length; i++){
				oNew.setAttribute(oNode.attributes[i].name, oNode.attributes[i].value);
			}
		} else if(oNode.nodeType == 3){
			oNew = xmldoc.createTextNode(oNode.nodeValue);
		}
		
		if(bImportChildren && oNode.hasChildNodes()){
			for(var oChild = oNode.firstChild; oChild; oChild = oChild.nextSibling){
				oNew.appendChild(importAllNode(xmldoc, oChild, true));
			}
		}
		
		return oNew;
	} else {
		return xmldoc.importNode(oNode, bImportChildren);
	}
}
	