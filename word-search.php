<?PHP

/*
 * Copyright (C) 2015 Vinodh Rajan vinodh@virtualvinodh.com
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
require_once "parsetreeclass.php";

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

	<h2><span class="uiTran"><?PHP echo lanconTrnL("சொல் தேடல்",$_SESSION['lang']); ?> </span></h2>
	எதுகை, மோனை, இயைபு, மாத்திரை அளவு, வாய்ப்பாடு, தளை முதலியவற்றை அடிப்படையாகக் கொண்டு,
	தங்களுடைய மூலச்சொல்லுடன் சிறந்த ஓசை நயத்துடன் பொருந்தக்கூடிய பல்வேறு சொற்களை இங்கு தாங்கள் தேடலாம்.

	<br/><br/> 

	<big>மூலச்சொல்:</big> <input type="text" id="rhymeInput"></input> <br/><br/>
	கீழ்க்கண்ட விதங்களில் பொருந்தக்கூடிய பிற சொற்களை காட்டுக <br/><br/>
	
	<hr/>
	
	<big>தொடை </big>
	<select id="todaiSel">
		<option value="etukai">எதுகை</option>
		<option value="monai">மோனை</option>
		<option value="iyaipu">இயைபு</option>
		<option value="first">முதல் எழுத்துக்கள்</option>
		<option value="last">இறுதி எழுத்துக்கள்</option>
		<option value="none">ஏதும் இல்லை</option>
	</select>
	<input type="text" id="todaiSelN" size="2" value="2" style="display:none;"></input>

	<big>எழுத்தெண்ணிக்கை</big>
	<select id="letterCountSel">
		<option value="all">அனைத்தும்</option>
		<option value="src" selected>மூலச்சொல்லின் எழுத்தெண்ணிக்கை</option>
		<option value="srcLs">மூலச்சொல்லைவிட குறைவாக</option>
		<option value="srcGt">மூலச்சொல்லைவிட அதிகமாக</option>
		<option value="other">பிற எழுத்தெண்ணிக்கை</option>
	</select>
	<input type="text" id="letterCountSelN" size="2" value="2" style="display:none;"></input>

	<big>மாத்திரை</big>
	<select id="matraCountSel">
		<option value="all" selected>அனைத்தும்</option>
		<option value="src">மூலச்சொல்லின் மாத்திரை</option>
		<option value="srcGt">மூலச்சொல்லைவிட குறைவாக</option>
		<option value="srcLs">மூலச்சொல்லைவிட அதிகமாக</option>		
		<option value="other">பிற மாத்திரை அளவு</option>
	</select>
	<input type="text" id="matraCountSelN" size="2" value="2" style="display:none;"></input>
	
	</span>
	
	<br/><br/>

	<big>வாய்ப்பாடு</big>
	<select id="vaypatuSel">
	<option value="all">அனைத்தும்</option>		
	
	<?PHP 
	
	$ptree = new ProsodyParseTree ("na na", "", "");
	
	foreach($ptree->WordType as $key=>$value)
			echo "<option value=\"".lat2tam($value)."\">".lat2tam($value)."</option>";
	
	?>	
	</select>
	
	<big>தளை</big>
	<select id="talaiSel">
		<option value="all">அனைத்தும்</option>											
		<option value="ேரொன்றிய ஆசிரியத்தள">நேரொன்றிய ஆசிரியத்தளை</option>
		<option value="நிரையொன்றிய ஆசிரியத்தளை">நிரையொன்றிய ஆசிரியத்தளை</option>
		<option value="ஆசிரியத்தளை">எல்லா ஆசிரியத்தளைகளும்</option>
		<option value="இயற்சீர் வெண்டளை">இயற்சீர் வெண்டளை</option>		
		<option value="இயற்சீர் வெண்டளை">வெண்சீர் வெண்டளை</option>
		<option value="ெண்டளை">எல்லா வெண்டளைகளும்</option>		
		<option value="ஒன்றிய வஞ்சித்தளை">ஒன்றிய வஞ்சித்தளை</option>
		<option value="ஒன்றா வஞ்சித்தளை">ஒன்றா வஞ்சித்தளை</option>
		<option value="வஞ்சித்தளை">எல்லா வஞ்சித்தளைகளும்</option>	
		<option value="கலித்தளை">கலித்தளை</option>		
	</select>
	
	<br/><br/>

	<hr/>
	
	<big><input type="button" value="தேடுக!" id="searchWord"></input> 
	<span id="loading" style="display:none;">பொருத்தமான சொற்கள் தேடப்படுகின்றன. பொறுத்தருளவும்...</span>
	
	<br/><br/> 

	<div id="resultRhyme"></div>
	<br/><br/>
	
</div>

<?PHP echo $foot?>

