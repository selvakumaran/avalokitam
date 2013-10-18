<?PHP

/*
 * Copyright (C) 2013 Vinodh Rajan vinodh@virtualvinodh.com This file is a part
 * of Avalokitam. Avalokitam is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version. This program is distributed in the hope that it
 * will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General
 * Public License for more details. You should have received a copy of the GNU
 * General Public License along with this program. If not, see
 * <http://www.gnu.org/licenses/>.
 */

require_once "transliteration.php";
require_once "translation.php";
require_once "utilityfunctions.php";

error_reporting ( E_ALL ^ E_NOTICE );

/**
 * Avalokitam - Tamil Prosody Analyzer
 *
 * @author Vinodh Rajan, vinodh@virtualviondh.com
 *        
 */
class ProsodyParseTree 

{
	/**
	 * The Root of the Parse Tree
	 *
	 * @var Iterative String Array
	 */
	public $ParseTreeRoot;
	
	/**
	 * The Input Source Text
	 *
	 * @var String
	 */
	public $InputSourceText;
	
	// Variables for Metrical Information
	
	/**
	 * The Metre type of the Prosody Text
	 *
	 * @var String
	 */
	public $MetreType;
	/**
	 * The Total Lines in the Text
	 *
	 * @var Integer
	 */
	public $TotalLines;
	/**
	 * Contains the Talai Informatoin
	 *
	 * @var String Array
	 */
	public $WordBond;
	public $VenLastSyllable;
	public $LetterCount;
	public $LineClass;
	public $VikalpaCount;
	public $Lang;
	
	// Reference arrays
	
	/**
	 * Reference Array of getting the Line Type
	 *
	 * @var array
	 */
	public $LineType = array (
			"",
			"taVi_cco_l",
			"kuRaLaTi",
			"ci_ntaTi",
			"_aLavaTi",
			"neTilaTi",
			"_aRucI_r_k kaZineTilaTi",
			"_eZucI_r_k kaZineTilaTi",
			"_e_NcI_r_k kaZineTilaTi",
			"_o_Vpati_ncI_r_k kaZineTilaTi",
			"pati_VcI_r_k kaZineTilaTi",
			"patiVoru cI_r_k kaZineTilaTi",
			"pa_VViru cI_r_k kaZineTilaTi",
			"patimU_VRu cI_r_k kaZineTilaTi",
			"patiVA_Vku cI_r_k kaZineTilaTi",
			"patiVY_ntu cI_r_k kaZineTilaTi",
			"patiVARu cI_r_k kaZineTilaTi",
			"patiVEZu cI_r_k kaZineTilaTi",
			"patiVe_TTu cI_r_k kaZineTilaTi",
			"pa_tto_Vpatu cI_r_k kaZineTilaTi",
			"_irupatu cI_r_k kaZineTilaTi",
			"_irupa_ttoru cI_r_k kaZineTilaTi",
			"_irupa_ttu _ira_NTu cI_r_k kaZineTilaTi",
			"_irupa_ttu mU_VRu cI_r_k kaZineTilaTi",
			"_irupa_ttu nA_Vku cI_r_k kaZineTilaTi" 
	);
	public $SyllableTypes = array (
			"nE_r",
			"nirY" 
	);
	
	/**
	 * Reference Array for getting the Word Type
	 *
	 * @var String Array
	 */
	public $WordType = array (
			
			// Two Asais
			
			"nE_rnE_r" => "tEmA",
			"nirYnE_r" => "puLimA",
			"nE_rnirY" => "kUviLa_m",
			"nirYnirY" => "karuviLa_m",
			
			// Three Asais - Kay seers
			
			"nE_rnE_rnE_r" => "tEmA_GkA_y",
			"nirYnE_rnE_r" => "puLimA_GkA_y",
			"nE_rnirYnE_r" => "kUviLa_GkA_y",
			"nirYnirYnE_r" => "karuviLa_GkA_y",
			
			// Three Asais - Kani seers
			
			"nE_rnE_rnirY" => "tEmA_GkaVi",
			"nirYnE_rnirY" => "puLimA_GkaVi",
			"nE_rnirYnirY" => "kUviLa_GkaVi",
			"nirYnirYnirY" => "karuviLa_GkaVi",
			
			// Four Asais - Tanpuu seers
			
			"nE_rnE_rnE_rnE_r" => "tEmA_nta_NpU",
			"nirYnE_rnE_rnE_r" => "puLimA_nta_NpU",
			"nE_rnirYnE_rnE_r" => "kUviLa_nta_NpU",
			"nirYnirYnE_rnE_r" => "karuviLa_nta_NpU",
			
			// Four Asais - naRumpU seers
			
			"nE_rnE_rnirYnE_r" => "tEmAnaRu_mpU",
			"nirYnE_rnirYnE_r" => "puLimAnaRu_mpU",
			"nE_rnirYnirYnE_r" => "kUviLanaRu_mpU",
			"nirYnirYnirYnE_r" => "karuviLanaRu_mpU",
			
			// Four Asais - naRunizhal
			
			"nE_rnE_rnirYnirY" => "tEmAnaRuniZa_l",
			"nirYnE_rnirYnirY" => "puLimAnaRuniZa_l",
			"nE_rnirYnirYnirY" => "kUviLanaRuniZa_l",
			"nirYnirYnirYnirY" => "karuviLanaRuniZa_l",
			
			// Four Asais- Tannizhal
			
			"nE_rnE_rnE_rnirY" => "tEmA_nta_NNiZa_l",
			"nirYnE_rnE_rnirY" => "puLimA_nta_NNiZa_l",
			"nE_rnirYnE_rnirY" => "kUviLa_nta_NNiZa_l",
			"nirYnirYnE_rnirY" => "karuviLa_nta_NNiZa_l",
			
			// Singla ASai - Exceptions
			
			"nE_r" => "mA",
			"nirY" => "viLa_m" 
	);
	public $VenpaaWordClass = array (
			
			"nE_r" => "nA_L",
			"nirY" => "mala_r",
			"nE_rpu" => "kAcu",
			"nirYpu" => "piRa_ppu" 
	);
	
	/**
	 * Class Constructor
	 *
	 * @param String $ProsodyText        	
	 * @param String $InterfaceLang        	
	 */
	function __construct($ProsodyText, $InterfaceLang, $uyirU = False) 

	{
		$ProsodyText = trim ( tam2lat ( $ProsodyText ) );
		
		if ($uyirU) {
			
			$ProsodyText = preg_replace ( "/([kcTpR]u)(\s)(_[aAiIuUeEoO])/", '($1)$2$3', $ProsodyText );
			$ProsodyText = preg_replace ( "/([kcTpR]u)(\s*\n)(_[aAiIuUeEoO])/", '($1)$2$3', $ProsodyText );
			$_POST ['ttxt'] = lat2tam ( $ProsodyText );
		}
		
		$this->InputSourceText = $ProsodyText; // Assigining Source Text to the
		                                       // Variable
		$this->LetterCount = $this->GetLetterCount ( $ProsodyText );
		$this->ParseTreeRoot [] = $this->GetTextSyllablePattern ( $ProsodyText );
		$this->VikalpaCount = $this->GetVikalpaCount ();
		$this->WordBond = $this->GetWordBond ( $this->ParseTreeRoot );
		$this->LineClass = $this->GetLineClass ( $this->ParseTreeRoot );
		$this->MetreType = $this->GetMetreType ( $this->ParseTreeRoot );
		
		$this->Lang = $InterfaceLang; // interface language
	}
	
	/**
	 * Returns the Various Count of Letters as an Array
	 *
	 * @param String $ProsodyText        	
	 * @return Associaative Array
	 */
	public function GetLetterCount($ProsodyText) {
		$TamilText = trim ( lat2tam ( $ProsodyText ) );
		
		$this->lat = "Vinodh" . $TamilText;
		
		/* Initialize Variables */
		
		$VowelCount = 0;
		$ConsonantVowelCount = 0;
		$VowelSignCount = 0;
		$AMeyCount = 0;
		$LetterCount = array ();
		
		$VowelList = array (
				"அ",
				"ஆ",
				"இ",
				"ஈ",
				"உ",
				"ஊ",
				"எ",
				"ஏ",
				"ஐ",
				"ஒ",
				"ஓ",
				"ஔ" 
		);
		$VowelSignList = array (
				"ா",
				"ி",
				"ீ",
				"ு",
				"ூ",
				"ெ",
				"ே",
				"ை",
				"ொ",
				"ோ",
				"ௌ" 
		);
		$AMeyList = array (
				"க",
				"ங",
				"ச",
				"ஜ",
				"ஞ",
				"ட",
				"ண",
				"த",
				"ந",
				"ன",
				"ப",
				"ம",
				"ய",
				"ர",
				"ற",
				"ல",
				"ள",
				"ழ",
				"வ",
				"ஶ",
				"ஷ",
				"ஸ",
				"ஹ" 
		);
		
		/*
		 * Count Vowels
		 */
		
		foreach ( $VowelList as $Vowel )
			$VowelCount += substr_count ( $TamilText, $Vowel );
			
			/*
		 * Count Mey-s
		 */
		
		$ConsonantCount = substr_count ( $TamilText, "்" );
		
		/*
		 * Count Aytham
		 */
		
		$AythamCount = substr_count ( $TamilText, "ஃ" );
		
		/*
		 * Count A Mey
		 */
		
		foreach ( $AMeyList as $amy )
			$AMeyCount += substr_count ( $TamilText, $amy );
		
		$ConsonantVowelCount = $AMeyCount - $ConsonantCount;
		
		$LetterCount ['Vowel'] = $VowelCount;
		$LetterCount ['Consonant'] = $ConsonantCount;
		$LetterCount ['ConsonantVowel'] = $ConsonantVowelCount;
		$LetterCount ['Aytham'] = $AythamCount;
		
		return $LetterCount;
	}
	
