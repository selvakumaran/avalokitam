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

require_once "menu.php";

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tamil Prosody Analyzer</title>
<?PHP echo $jscss; ?>
</head>
<body>

<?PHP echo $head?>

<?PHP echo $menu?>

<div class="container-cont">
		<h1>பதிவிறக்கம்</h1>
		<p>
			இத்திட்டம் <a
				href="https://github.com/virtualvinodh/avalokitam">கிட்ஹப்பில்</a>
			உள்ளது. இங்கிருந்து
			சோர்ஸ் கோட்'ஐ டவுன்லோட்
			செய்து கொள்ளவும்.
		</p>
		<p>
			இம்மென்பொருளை
			டெர்மமினலில் பிஹெச்பி
			சிஎல்ஐ மூலமும் <a href=help-ta#terminal>இங்குள்ளவாறு</a>
			இயக்கலாம். தேவையெனில்,
			இதை தங்களுடைய லோக்கல்
			வெப் சர்வரில் இருந்தும்
			இயக்கலாம். லோக்கல்
			சர்வரில் இருந்து
			இயக்கும் பட்சத்தில்,
			ஜேகுவெரி மற்றும் ஜேகுவரி
			யூஐ ஆகியவற்றை தனியாக
			டவுன்லோடு செய்துவித்து,
			பிறகு அதை இணைக்கவும்.
			தற்போது இவை கூகிள்
			சீடிஎன்னில் இருந்து
			இணைக்கப்பட்டுள்ளது.
			menu.php'ல் $jscss'ஐ மாறுதல் செய்ய
			வேண்டும்.
		</p>
		<p>விண்டோஸ்'ற்கான ஏற்கன்வே
			பேக்கேஜ் செய்யப்பட்டதை
			கீழே இருக்கும் இணைப்பில்
			இருந்து டவுன்லோடு செய்து
			கொள்ளவும். இவ்விணைப்பில்,
			சமீபத்திய அப்டேட்'கள்
			இல்லாமல் இருக்கலாம்
			எனப்தை கவனத்தில்
			கொள்ளவும்.</p>
			
		<p><em>கீழே உள்ள இணைப்பை பழைய பதிப்பைக் கொண்டுள்ளது. கூடிய விரைவில் 
		புதிய பதிப்புக்கான இணைப்பு தரப்படும்.</em></p>


		<h1>Download</h1>
		<p>
			This project is hosted at <a
				href="https://github.com/virtualvinodh/avalokitam">Github</a>. You
			can download the latest source code from there.
		</p>
		<p>
			The tool can also be run in the Terminal using PHP CLI as described <a
				href=help-en#terminal>here</a>.
		</p>

		<p>
			If required, it can be hosted in a local web server too. However, you
			should download and link to the local version of the Jquery & Jquery
			UI files. Currently, they are being served from Google CDN. The
			changes must be made within menu.php in the variable <em>$jscss</em>.
		</p>
		<p>A prepackaged and self-contained version for Windows can be
			downloaded from the below link. Note that, this may not contain the
			latest updates made to the live server.
			
			<p><em>The link below points to an older version. The package will be updated 
			soon with the new code and the link will be provided. </em></p>
			
			</p>
			<br/>
		<ul>
			<li><a
				href="http://www.virtualvinodh.com/download/Avalokitam%20Setup.exe">http://www.virtualvinodh.com/download/Avalokitam
					Setup.exe</a> [11/25/2011]
		
		</uL>



	</div>



<?PHP echo $foot ?>

