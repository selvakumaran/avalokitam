<?PHP

/*
 * Copyright (C) 2013 Vinodh Rajan vinodh@virtualvinodh.com
 *
 * This file is a part
 * of Avalokitam. Avalokitam is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version. This program is distributed in the hope that it
 * will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General
 * Public License for more details. You should have received a copy of the GNU
 * Affero General Public License along with this program. If not, see
 * <http://www.gnu.org/licenses/>.
 */

session_start ();
require_once "translation.php";
require_once "transliteration.php";

if (file_exists ( "analyticsSharing.php" ))
	include "analyticsSharing.php";

error_reporting ( E_ERROR | E_PARSE );

$jscss = '
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/effect.js"></script>

<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/blitzer/jquery-ui.min.css"	rel="stylesheet" />
<link type="text/css" href="css/avalokitam.css"	rel="stylesheet" />';

$head = $analytics . '<table align="center">
	<tr>
	  <td align="center">
			<img src="css/images/Avalokitesvara.gif" height="105" style="float:left;" >
	  </td>
	  <td align="center">
<h2 align=center> <span class="Header"><big><span class="uiTrant">' . lancon ( "அ", $_SESSION ['lang'] ) . '</span></big><span class="uiTrant">' . lancon ( "வலோகிதம்", $_SESSION ['lang'] ) . '</span></span> | <span class="subHeader"><small><span class="uiTran">' . lanconTrnL ( "யாப்பு மென்பொருள்", $_SESSION ['lang'] ) . '</span></small> </span></h2>
<h5 class="subtitle"><span class="uiTrant">' . lancon ( "பன்னூறாயிரம் விதத்திற் பொலியும் புகழ்", $_SESSION ['lang'] ) . ' </span><i><span class="uiTrant">' . lancon ( "அவலோகிதன்", $_SESSION ['lang'] ) . '</span></i> <span class="uiTrant">' . lancon ( "மெய்த் தமிழே", $_SESSION ['lang'] ) . ' !</span></h5>

	  </td>	
	  <td align="center">
	    
	  </td>
	</tr>
</table>

';

if (isset ( $_SESSION ['lang'] )) {
	if ($_SESSION ['lang'] == "ta") {
		$checkedTamil = "checked";
	}
	if ($_SESSION ['lang'] == "en") {
		$checkedEnglish = "checked";
	}
} else {
	$checkedTamil = "checked";
}

$menu = '
<div class="sidemenu-left">
<ul id="menu-left">
  <li><a href="/"><span class="uiTran">' . lanconTrnL ( "முகப்பு", $_SESSION ['lang'] ) . '</span></a></li>
  <li><a href="/editor"><span class="uiTran">' . lanconTrnL ( "பா இயற்றி", $_SESSION ['lang'] ) . '</span></a></li>
  <li><a href="/word-search"><span class="uiTran">' . lanconTrnL ( "சொல் தேடல்", $_SESSION ['lang'] ) . '</span></a></li>';
$menu .= '<li><span class=""><a href="help-ta">உதவி</a></span></li>';
$menu .= '<li><span class=""><a href="help-en">Help</a></span></li>';
$menu .= '
  <li ><a href="feedback"><span class="uiTran">' . lanconTrnL ( "கருத்து", $_SESSION ['lang'] ) . '</span></a></li>
  <li ><a href="download"><span class="uiTran">' . lanconTrnL ( "பதிவிறக்கம்", $_SESSION ['lang'] ) . '</span></a></li>
  <li ><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=28ZHZ2FKTVTKL">Donate</a></li>
  <li ><a href="about">பற்றி | About</a></li>  
  <li ><a href="tamilprosody"><span id="uiTran">Tamil Prosody</span></a></li>
  <li class="ui-state-disabled"><a href="#"><b><span class="uiTran">' . lanconTrnL ( "மற்ற கருவிகள்", $_SESSION ['lang'] ) . '</span></b></a></li>
  <li><a href="http://www.virtualvinodh.com/aksharamukha"><span class="uiTran">' . lanconTrnL ( "அக்ஷரமுகம்", $_SESSION ['lang'] ) . '</span></a></li>
  <li ><a href="http://www.virtualvinodh.com/tamil-ipa"><span class="uiTran">' . lanconTrnL ( "அனுநாதம்", $_SESSION ['lang'] ) . '</span></a></li>