	/**
	 * Displays the Count of Letters
	 */
	public function DisplayLetterCount() {
		$LetterCount = $this->LetterCount;
		
		echo "<span class=\"uiTran\">" . lanconTrnL ( "உயிரெழுத்துக்கள்", $this->Lang ) . ": </span>";
		echo $LetterCount ['Vowel'];
		
		echo "<br/><br/>";
		
		echo "<span class=\"uiTran\">" . lanconTrnL ( "மெய்யெழுத்துக்கள்", $this->Lang ) . ": </span>";
		echo $LetterCount ['Consonant'];
		
		echo "<br/><br/>";
		
		echo "<span class=\"uiTran\">" . lanconTrnL ( "உயிர்மெய்யெழுத்துக்கள்", $this->Lang ) . ": </span>";
		echo $LetterCount ['ConsonantVowel'];
		
		echo "<br/><br/>";
		
		echo "<span class=\"uiTran\">" . lanconTrnL ( "ஆய்த எழுத்து", $this->Lang ) . ": </span>";
		echo $LetterCount ['Aytham'];
	}
	
	/**
	 * Displays the analysis as XML
	 */
	public function DisplayXML() {
		$verseXML = new SimpleXMLElement ( "<?xml version=\"1.0\" encoding=\"utf-8\" ?><verse></verse>" );
		$verseXML->addAttribute ( 'metre', lancon ( lat2tam ( $this->MetreType ), $this->Lang ) );
		
		$rit = new RecursiveIteratorIterator ( new RecursiveArrayIterator ( $this->ParseTreeRoot ), RecursiveIteratorIterator::SELF_FIRST );
		
		$feetCount = 0;
		$lineCount = 0;
		
		ob_start ();
		$alliteration = $this->DisplayTodai ( "mOVY" );
		$rhyme = $this->DisplayTodai ( "_etukY" );
		ob_end_clean ();
		
		$phone = $verseXML->addChild ( 'Letter' );
		$phone->addAttribute ( "InitialVowels", $this->LetterCount ['Vowel'] );
		$phone->addAttribute ( "PureConsonants", $this->LetterCount ['Consonant'] );
		$phone->addAttribute ( "ConsonantVowels", $this->LetterCount ['ConsonantVowel'] );
		$phone->addAttribute ( "Aytham", $this->LetterCount ['Aytham'] );
		
		$VenpaaIndicator = strpos ( $this->MetreType, "ve_NpA" ) != FALSE;
		
		foreach ( $rit as $key => $value ) {
			
			if ($rit->getDepth () > 1) {
				
				if (substr ( $key, 0, 3 ) == "aTi") {
					$line = $verseXML->addChild ( 'MetricalLine' );
				}
				
				if (substr ( $key, 0, 4 ) == "cI_r") {
					$feet = $line->addChild ( 'MetricalFoot' );
					$metremeCount = 0;
				}
				
				if (substr ( $key, 0, 3 ) == "acY") {
					$metremeCount ++;
					
					if (isset ( $value ['nE_r'] )) {
						$metreme = $feet->addChild ( "Metreme", lancon ( lat2tam ( $value ['nE_r'] ), $this->Lang ) );
						
						if ($VenpaaIndicator && $lineCount == $this->TotalLines - 1 && $lineFeetCount == 3 && $metremeCount == 2)
							$metreme->addAttribute ( 'type', lancon ( lat2tam ( 'pu' ), $this->Lang ) );
						else
							$metreme->addAttribute ( 'type', lancon ( lat2tam ( 'nE_r' ), $this->Lang ) );
					}
					
					if (isset ( $value ['nirY'] )) {
						$metreme = $feet->addChild ( "Metreme", lancon ( lat2tam ( $value ['nirY'] ), $this->Lang ) );
						$metreme->addAttribute ( 'type', lancon ( lat2tam ( 'nirY' ), $this->Lang ) );
					}
				}
				
				if ($key == "meta") {
					if ($VenpaaIndicator && $lineCount == $this->TotalLines - 1 && $lineFeetCount == 3)
						$feet->addAttribute ( 'class', lancon ( lat2tam ( $this->VenpaaWordClass [$this->VenLastSyllable] ), $this->Lang ) );
					else
						$feet->addAttribute ( 'class', lancon ( lat2tam ( $value ), $this->Lang ) );
					
					if ($feetCount > 0)
						$feet->addAttribute ( 'linkage', lancon ( lat2tam ( $this->WordBond [$feetCount - 1] ['bond'] ), $this->Lang ) );
					
					$feetCount += 1;
					$lineFeetCount += 1;
				}
				
				if ($key == "smeta") {
					$lineFeetCount = 1;
					
					$line->addAttribute ( 'type', lancon ( lat2tam ( $this->LineType [$value] ), $this->Lang ) );
					
					if (count ( $alliteration [0] [$lineCount] ) > 0 || count ( $rhyme [0] [$lineCount] ) > 0) 

					{
						$ornament = $line->addChild ( "Ornamentation" );
						
						if (count ( $alliteration [0] [$lineCount] ) > 0) {
							$alliterationX = $ornament->addChild ( "Alliteration" );
							
							foreach ( $alliteration [0] [$lineCount] [0] as $ind => $match ) {
								$match = $alliterationX->addChild ( "Match", $match );
								$match->addAttribute ( "foot", $ind + 1 );
							}
							
							$alliterationX->addAttribute ( 'type', $alliteration [0] [$lineCount] [1] );
						}
						
						if (count ( $rhyme [0] [$lineCount] ) > 0) {
							$rhymeX = $ornament->addChild ( "Rhyme" );
							
							foreach ( $rhyme [0] [$lineCount] [0] as $ind => $match ) {
								$match = $rhymeX->addChild ( "Match", $match );
								$match->addAttribute ( "foot", $ind + 1 );
							}
							
							$rhymeX->addAttribute ( 'type', $rhyme [0] [$lineCount] [1] );
						}
					}
					
					$lineCount += 1;
				}
			}
		}
		
		if (count ( $alliteration [1] ) > 0 || count ( $rhyme [1] ) > 0) {
			$ornament = $verseXML->addChild ( "Ornamentation" );
			
			if (count ( $alliteration [1] ) > 0) {
				$alliterationX = $ornament->addChild ( "Alliteration" );
				
				foreach ( $alliteration [1] [0] [0] as $ind => $match ) {
					$match = $alliterationX->addChild ( "Match", $match );
					$match->addAttribute ( "line", $ind + 1 );
				}
			}
			
			if (count ( $rhyme [1] ) > 0) {
				$rhymeX = $ornament->addChild ( "Rhyme" );
				
				foreach ( $rhyme [1] [0] [0] as $ind => $match ) {
					$match = $rhymeX->addChild ( "Match", $match );
					$match->addAttribute ( "line", $ind + 1 );
				}
			}
		}
		
		$dom = new DOMDocument ( '1.0' );
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML ( $verseXML->asXML () );
		
		return html_entity_decode ( $dom->saveXML () );
	}
	
	/**
	 * Returns the Class of each Prosody Line as an Array .
	 *
	 * ..
	 *
	 * @return multitype:String
	 *
	 */
	public function GetLineClass($ParseTreeRoot) 

	{
		$rit = new RecursiveIteratorIterator ( new RecursiveArrayIterator ( $ParseTreeRoot ), RecursiveIteratorIterator::SELF_FIRST );
		
		foreach ( $rit as $key => $value )
			if ($rit->hasChildren () === FALSE)
				if ($key == "smeta")
					$LineClass [] = $this->LineType [$value];
		
		return $LineClass;
	}
	
	/**
	 * Displays the Line class
	 */
	public function DisplayLineClass() {
		$rit = new RecursiveIteratorIterator ( new RecursiveArrayIterator ( $this->ParseTreeRoot ), RecursiveIteratorIterator::SELF_FIRST );
		
		foreach ( $rit as $key => $value ) {
			
			if ($rit->hasChildren () === FALSE) {
				
				if ($key == "nE_r" || $key == "nirY")
					echo "<span class=\"uiTrant\">" . lancon ( lat2tam ( $value ), $this->Lang ) . "</span>";
				
				if ($key == "smeta")
					echo "&nbsp;&nbsp;| <span class=\"ati uiTrant\">" . lancon ( lat2tam ( $this->LineType [$value] ), $this->Lang ) . "</span><br/>";
			} 

			else {
				if ($rit->getDepth () == 3)
					echo "&nbsp;&nbsp;";
				if ($rit->getDepth () == 2)
					echo "<br/>";
			}
		}
	}
	
	/**
	 * Displays the Vaypaadu, Asai & Seer information as a Table
	 */
	public function DisplaySyllableWordClass() 

	{
		$VenpaaIndicator = $this->CheckVenpaa ( $this->ParseTreeRoot );
		
		$LastLine = FALSE;
		$VenpaaWordCntr = 0;
		$VenpaaSyllableCntr = 0;
		
		$rit = new RecursiveIteratorIterator ( new RecursiveArrayIterator ( $this->ParseTreeRoot ), RecursiveIteratorIterator::CHILD_FIRST );
		
		$WordClass = "";
		$Syllable = "";
		
		echo "<table border=0 CELLSPACING=15>";
		
		$NewWord = TRUE;
		$NewSentence = TRUE;
		
		foreach ( $rit as $key => $value ) {
			
			if ($rit->hasChildren () === FALSE) {
				
				if ($NewSentence) {
					echo "<tr>";
					$tr = "<tr>";
				}
				
				if (in_array ( $key, $this->SyllableTypes )) {
					if ($NewWord) {
						echo "<td>";
						$td = "<td>";
					}
					
					$NewWord = FALSE;
					$NewSentence = FALSE;
					
					if ($VenpaaWordCntr == 2)
						$VenpaaSyllableCntr ++;
					
					echo "<span class=\"" . $key . "asai uiTrant\">" . lancon ( lat2tam ( $value ), $this->Lang ) . " </span>";
					
					if ($VenpaaSyllableCntr == 2) {
						
						$Syllable = $Syllable . $tr . $td . "<span class=\"" . $key . "asai2 uiTrant\">" . lancon ( lat2tam ( "pu" ), $this->Lang ) . " </span>";
					} 

					else {
						
						$Syllable = $Syllable . $tr . $td . "<span class=\"" . $key . "asai2 uiTrant\">" . lancon ( lat2tam ( $key ), $this->Lang ) . " </span>";
					}
					
					$td = "";
					$tr = "";
				} 

				else if ($key == "meta") {
					
					if ($VenpaaSyllableCntr > 0)
						$WordClass = $WordClass . "<td><span class=\"uiTrant\">" . lancon ( lat2tam ( $this->VenpaaWordClass [$this->VenLastSyllable] ), $this->Lang ) . "</span></td>";
					else
						$WordClass = $WordClass . "<td><span class=\"uiTrant\">" . lancon ( lat2tam ( $value ), $this->Lang ) . "</span></td>";
				}
			} 

			else 

			{
				if ($key == "aTi-" . (($this->TotalLines) - 1) && $key != "")
					$LastLine = TRUE;
				
				if ($rit->getDepth () == 3) {
					echo "</td>";
					
					if ($LastLine == TRUE && $VenpaaIndicator != NULL)
						$VenpaaWordCntr ++;
					
					$NewWord = TRUE;
					$Syllable = $Syllable . "</td>";
					$td = "";
				} 

				else if ($rit->getDepth () == 2) {
					echo "</tr>";
					echo $Syllable . "<tr><span class=\"vaypatu uiTrant\">" . $WordClass . "</span></tr>";
					
					$NewSentence = TRUE;
					$WordClass = "";
					$Syllable = "";
				}
			}
		}
		
		echo "</table>";
	}
	
