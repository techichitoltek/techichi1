<?php
class ParseFile extends App_Model_Std {

	public function _parseRoutes() {
		$dom = new DomDocument ();
		$dom->recover = True;
		$dom->strictErrorChecking = False;
		$dom->validateOnParse = False;

		try {
			$dom->load (APPLICATION_PATH . '/configs/frontend_routes.xml');
			$routeArray = array();
			foreach ($dom->getElementsByTagName('route') as $route)
			{
				array_push($routeArray, $route->nodeValue);
			}
			return $routeArray;

		} catch ( Exception $e ) {
			debug($e->getMessage());
		}
	}

	public function _parseMemoFile($memo_file_url) {

		$dom = new DomDocument();
		$dom->load(APPLICATION_PATH . '/modules/frontend/views/scripts/memo/zendcommon.phtml');



		$xpath = new DOMXPath($dom);

		$pdvs = $xpath->evaluate("//h2");


		$arrayPDV = array();

		for ($i = 0; $i < $pdvs->length; $i++) {
			debug('pouet');
			/*$pdv = $pdvs->item($i);

			$pdv1 = $dom->getElementsByTagName('pdv')->item($i);
			$listeVille = $pdv1->getElementsByTagName('ville');
			foreach($listeVille as $ville)
				$commune =  $ville->firstChild->nodeValue;


			$array = array(
					"id" => $pdv->getAttribute('id'),
					"cp" => $pdv->getAttribute('cp'),
					"latitude" => $pdv->getAttribute('latitude'),
					"longitude" => $pdv->getAttribute('longitude'),
					"typeroute" => $pdv->getAttribute('pop'),
					"ville" =>  mb_convert_encoding(trim($commune), 'HTML-ENTITIES', 'UTF-8')
			);


			array_push($arrayPDV, $array);*/
		}



		/*$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, APPLICATION_PATH . '/modules/frontend/views/scripts/memo/zendcommon.phtml');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$return = curl_exec($curl);
		curl_close($curl);

		$dom = new DOMDocument();

		try {
			@$dom->loadHTML($return);

			// get PAGINATION
			$finder = new DomXPath($dom);
			$nodesTable = $finder->query("h2");
			debug($nodesTable);


			foreach ($nodesTable as $node)
			{
				debug('node');
			}
		} catch (Exception $e){
			debug($e->getMessage());
		}*/








		/*$dom = new DomDocument ();
		$dom->recover = True;
		$dom->strictErrorChecking = False;
		$dom->validateOnParse = False;

		$memo_file_url = '/modules/frontend/views/scripts/memo/zendcommon.phtml';
		try {
			$dom->load (APPLICATION_PATH . '/modules/frontend/views/scripts/memo/zendcommon.phtml');
			$memo_map = array();
			foreach ($dom->getElementsByTagName('h2') as $category)
			{
				array_push($memo_map, array(true,$category->nodeValue));


			}
			return $memo_map;

		} catch ( Exception $e ) {
			debug($e->getMessage());
		}*/
	}


}