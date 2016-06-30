<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:fo="http://www.w3.org/1999/XSL/Format">

<xsl:output method="html" indent="yes" encoding="utf-8" doctype-public="-//W3C//DTD HTML 4.01 Transitional//EN"/>
<xsl:strip-space elements="*"/>
<xsl:include href="buttons.xsl"/>

<xsl:template match="LAYOUT">
	<xsl:variable name="cID" select="@ID"/>
	<html>
<!-- av-093 -->
		<head>
			<title><xsl:value-of select="@SITE-TITLE" disable-output-escaping="yes"/> - <xsl:value-of select="@TITLE" disable-output-escaping="yes"/></title>
			<xsl:apply-templates select="META-TAGS"/>
			<link href="css/styles.css" rel="stylesheet" type="text/css" />
		</head>
<body style="margin:0px;" bgcolor="#8D8D8D">
<center>
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#080e0c">
  <tr>
    <td></td>
    <td><br/>
	<table border="0" cellspacing="0" cellpadding="0">
          <tr>
<xsl:call-template name="TOP-MENU"/>
          </tr>
        </table>
	</td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td height="26"><img src="images/line2.jpg" width="3" height="26"/></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td height="282" background="images/header2.jpg"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="100%" height="282" align="left" background="images/header1.jpg" style="background-repeat:no-repeat"><table border="0" cellpadding="0" cellspacing="0" style="width: 200px; height: 100%; background-image: url('images/logo_bg'); background-position: bottom; background-repeat: repeat-x;">
              <tr>
                <td><!-- LOGO -->
                    <table cellpadding="0" cellspacing="0" align="center">
                      <tr>
                        <td align="center"><a href="./"><img src="images/{LOGO/@NAME}" border="0" alt=""/></a> </td>
                      </tr>
                      <tr>
                        <td align="center" class="company"><xsl:value-of select="COMPANY-INFO/NAME" disable-output-escaping="yes"/> </td>
                      </tr>
                      <tr>
                        <td align="center" class="slogan"><xsl:value-of select="COMPANY-INFO/SLOGAN" disable-output-escaping="yes"/> </td>
                      </tr>
                    </table>
                    <!-- END LOGO -->
                </td>
              </tr>
            </table></td>
            <td width="504" align="right"><img src="images/header3.jpg" width="504" height="282"/></td>
          </tr>
        </table>
	</td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td height="26"><img src="images/line2.jpg" width="3" height="26"/></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td width="100%" height="100%">
	  <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
		<td width="262" valign="top" class="submenutable" >
		<table width="250" align="left" cellpadding="0" cellspacing="0">
<xsl:call-template name="SUB-MENU">
<xsl:with-param name="pageID" select="@ID"/>
</xsl:call-template>
          </table></td>
        <td width="1" background="images/line1.jpg"><div style="width:1px; height:0px;"><span></span></div></td>
        <td width="100%" height="100%" align="left" valign="top">
		<table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: 100%;">
				<tr>
				  <td width="100%" height="100%" align="left" valign="top" class="pageContent" style="padding: 25px;" name="SB_stretch">
						<!-- CONTENT -->
						<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td class="text-header"><xsl:value-of select="@TITLE" disable-output-escaping="yes"/></td>
								<td style="padding-left: 5px;"><img src="images/txtheader_bullet.jpg" alt="" width="17" height="17" border="0"/></td>
					  		</tr>
						</table>
						<div style="width:0px; height:15px;"><span></span></div>
			   		  <xsl:apply-templates select="PAGE-CONTENT"/>
				  <!-- END CONTENT -->					</td>
				</tr>
		  </table></td>
        </tr>
      </table>
	</td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td>
	<table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: 98px;">
				<tr>
					<td>
						<!-- BOTTOM MENU -->
						<table cellpadding="0" cellspacing="0" align="center">
							<tr>
<xsl:call-template name="BOTTOM-MENU"/>
							</tr>
						</table>
						<!-- END BOOTTOM MENU -->
						<div style="width:0px; height:10px;"><span></span></div>
						<!-- FOOTER -->
						<div align="center" class="footer"><xsl:value-of select="COPYRIGHT" disable-output-escaping="yes"/>
</div>
						<!-- END FOOTER -->					</td>
				</tr>
			</table>
	</td>
    <td></td>
  </tr>
  <tr>
    <td><img src="images/blank.gif" width="30" height="1"/></td>
    <td>
	<img src="images/blank.gif" width="720" height="1"/>
	</td>
    <td><img src="images/blank.gif" width="30" height="1"/></td>
  </tr>