	/**
	 * Returns the Talai information as an Associative Array
	 *
	 * @param ParseTree $root        	
	 * @return multitype:string
	 */
	public function GetWordBond($root) 

	{
		$SyllableBond = array ();
		
		$rit = new RecursiveIteratorIterator ( new RecursiveArrayIterator ( $root ), RecursiveIteratorIterator::LEAVES_ONLY );
		
		$WordClass = array ();
		$Syllable = "";
		$Word = array ();
		$SyllableClass = array ();
		$FirstSyllable = TRUE;
		
		/*
		 * Push the Word with Divides, WordClass (Tema, Pulima, etc) & First
		 * Syllable Class (ner nirai) into two Arrays to calculate the Talai.
		 */
		
		foreach ( $rit as $key => $value ) {
			
			if ($key == "nE_r" || $key == "nirY") {
				
				$Syllable = $Syllable . $value . "/";
				
				if ($FirstSyllable) {
					array_push ( $SyllableClass, $key );
					$FirstSyllable = FALSE;
				}
			}
			
			if ($key == "meta") {
				array_push ( $WordClass, $value );
				array_push ( $Word, $Syllable );
				$Syllable = "";
				$FirstSyllable = TRUE;
			}
		}
		
		$Bond = "";
		
		/*
		 * Compare the Word Class & Syllable Class to calculate the Talai
		 */
		
		for($i = 0; $i < count ( $Word ) - 1; $i ++) 

		{
			
			$Bond ['word1'] = $Word [$i];
			$Bond ['word2'] = $Word [$i + 1];
			$Bond ['class1'] = $WordClass [$i];
			$Bond ['class2'] = $SyllableClass [$i + 1];
			
			// $tl[$seer[$i]]=$vayp[$i];
			// $tl[$seer[$i+1]]=$asai[$i+1];
			
			if (substr ( $WordClass [$i], strlen ( $WordClass [$i] ) - 2 ) == "mA" && ($SyllableClass [$i + 1] == "nE_r")) 

			{
				$Bond ['bond'] = "நேரொன்றிய ஆசிரியத்தளை";
			} 

			else if (substr ( $WordClass [$i], strlen ( $WordClass [$i] ) - 6 ) == "viLa_m" && ($SyllableClass [$i + 1] == "nirY")) 

			{
				
				$Bond ['bond'] = "நிரையொன்றிய ஆசிரியத்தளை";
			} 

			else if ((substr ( $WordClass [$i], strlen ( $WordClass [$i] ) - 2 ) == "mA" && ($SyllableClass [$i + 1] == "nirY")) || (substr ( $WordClass [$i], strlen ( $WordClass [$i] ) - 6 ) == "viLa_m" && ($SyllableClass [$i + 1] == "nE_r"))) 

			{
				$Bond ['bond'] = "இயற்சீர் வெண்டளை";
			} 

			else if ((substr ( $WordClass [$i], strlen ( $WordClass [$i] ) - 4 ) == "kA_y" && ($SyllableClass [$i + 1] == "nE_r")) || (substr ( $WordClass [$i], strlen ( $WordClass [$i] ) - 2 ) == "pU" && ($SyllableClass [$i + 1] == "nE_r"))) 

			{
				
				$Bond ['bond'] = "வெண்சீர் வெண்டளை";
			} 

			else if ((substr ( $WordClass [$i], strlen ( $WordClass [$i] ) - 4 ) == "kaVi" && ($SyllableClass [$i + 1] == "nirY")) || (substr ( $WordClass [$i], strlen ( $WordClass [$i] ) - 6 ) == "niZa_l" && ($SyllableClass [$i + 1] == "nirY")) || (substr ( $WordClass [$i], strlen ( $WordClass [$i] ) - 6 ) == "NiZa_l" && ($SyllableClass [$i + 1] == "nirY"))) 

			{
				$Bond ['bond'] = "ஒன்றிய வஞ்சித்தளை";
			} else if ((substr ( $WordClass [$i], strlen ( $WordClass [$i] ) - 4 ) == "kaVi" && ($SyllableClass [$i + 1] == "nE_r")) || (substr ( $WordClass [$i], strlen ( $WordClass [$i] ) - 6 ) == "niZa_l" && ($SyllableClass [$i + 1] == "nE_r")) || (substr ( $WordClass [$i], strlen ( $WordClass [$i] ) - 6 ) == "NiZa_l" && ($SyllableClass [$i + 1] == "nE_r"))) 

			{
				$Bond ['bond'] = "ஒன்றா வஞ்சித்தளை";
			} 

			else if ((substr ( $WordClass [$i], strlen ( $WordClass [$i] ) - 4 ) == "kA_y" && ($SyllableClass [$i + 1] == "nirY")) || (substr ( $WordClass [$i], strlen ( $WordClass [$i] ) - 2 ) == "pU" && ($SyllableClass [$i + 1] == "nirY"))) 

			{
				$Bond ['bond'] = "கலித்தளை";
			}
			
			$SyllableBond [] = $Bond;
			
			$Bond = "";
		}
		
		return $SyllableBond;
	}
	
	/**
	 * Displays Talai Information as a Table
	 */
	public function DisplayWordBond() 

	{
		echo "<table border=0 CELLSPACING=10>";
		
		echo <<<CWS
<tr>
CWS;
		echo "<th><span class=\"uiTran\">" . lanconTrnL ( "சீர்கள்", $this->Lang ) . "</span></th>";
		echo "<th><span class=\"uiTran\">" . lanconTrnL ( "வாய்ப்பாடு - அசை", $this->Lang ) . "</span></th>";
		echo "<th><span class=\"uiTran\">" . lanconTrnL ( "தளை", $this->Lang ) . "</span></th>";
		echo "</tr>";
		
		foreach ( $this->WordBond as $Bond ) 

		{
			
			echo "<tr>";
			echo "<td><span class=\"tal-seer uiTrant\">";
			
			echo lancon ( lat2tam ( $Bond ['word1'] ), $this->Lang ) . " - " . lancon ( lat2tam ( $Bond ['word2'] ), $this->Lang );
			
			echo "</span></td>";
			
			echo "<td><span class=\"tal-asai uiTrant\">";
			
			echo lancon ( lat2tam ( $Bond ['class1'] ), $this->Lang ) . " - " . lancon ( lat2tam ( $Bond ['class2'] ), $this->Lang );
			
			echo "</span></td>";
			
			echo "<td>";
			
			if ($Bond ['bond'] == "நேரொன்றிய ஆசிரியத்தளை" || $Bond ['bond'] == "நிரையொன்றிய ஆசிரியத்தளை")
				
				echo "<span class=\"aatalai uiTrant\">";
			
			else if ($Bond ['bond'] == "இயற்சீர் வெண்டளை" || $Bond ['bond'] == "வெண்சீர் வெண்டளை")
				
				echo "<span class=\"vetalai uiTrant\">";
			
			else if ($Bond ['bond'] == "ஒன்றிய வஞ்சித்தளை" || $Bond ['bond'] == "ஒன்றா வஞ்சித்தளை")
				
				echo "<span class=\"vatalai uiTrant\">";
			
			else if ($Bond ['bond'] == "கலித்தளை")
				
				echo "<span class=\"katalai uiTrant\">";
			
			echo lancon ( $Bond ['bond'], $this->Lang );
			
			echo "</td>";
			echo "</span>";
			echo "</tr>";
		}
		
		echo "</table>";
	}
	
	/**
	 * Return the Metre of the Prosody
	 *
	 * @param unknown_type $root        	
	 * @return Ambigous <NULL, string>
	 */
	public function GetMetreType($root) 

	{
		$Venpaa = $this->CheckVenpaa ();
		$Asiriyappaa = $this->CheckAsiyaripaa ();
		$Kalippaa = $this->CheckKalippaa ();
		$VenKalippaa = $this->CheckVenKalippaa ();
		$Vanjippaa = $this->CheckVanjippaa ();
		$VenInam = $this->CheckVenInam ();
		$AsiriyaInam = $this->CheckAsiriyaInam ();
		$VanjiInam = $this->CheckVanjiInam ();
		$KaliInam = $this->CheckKaliInam ();
		
		if ($Venpaa != NULL)
			$MetreType = $Venpaa;
		else if ($Asiriyappaa != NULL)
			$MetreType = $Asiriyappaa;
		else if ($Kalippaa != NULL)
			$MetreType = $Kalippaa;
		else if ($VenKalippaa != NULL)
			$MetreType = $VenKalippaa;
		else if ($Vanjippaa != NULL)
			$MetreType = $Vanjippaa;
		else if ($VenInam != NULL)
			$MetreType = $VenInam;
		else if ($AsiriyaInam != NULL)
			$MetreType = $AsiriyaInam;
		else if ($KaliInam != NULL)
			$MetreType = $KaliInam;
		else if ($VanjiInam != NULL)
			$MetreType = $VanjiInam;
		else
			$MetreType = NULL;
		
		return $MetreType;
	}
	
