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

require_once 'google-api-php-client/src/Google/autoload.php';
require_once 'google-api-php-client/src/Google/Client.php';
require_once 'google-api-php-client/src/Google/Client.php';
require_once 'google-api-php-client/src/Google/Auth/AssertionCredentials.php';
require_once 'google-api-php-client/src/Google/Service/Datastore.php';

function createKeyForTestItem() {
  $path = new Google_Service_Datastore_KeyPathElement();
  $path->setKind("URLLinks");
  $key = new Google_Service_Datastore_Key();
  $key->setPath([$path]);
  return $key;
}
  
function create_entity($hashkey,$text) {
  $entity = new Google_Service_Datastore_Entity();
  $entity->setKey(createKeyForTestItem());
    
  $string_prop_hash = new Google_Service_Datastore_Property();
  $string_prop_hash->setStringValue($hashkey);
  
  $string_prop_text = new Google_Service_Datastore_Property();
  $string_prop_text->setStringValue($text);
  
  $property_map = [];
  
  $property_map["hash"] = $string_prop_hash;
  $property_map["text"] = $string_prop_text;
  
  $entity->setProperties($property_map);
  return $entity;
}  
  
function create_request($hashkey,$text) {
  $entity = create_entity($hashkey,$text);
  $mutation = new Google_Service_Datastore_Mutation();
  $mutation->setInsertAutoId([$entity]);  // Causes ID to be allocated.
#  $mutation->setUpsert([$entity]);
  $req = new Google_Service_Datastore_CommitRequest();
  $req->setMode('NON_TRANSACTIONAL');
  $req->setMutation($mutation);
  return $req;
}

function insert_datastore($text)
{
	include_once "config.php";
	
	$scopes = [
    	"https://www.googleapis.com/auth/datastore",
	    "https://www.googleapis.com/auth/userinfo.email",
	  ];

	$client = new Google_Client();
	$client->setApplicationName($google_api_config['application-id']);
	$client->setAssertionCredentials(new Google_Auth_AssertionCredentials(
  						$google_api_config['service-account-name'],
					    $scopes, $google_api_config['private-key']));
  
	$service = new Google_Service_Datastore($client);
	$service_dataset = $service->datasets;

	$dataset_id = $google_api_config['dataset-id'];
	
	$hashtext = $text.date("Y-m-d H:i:s");    
	$hashkey = hash('adler32',$hashtext,false).hash('crc32',$hashtext,false);


	try {
		$req = create_request($hashkey,$text);
		$service_dataset->commit($dataset_id, $req, []);
	}

	catch (Google_Exception $ex) {
		 syslog(LOG_WARNING, 'Commit to Cloud Datastore exception: ' . $ex->getMessage());
	}
}	

?>