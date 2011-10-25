<?xml version="1.0" encoding="UTF-8"?>
<!-- edited with XMLSPY v2004 rel. 2 U (http://www.xmlspy.com) by Charles McGinnis (Performix Group) -->
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:pg="../SCOManifest.xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
	<xsl:strip-space elements="*"/>
	<xsl:template match="/">
		<!--paramPage recieves the current page context identifier from the SCOController.  "1" is the default-->
		<xsl:param name="paramPage">1</xsl:param>
		<!--title retrieves the page title from the page-we may not need this.  We need to wait to determine the exact form of the page id-->
		<xsl:variable name="title" select="//orgs/org/page[$paramPage]/@refPageID"/>
		<!-- The select refasset[2] will need to change to select refasset[curAsset] We need a test that will match the type to certain kind of element.-->
		
		<!--for each refasset
				find the matching srcasset assetID
		
		check the srcasset[@type='swf']
		
		
		
		<xsl:for-each select="//orgs/org/page[$paramPage]/refasset/">
			<xsl:variable name="test" select="@refAssetID"/>
			<xsl:variable name="swfElement" select="//srcassets/srcasset[@assetID=$test][@type='swf']/@xref"/>
		</xsl:for-each>-->
		<xsl:variable name="pageElement" select="//orgs/org/page[$paramPage]/refasset[2]/@refAssetID"/>
		<html>
			<head>
				<title/>
				<!--The Interaction Utility file provides intra-page functionality such as rollovers, temp variables, etc.-->
				<script language="JavaScript" src="scormCalls.js" type="text/javascript"/>
				<script language="JavaScript" src="APIWrapper.js" type="text/javascript"/>	
				<script language="JavaScript" src="../scripts/InteractionUtility.js" type="text/javascript"/>
				<!--The following array implements changing text and titles for the table layout on the right-hand content pain.  These arrays will be accessed by text on the page as well as by flash fs commands-->
				<script language="JavaScript" xml:space="preserve" type="text/javascript">
					<!--The XPATHs listed to created this array assume a table that exists in a certain order within the source xml.  This needs to have a more intelligent test.-->
				var changeTitle = new Array(); <xsl:for-each select="//srcpages/pageText[@pageID = $paramPage]/sectLevel1[2]/contBit/contStruct/dtable/row/cell/textBit[@textType='title']">
						changeTitle[<xsl:value-of select="position()-1"/>] = new objChangeText('<xsl:apply-templates/>');</xsl:for-each>
					<!--The XPATHs listed to created this array assume a table that exists in a certain order within the source xml.  This needs to have a more intelligent test.-->
				var changeText = new Array(); <xsl:for-each select="//srcpages/pageText[@pageID = $paramPage]/sectLevel1[2]/contBit/contStruct/dtable/row/cell/textBit[@textType='normal']">
						changeText[<xsl:value-of select="position()-1"/>] = new objChangeText('<xsl:apply-templates/>');</xsl:for-each>
				</script>
				<!--CSS Level2 defines formatting -->
				<link href="../chrysler.css" rel="stylesheet" type="text/css"/>
			</head>
			<body onLoad="doLMSInitialize()" onUnload="doLMSFinish()">
				<table border="0" cellpadding="0" cellspacing="0" width="100%" class="contTitle">
					<tbody>
						<tr height="25px">
							<td width="6px"/>
							<td width="574px">
								<!--Call the page title-->
								<xsl:value-of select="//srcpages/pageText[@pageID = $paramPage]/@title"/>
							</td>
							<td width="100%" rowspan="2" align="left" valign="top">
								<table>
									<tr>
										<td>
											<table>
												<tr>
													<td height="25px"/>
												</tr>
												<!--For each row of the table in the first section GET the value.-->
												<!--the XPATH listed below "//srcpages/pageText[@pageID = $paramPage]//sectLevel1[@sectID=$paramPage]//row" 
										has a hard-coded sectLevel1 element.  It would be beneficial to refactor a section level param into this.-->
												<xsl:for-each select="//srcpages/pageText[@pageID = 1]/sectLevel1[@sectID=1]//row/cell">
													<!--Mark each Menu cell for use with Navigation and dynamic formatting-->
													<xsl:variable name="preID" select="1"/>
													<xsl:variable name="mnuID" select="position()"/>
													<tr>
														<td id="{$preID}{$mnuID}" class="menuRight" onmouseover="showText({$mnuID},{$preID}{$mnuID});" onmouseout="returnText({$preID}{$mnuID});" onclick="go({$mnuID});">
															<!--For each row of the table in the first section WRITE the value.-->
															<!--Refactor this so that it tests for the textType attribute-->
															<xsl:value-of select="textBit[@textType='title']"/>
														</td>
													</tr>
													<tr>
														<td id="{$mnuID}" class="menuRighttext">
															<!--For each row of the table in the first section WRITE the value.-->
															<!--Refactor this so that it tests for the textType attribute-->
															<xsl:value-of select="textBit[@textType='normal']"/>
														</td>
													</tr>
												</xsl:for-each>
											</table>
										</td>
									</tr>
									<tr>
										<td>
											<table>
												<tr>
													<!--For each row of the table in the second section GET the value.-->
													<!--Mark each text cell for use with Navigation and dynamic formatting-->
													<td id="titleContainer" class="menuRight">
														<!--For each row of the table in the second section WRITE the value.-->
													</td>
												</tr>
												<tr>
													<!--For each row of the table in the second section GET the value.-->
													<!--Mark each text cell for use with Navigation and dynamic formatting-->
													<td id="textContainer" class="menuRighttext">
														<!--For each row of the table in the second section WRITE the value.-->
														Roll over the titles above or on the image to read a description
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<!--This will be a value of reference for a different piece of content
								<xsl:value-of select="//srcpages/pageText[@pageID = $paramPage]//*"/>-->
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<!--Set a variable equal to a page element. -->
								<!--The following variable reference needs to be refactored for dynamic detection of the correct pages 'swf' type asset.-->
								<xsl:variable name="curSWF">
									<xsl:value-of select="//srcassets/srcasset[@assetID = $pageElement]/@xref"/>
								</xsl:variable>
								<p>
									<object id="walkaround" idclassid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="600" height="500">
										<param name="walkaround" value="{$curSWF}"/>
										<param name="quality" value="high"/>
										<!--Call the swf.  i.e. {$curSWF}-->
										<embed name="walkaround" swLiveConnect="true" src="{$curSWF}" quality="high" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="600" height="500"/>
									</object>
								</p>
							</td>
						</tr>
					</tbody>
				</table>
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>
