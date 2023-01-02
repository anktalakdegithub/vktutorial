<?php
class Spaces_Model extends CI_Model 
{
	public function connect_spaces(){
		$client = new Aws\S3\S3Client([
	        'version' => 'latest',
	        'region'  => 'SGP1',
	        'endpoint' => 'https://SGP1.digitaloceanspaces.com',
	        'credentials' => [
	            'key'    => 'PK2EE3QRHH22OE2F23ST',
	            'secret' => 'kEWGSra9qE53kjDaOHW1emqoFVk1QuEtJTOX/jwhZag',
	        ],
		]);
		return $client;
	}
	public function upload_file($key,$source){
		$client=$this->connect_spaces();
		$insert = $client->putObject([
		    'Bucket' => 'arkdes',
		    'Key'    => $key,
		    'SourceFile'   => $source,
		    'ACL' => 'public-read'
		]);
	}
	public function delete_file($key){
		$client=$this->connect_spaces();
		$client->deleteObject([
		    'Bucket' => 'arkdes',
		    'Key'    => $key
		]);
	}
}
?>