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
Header ( 'Content-type: text/xml' );

ob_start ();
require_once "parsetreeclass.php";
ob_end_clean ();

// API for Avalokitam
// Returns an XML for a post request with the following parameters
// Verse - Verse in Tamil Unicode
// Langa - en or ta ; Default ta
// Kurilu - 0 or 1 ; Default 0

if (isset ( $_REQUEST ['verse'] )) {
	if (isset ( $_REQUEST ['lang'] ))
		$lang = $_REQUEST ['lang'];
	else
		$lang = 'ta';
	
	if ($_REQUEST ['lang'] == 1)
		$kurilu = True;
	if ($_REQUEST ['lang'] == 0)
		$kurilu = False;
	
	$ptree = new ProsodyParseTree ( $_REQUEST ['verse'], $lang, $kurilu );
	
	echo $ptree->DisplayXML ();
}

?>