	/**
	 * Check if the Prosody Metre is Venpaa - If Venpaa return the exact type,
	 * else return NULL
	 *
	 * @return string NULL
	 */
	public function CheckVenpaa() {
		
		// check and remove the eetrasai class variable
		$root = $this->ParseTreeRoot;
		
		$rit = new RecursiveIteratorIterator ( new RecursiveArrayIterator ( $root ), RecursiveIteratorIterator::SELF_FIRST );
		
		$LineClassCheck = TRUE;
		$WordClassCheck = TRUE;
		
		$AllowedWordClass = array (
				"tEmA",
				"puLimA",
				"kUviLa_m",
				"karuviLa_m",
				"tEmA_GkA_y",
				"puLimA_GkA_y",
				"kUviLa_GkA_y",
				"karuviLa_GkA_y" 
		); // ,"mA","viLa_m");
		
		/* Word Count */
		
		$cirs = new RecursiveIteratorIterator ( new RecursiveArrayIterator ( $root ), RecursiveIteratorIterator::SELF_FIRST );
		
		$wordCount = - 1;
		
		foreach ( $cirs as $key => $value )
			if ($key == 'meta')
				$wordCount += 1;
			
			/* Check for Allowed Seers, Line Count */
		
		$wrongWordClasses = array ();
		
		$wordIndex == 0;
		
		foreach ( $rit as $Line => $Words ) {
			
			if ($rit->hasChildren () == FALSE) {
				
				if ($Line == 'meta') {
					$wordIndex += 1;
					
					/* Check for Allowed Seers */
					
					if ($wordIndex != $wordCount && ! in_array ( $Words, $AllowedWordClass )) {
						$WordClassCheck = FALSE;
						$wrongWordClasses [] = $Words;
					}
				}
			}
			
			if ($rit->getDepth () == 2) {
				
				/* Check for Allowed Line Classes */
				
				if ($Line != ("aTi-" . $this->TotalLines) && $Words ['smeta'] != 4)
					$LineClassCheck = FALSE;
				
				if ($Line == ("aTi-" . ($this->TotalLines)) && $Words ['smeta'] != 3)
					$LineClassCheck = FALSE;
				
				if ($Line == ("aTi-" . $this->TotalLines))
					$LastLine = $Words;
			}
		}
		
		/*
		 * Getting Last Syllable to Check for Naal,Kaasu, Malar, Pirappu
		 * patterns
		 */
		foreach ( $LastLine as $key => $value )
			if ($key != "smeta")
				$LastWord = $value;
		
		$LastWord = new RecursiveIteratorIterator ( new RecursiveArrayIterator ( $LastWord ), RecursiveIteratorIterator::LEAVES_ONLY );
		
		$LastSyllable = array ();
		$LastSyllableClass = array ();
		
		foreach ( $LastWord as $key => $value ) {
			
			$LastSyllableClass [] = $key;
			$LastSyllable [] = $value;
		}
		
		$FinalSyllableClassCheck = FALSE;
		
		if (empty ( $LastSyllable [2] )) {
			
			$FinalSyllableClassCheck = TRUE;
		} 

		else if (strlen ( $LastSyllable [1] ) == 2 && substr ( $LastSyllable [1], 1 ) == 'u') 

		{
			
			$FinalSyllableClassCheck = TRUE;
			$LastSyllableClass [0] .= 'pu';
		}
		
		$this->VenLastSyllable = $LastSyllableClass [0];
		
		/* Check for Metre Specific Talais */
		
		$WordBondClassCheck = TRUE;
		$Bond = array ();
		
		$wrongBonds = array ();
		
		foreach ( $this->WordBond as $Bond ) {
			$BondType = $Bond ['bond'];
			
			if (substr ( $BondType, strlen ( $BondType ) - 21 ) != "வெண்டளை") {
				$WordBondClassCheck = FALSE;
				$wrongBonds [] = $BondType;
			}
		}
		
		/* Classify the Metre */
		
		$this->VenpaError = "";
		
		// Logging and Classifying Errors
		
		$this->VenpaError ['word'] [0] = 'ஈற்றசையின் ஈற்றுச்சீரைத் தவிர்த்து ஈரசைச்சீர்களும் காய்ச்சீர்களும் மட்டுமே பயின்று வருதல் வேண்டும்';
		$this->VenpaError ['bond'] [0] = 'வெண்டளைகள் மட்டுமே பயின்று வருதல் வேண்டும்';
		$this->VenpaError ['line'] [0] = 'ஈற்றடி மூன்று சீர்களும் ஏனைய அடிகள் நான்கு சீர்களும் கொண்டிருத்தல் வேண்டும்';
		$this->VenpaError ['final'] [0] = 'ஈற்றடியின் ஈற்றுச்சீர் நாள், மலர், காசு, பிறப்பு ஆகியவற்றுள் இருத்தல் வேண்டும்';
		
		// Bonds
		if (! $WordBondClassCheck) {
			$wrongBondsList = join ( ",", array_unique ( $wrongBonds ) );
			$this->VenpaError ['bond'] [1] = 'பாவினுள் வெண்டளை அல்லாத ' . $wrongBondsList . ' பயின்று வந்துள்ளது(ன)';
		}
		
		// WordClass
		if (! $WordClassCheck) {
			$wrongWordClassList = lat2tam ( join ( ",", array_unique ( $wrongWordClasses ) ) );
			$this->VenpaError ['word'] [1] = $wrongWordClassList . ' ஆகிய வாய்ப்பாடு(கள்) பயின்றுள்ளது(ன)';
		}
		
		// LineClass
		if (! $LineClassCheck) {
			$this->VenpaError ['line'] [1] = "பொருந்தவில்லை";
		}
		
		// Final Syllable
		if (! $FinalSyllableClassCheck) {
			$this->VenpaError ['final'] [1] = "பொருந்தவில்லை";
		}
		
		$this->VenpaaTypeExpl = "";
		
		if ($WordBondClassCheck && $FinalSyllableClassCheck && $LineClassCheck && $WordClassCheck) 

		{
			
			$Vikalpa = $this->VikalpaCount;
			
			$TaniccolExists = $this->CheckTaniccol ( $this->InputSourceText, 2, TRUE );
			
			$this->VenpaaTypeExpl = ( string ) $this->TotalLines . " அடிகளுடன் ";
			
			if ($Vikalpa == 1)
				$this->VenpaaTypeExpl .= ( string ) $Vikalpa . " விகற்பம் கொண்டு ";
			else
				$this->VenpaaTypeExpl .= ( string ) $Vikalpa . " விகற்பங்கள் கொண்டு ";
			
			if ($this->TotalLines == 3 || $this->TotalLines == 4) {
				if ($TaniccolExists)
					$this->VenpaaTypeExpl .= "<em>தனிச்சொல்</em> பெற்று ";
				else
					$this->VenpaaTypeExpl .= "<em>தனிச்சொல்</em> பெறாது ";
			}
			
			if ($this->TotalLines == 4 && $Vikalpa == 1 && $TaniccolExists == TRUE)
				$MetreType = "_oru vika_Rpa nEricY ve_NpA";
			else if ($this->TotalLines == 4 && $Vikalpa == 2 && $TaniccolExists == TRUE)
				$MetreType = "_iru vika_Rpa nEricY ve_NpA";
			else 

			{
				$MetreType = "_i_VVicY ve_NpA";
				
				if ($Vikalpa == 1)
					$MetreType = "_oru vika_Rpa " . $MetreType;
				else
					$MetreType = "pala vika_Rpa " . $MetreType;
			}
			
			if ($this->TotalLines == 2 && $Vikalpa == 1)
				$MetreType = "_oru vika_Rpa_k kuRa_L ve_NpA";
			else if ($this->TotalLines == 2 && $Vikalpa == 2)
				$MetreType = "_iru vika_Rpa_k kuRa_L ve_NpA";
			else if ($this->TotalLines == 3 && $TaniccolExists == TRUE && $Vikalpa == 1)
				$MetreType = "_oru vika_Rpa nEricY ci_ntiya_l ve_NpA";
			else if ($this->TotalLines == 3 && $TaniccolExists == TRUE && $Vikalpa == 2)
				$MetreType = "_iru vika_Rpa nEricY ci_ntiya_l ve_NpA";
			else if ($this->TotalLines == 3 && $TaniccolExists == FALSE && $Vikalpa == 1)
				$MetreType = "_oru vika_Rpa _i_VVicY ci_ntiya_l ve_NpA";
			else if ($this->TotalLines == 3 && $TaniccolExists == FALSE && $Vikalpa > 1)
				$MetreType = "pala vika_Rpa _i_VVicY ci_ntiya_l ve_NpA";
			else if ($this->TotalLines > 4 && $this->TotalLines <= 12 && $Vikalpa == 1)
				$MetreType = "_oru vika_Rpa pa_KRoTY ve_NpA";
			else if ($this->TotalLines > 4 && $this->TotalLines <= 12 && $Vikalpa > 1)
				$MetreType = "pala vika_Rpa pa_KRoTY ve_NpA";
			else if ($this->TotalLines > 12)
				$MetreType = "kalive_NpA";
			
			$this->VenpaaTypeExpl .= "வந்ததால் <strong>" . lancon ( lat2tam ( $MetreType ), $this->lang ) . "</strong> ஆயிற்று";
			
			return $MetreType;
		} 

		else
			return NULL;
	}
	
	// # Displaying Errors occured on Checking with Venpa Rules
	public function displayError($verseError) {
		echo "<table order=0 CELLSPACING=20>";
		
		echo "<tr>";
		echo "<td> <big><b> விதி  </b></big> </td>";
		echo "<td> <big><b> பொருத்தம் </b></big> </td>";
		echo "</tr>";
		
		foreach ( $verseError as $rules => $results ) {
			
			echo "<tr>";
			echo "<td>" . $results [0] . "</td>";
			
			if (isset ( $results [1] ))
				echo "<td><div class=\"wrong\">" . $results [1] . "</div></td>";
			else
				echo "<td> <div class=\"right\"> பொருந்துகிறது </div> </td>";
		}
		
		echo "</table>";
		
		if ($this->VenpaaTypeExpl != "")
			echo "<hr/>";
		
		echo "<p>" . $this->VenpaaTypeExpl . "</p>";
	}
	
