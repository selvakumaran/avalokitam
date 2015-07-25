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


/* Terminal version of Avalokitam */

ini_set ( 'default_charset', 'utf-8' );
error_reporting ( E_ERROR | E_PARSE );

ob_start ();
require_once "parsetreeclass.php";
ob_end_clean ();

$options = getopt ( "", array (
		"lang:",
		"xml::",
		"file::",
		"alagu::",
		"todai::",
		"count::",
		"talai::",
		"type::",
		"verse::",
		"h::",
		"help::" 
) );

$showPartial = isset ( $options ['alagu'] ) || isset ( $options ['todai'] ) || isset ( $options ['count'] ) || isset ( $options ['talai'] ) || isset ( $options ['type'] );

if (isset ( $options ['help'] ) || isset ( $options ['h'] )) {
	echo "\nAvalokitam - Tamil Prosody Analyzer\n\n";
	
	echo "usage: avalokitam.php [-h] [--help] [--file=file_path] [--xml] [--lang=language] [--alagu] [--todai] [--count] [--talai] [--type] [--verse]\n";
	
	echo '
h     : Help
help  : Help 
file  : Input file path. Must be in UTF-8
xml   : Ouputs the parse output as XML 
lang  : \'en\' for ouput in Roman Script. Default \'ta\' 
alagu : Displays only the Metrical Foot analysis 
count : Displays only the letter count 
talai : Dispalys only Talai types 
type  : Displays only the verse type 
verse : Displays analyzed verse

Reads the verse from standard input if input file not provided

';
} 

else 

{
	
	if (isset ( $options ['file'] ))
		$verse = file_get_contents ( $options ['file'] );
	else
		$verse = file_get_contents ( 'php://stdin' );
	
	if ($options ['lang'] == 'en')
		$lang = 'en';
	else
		$lang = 'ta';
	
	$ptree = new ProsodyParseTree ( $verse, $lang );
	
	if (isset ( $options ['xml'] ))
	{
		echo $ptree->DisplayXML ();
		echo "end";
	}
	else {
		
		$xml = simplexml_load_string ( $ptree->DisplayXML () );
		
		echo "\n";
		
		if (isset ( $options ['verse'] ))
			echo lancon ( $verse, $lang ) . "\n\n";
		
		if (isset ( $options ['type'] ) || ! $showPartial) {
			
			echo lancon ( lat2tam ( $ptree->MetreType ), $lang );
			
			echo "\n\n";
		}
		
		if (isset ( $options ['count'] ) || ! $showPartial) {
			
			echo lancon ( lat2tam ( "_uyireZu_ttu" ), $lang ) . " " . $ptree->LetterCount ['Vowel'] . "\n";
			echo lancon ( lat2tam ( "me_yyeZu_ttu" ), $lang ) . " " . $ptree->LetterCount ['Consonant'] . "\n";
			echo lancon ( lat2tam ( "_uyi_rme_yyeZu_ttu" ), $lang ) . " " . $ptree->LetterCount ['ConsonantVowel'] . "\n";
			echo lancon ( lat2tam ( "_A_yta_m" ), $lang ) . " " . $ptree->LetterCount ['Aytham'] . "\n";
			
			echo "\n";
		}
		
		foreach ( $xml->MetricalLine as $line ) {
			if (isset ( $options ['alagu'] ) || ! $showPartial) {
				foreach ( $line->MetricalFoot as $foot ) {
					foreach ( $foot->Metreme as $metreme )
						echo $metreme . "/";
					
					echo " ";
				}
				
				echo "\n";
				
				foreach ( $line->MetricalFoot as $foot ) {
					foreach ( $foot->Metreme as $metre )
						echo $metre ["type"] . "/";
					
					echo " ";
				}
				
				echo "\n";
				
				foreach ( $line->MetricalFoot as $foot )
					echo $foot ["class"] . " ";
				
				echo "\n";
				
				echo "\n";
			}
			
			if (isset ( $options ['todai'] ) || ! $showPartial) {
				
				if (isset ( $line->Ornamentation )) {
					
					if (isset ( $line->Ornamentation->Alliteration )) {
						$type = $line->Ornamentation->Alliteration ['type'];
						
						if ($type != "")
							echo lancon ( $type, $lang );
						else
							echo lancon ( lat2tam ( 'moVY' ), $lang );
						
						echo " : ";
						
						if (isset ( $line->Ornamentation->Alliteration ))
							foreach ( $line->Ornamentation->Alliteration->Match as $match )
								echo $match ['foot'] . " " . $match . " ";
					}
					
					echo "\n";
					
					if (isset ( $line->Ornamentation->Rhyme )) {
						$type = $line->Ornamentation->Rhyme ['type'];
						
						if ($type != "")
							echo lancon ( $type, $lang );
						else
							echo lancon ( lat2tam ( '_etukY' ), $lang );
						
						echo " : ";
						
						if (isset ( $line->Ornamentation->Rhyme ))
							foreach ( $line->Ornamentation->Rhyme->Match as $match )
								echo $match ['foot'] . " " . $match . " ";
					}
					
					echo "\n";
				}
				
				echo "\n";
			}
		}
	}
	
	if (isset ( $options ['todai'] ) || ! $showPartial) {
		
		if (isset ( $xml->Ornamentation )) {
			
			if (isset ( $xml->Ornamentation->Alliteration )) {
				$type = $xml->Ornamentation->Alliteration ['type'];
				
				echo lancon ( lat2tam ( '_aTi moVY' ), $lang );
				
				echo " : ";
				
				if (isset ( $line->Ornamentation->Alliteration ))
					foreach ( $line->Ornamentation->Alliteration->Match as $match )
						echo $match ['line'] . " " . $match . " ";
			}
			
			echo "\n";
			
			if (isset ( $xml->Ornamentation->Rhyme )) {
				$type = $xml->Ornamentation->Rhyme ['type'];
				
				echo lancon ( lat2tam ( '_aTi _etukY' ), $lang );
				
				echo " : ";
				
				if (isset ( $xml->Ornamentation->Rhyme ))
					foreach ( $xml->Ornamentation->Rhyme->Match as $match )
						echo $match ['line'] . " " . $match . " ";
			}
			
			echo "\n";
		}
		
		echo "\n";
	}
	
	if (isset ( $options ['talai'] ) || ! $showPartial) {
		
		echo lancon ( lat2tam ( 'taLY' ), $lang ) . "\n\n";
		
		$footL = array ();
		
		foreach ( $xml->MetricalLine as $line )
			foreach ( $line->MetricalFoot as $foot )
				$footL [] = $foot;
		
		for($i = 0; $i < count ( $footL ) - 1; $i ++) {
			foreach ( $footL [$i]->Metreme as $metreme )
				echo $metreme;
			
			echo " → ";
			
			foreach ( $footL [$i + 1]->Metreme as $metreme )
				echo $metreme;
			
			echo " : " . $footL [$i + 1] ["linkage"] . "\n";
		}
		
		echo "\n";
	}
}

?>