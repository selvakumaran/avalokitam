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
 
 require_once "parsetreeclass.php";
 
 @$ptreeA = new ProsodyParseTree ("", "", "");
 
 # The Wordlist was extracted from Wiktionary
 $wordListCont = file_get_contents('http://www.avalokitam.com/wordlists/wordListWikt.txt');
 $wordList = explode("\n",$wordListCont); 

 $source = trim(tam2lat($_POST['source']));	
 $sourceSyll = str_split($source,2);
 $sourceLen = count($sourceSyll);
 $sourceMatra = $ptreeA->GetMatraCount($source);
  
 $matchList = [];
 
#$wordList = array_splice($wordList,0,2000);
 
 foreach($wordList as $wordPair)
 {	
	$wordSplit = explode(",",$wordPair);
	$word = trim($wordSplit[0]);
	$vaypatu = trim($wordSplit[1]);
	
	$wordL = tam2lat($word);
	$wordSyll = str_split($wordL,2);
	$wordLen = count($wordSyll);
	$wordMatra = $ptreeA->GetMatraCount($wordL);
	
	# Selectors based on options
	
	if($_POST['todaiSel'] == "none")
		$todaiSel = True;
	else if($_POST['todaiSel'] == "etukai")
		$todaiSel = $ptreeA->checkEtukai($source,$wordL);
	else if($_POST['todaiSel'] == "monai")
		$todaiSel = $ptreeA->checkMonai($source,$wordL);
	else if($_POST['todaiSel'] == "iyaipu")
		$todaiSel = $ptreeA->checkIyaipu($source,$wordL);
	else if($_POST['todaiSel'] == "first")
		$todaiSel = substr($wordL,0,$_POST['todaiSelN']*2) == substr($source,0,$_POST['todaiSelN']*2);			
	else if($_POST['todaiSel'] == "last")
		$todaiSel = substr($wordL,-$_POST['todaiSelN']*2) == substr($source,-$_POST['todaiSelN']*2);				
		
	if($_POST['letterCountSel'] == "all")
 		$letterCountSel = True;
 	else if($_POST['letterCountSel'] == "src")
 		$letterCountSel = ($wordLen == $sourceLen);
 	else if($_POST['letterCountSel'] == "srcGt")
 		$letterCountSel = ($wordLen > $sourceLen);
 	else if($_POST['letterCountSel'] == "srcLs")
 		$letterCountSel = ($wordLen < $sourceLen);
  	else if($_POST['letterCountSel'] == "other")
 		$letterCountSel = ($wordLen == $_POST['letterCountSelN']);
		
	if($_POST['matraCountSel'] == "all")
 		$matraCountSel = True;
 	else if($_POST['matraCountSel'] == "src")
 		$matraCountSel = ($wordMatra == $sourceMatra);
 	else if($_POST['matraCountSel'] == "srcGt")
 		$matraCountSel = ($wordMatra > $sourceMatra);
 	else if($_POST['matraCountSel'] == "srcLs")
 		$matraCountSel = ($wordMatra < $sourceMatra);
  	else if($_POST['matraCountSel'] == "other")
 		$letterCountSel = ($wordLen == $_POST['matraCountSelN']);
 		
	if($_POST['vaypatuSel'] == "all")
 		$vaypatuSel = True;
 	else
 		$vaypatuSel = ($_POST['vaypatuSel'] == $vaypatu);
 	 	
 	if($todaiSel && $letterCountSel && $matraCountSel && $vaypatuSel)
		$matchList[] = $word;
 }

$matchListTalai = [];

$bonds = "";

# Check for Linkage

if($_POST['talaiSel'] == "all")
 	$matchListTalai = $matchList;
else
{
	foreach($matchList as $word)
	{
		@$ptree= new ProsodyParseTree (lat2tam($source)." ".$word, "", "");
		$bond = trim($ptree->WordBond[0]['bond']);
 		$talaiSel = (strpos($bond,$_POST['talaiSel']) !== False);
 		
# 		$bonds .= $bond." ";
 		
	 	if($talaiSel)
			$matchListTalai[] = $word;
	}

}

echo "பொருத்தமான சொற்கள் : ".count($matchListTalai)."<br/><br/>";
 
echo "<div class=\"result\">"; 

#echo $bonds."<br/><br/>";

foreach($matchListTalai as $word)
	echo "<span class=\"resultWord\">".$word." |</span>";
	
echo "</div>";
 
?>