	/**
	 * Check if the Prosody Metre is Asiriyapaa - If Asiriyappaa return the
	 * exact type, else return NULL
	 *
	 * @return string NULL
	 */
	public function CheckAsiyaripaa() {
		$root = $this->ParseTreeRoot;
		
		$rit = new RecursiveIteratorIterator ( new RecursiveArrayIterator ( $root ), RecursiveIteratorIterator::SELF_FIRST );
		
		$WordClassCheck = TRUE;
		$FinalLastSyllableClassCheck = FALSE;
		$LineClassCheck = FALSE;
		
		$AllowedWordClassCount = 0;
		$TotalWordCount = 0;
		
		$DisAllowedWordClass = array (
				"karuviLa_GkaVi",
				"kUviLa_GkaVi" 
		);
		$AllowedWordClass = array (
				"tEmA",
				"puLimA",
				"kUviLa_m",
				"karuviLa_m" 
		);
		
		$AllowedMonoFinalLetters = array (
				"E",
				"O",
				"I",
				"Y",
				"Q" 
		);
		$AllowedTriFinalLetters = array (
				"A_y",
				"e_V" 
		);
		
		$LineWordCount = array ();
		
		/* Check for Allowed Word Class and DisAllowed Word Class */
		
		foreach ( $rit as $Line => $Words ) {
			
			if ($rit->hasChildren () == FALSE) {
				
				if ($Line == 'meta') {
					
					$TotalWordCount ++;
					
					if (in_array ( $Words, $DisAllowedWordClass ))
						$WordClassCheck = FALSE;
					if (in_array ( $Words, $AllowedWordClass ))
						$AllowedWordClassCount ++;
				}
			}
			
			if ($rit->getDepth () == 2) {
				
				$LineWordCount [] = $Words ['smeta'];
			}
		}
		
		/*
		 * Check for Final Syllable ending
		 */
		
		$FinalLettersMono = substr ( $this->InputSourceText, - 1 );
		$FinalLettersTri = substr ( $this->InputSourceText, - 3 );
		
		if (in_array ( $FinalLettersMono, $AllowedMonoFinalLetters ) || in_array ( $FinalLettersTri, $AllowedTriFinalLetters ))
			$FinalLastSyllableClassCheck = TRUE;
			
			/*
		 * Check for Line Count
		 */
		
		if ($this->TotalLines > 2)
			$LineClassCheck = TRUE;
			
			/*
		 * Check if Agavarseers are Majority
		 */
		$WordSyllableCheck = FALSE;
		
		if (($AllowedWordClassCount / $TotalWordCount) > 0.45)
			$WordSyllableCheck = TRUE;
			
			/*
		 * Check if all Conditions are TRUE
		 */
		
		if ($WordClassCheck && $FinalLastSyllableClassCheck && $LineClassCheck && $WordSyllableCheck)
			$AsiriyappaaCheck = TRUE;
		else
			$AsiriyappaaCheck = FALSE;
			
			/*
		 * Find the Type of Asiriyappaa
		 */
		
		$AlavadiClass = TRUE;
		$NonAlavadiClassCount = array ();
		
		/*
		 * Validate the count of Words in Each line, to decide the type of
		 * Asiriyappa
		 */
		
		$Vikalpa = $this->VikalpaCount;
		
		for($LineIndex = 0; $LineIndex < count ( $LineWordCount ); $LineIndex ++) {
			if ($LineWordCount [$LineIndex] < 4) {
				$AlavadiClass = FALSE;
				$NonAlavadiClassCount [] = $LineIndex + 1;
				
				if ($LineIndex == 0 || $LineIndex == (count ( $LineWordCount ) - 1))
					$AsiriyappaaCheck = FALSE;
			}
			
			if ($LineWordCount [$LineIndex] > 4)
				$AsiriyappaaCheck = FALSE;
		}
		
		if ($AsiriyappaaCheck) 

		{
			
			/*
			 * If Vikalpa = 1 the it must be considered as Kali Vritta rather
			 * than Asiriyappaa
			 */
			
			if ($AlavadiClass) {
				if ($Vikalpa != 1)
					$MetreType = "nilYma_NTila _Aciriya_ppA";
				else
					$MetreType = NULL;
			} 

			else {
				if (count ( $NonAlavadiClassCount ) == 1 && $NonAlavadiClassCount [0] == ($this->TotalLines - 1))
					
					$MetreType = "nEricY _Aciriya_ppA";
				
				else
					
					$MetreType = "_iNY_kkuRa_L _Aciriya_ppA";
			}
			
			return $MetreType;
		} 

		else
			
			return NULL;
	}
	
	/**
	 * Check if the Prosody Metre is Kalipaa - If the metre matches return the
	 * exact type, else return NULL
	 *
	 * @return string NULL
	 */
	public function CheckKalippaa() 

	{
		$root = $this->ParseTreeRoot;
		
		$rit = new RecursiveIteratorIterator ( new RecursiveArrayIterator ( $root ), RecursiveIteratorIterator::SELF_FIRST );
		
		$LineClassCheck = TRUE;
		$WordClassCheck = TRUE;
		$WordSyllableClassCheck = FALSE;
		$LineCountCheck = FALSE;
		
		$DisAllowedWordClass = array (
				"karuviLa_GkaVi",
				"kUviLa_GkaVi",
				"tEmA",
				"puLimA" 
		);
		$AllowedWordClass = array (
				"tEmA_GkA_y",
				"puLimA_GkA_y",
				"kUviLa_GkA_y",
				"karuviLa_GkA_y" 
		);
		
		$TotalWordCount = 0;
		
		$AllowedWordClassCount = 0;
		
		/*
		 * Check for Line Count
		 */
		
		if ($this->TotalLines > 3)
			$LineCountCheck = TRUE;
			
			/*
		 * Check for Allowed Word Class
		 */
		
		foreach ( $rit as $Line => $Words ) {
			
			if ($rit->hasChildren () == FALSE) {
				
				if ($Line == 'meta') {
					
					$TotalWordCount ++;
					
					if (in_array ( $Words, $DisAllowedWordClass ))
						$WordClassCheck = FALSE;
					if (in_array ( $Words, $AllowedWordClass ))
						$AllowedWordClassCount ++;
				}
			}
			
			if ($rit->getDepth () == 2) {
				
				if ($Words ['smeta'] != 4)
					$LineClassCheck = FALSE;
			}
		}
		
		/*
		 * Check for Allowed Word Syllable Types is Majority
		 */
		
		if ($AllowedWordClassCount / $TotalWordCount > 0.45)
			$WordSyllableClassCheck = TRUE;
		
		if ($WordClassCheck && $LineClassCheck && $WordSyllableClassCheck && $LineCountCheck)
			return "taravu ko_ccaka_k kali_ppA";
		else
			return NULL;
	}
	
	/**
	 * Check if the Prosody Metre is Kalivenpaa - If the metre matches return
	 * the exact type, else return NULL
	 *
	 * @return string NULL
	 */
	public function CheckVenKalippaa() 

	{
		$root = $this->ParseTreeRoot;
		
		$rit = new RecursiveIteratorIterator ( new RecursiveArrayIterator ( $root ), RecursiveIteratorIterator::SELF_FIRST );
		
		$LineClassCheck = TRUE;
		$WordClassCheck = TRUE;
		$WordSyllableClassCheck = FALSE;
		$VenkalippaaEndCheck = FALSE;
		$LineCountCheck = FALSE;
		
		$DisAllowedWordClass = array (
				"karuviLa_GkaVi",
				"kUviLa_GkaVi",
				"tEmA",
				"puLimA" 
		);
		$NonFinalWordClass = array (
				"karuviLa_GkaVi",
				"kUviLa_GkaVi" 
		);
		$AllowedWordClass = array (
				"tEmA_GkA_y",
				"puLimA_GkA_y",
				"kUviLa_GkA_y",
				"karuviLa_GkA_y" 
		);
		
		$TotalWordCount = 0;
		$AllowedWordClassCount = 0;
		$FinalWords = array ();
		
		$LineIndex = 0;
		
		/*
		 * Check for Line Count
		 */
		
		if ($this->TotalLines > 3)
			$LineCountCheck = TRUE;
			
			/*
		 * Check for Allowed Word Classes
		 */
		
		foreach ( $rit as $Line => $Words ) {
			
			if ($rit->hasChildren () == FALSE) {
				
				if ($Line == 'meta' && $LineIndex != $this->TotalLines) {
					
					$TotalWordCount ++;
					
					if (in_array ( $Words, $DisAllowedWordClass ))
						$WordClassCheck = FALSE;
					if (in_array ( $Words, $AllowedWordClass ))
						$AllowedWordClassCount ++;
				}
				if ($Line == 'meta' && $LineIndex == $this->TotalLines) 

				{
					$FinalWords [] = $Words;
					
					if (in_array ( $Words, $AllowedWordClass ))
						$AllowedWordClassCount ++;
				}
			}
			
			if ($rit->getDepth () == 2) {
				
				$LineIndex ++;
				
				if ($Words ['smeta'] != 4 && $Line != ("aTi-" . $this->TotalLines)) {
					$LineClassCheck = FALSE;
				}
				if ($Line == ("aTi-" . $this->TotalLines)) {
					
					$FinalWordsCount = $Words ['smeta'];
				}
			}
		}
		
		/*
		 * Check if Final Line Word Coutn is 3 and prsence of DisallowedWord
		 * Class
		 */
		if ($FinalWordsCount == 3 && (! in_array ( $FinalWords [0], $DisAllowedWordClass )) && (! in_array ( $FinalWords [1], $DisAllowedWordClass )) && (! in_array ( $FinalWords [2], $NonFinalWordClass ))) {
			$VenkalippaaEndCheck = TRUE;
		}
		
		if ($TotalWordCount > 0 && $AllowedWordClassCount / $TotalWordCount > 0.45)
			$WordSyllableClassCheck = TRUE;
		
		if ($WordClassCheck && $LineClassCheck && $WordSyllableClassCheck && $VenkalippaaEndCheck && $LineCountCheck)
			return "ve_Nkali_ppA";
		else
			return NULL;
	}
	
	/**
	 * Check if the Prosody Metre is Vanjipaa - If the metre matches return the
	 * exact type, else return NULL
	 *
	 * @return string NULL
	 */
	public function CheckVanjippaa() 

