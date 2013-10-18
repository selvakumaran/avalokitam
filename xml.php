<?php

/*

	Copyright (C) 2013 Vinodh Rajan vinodh@virtualvinodh.com 
	
	This file is part of Avalokitam.

    Avalokitam is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Avalokitam is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
      
*/

session_start ();
Header ( 'Content-type: text/xml' );
echo $_SESSION ['xml'];

?>