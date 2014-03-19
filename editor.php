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
<div class="container">

<div style="float:left;position:relative;width:35%">
<h2><span class="uiTran"><?PHP echo lanconTrnL("பா இயற்றவும்",$_SESSION['lang']); ?></span></h2>
				<div id="checkbox">
					<p>
						<input type="checkbox" id="kurilCk" name="kurilU"
							<?PHP if(isset($_POST['kurilU'])) echo "checked"; ?>> <span
							class="uiTran"><?PHP echo lanconTrnL("உயிர்முன் குற்றியலுகரத்தை அலகிடாது விடுக",$_SESSION['lang']); ?> </span></input>
					</p>
					<p>
						<input type="checkbox" id="rulesCk" name="venRules"
							<?PHP if(isset($_POST['venRules'])) echo "checked"; ?>> <span
							class="uiTran"><?PHP echo lanconTrnL("வெண்பா விதிகளை (தளை, சீர் மட்டும்) சரிபார்க்க",$_SESSION['lang']); ?> </span></input>
					</p>

				</div>
<div id="editor">
<textarea style="width:95%;height:400px;" id="inp"></textarea>
<br/><br/>
<div id="extendanalysis">
					<span class="uiTran"><?PHP echo lanconTrnL("இதை விரிவாக ஆராய்க",$_SESSION['lang']); ?></span>
</div>

</div>
</div>

<div style="float:left;position:relative;width:65%">
<h2><span class="uiTran"><?PHP echo lanconTrnL("துரித பகுப்பாய்வு",$_SESSION['lang']); ?></span></h2>
<div style="padding-bottom:30px;"><i><span class="uiTran"><?PHP echo lanconTrnL("நீங்கள் பா இயற்றிக்கொண்டிருக்கும்போதே , உடனுக்குடன் தளை மற்றும் சீர் வாய்ப்பாடுகள் முதலியவை பகுப்பாய்வு செய்து கீழே வெளியிடப்படும்.",$_SESSION['lang']); ?></span></i> </div>
<div id="parseedit">
</div>

</div>
<?PHP echo $foot; ?>