	{
		$root = $this->ParseTreeRoot;
		
		$rit = new RecursiveIteratorIterator ( new RecursiveArrayIterator ( $root ), RecursiveIteratorIterator::SELF_FIRST );
		
		$WordSyllableClassCheck = FALSE;
		$LineClassCheck = TRUE;
		$LoneWord = FALSE;
		$LineWordCount = array ();
		$AllowedWordClass = array (
				"tEmA",
				"puLimA",
				"kUviLa_m",
				"karuviLa_m" 
		);
		$AllowedWordClassCount = 0;
		$TotalWordCount = 0;
		
		/*
		 * Check for Taniccol, Allowed Word Class in Asiriya Surithakam
		 */
		
		foreach ( $rit as $Line => $Words ) {
			
			if ($rit->hasChildren () == FALSE) {
				
				if ($Line == 'meta' && $LoneWord) {
					
					$TotalWordCount ++;
					
					if (in_array ( $Words, $AllowedWordClass ))
						$AllowedWordClassCount ++;
				}
			}
			
			if ($rit->getDepth () == 2) {
				
				if ($Words ['smeta'] == 1)
					$LoneWord = TRUE;
				
				$LineWordCount [] = $Words ['smeta'];
			}
		}
		
		/*
		 * Check if Allowed Word Class is Majority in Asiriyasurithakam
		 */
		if ($LoneWord)
			if ($AllowedWordClassCount / $TotalWordCount > 0.45)
				$WordSyllableClassCheck = TRUE;
			
			/*
		 * Validate the Words in Each line
		 */
		
		for($LineIndex = 0; $LineIndex < count ( $LineWordCount ); $LineIndex ++) {
			
			if ($LineWordCount [$LineIndex] != $LineWordCount [$LineIndex + 1])
				$LineClassCheck = FALSE;
			
			if ($LineWordCount [$LineIndex + 2] == 1)
				break;
		}
		
		if ($LineIndex < 1 || $LineWordCount [$LineIndex + 2] != 1)
			$LineClassCheck = FALSE;
		
		for($NextLineIndex = $LineIndex + 3; $NextLineIndex < count ( $LineWordCount ); $NextLineIndex ++) {
			if ($LineWordCount [$NextLineIndex] != 3 && $LineWordCount [$NextLineIndex] != 4)
				$LineClassCheck = FALSE;
		}
		
		$SuridhagamWordCount = ($NextLineIndex - ($LineIndex + 3));
		
		if ($SuridhagamWordCount != 2)
			$LineClassCheck = FALSE;
			
			/*
		 * Check the Type of Vanjippa
		 */
		
		if ($LineClassCheck && $WordSyllableClassCheck) {
			if ($LineWordCount [$LineIndex] == 2)
				$MetreType = "kuRaLaTi va_Jci_ppA";
			if ($LineWordCount [$LineIndex] == 3)
				$MetreType = "ci_ntaTi va_Jci_ppA";
			
			return $MetreType;
		} 

		else
			return NULL;
	}
	
	/**
	 * Check if the Prosody Metre is VenpaaInam - If the metre matches return
	 * the exact type, else return NULL
	 *
	 * @return Ambigous <string, NULL>
	 */
	public function CheckVenInam() {
		$KuralTaazhisaiCheck = FALSE;
		$KuralTuraiCheck = FALSE;
		
		$TaazhisaiCheck = TRUE;
		$TuraiCheck = TRUE;
		$ViruttamCheck = TRUE;
		
		$LineTypeReverse = array_flip ( $this->LineType );
		
		/*
		 * Check Kural Turai & Thaazhisai
		 */
		
		if ($this->TotalLines == 2) {
			if ($LineTypeReverse [$this->LineClass [0]] == $LineTypeReverse [$this->LineClass [1]])
				$KuralTuraiCheck = TRUE;
			
			if ($LineTypeReverse [$this->LineClass [0]] > $LineTypeReverse [$this->LineClass [1]])
				$KuralTaazhisaiCheck = TRUE;
		}
		
		/*
		 * Check for Ven Thaazhisai
		 */
		
		if ($this->TotalLines == 3) {
			if (($this->LineClass [0] != "_aLavaTi") || ($this->LineClass [1] != "_aLavaTi") || $this->LineClass [2] != "ci_ntaTi")
				$TaazhisaiCheck = FALSE;
		} 

		else
			$TaazhisaiCheck = FALSE;
			
			/*
		 * Check for Ven Thurai
		 */
		
		$ProsodyLineTypes = $this->LineClass;
		$LinesCount = array ();
		
		foreach ( $ProsodyLineTypes as $key => $value )
			$LinesCount [] = ($LineTypeReverse [$value]);
		
		$RevLinesCount = $LinesCount;
		rsort ( $RevLinesCount );
		
		if ($LinesCount != $RevLinesCount)
			$TuraiCheck = FALSE;
		
		$LineClassCheck = $this->CheckLineWordCount ( $this->TotalLines, $LinesCount [0] );
		
		if ($this->TotalLines < 3 || $this->TotalLines > 7 || $LineClassCheck)
			$TuraiCheck = FALSE;
			
			/*
		 * Check for Veli Viruttam
		 */
		
		$TaniccolCheck = array ();
		
		for($LineIndex = 1; $LineIndex <= $this->TotalLines; $LineIndex ++) {
			$TaniccolCheck = $this->CheckTaniccol ( $this->InputSourceText, $LineIndex, FALSE );
			
			if (! $TaniccolCheck)
				$ViruttamCheck = FALSE;
		}
		
		$LineClassCheck = $this->CheckLineWordCount ( $this->TotalLines, 5 );
		
		if ($this->TotalLines != 3 && $this->TotalLines != 4 && $LineClassCheck)
			$ViruttamCheck = FALSE;
		
		if ($KuralTaazhisaiCheck)
			$MetreType = "kuRa_TTAZicY";
		else if ($KuralTuraiCheck)
			$MetreType = "kuRa_L ve_Nce_ntuRY";
		else if ($TaazhisaiCheck)
			$MetreType = "ve_NTAZicY";
		else if ($TuraiCheck)
			$MetreType = "ve_NTuRY";
		else if ($ViruttamCheck)
			$MetreType = "veLi viru_tta_m";
		else
			$MetreType = NULL;
		
		return $MetreType;
	}
	
	/**
	 * Check if the Prosody Metre is Aasiriyapaainam - If the metre matches
	 * return the exact type, else return NULL
	 *
	 * @return Ambigous <string, NULL>
	 */
	public function CheckAsiriyaInam() {
		$TaazhisaiCheck = FALSE;
		$TuraiCheck = FALSE;
		$ViruttamCheck = FALSE;
		
		for($LineIndex = 6; $LineIndex <= 24; $LineIndex ++) 

		{
			$ViruttamCheck = $this->CheckLineWordCount ( 4, $LineIndex );
			
			if ($ViruttamCheck)
				break;
		}
		
		/*
		 * Check for Thaazhisai
		 */
		
		for($WordCount = 2; $WordCount <= 9; $WordCount ++)
			$TaazhisaiCheck = $TaazhisaiCheck || $this->CheckLineWordCount ( 3, $WordCount );
			
			/*
		 * Check for Turai
		 */
		
		$LineLevelCheck = FALSE;
		
		if ($this->TotalLines == 4) 

		{
			for($WordCount = 2; $WordCount <= 24; $WordCount ++)
				$LineLevelCheck = $LineLevelCheck || $this->CheckLineWordCount ( 4, $WordCount );
			
			$TuraiCheck = ! $LineLevelCheck;
			
			$ProsodyLineTypes = $this->LineClass;
			$LineTypeReverse = array_flip ( $this->LineType );
			
			/* Check if it isn't a Kalittaazhisai */
			
			foreach ( $ProsodyLineTypes as $key => $value ) {
				if (($key + 1) != $this->TotalLines)
					$LineWordCount [] = ($LineTypeReverse [$value]);
				else
					$FinalLineCount = ($LineTypeReverse [$value]);
			}
			
			if (max ( $LineWordCount ) < $FinalLineCount)
				$TuraiCheck = FALSE;
		} 

		else
			$TuraiCheck = FALSE;
		
		if ($TaazhisaiCheck)
			$MetreType = "_Aciriya_ttAZicY";
		else if ($TuraiCheck)
			$MetreType = "_Aciriya_ttuRY";
		else if ($ViruttamCheck)
			$MetreType = $this->LineType [$LineIndex] . " _Aciriya viru_tta_m";
		else
			$MetreType = NULL;
		
		return $MetreType;
	}
	
	/**
	 * Check if the Prosody Metre is KalipaaInam - If the metre matches return
	 * the exact type, else return NULL
	 *
	 * @return Ambigous <string, NULL>
	 */
	public function CheckKaliInam() {
		$TaazhisaiCheck = TRUE;
		$KattalaiCheck = FALSE;
		$TuraiCheck = $this->CheckLineWordCount ( 4, 5 );
		$ViruttamCheck = $this->CheckLineWordCount ( 4, 4 );
		
		/* Check for Kattalai Kaliththurai */
		
		if ($TuraiCheck) 

		{
			
			/*
			 * Check for Letter count in Each line
			 */
			
			$Lines = explode ( PHP_EOL, trim ( $this->InputSourceText ) );
			$LinesMetre = array ();
			
			$root = $this->ParseTreeRoot;
			
			$rit = new RecursiveIteratorIterator ( new RecursiveArrayIterator ( $root ), RecursiveIteratorIterator::SELF_FIRST );
			
			$NewSentence = TRUE;
			
			foreach ( $rit as $key => $value ) {
				
				if ($rit->hasChildren () === FALSE) {
					
					if ($NewSentence)
						if ($key == "nE_r" || $key == "nirY") {
							
							$LinesMetre [] = $key;
							$NewSentence = FALSE;
						}
				} 

				else {
					if ($rit->getDepth () == 2)
						$NewSentence = TRUE;
				}
			}
			
			$WordCountCheck = TRUE;
			
			for($LineIndex = 0; $LineIndex < count ( $Lines ); $LineIndex ++) {
				
				$LetterCount = $this->GetLetterCount ( $Lines [$LineIndex] );
				$KattalaiCount = $LetterCount ['Vowel'] + $LetterCount ['ConsonantVowel'];
				
				// echo $KattalaiCount;
				
				if ($LinesMetre [$LineIndex] == "nE_r" && $KattalaiCount != 16)
					$WordCountCheck = FALSE;
				if ($LinesMetre [$LineIndex] == "nirY" && $KattalaiCount != 17)
					$WordCountCheck = FALSE;
			}
			
			/*
			 * Check for Vendalai in each line.. but not inbetween lines
			 */
			
			$WordBondClassCheck = TRUE;
			$WCount = 1;
			
			foreach ( $this->WordBond as $Bond ) {
				$BondType = $Bond ['bond'];
				
				if ($WCount % 5 != 0)
					if (substr ( $BondType, strlen ( $BondType ) - 21 ) != "வெண்டளை")
						$WordBondClassCheck = FALSE;
				
				$WCount ++;
			}
			
			/*
			 * Check if LastSyllableEnds with E
			 */
			
			$LastSyllableCheck = TRUE;
			$LastSyllable = substr ( $this->InputSourceText, - 1 );
			
			if ($LastSyllable != "E")
				$LastSyllableCheck = FALSE;
			
			if ($WordBondClassCheck && $WordCountCheck && $LastSyllableCheck)
				$KattalaiCheck = TRUE;
		}
		
		/*
		 * Check for Kalittaazhisai
		 */
		
		if ($this->TotalLines < 2)
			$TaazhisaiCheck = FALSE;
		
		$LineTypeReverse = array_flip ( $this->LineType );
		$ProsodyLineTypes = $this->LineClass;
		
		$LineWordCount = array ();
		
		foreach ( $ProsodyLineTypes as $key => $value ) {
			if (($key + 1) != $this->TotalLines)
				$LineWordCount [] = ($LineTypeReverse [$value]);
			else
				$FinalLineCount = ($LineTypeReverse [$value]);
		}
		
		if (count ( $LineWordCount ) > 0)
			if (max ( $LineWordCount ) >= $FinalLineCount)
				$TaazhisaiCheck = FALSE;
		
		if ($TaazhisaiCheck)
			$MetreType = "kali_ttAZicY";
		else if ($KattalaiCheck)
			$MetreType = "ka_TTaLY kali_ttuRY";
		else if ($TuraiCheck)
			$MetreType = "kali_ttuRY";
		else if ($ViruttamCheck)
			$MetreType = "kali viru_tta_m";
		else
			$MetreType = NULL;
		
		return $MetreType;
	}
	