</ul>
<br/>
<div class="languages" align="left"> 
<input type="radio" id="tamil" name="lang" value="ta" ' . $checkedTamil . '><label for="tamil">Tamil</label>
<input type="radio" id = "english" name="lang" value="en" ' . $checkedEnglish . '><label for="english">English</label>
</div>
<br/>' . $sharing . '</div><div class="sidemenu-right">
<ul id="menu-right">
  <li class="ui-state-disabled"><a href="#"><b><span class="uiTran">' . lanconTrnL ( "பா உதாரணங்கள்", $_SESSION ['lang'] ) . '</span></b></a></li>
  <li><a href="venpa"><span class="uiTrant">' . lancon ( "வெண்பா", $_SESSION ['lang'] ) . '</span></a></li>
  <li><a href="asiriyappa"><span class="uiTrant">' . lancon ( "ஆசிரியப்பா", $_SESSION ['lang'] ) . '</span></a></li>
  <li><a href="kalippa"><span class="uiTrant">' . lancon ( "கலிப்பா", $_SESSION ['lang'] ) . '</span></a></li>
  <li ><a href="vanjippa"><span class="uiTrant">' . lancon ( "வஞ்சிப்பா", $_SESSION ['lang'] ) . '</span></a></li>
  <li><a href="venpavinam"><span class="uiTrant">' . lancon ( "வெண்பாவினம்", $_SESSION ['lang'] ) . '</span></a></li>
  <li><a href="asiriyappavinam"><span class="uiTrant">' . lancon ( "ஆசிரியப்பாவினம்", $_SESSION ['lang'] ) . '</span></a></li>
  <li><a href="kalippavinam"><span class="uiTrant">' . lancon ( "கலிப்பாவினம்", $_SESSION ['lang'] ) . '</span></a></li>
  <li ><a href="vanjippavinam"><span class="uiTrant">' . lancon ( "வஞ்சிப்பாவினம்", $_SESSION ['lang'] ) . '</span></a></li>
  <li ><a href="thodai"><span class="uiTrant">' . lancon ( "தொடை", $_SESSION ['lang'] ) . '</span></a></li>
</ul>
</div>';

$foot = '<br/><table align="center">
<tr>
<td>
<img src="css/images/buddha-dharmachakra.png" height="80" style="float:left;" >
</td>
<td>
<h5 class="subtitle"><br/>
<span class="uiTrant">' . lancon ( "மிக்கவன் போதியின் மேதக்கு இருந்தவன் மெய்த்தவத்தால்", $_SESSION ['lang'] ) . "</span><br/>" . '<span class="uiTrant">' . lancon ( "தொக்கவன் யார்க்கும் தொடர ஒண்ணாதவன் தூயன் எனத்", $_SESSION ['lang'] ) . "</span><br/>" . '<span class="uiTrant">' . lancon ( "தக்கவன் பாதம் தலைமேல் புனைந்து தமிழுரைக்க !", $_SESSION ['lang'] ) . '</span><br/> 
</h5>
</td>
<!--
<td>
<img src="bhah_lotus.jpg" height="70" style="float:left;" >
</td>
!-->
</tr>
</table>
<br/>
<div class="footnote" style="text-align:center;color:grey">
Copyright © 2013 <a href="http://www.virtualvinodh.com">Vinodh Rajan</a>. This software is released under GNU AGPL v3 license. You may read the license <a href="http://www.gnu.org/licenses/agpl.html">here</a></div>
<br/>';

?>