</table>
</center>
</body>

	</html>
</xsl:template>


<xsl:template name="TOP-MENU">
		<xsl:apply-templates select="MENU" mode="top"/>	
</xsl:template>


<xsl:template name="SUB-MENU">
	<xsl:param name="pageID"/>
	<xsl:choose>
		<xsl:when test="//MENU/MENU-ITEM[@ID = $pageID]/MENU-ITEM">
			<xsl:apply-templates select="//MENU/MENU-ITEM[@ID = $pageID]/MENU-ITEM" mode="sub"/>
		</xsl:when>
		<xsl:when test="//MENU/MENU-ITEM/MENU-ITEM[@ID = $pageID]">
			<xsl:variable name="parentID" select="//MENU/MENU-ITEM/MENU-ITEM[@ID = $pageID]/../@ID"/>
			<xsl:apply-templates select="//MENU/MENU-ITEM[@ID=$parentID]/MENU-ITEM" mode="sub"/>
		</xsl:when>
	</xsl:choose>
</xsl:template>
	
<xsl:template match="MENU-ITEM" mode="sub">
	<xsl:choose>
		<xsl:when test="@ID=/LAYOUT/@ID" >
            <tr>
              <td><img src="images/submenu_bullet.jpg" alt="" width="33" height="22" border="0" align="absbottom"/></td>
              <td valign="top" class="asubmenu" style="padding-left: 5px; width: 100%;"><xsl:value-of select="@TITLE" disable-output-escaping="yes"/></td>
            </tr>
		</xsl:when>
		<xsl:otherwise>
			<xsl:if test="../MENU-ITEM[@ID=/LAYOUT/@ID] or ../../MENU-ITEM[@ID=/LAYOUT/@ID]">
            <tr>
              <td><img src="images/submenu_bullet.jpg" alt="" width="33" height="22" border="0" align="absbottom"/></td>
              <td valign="top" class="submenu" style="padding-left: 5px; width: 100%;"><a href="{@HREF}" class="submenu"><xsl:value-of select="@TITLE" disable-output-escaping="yes"/></a></td>
            </tr>
			</xsl:if>
		</xsl:otherwise>
	</xsl:choose>
	<xsl:if test="position()!=last()">
            <tr>
              <td><img src="images/line.jpg" width="1" height="1"/></td>
              <td><div style="height:1px; background-color: #0F1513; background-image: url('images/submenu_hr.gif'); background-repeat: repeat-x;"><span></span></div></td>
            </tr>
	</xsl:if>
</xsl:template>	

<xsl:template name="BOTTOM-MENU">   		
	<xsl:apply-templates select="MENU" mode="bottom"/>			
</xsl:template>

<xsl:template match="MENU" mode="bottom">
	<xsl:apply-templates select="MENU-ITEM"  mode="bottom"/>
</xsl:template>
		
<xsl:template match="MENU-ITEM"  mode="bottom">
	<xsl:choose>
       <!-- when vizited inside-->
       	<xsl:when test="MENU-ITEM[@ID=/LAYOUT/@ID] or @ID=/LAYOUT/@ID">
								<td width="5"></td>
								<td><img src="images/bmenu_separator.jpg" width="6" height="5"/></td>
								<td width="5"></td>
								<td><a href="{@HREF}" class="abmenu" id="abmenu"><xsl:value-of select="@TITLE" disable-output-escaping="yes"/></a></td>
           </xsl:when>
           <!-- when active-->
           
           <xsl:otherwise>
								<td width="5"></td>
								<td><img src="images/bmenu_separator.jpg" width="6" height="5"/></td>
								<td width="5"></td>
								<td><a href="{@HREF}" class="bmenu" id="bmenu{position()}"><xsl:value-of select="@TITLE" disable-output-escaping="yes"/></a></td>
           </xsl:otherwise>
       </xsl:choose>
  		<xsl:if test="position()!=last()">
  		</xsl:if>
</xsl:template>
	
<xsl:template match="META-TAGS">
	<xsl:apply-templates mode="meta-tags"/>
</xsl:template>
	
<xsl:template match="*" mode="meta-tags">
	<meta name="{local-name(.)}"><xsl:attribute name="content"><xsl:value-of select="." disable-output-escaping="yes"/></xsl:attribute></meta>
</xsl:template>


<xsl:template match="PAGE-CONTENT">
	<xsl:comment> EDITABLE CONTENT </xsl:comment>
	<xsl:apply-templates mode="meta-tags"/>
</xsl:template>
	     	
</xsl:stylesheet>