	/**
	 * Check if the Prosody Metre is VanjippaaInam - If the metre matches return
	 * the exact type, else return NULL
	 *
	 * @return Ambigous <string, NULL>
	 */
	public function CheckVanjiInam() {
		$TaazhisaiCheck = $this->CheckLineWordCount ( 12, 2 );
		$TuraiCheck = $this->CheckLineWordCount ( 4, 2 );
		$ViruttamCheck = $this->CheckLineWordCount ( 4, 3 );
		
		if ($TaazhisaiCheck)
			$MetreType = "va_Jci_ttAZicY";
		else if ($TuraiCheck)
			$MetreType = "va_Jci_ttuRY";
		else if ($ViruttamCheck)
			$MetreType = "va_Jci viru_tta_m";
		else
			$MetreType = NULL;
		
		return $MetreType;
	}
	
	/**
	 * Parses the Text and constructs the Parse Tree with the Information on
	 * Sentence, WordClass, Syllable Class
	 *
	 * @param String $ProsodyText        	
	 * @return AssociativeArray ParseTree
	 */
	public function GetTextSyllablePattern($ProsodyText) 

	{
		$ProsodyText = preg_replace ( "/\(.{1,2}\)/", "", $ProsodyText ); // remov
		                                                                  // paranthesized
		                                                                  // words
		
		$ProsodyText = RemovePunctuation ( $ProsodyText ); // Removing Punctuation
		                                                   // and
		                                                   // reformatting the
		                                                   // text.
		
		$Lines = explode ( PHP_EOL, trim ( $ProsodyText ) ); // Seperating the
		                                                     // lines of the
		                                                     // text.
		
		$Lines = preg_replace ( "/\s$/", "", $Lines ); // remove unnecessary
		                                               // spaces
		
		$LineList = array ();
		$LineCount = 1;
		
		foreach ( $Lines as $Line ) {
			$Words = explode ( " ", trim ( $Line ) );
			
			$WordList = array ();
			$WordCount = 1;
			
			foreach ( $Words as $Word ) {
				$WordSyllable = array ();
				
				$Word = str_replace ( array (
						"W",
						"Y" 
				), array (
						"B",
						"Q" 
				), $Word ); // B-aukarakurukkam
				            // Q-Aikaarakurukkam
				
				$Word = preg_replace ( "/(\b.)B/", "$1W", $Word );
				
				$Word = preg_replace ( "/(\b.)Q/", "$1Y", $Word );
				
				/* Get Nirai Words */
				
				preg_match_all ( '/([kGcJTNtnpmyrlvZLRVjSsh]?_?[aiueoBQ])([kGcJTNtnpmyrlvZLRVjSsh][aAiIuUeEoOYWBQ])(_[KkGcJTNtnpmyrlvZLRVjSsh])*/', $Word, $WordClassNirai, PREG_OFFSET_CAPTURE );
				
				foreach ( $WordClassNirai [0] as $Nirai ) {
					$WordSyllable [$Nirai [1]] = array (
							'nirY' => $Nirai [0] 
					);
					
					$chr = "";
					
					for($i = 0; $i < strlen ( $Nirai [0] ); $i ++)
						$chr = $chr . "^";
						
						// $Word=str_replace($Nirai,$chr,$Word);
					$Word = preg_replace ( "/" . $Nirai [0] . "/", $chr, $Word, 1 );
				}
				
				/* Get Ner Words */
				
				preg_match_all ( '/[kGcJTNtnpmyrlvZLRVjSsh]?_?[aAiIuUeEoOQYBW](_[KkGcJTNtnpmyrlvZLRVjSsh])*/', $Word, $WordClassNer, PREG_OFFSET_CAPTURE );
				// preg_match_all('/[kGcJTNtnpmyrlvZLRVjSsh]?[aAiIuUeEoOYWBQ](_[KkGcJTNtnpmyrlvZLRVjSsh])*/',$wrd,$ner,PREG_OFFSET_CAPTURE);
				
				if (! empty ( $WordClassNer ))
					foreach ( $WordClassNer [0] as $Ner ) {
						$WordSyllable [$Ner [1]] = array (
								'nE_r' => $Ner [0] 
						);
					}
				
				ksort ( $WordSyllable );
				
				$Syllable = array ();
				$SyllableCount = 1;
				$WordPattern = "";
				
				foreach ( $WordSyllable as $key => $value ) {
					$Syllable ["acY-" . $SyllableCount ++] = $value;
					
					foreach ( $value as $Class => $ClassWord )
						$WordPattern = $WordPattern . $Class;
				}
				
				if (! empty ( $WordPattern ))
					$Syllable ["meta"] = $this->WordType [$WordPattern];
				else
					$WordCount --;
				
				$WordList ["cI_r-" . $WordCount ++] = $Syllable;
			}
			
			$WordList ["smeta"] = -- $WordCount;
			
			$LineList ["aTi-" . $LineCount ++] = $WordList;
		}
		
		$this->TotalLines = -- $LineCount;
		
		return array (
				"pA" => $LineList 
		);
	}
	
	/**
	 * Calculates the number of Vikalpa (Adi Etukai) in the Text
	 *
	 * @return number
	 */
	public function GetVikalpaCount() 

	{
		$ProsodyText = RemovePunctuation ( $this->InputSourceText ); // Removing
		                                                             // Punctuation
		                                                             // and
		                                                             // reformatting
		                                                             // the
		                                                             // text.
		$Lines = explode ( PHP_EOL, trim ( $ProsodyText ) );
		
		$FeetWords = array ();
		$VikalpaCount = 1;
		
		foreach ( $Lines as $Line ) {
			$Words = explode ( " ", $Line );
			$FeetWords [] = $Words [0];
		}
		
		for($WordIndex = 0; $WordIndex < count ( $FeetWords ) - 1; $WordIndex ++)
			if (! $this->CheckEtukai ( $FeetWords [$WordIndex], $FeetWords [$WordIndex + 1] ))
				$VikalpaCount ++;
		
		return $VikalpaCount;
	}
	
	/**
	 * Checks if the Taniccol is present in a give Line, and whether it should
	 * rhyme (etukai) with the line
	 *
	 * @param String $SourceText        	
	 * @param Number $LineIndex        	
	 * @param Boolean $RhymeCheck        	
	 * @return boolean
	 */
	public function CheckTaniccol($SourceText, $LineIndex, $RhymeCheck) 

