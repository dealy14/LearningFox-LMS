<?xml version="1.0" encoding="UTF-8"?>
<!--version to Matthai, 18.1.2004-->
<!--version back from Mattha Matthai, 30.3.2004-->
<!--idx jetzt weg-->
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:xsi="http://www.w3.org/2000/10/XMLSchema-Instance" xmlns:my="http://www.isn.ethz.ch/namespace">
	<xsl:output method="html" encoding="utf-8" indent="yes"/>
	<xsl:variable name="max-img-width" select="300"/>
	<xsl:variable name="max-img-height" select="400"/>
	<xsl:variable name="juxtapose-width" select="300"/>
	<!-- juxtapose-width LESS THAN  max-img-width -->
	<xsl:template match="text()">
		<xsl:value-of select="." disable-output-escaping="yes"/>
	</xsl:template>
	<!--
         ! Root Template, the sco in all its glory
         !-->
	<xsl:template match="learningobject">
		<html>
			<meta http-equiv="Content-type" content="text/html; utf-8"/>
			<link rel="stylesheet" type="text/css" href="./css/plainvanilla.css"/>
			<script type="text/javascript" language="JavaScript1.2" src="./js/plainvanilla.js"/>
			<script type="text/javascript" language="JavaScript1.2" src="./js/x/x.js"/>
			<script type="text/javascript" language="JavaScript1.2" src="./js/x/x_drag.js"/>
			<script type="text/javascript" language="JavaScript1.2" src="./js/x/x_timer.js"/>
			<body onload="init()">
				<center>
					<div id="sco">
						<xsl:apply-templates select="title"/>
						<xsl:apply-templates select="description"/>
						<xsl:apply-templates select="objectives"/>
						<div id="throb"></div>
						<br clear="all"/>
						<div id="initmsg"></div>
						<div id="start" class="divstart" style="display:none">
							<input id="button.start" type="button" value="Start" onclick="eat(this)"/>
						</div>
						<xsl:apply-templates select="part"/>
						<xsl:apply-templates select="learningstep"/>
						<br clear="all"/>
						<div id="continue" style="display:none">
							<input type="button" id="button.continue" value="Continue" onclick="eat(this)"/>
						</div>
						<div id="finished" style="display:none">
						<p>
							You have completed this learning object.
						</p>
						</div>
						<div id="finishedwindow" style="display:none">
							<p>
						You have completed this learning object. <br/>
						Please click on the button to close this window.
						</p>
							<input type="button" id="button.close" value="Close" onclick="eat(this)"/>
						</div>
						<br clear="all"/>
						<div id="dbgmsg" style="position:absolute;display:none"></div>
					</div>
				</center>
				<br clear="all"/>
				<div id="dynWin" style="position:absolute;display:none">
					<img id="dynImg" title="Click on the top right corner to close"/>
				</div>
				<xsl:if test="count(descendant::audio)>0">
				<xsl:element name="applet">
					<xsl:attribute name="id">AudioPlayer</xsl:attribute>
					<xsl:attribute name="height">1</xsl:attribute>
					<xsl:attribute name="width">1</xsl:attribute>
					<xsl:attribute name="code">PlayerApplet</xsl:attribute>
					<xsl:attribute name="archive">./lib/javalayer.jar</xsl:attribute>
					<xsl:attribute name="scriptable">true</xsl:attribute>
				</xsl:element>
				<div id="dynAudio" style="position:absolute;display:none">
				<center>
				Audio Player
				<div id="dynAudioStatus">Initializing</div>
				</center>
				<input type="button" id="button.audio" value="Stop" onclick="eat(this)"/>
				<input type="button" id="button.save"  value="Save" onclick="eat(this)"/>
				</div>
				</xsl:if>
				<form name="dynDnld" method="GET" action=""></form>
			</body>
		</html>
	</xsl:template>
	<xsl:template match="description">
		<xsl:choose>
			<xsl:when test="name(parent::*)='part'">
				<xsl:element name="div">
					<xsl:attribute name="id">Description</xsl:attribute>
					<xsl:attribute name="style">display:none</xsl:attribute>
					<div id="partdescriptiontitle">Description</div>
					<p>
						<xsl:apply-templates/>
					</p>
				</xsl:element>
			</xsl:when>
			<xsl:when test="name(parent::*)='learningobject'">
				<xsl:element name="div">
					<xsl:attribute name="id">description</xsl:attribute>
					<div id="descriptiontitle">Description</div>
					<p>
						<xsl:apply-templates/>
					</p>
				</xsl:element>
			</xsl:when>
			<xsl:otherwise>
				<xsl:apply-templates/>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template match="objectives">
		<xsl:choose>
			<xsl:when test="name(parent::*)='part'">
				<xsl:element name="div">
					<xsl:attribute name="id">objectives</xsl:attribute>
					<xsl:attribute name="style">display:none</xsl:attribute>
					<div id="partobjectivestitle">Objectives</div>
					<p>
						<xsl:apply-templates/>
					</p>
				</xsl:element>
			</xsl:when>
			<xsl:when test="name(parent::*)='learningobject'">
				<xsl:element name="div">
					<xsl:attribute name="id">objectives</xsl:attribute>
					<div id="objectivestitle">Objectives</div>
					<p>
						<xsl:apply-templates/>
					</p>
				</xsl:element>
			</xsl:when>
			<xsl:otherwise>
				<xsl:apply-templates/>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<!--
	 ! Template: part
	 !-->
	<xsl:template match="part">
		<xsl:variable name="divid">part<xsl:call-template name="getp"/>
		</xsl:variable>
		<xsl:variable name="divclass">
			<xsl:value-of select="name()"/>
		</xsl:variable>
		<xsl:element name="div">
			<xsl:attribute name="id"><xsl:value-of select="$divid"/></xsl:attribute>
			<xsl:attribute name="class"><xsl:value-of select="$divclass"/></xsl:attribute>
			<xsl:attribute name="style">display:none</xsl:attribute>
			<xsl:apply-templates/>
		</xsl:element>
	</xsl:template>
	<!--
	 ! Template: learningstep
	 ! for each learning step, nothing special because we do dynView
	 !-->
	<xsl:template match="learningstep">
		<xsl:apply-templates/>
	</xsl:template>
	<!--
         ! pfplms p2 objects, generally
         !-->
	<xsl:template match="anyfile">
		<!-- not yet implemented -->
	</xsl:template>
	<xsl:template match="audio">
		<xsl:variable name="divid">s<xsl:call-template name="gets"/>n<xsl:call-template name="getn"/>i<xsl:call-template name="geti"/>
		</xsl:variable>
		<xsl:variable name="divclass">
			<xsl:value-of select="name()"/>
		</xsl:variable>
		<xsl:element name="div">
			<xsl:attribute name="id"><xsl:value-of select="$divid"/></xsl:attribute>
			<xsl:attribute name="class"><xsl:value-of select="$divclass"/></xsl:attribute>
			<xsl:attribute name="style">display:none</xsl:attribute>
			<p>
				<xsl:element name="img">
					<xsl:attribute name="align">left</xsl:attribute>
					<xsl:attribute name="border">0</xsl:attribute>
					<xsl:attribute name="src">./icons/audio.png</xsl:attribute>
					<xsl:attribute name="title">Click to play the audio clip</xsl:attribute>
					<xsl:attribute name="name">audio.<xsl:value-of select="count(preceding::audio)"/></xsl:attribute>
					<xsl:attribute name="onclick">eat(this)</xsl:attribute>
				</xsl:element>
				<xsl:text disable-output-escaping="yes">&lt;/a&gt;</xsl:text>
				<xsl:apply-templates/>
			</p>
		</xsl:element>
		<br clear="all"/>
	</xsl:template>
	<xsl:template match="bibitem">
		<xsl:variable name="divid">s<xsl:call-template name="gets"/>n<xsl:call-template name="getn"/>i<xsl:call-template name="geti"/>
		</xsl:variable>
		<xsl:variable name="divclass">
			<xsl:value-of select="name()"/>
		</xsl:variable>
		<xsl:element name="div">
			<xsl:attribute name="id"><xsl:value-of select="$divid"/></xsl:attribute>
			<xsl:attribute name="class"><xsl:value-of select="$divclass"/></xsl:attribute>
			<xsl:attribute name="style">display:none</xsl:attribute>
			<xsl:apply-templates select="title"/>
			<p>
				<img align="left" border="0" src="./icons/gdict.png" alt="That's all I can tell." title="dies ist der tooltip"/>
				<xsl:apply-templates select="description"/>
				<xsl:apply-templates select="text()"/>
				<br clear="all"/>
				<xsl:apply-templates select="details"/>
			</p>
		</xsl:element>
		<br clear="all"/>
	</xsl:template>
	<xsl:template match="definitionlist">
		<xsl:variable name="divid">s<xsl:call-template name="gets"/>n<xsl:call-template name="getn"/>i<xsl:call-template name="geti"/>
		</xsl:variable>
		<xsl:variable name="divclass">
			<xsl:value-of select="name()"/>
		</xsl:variable>
		<xsl:element name="div">
			<xsl:attribute name="id"><xsl:value-of select="$divid"/></xsl:attribute>
			<xsl:attribute name="class"><xsl:value-of select="$divclass"/></xsl:attribute>
			<xsl:attribute name="style">display:none</xsl:attribute>
			<xsl:apply-templates select="description"/>
			<dl>
				<xsl:apply-templates select="term|definition"/>
			</dl>
		</xsl:element>
	</xsl:template>
	<xsl:template match="document">
		<xsl:variable name="divid">s<xsl:call-template name="gets"/>n<xsl:call-template name="getn"/>i<xsl:call-template name="geti"/>
		</xsl:variable>
		<xsl:variable name="divclass">
			<xsl:value-of select="name()"/>
		</xsl:variable>
		<xsl:element name="div">
			<xsl:attribute name="id"><xsl:value-of select="$divid"/></xsl:attribute>
			<xsl:attribute name="class"><xsl:value-of select="$divclass"/></xsl:attribute>
			<xsl:attribute name="style">display:none</xsl:attribute>
			<p>
				<xsl:text disable-output-escaping="yes">&lt;a href="#" onclick="w=window.open('</xsl:text>
				<xsl:value-of select="@file"/>
				<xsl:text disable-output-escaping="yes">','file','width=600,height=380,toolbar=yes,location=yes,menubar=no,status=no,scrollbars=yes,resizable=yes,left=0,top=0');return false;"')&gt;</xsl:text>
				<img align="left" border="0" src="./icons/pdf.png" alt="PDF Document"/>
				<xsl:text disable-output-escaping="yes">&lt;/a&gt;</xsl:text>
				<xsl:apply-templates/>
			</p>
		</xsl:element>
	</xsl:template>
	<xsl:template match="mediafile">
		<xsl:variable name="divid">s<xsl:call-template name="gets"/>n<xsl:call-template name="getn"/>i<xsl:call-template name="geti"/>
		</xsl:variable>
		<xsl:variable name="divclass">
			<xsl:value-of select="name()"/>
		</xsl:variable>
		<xsl:element name="div">
			<xsl:attribute name="id"><xsl:value-of select="$divid"/></xsl:attribute>
			<xsl:attribute name="class"><xsl:value-of select="$divclass"/></xsl:attribute>
			<xsl:attribute name="style">display:none</xsl:attribute>
			<p>
				<xsl:text disable-output-escaping="yes">&lt;a href="#" onclick="w=window.open('</xsl:text>
				<xsl:value-of select="@file"/>
				<xsl:text disable-output-escaping="yes">','file','width=600,height=380,toolbar=yes,location=yes,menubar=no,status=no,scrollbars=yes,resizable=yes,left=0,top=0');return false;"')&gt;</xsl:text>
				<img align="left" border="0" src="./icons/file.png" alt="Media file"/>
				<xsl:text disable-output-escaping="yes">&lt;/a&gt;</xsl:text>
				<xsl:apply-templates/>
			</p>
		</xsl:element>
	</xsl:template>
	<xsl:template match="enumeration">
		<xsl:variable name="divid">s<xsl:call-template name="gets"/>n<xsl:call-template name="getn"/>i<xsl:call-template name="geti"/>
		</xsl:variable>
		<xsl:variable name="divclass">
			<xsl:value-of select="name()"/>
		</xsl:variable>
		<xsl:element name="div">
			<xsl:attribute name="id"><xsl:value-of select="$divid"/></xsl:attribute>
			<xsl:attribute name="class"><xsl:value-of select="$divclass"/></xsl:attribute>
			<xsl:attribute name="style">display:none</xsl:attribute>
			<xsl:apply-templates select="description"/>
			<ol>
				<xsl:apply-templates select="listitem"/>
			</ol>
		</xsl:element>
	</xsl:template>
	<xsl:template match="hint">
		<xsl:variable name="divid">s<xsl:call-template name="gets"/>n<xsl:call-template name="getn"/>i<xsl:call-template name="geti"/>
		</xsl:variable>
		<xsl:variable name="divclass">
			<xsl:value-of select="name()"/>
		</xsl:variable>
		<xsl:variable name="dhname">dh<xsl:value-of select="$divid"/>
		</xsl:variable>
		<xsl:element name="div">
			<xsl:attribute name="id"><xsl:value-of select="$divid"/></xsl:attribute>
			<xsl:attribute name="class"><xsl:value-of select="$divclass"/></xsl:attribute>
			<xsl:attribute name="style">display:none</xsl:attribute>
			<p>
				<xsl:apply-templates select="hintdetails">
					<xsl:with-param name="dethintname" select="$dhname"/>
				</xsl:apply-templates>
				<br clear="all"/>
				<xsl:element name="img">
					<xsl:attribute name="border">0</xsl:attribute>
					<xsl:attribute name="src">./icons/hint.png</xsl:attribute>
					<xsl:attribute name="alt"/>
					<xsl:choose>
						<xsl:when test="not(hintdetails)">
							<xsl:attribute name="title">That is all I can say.</xsl:attribute>
						</xsl:when>
						<xsl:otherwise>
							<xsl:attribute name="title">Click on me and I will tell you more.</xsl:attribute>
							<xsl:attribute name="onclick">eat(this)</xsl:attribute>
							<xsl:attribute name="name">hint.<xsl:value-of select="$dhname"/></xsl:attribute>
						</xsl:otherwise>
					</xsl:choose>
					<xsl:attribute name="align">left</xsl:attribute>
				</xsl:element>
				<xsl:apply-templates select="hinttext"/>
			</p>
			<br clear="all"/>
		</xsl:element>
	</xsl:template>
	<xsl:template match="htmlblock ">
		<xsl:variable name="divid">s<xsl:call-template name="gets"/>n<xsl:call-template name="getn"/>i<xsl:call-template name="geti"/>
		</xsl:variable>
		<xsl:variable name="divclass">
			<xsl:value-of select="name()"/>
		</xsl:variable>
		<xsl:element name="div">
			<xsl:attribute name="id"><xsl:value-of select="$divid"/></xsl:attribute>
			<xsl:attribute name="class"><xsl:value-of select="$divclass"/></xsl:attribute>
			<xsl:attribute name="style">display:none</xsl:attribute>
			<xsl:apply-templates/>
			<br clear="all"/>
		</xsl:element>
	</xsl:template>
	<xsl:template match="interaction">
		<xsl:variable name="divid">s<xsl:call-template name="gets"/>n<xsl:call-template name="getn"/>i<xsl:call-template name="geti"/>
		</xsl:variable>
		<xsl:variable name="divclass">
			<xsl:value-of select="name()"/>
		</xsl:variable>
		<xsl:element name="div">
			<xsl:attribute name="id"><xsl:value-of select="$divid"/></xsl:attribute>
			<xsl:attribute name="class"><xsl:value-of select="$divclass"/></xsl:attribute>
			<xsl:attribute name="style">display:none</xsl:attribute>
			<xsl:element name="form">
				<xsl:attribute name="name">fi_<xsl:call-template name="geti"/></xsl:attribute>
				<xsl:attribute name="onsubmit">return false;</xsl:attribute>
				<table>
					<xsl:apply-templates select="question"/>
					<!-- all types are explicitly listed, rethink this-->
					<xsl:apply-templates select="associate|choice|likert|textentry|fillinthegaps"/>
				</table>
			</xsl:element>
		</xsl:element>
	</xsl:template>
	<xsl:template match="itemization">
		<xsl:variable name="divid">s<xsl:call-template name="gets"/>n<xsl:call-template name="getn"/>i<xsl:call-template name="geti"/>
		</xsl:variable>
		<xsl:variable name="divclass">
			<xsl:value-of select="name()"/>
		</xsl:variable>
		<xsl:element name="div">
			<xsl:attribute name="id"><xsl:value-of select="$divid"/></xsl:attribute>
			<xsl:attribute name="class"><xsl:value-of select="$divclass"/></xsl:attribute>
			<xsl:attribute name="style">display:none</xsl:attribute>
			<xsl:apply-templates select="description"/>
			<ul>
				<xsl:apply-templates select="listitem"/>
			</ul>
		</xsl:element>
	</xsl:template>
	<xsl:template match="link">
		<xsl:variable name="divid">s<xsl:call-template name="gets"/>n<xsl:call-template name="getn"/>i<xsl:call-template name="geti"/>
		</xsl:variable>
		<xsl:variable name="divclass">
			<xsl:value-of select="name()"/>
		</xsl:variable>
		<xsl:element name="div">
			<xsl:attribute name="id"><xsl:value-of select="$divid"/></xsl:attribute>
			<xsl:attribute name="class"><xsl:value-of select="$divclass"/></xsl:attribute>
			<xsl:attribute name="style">display:none</xsl:attribute>
			<xsl:apply-templates select="title"/>
			<p>
				<xsl:text disable-output-escaping="yes">&lt;a href="#" onclick="w=window.open('</xsl:text>
				<xsl:value-of select="@href"/>
				<xsl:text disable-output-escaping="yes">', 'www', 'width=600,height=380,toolbar=yes,location=yes,menubar=no,status=no,scrollbars=yes,resizable=yes,left=0,top=0');setTimeout('w.focus();',250);return false;")&gt;</xsl:text>
				<img align="left" border="0" src="./icons/html.png" alt="That's all I can tell."/>
				<xsl:text disable-output-escaping="yes">&lt;/a&gt;</xsl:text>
				<xsl:apply-templates select="description"/>
			</p>
			<br clear="all"/>
		</xsl:element>
	</xsl:template>
	<xsl:template match="paragraph">
		<xsl:variable name="divid">s<xsl:call-template name="gets"/>n<xsl:call-template name="getn"/>i<xsl:call-template name="geti"/>
		</xsl:variable>
		<xsl:variable name="divclass">
			<xsl:value-of select="name()"/>
		</xsl:variable>
		<xsl:element name="div">
			<xsl:attribute name="id"><xsl:value-of select="$divid"/></xsl:attribute>
			<xsl:attribute name="class"><xsl:value-of select="$divclass"/></xsl:attribute>
			<xsl:attribute name="style">display:none</xsl:attribute>
			<p>
				<xsl:apply-templates/>
			</p>
		</xsl:element>
	</xsl:template>
	<xsl:template match="picture">
		<xsl:variable name="divid">s<xsl:call-template name="gets"/>n<xsl:call-template name="getn"/>i<xsl:call-template name="geti"/>
		</xsl:variable>
		<xsl:variable name="divclass">
			<xsl:value-of select="name()"/>
		</xsl:variable>
		<xsl:element name="div">
			<xsl:attribute name="id"><xsl:value-of select="$divid"/></xsl:attribute>
			<xsl:attribute name="class"><xsl:value-of select="$divclass"/></xsl:attribute>
			<xsl:attribute name="style">display:none</xsl:attribute>
			<p>
				<xsl:choose>
					<xsl:when test="(@width &gt; $max-img-width) or (@height &gt; $max-img-height)">
						<xsl:call-template name="scaled"/>
					</xsl:when>
					<xsl:otherwise>
						<xsl:element name="img">
							<xsl:attribute name="hspace">10</xsl:attribute>
							<xsl:attribute name="vspace">2</xsl:attribute>
							<xsl:if test="not(@width &gt; $juxtapose-width)">
								<xsl:attribute name="align">left</xsl:attribute>
							</xsl:if>
							<xsl:attribute name="id">pic<xsl:call-template name="getpicidx"/></xsl:attribute>
							<xsl:attribute name="name">im<xsl:call-template name="getn"/></xsl:attribute>
							<xsl:attribute name="onload">eat(this)</xsl:attribute>
							<xsl:apply-templates select="@*"/>
						</xsl:element>
						<xsl:if test="(@width &gt; $juxtapose-width)">
							<br clear="all"/>
						</xsl:if>
						<i>
							<xsl:apply-templates select="description"/>
						</i>
					</xsl:otherwise>
				</xsl:choose>
			</p>
			<br clear="all"/>
		</xsl:element>
	</xsl:template>
	<xsl:template match="quotation">
		<xsl:variable name="divid">s<xsl:call-template name="gets"/>n<xsl:call-template name="getn"/>i<xsl:call-template name="geti"/>
		</xsl:variable>
		<xsl:variable name="divclass">
			<xsl:value-of select="name()"/>
		</xsl:variable>
		<xsl:element name="div">
			<xsl:attribute name="id"><xsl:value-of select="$divid"/></xsl:attribute>
			<xsl:attribute name="class"><xsl:value-of select="$divclass"/></xsl:attribute>
			<xsl:attribute name="style">display:none</xsl:attribute>
			<blockquote>
				<xsl:apply-templates select="quote"/>
			</blockquote>
			<div align="right">
				<xsl:apply-templates select="source"/>
			</div>
		</xsl:element>
	</xsl:template>
	<xsl:template match="title">
		<xsl:param name="modifier"/>
		<xsl:variable name="divid">s<xsl:call-template name="gets"/>n<xsl:call-template name="getn"/>i<xsl:call-template name="geti"/>
		</xsl:variable>
		<xsl:variable name="divclass">
			<xsl:value-of select="name(parent::*)"/>
			<xsl:value-of select="name()"/>
		</xsl:variable>
		<xsl:element name="div">
			<xsl:attribute name="class"><xsl:value-of select="$divclass"/></xsl:attribute>
			<xsl:apply-templates/>
		</xsl:element>
	</xsl:template>
	<xsl:template match="part/title|learningobject/title|learningstep/title">
		<xsl:variable name="divid">s<xsl:call-template name="gets"/>n<xsl:call-template name="getn"/>i<xsl:call-template name="geti"/>
		</xsl:variable>
		<xsl:variable name="divclass">
			<!--it's important what kind of title, thus classname two-levels-->
			<xsl:value-of select="name(parent::*)"/>
			<xsl:value-of select="name()"/>
		</xsl:variable>
		<xsl:element name="div">
			<xsl:if test="name(parent::*)='learningstep' or name(parent::*)='part'">
				<xsl:attribute name="id"><xsl:value-of select="$divid"/></xsl:attribute>
				<xsl:attribute name="style">display:none</xsl:attribute>
			</xsl:if>
			<xsl:attribute name="class"><xsl:value-of select="$divclass"/></xsl:attribute>
			<!--<xsl:value-of select="name(parent::*)"/>-->
			<xsl:apply-templates/>
		</xsl:element>
	</xsl:template>
	<!--
	 ! children of interactions (do not occur in any other p2 element)
	 !-->
	<xsl:template match="question">
		<tr>
			<xsl:element name="td">
				<xsl:attribute name="colspan"><xsl:choose><xsl:when test="name(following-sibling::*[1])='fillinthegaps'">2</xsl:when><xsl:when test="name(following-sibling::*[1])='textentry'">2</xsl:when><xsl:otherwise>3</xsl:otherwise></xsl:choose></xsl:attribute>
				<xsl:if test="name(following-sibling::*[1])='likert'">
					<xsl:element name="img">
						<xsl:attribute name="src">./icons/likert.png</xsl:attribute>
						<xsl:attribute name="align">left</xsl:attribute>
					</xsl:element>
				</xsl:if>
				<b>
					<xsl:apply-templates/>
				</b>
			</xsl:element>
		</tr>
	</xsl:template>
	<xsl:template match="associate">
		<xsl:for-each select="this">
			<tr>
				<td>
					<img src="./images/yesno.png"/>
				</td>
				<td width="50%">
					<xsl:apply-templates/>
				</td>
				<xsl:element name="td">
					<xsl:attribute name="width">50%</xsl:attribute>
					<xsl:attribute name="nowrap"/>
					<xsl:text disable-output-escaping="yes">&amp;nbsp;</xsl:text>
					<xsl:element name="select">
						<xsl:attribute name="onchange">eat(this)</xsl:attribute>
						<xsl:attribute name="name">q_<xsl:call-template name="geti"/>_<xsl:value-of select="count(preceding-sibling::this)+1"/></xsl:attribute>
						<option value="0" selected="selected">  </option>
						<xsl:variable name="this_id">
							<xsl:call-template name="geti"/>
						</xsl:variable>
						<xsl:for-each select="../that[@idx]">
							<xsl:element name="option">
								<xsl:attribute name="value"><xsl:value-of select="@idx"/></xsl:attribute>
								<xsl:value-of select="."/>
							</xsl:element>
						</xsl:for-each>
					</xsl:element>
					<xsl:element name="img">
						<xsl:attribute name="src">./images/yesno.png</xsl:attribute>
						<xsl:attribute name="name">fbi_<xsl:call-template name="geti"/>_<xsl:value-of select="count(preceding-sibling::this)+1"/></xsl:attribute>
					</xsl:element>
				</xsl:element>
			</tr>
		</xsl:for-each>
	</xsl:template>
	<xsl:template match="choice">
		<xsl:variable name="checkradio">
			<xsl:call-template name="getchoicetype"/>
		</xsl:variable>
		<xsl:for-each select="option">
			<tr>
				<td>
					<xsl:element name="img">
						<xsl:attribute name="src">./images/yesno.png</xsl:attribute>
						<xsl:attribute name="name">fbi_<xsl:call-template name="geti"/>_<xsl:call-template name="getsibs"/></xsl:attribute>
					</xsl:element>
				</td>
				<td>
					<xsl:element name="input">
						<xsl:attribute name="type"><xsl:value-of select="$checkradio"/></xsl:attribute>
						<xsl:attribute name="name">q_<xsl:call-template name="geti"/></xsl:attribute>
						<xsl:attribute name="value"><xsl:call-template name="getsibs"/></xsl:attribute>
						<xsl:attribute name="onclick">eat(this)</xsl:attribute>
					</xsl:element>
				</td>
				<td width="100%">
					<xsl:apply-templates/>
				</td>
			</tr>
		</xsl:for-each>
	</xsl:template>
	<xsl:template match="fillinthegaps">
		<tr>
			<td>
				<img src="./images/yesno.png"/>
			</td>
			<td width="100%">
				<xsl:apply-templates/>
			</td>
		</tr>
	</xsl:template>
	<xsl:template match="gap">
		<xsl:comment>mind the gap</xsl:comment>
		<xsl:variable name="longus">
			<xsl:for-each select="option">
				<xsl:sort select="string-length(.)" order="descending" data-type="number"/>
				<xsl:if test="position()=1">
					<xsl:value-of select="string-length(.)"/>
				</xsl:if>
			</xsl:for-each>
		</xsl:variable>
		<!--remember option numbering starts with 1-->
		<xsl:element name="input">
			<xsl:attribute name="type">text</xsl:attribute>
			<xsl:attribute name="size"><xsl:value-of select="$longus+1"/></xsl:attribute>
			<xsl:attribute name="maxlength"><xsl:value-of select="$longus+1"/></xsl:attribute>
			<xsl:attribute name="id">chq_<xsl:call-template name="geti"/>_<xsl:value-of select="count(preceding-sibling::gap)+1"/></xsl:attribute>
			<xsl:attribute name="name">chq_<xsl:call-template name="geti"/>_<xsl:value-of select="count(preceding-sibling::gap)+1"/></xsl:attribute>
			<xsl:attribute name="onchange">eat(this)</xsl:attribute>
		</xsl:element>
		<xsl:element name="select">
			<xsl:attribute name="id">q_<xsl:call-template name="geti"/>_<xsl:value-of select="count(preceding-sibling::gap)+1"/></xsl:attribute>
			<xsl:attribute name="name">q_<xsl:call-template name="geti"/>_<xsl:value-of select="count(preceding-sibling::gap)+1"/></xsl:attribute>
			<xsl:attribute name="style">display:none</xsl:attribute>
			<xsl:attribute name="onchange">eat(this)</xsl:attribute>
			<option value="1" selected="selected"/>
			<xsl:for-each select="option">
				<xsl:element name="option">
					<xsl:attribute name="value"><xsl:value-of select="count(preceding-sibling::option)+2"/></xsl:attribute>
					<xsl:value-of select="."/>
				</xsl:element>
			</xsl:for-each>
		</xsl:element>
		<xsl:element name="img">
			<xsl:attribute name="src">./images/pixel.png</xsl:attribute>
			<xsl:attribute name="name">fbi_<xsl:call-template name="geti"/>_<xsl:value-of select="count(preceding-sibling::gap)+1"/></xsl:attribute>
		</xsl:element>
	</xsl:template>
	<xsl:template match="likert">
		<xsl:for-each select="option">
			<tr>
				<td>
					<xsl:element name="img">
						<xsl:attribute name="src">./images/yesno.png</xsl:attribute>
						<xsl:attribute name="name">fbi_<xsl:call-template name="geti"/>_<xsl:call-template name="getsibs"/></xsl:attribute>
					</xsl:element>
				</td>
				<td>
					<xsl:element name="input">
						<xsl:attribute name="type">radio</xsl:attribute>
						<xsl:attribute name="name">q_<xsl:call-template name="geti"/></xsl:attribute>
						<xsl:attribute name="value"><xsl:call-template name="getsibs"/></xsl:attribute>
						<xsl:attribute name="onclick">eat(this)</xsl:attribute>
					</xsl:element>
				</td>
				<td width="100%">
					<xsl:apply-templates/>
				</td>
			</tr>
		</xsl:for-each>
	</xsl:template>
	<xsl:template match="textentry">
		<tr>
			<td colspan="2">
				<xsl:element name="textarea">
					<xsl:attribute name="name">q_<xsl:call-template name="geti"/></xsl:attribute>
					<xsl:attribute name="cols">64</xsl:attribute>
					<xsl:attribute name="rows">4</xsl:attribute>
					<xsl:attribute name="wrap">virtual</xsl:attribute>
					<xsl:attribute name="onchange">eat(this)</xsl:attribute>
				</xsl:element>
			</td>
		</tr>
		<tr>
			<xsl:element name="td">
				<xsl:attribute name="colspan">2</xsl:attribute>
				<xsl:attribute name="id">pa_<xsl:call-template name="geti"/></xsl:attribute>
				<xsl:attribute name="style">display:none</xsl:attribute>
				<xsl:apply-templates select="possibleanswer"/>
			</xsl:element>
		</tr>
	</xsl:template>
	<!--
	 ! children of pfplms/p2 elements
	 !-->
	<xsl:template match="listitem">
		<li>
			<xsl:apply-templates/>
		</li>
	</xsl:template>
	<xsl:template match="definition">
		<dd>
			<xsl:apply-templates/>
		</dd>
	</xsl:template>
	<xsl:template match="hintdetails">
		<xsl:param name="dethintname"/>
		<xsl:element name="div">
			<xsl:attribute name="id"><xsl:value-of select="$dethintname"/></xsl:attribute>
			<xsl:attribute name="class">hintdetails</xsl:attribute>
			<xsl:attribute name="style">display:none;</xsl:attribute>
			<xsl:apply-templates/>
			<br clear="all"/>
			<xsl:element name="input">
				<xsl:attribute name="type">button</xsl:attribute>
				<xsl:attribute name="value">Thanks</xsl:attribute>
				<xsl:attribute name="onclick">hide('<xsl:value-of select="$dethintname"/>');</xsl:attribute>
			</xsl:element>
		</xsl:element>
	</xsl:template>
	<xsl:template match="term">
		<dt>
			<b>
				<xsl:apply-templates/>
			</b>
		</dt>
	</xsl:template>
	<!--
	 ! children of bibitem
	 !-->
	<xsl:template match="details/author">
		<xsl:apply-templates/>:
	</xsl:template>
	<xsl:template match="details/title">
		<i>
			<xsl:apply-templates/>
		</i>
	</xsl:template>
	<xsl:template match="details/editor">	 
		in <xsl:apply-templates/>,
	</xsl:template>
	<xsl:template match="details/etitle">
		<xsl:apply-templates/>,
	</xsl:template>
	<xsl:template match="details/city">
		<xsl:apply-templates/>,
	</xsl:template>
	<xsl:template match="details/date">
		<xsl:apply-templates/>,
	</xsl:template>
	<xsl:template match="details/pages">	 
		pp.	 <xsl:apply-templates/>
	</xsl:template>
	<!--feedback tags, not used yet-->
	<xsl:template match="explain"/>
	<!--
	 ! inline tags
	 !-->
	<xsl:template match="b|i|p|br|tt|u|strike|s|big|small|sup|sub">
		<xsl:element name="{name()}">
			<xsl:apply-templates/>
		</xsl:element>
	</xsl:template>
	<!--
	 ! attribute templates
	 !-->
	<xsl:template match="@*">
		<xsl:copy/>
	</xsl:template>
	<xsl:template match="@file">
		<xsl:attribute name="src"><xsl:value-of select="."/></xsl:attribute>
	</xsl:template>
	<!--
	 ! named templates
	 !-->
	<xsl:template name="geti">
		<!--the ordinal of the current interaction, if context node is within an i, or the number of the preceding interactions-->
		<xsl:choose>
			<xsl:when test="count(ancestor-or-self::interaction)>0">
				<xsl:value-of select="count(preceding::interaction)+1"/>
			</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="count(preceding::interaction)"/>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template name="getpicidx">
		<!--the ordinal of the current picture, if context node is within a picture, or the number of the preceding pictures-->
		<xsl:choose>
			<xsl:when test="count(ancestor-or-self::picture)>0">
				<xsl:value-of select="count(preceding::picture)+1"/>
			</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="count(preceding::picture)"/>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template name="getaudioidx">
		<!--the ordinal of the current audio, if context node is within an audio, or the number of the preceding audos-->
		<xsl:choose>
			<xsl:when test="count(ancestor-or-self::audio)>0">
				<xsl:value-of select="count(preceding::audio)+1"/>
			</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="count(preceding::audio)"/>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template name="getsibs">
		<!--the ordinal of the option or gap element, given the context node is such-->
		<xsl:value-of select="count(preceding-sibling::*)+1"/>
	</xsl:template>
	<xsl:template name="getn">
		<!--the ordinal of the block element, counted over all learningsteps, given the context node is a block element-->
		<xsl:value-of select="count(preceding::learningstep/*)+count(preceding-sibling::*)+1"/>
	</xsl:template>
	<xsl:template name="gets">
		<!--the ordinal of the learningstep-->
		<xsl:value-of select="count(preceding::learningstep)+1"/>
	</xsl:template>
	<xsl:template name="getp">
		<!--the ordinal of the learningstep-->
		<xsl:value-of select="count(preceding::part)+1"/>
	</xsl:template>
	<xsl:template name="getchoicetype">
		<!-- given the context node is a choice-->
		<xsl:choose>
			<xsl:when test="count(option[@correct='true'])&gt;1">checkbox</xsl:when>
			<xsl:otherwise>radio</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template name="scaled">
		<xsl:element name="img">
			<xsl:attribute name="src"><xsl:value-of select="thumbnail/@file"/></xsl:attribute>
			<xsl:attribute name="name">th<xsl:call-template name="getn"/></xsl:attribute>
			<xsl:attribute name="width"><xsl:value-of select="thumbnail/@width"/></xsl:attribute>
			<xsl:attribute name="height"><xsl:value-of select="thumbnail/@height"/></xsl:attribute>
			<xsl:attribute name="align">left</xsl:attribute>
			<xsl:attribute name="class">thumbnail</xsl:attribute>
			<xsl:attribute name="title">Click on the picture to magnify it</xsl:attribute>
			<xsl:attribute name="onclick">eat(this)</xsl:attribute>
		</xsl:element>
		<xsl:element name="div">
			<xsl:attribute name="id">imdiv<xsl:call-template name="getn"/></xsl:attribute>
			<xsl:attribute name="style">display:none</xsl:attribute>
			<xsl:attribute name="width"><xsl:value-of select="@width"/></xsl:attribute>
			<xsl:attribute name="height"><xsl:value-of select="@height"/></xsl:attribute>
			<xsl:element name="img">
				<xsl:attribute name="id">pic<xsl:call-template name="getpicidx"/></xsl:attribute>
				<xsl:attribute name="name">im<xsl:call-template name="getn"/></xsl:attribute>
				<xsl:attribute name="onload">eat(this)</xsl:attribute>
				<xsl:attribute name="src"><xsl:value-of select="@file"/></xsl:attribute>
				<xsl:attribute name="width"><xsl:value-of select="@width"/></xsl:attribute>
				<xsl:attribute name="height"><xsl:value-of select="@height"/></xsl:attribute>
				<xsl:attribute name="class">picture</xsl:attribute>
			</xsl:element>
		</xsl:element>
		<i>
			<xsl:apply-templates select="description"/>
		</i>
	</xsl:template>
</xsl:stylesheet>