	{
		$SourceText = str_replace ( "--", "-", $SourceText );
		$SourceText = str_replace ( "–", "-", $SourceText );
		
		$Lines = explode ( PHP_EOL, trim ( $SourceText ) );
		$Words = explode ( "-", $Lines [$LineIndex - 1] );
		
		$TaniccolExists = TRUE;
		$TaniccolVikalpaExists = TRUE;
		
		// echo $words[1];
		
		if (count ( $Words ) != 2)
			$TaniccolExists = FALSE;
		
		$LongVowels = array (
				"A",
				"I",
				"U",
				"E",
				"O",
				"W",
				"Y" 
		);
		$ShortVowels = array (
				"a",
				"i",
				"u",
				"e",
				"o" 
		);
		
		if (! $this->CheckEtukai ( trim ( $Words [0] ), trim ( $Words [1] ) ))
			$TaniccolVikalpaExists = FALSE;
		
		if (! $RhymeCheck)
			$TaniccolVikalpaExists = TRUE;
		
		if ($TaniccolExists && $TaniccolVikalpaExists)
			return TRUE;
		else
			return FALSE;
	}
	public function CheckLineWordCount($LineCount, $WordCount) {
		$ProsodyLineTypes = $this->LineClass;
		
		$LineClassCheck = TRUE;
		
		foreach ( $ProsodyLineTypes as $ProsodyLineClass )
			if ($ProsodyLineClass != $this->LineType [$WordCount])
				$LineClassCheck = FALSE;
		
		if ($this->TotalLines != $LineCount)
			$LineClassCheck = FALSE;
		
		return $LineClassCheck;
	}
	public function DisplayTodai($TodaiType) {
		$MonaiArray = $this->GetTodai ( $this->InputSourceText, $TodaiType );
		$ProsodyText = RemovePunctuation ( $this->InputSourceText ); // Removing
		                                                             // Punctuation
		                                                             // and
		                                                             // reformatting
		                                                             // the
		                                                             // text.
		$Lines = explode ( PHP_EOL, trim ( $ProsodyText ) );
		
		$MonaiExists = FALSE;
		
		$DivTag = <<<CWS

<div class="ui-state-highlight ui-corner-all"
	style="margin-top: 5px; padding: 0 .7em;">
<p><span class="ui-icon ui-icon-info"
	style="float: left; margin-right: .3em;"></span>

CWS;
		
		echo $DivTag;
		echo "<span class=\"uiTran\">" . lanconTrnL ( lat2tam ( "cI_r " . $TodaiType ), $this->Lang ) . "</span>";
		echo "</div><br/>";
		
		$Ornament [] = $this->DisplayTodaiElements ( $MonaiArray, $Lines, $TodaiType, "Line" );
		
		echo $DivTag;
		echo "<span class=\"uiTran\">" . lanconTrnL ( lat2tam ( "_aTi " . $TodaiType ), $this->Lang ) . "</span>";
		echo "</div><br/>";
		
		$FeetLine = "";
		
		foreach ( $Lines as $Line ) {
			$FeetWords = explode ( " ", $Line );
			
			$FeetLine .= $FeetWords [0] . " ";
		}
		
		$FeetTodai = $this->GetTodai ( $FeetLine, $TodaiType );
		
		$Ornament [] = $this->DisplayTodaiElements ( $FeetTodai, $Lines, $TodaiType, NULL );
		
		return $Ornament;
	}
	public function DisplayTodaiElements($TodaiArray, $Lines, $TodaiType, $TodaiClass) {
		$TodadiPatternName = array (
				"12" => "_iNY",
				"13" => "poZi_ppu",
				"14" => "_orU_u",
				"123" => "kUZY",
				"134" => "mE_RkatuvA_y",
				"124" => "kI_Z_kkatuvA_y",
				"1234" => "mu_RRu" 
		);
		
		$TodaiExists = FALSE;
		
		$Ornament = array ();
		
		for($LineIndex = 0; $LineIndex < count ( $TodaiArray ); $LineIndex ++) {
			
			if ($TodaiClass == "Line") {
				echo "<em><span class=\"uiTran\">" . lanconTrnL ( "அடி", $this->Lang ) . "</span> </em>" . ($LineIndex + 1) . " | ";
				echo "<span class=\"todailine uiTrant\">";
				echo lancon ( lat2tam ( $Lines [$LineIndex] ), $this->Lang );
				echo "</span>" . "<br/><br/>";
			}
			
			$TodaiLine = $TodaiArray [$LineIndex];
			
			$LineWordCount = count ( explode ( " ", trim ( $Lines [$LineIndex] ) ) );
			
			foreach ( $TodaiLine as $TodaiSeer ) {
				if (count ( $TodaiSeer ) > 1) {
					$TodaiExists = true;
					
					for($TodaiIndex = 0; $TodaiIndex < count ( $TodaiSeer ); $TodaiIndex ++) {
						foreach ( $TodaiSeer [$TodaiIndex] as $Index => $Word )
							;
						{
							
							echo "<span class=\"todaiindex\">";
							echo ($Index + 1) . " ";
							echo "</span>";
							
							$TodaiPattern = $TodaiPattern . ($Index + 1);
							
							if ($TodaiType == "mOVY") {
								$Ornament [$LineIndex] [0] [$Index] = lancon ( lat2tam ( $Word ), $this->Lang );
								
								echo "<span class=\"todaiword uiTrant\">";
								echo lancon ( lat2tam ( substr ( $Word, 0, 2 ) ), $this->Lang );
								echo "</span>";
								echo "<span class=\"uiTrant\">" . lancon ( lat2tam ( substr ( $Word, 2 ) ), $this->Lang ) . "</span>" . " ";
							}
							
							if ($TodaiType == "_etukY") {
								
								$Ornament [$LineIndex] [0] [$Index] = lancon ( lat2tam ( $Word ), $this->Lang );
								
								echo "<span class=\"uiTrant\">" . lancon ( lat2tam ( substr ( $Word, 0, 2 ) ), $this->Lang ) . "</span>";
								echo "<span class=\"todaiword uiTrant\">";
								echo lancon ( lat2tam ( substr ( $Word, 2, 2 ) ), $this->Lang );
								echo "</span>";
								echo "<span class=\"uiTrant\">" . lancon ( lat2tam ( substr ( $Word, 4 ) ), $this->Lang ) . "</span>" . " ";
							}
						}
					}
					
					echo "<span class=\"todaipattern uiTrant\">";
					
					if ($TodadiPatternName [$TodaiPattern] != "" && $TodaiClass == "Line" && $LineWordCount == 4) {
						echo " | " . lancon ( lat2tam ( $TodadiPatternName [$TodaiPattern] . " " . $TodaiType ), $this->Lang );
						
						$Ornament [$LineIndex] [1] = lancon ( lat2tam ( $TodadiPatternName [$TodaiPattern] . " " . $TodaiType ), $this->Lang );
					}
					
					echo "</span>";
					echo "<br/>";
					$TodaiPattern = "";
				}
			}
			if (! $TodaiExists) {
				echo "<span class=\"uiTran\">" . lanconTrnL ( lat2tam ( $TodaiType ), $this->Lang ) . "</span> " . "<span class=\"uiTran\">" . lanconTrnL ( "இல்லை", $this->Lang ) . "</span></br/>";
			}
			
			$TodaiExists = FALSE;
			echo "<br/>";
		}
		
		return $Ornament;
	}
	public function GetTodai($ProsodyText, $TodaiType) {
		$ProsodyText = RemovePunctuation ( $ProsodyText ); // Removing Punctuation
		                                                   // and
		                                                   // reformatting the
		                                                   // text.
		$Lines = explode ( PHP_EOL, trim ( $ProsodyText ) ); // Seperating the
		                                                     // lines of the
		                                                     // text.
		
		$TodaiLineIndex = array ();
		
		$TodaiList = array ();
		
		/*
		 * Compare each word in a line, with the rest of the words if words
		 * match, place them in an array iterate again with the next word skip
		 * already matched words
		 */
		
		foreach ( $Lines as $Line ) {
			$Words = explode ( " ", $Line );
			
			$TodaiWordIndex = array ();
			
			$TodaiIndex = array ();
			
			$TodaiIndex [] = array (
					0 => $Words [0] 
			);
			
			for($NewIndex = 1; $NewIndex < count ( $Words ); $NewIndex ++) {
				if ($TodaiType == "mOVY")
					$TodaiCheck = $this->CheckMonai ( $Words [0], $Words [$NewIndex] );
				if ($TodaiType == "_etukY")
					$TodaiCheck = $this->CheckEtukai ( $Words [0], $Words [$NewIndex] );
				
				if ($TodaiCheck) {
					$TodaiIndex [] = array (
							$NewIndex => $Words [$NewIndex] 
					);
					$TodaiList [] = $NewIndex;
				}
			}
			
			$TodaiWordIndex [] = $TodaiIndex;
			
			$TodaiLineIndex [] = $TodaiWordIndex;
			$TodaiList = array ();
		}
		
		return $TodaiLineIndex;
	}
	public function CheckMonai($FirstWord, $SecondWord) 

	{
		$MonaiAksharaVow = array ();
		
		// Monai Equivalents
		
		$MonaiAksharaVow [] = array (
				"a",
				"A",
				"Y",
				"W" 
		);
		$MonaiAksharaVow [] = array (
				"i",
				"I",
				"e",
				"E" 
		);
		$MonaiAksharaVow [] = array (
				"u",
				"U",
				"o",
				"O" 
		);
		
		$MonaiAksharaCons [] = array (
				"J",
				"n" 
		);
		$MonaiAksharaCons [] = array (
				"m",
				"v" 
		);
		$MonaiAksharaCons [] = array (
				"t",
				"c" 
		);
		
		$MonaiFirstLtr = FALSE;
		$MonaiSecondLtr = FALSE;
		
		// Compare First Letter
		
		if (substr ( $FirstWord, 0, 1 ) == substr ( $SecondWord, 0, 1 )) 

		{
			$MonaiFirstLtr = TRUE;
		} 

		else {
			foreach ( $MonaiAksharaCons as $Monai ) {
				if (in_array ( substr ( $FirstWord, 0, 1 ), $Monai ) && in_array ( substr ( $SecondWord, 0, 1 ), $Monai ))
					$MonaiFirstLtr = TRUE;
			}
		}
		
		// if first letter matches, then compare second letter
		
		if ($MonaiFirstLtr) {
			foreach ( $MonaiAksharaVow as $Monai ) {
				if (in_array ( substr ( $FirstWord, 1, 1 ), $Monai ) && in_array ( substr ( $SecondWord, 1, 1 ), $Monai )) {
					$MonaiSecondLtr = TRUE;
				}
			}
		}
		
		return $MonaiSecondLtr;
	}
	public function CheckEtukai($FirstWord, $SecondWord) 

	{
		$EtukaiLetterCheck = FALSE;
		
		$LongVowels = array (
				"A",
				"I",
				"U",
				"E",
				"O",
				"W",
				"Y" 
		);
		$ShortVowels = array (
				"a",
				"i",
				"u",
				"e",
				"o" 
		);
		
		$FirstWordInit = substr ( $FirstWord, 1, 1 );
		$SecondWordInit = substr ( $SecondWord, 1, 1 );
		
		$FirstWordSuff = substr ( $FirstWord, 2, 2 );
		$SecondWordSuff = substr ( $SecondWord, 2, 2 );
		
		$InLongVowels = (in_array ( $FirstWordInit, $LongVowels ) && in_array ( $SecondWordInit, $LongVowels ));
		$InShortVowels = (in_array ( $FirstWordInit, $ShortVowels ) && in_array ( $SecondWordInit, $ShortVowels ));
		
		$VowelLengthCheck = $InLongVowels || $InShortVowels;
		
		if (substr ( $FirstWordSuff, 0, 1 ) == "_" || substr ( $SecondWordSuff, 0, 1 ) == "_") {
			
			if ($FirstWordSuff == $SecondWordSuff) {
				$EtukaiLetterCheck = TRUE;
			}
		} 

		else 

		{
			if (substr ( $FirstWordSuff, 0, 1 ) == substr ( $SecondWordSuff, 0, 1 ))
				$EtukaiLetterCheck = TRUE;
		}
		
		$EtukaiCheck = $VowelLengthCheck && $EtukaiLetterCheck;
		
		return $EtukaiCheck;
	}
}

// Class declaration over

?>