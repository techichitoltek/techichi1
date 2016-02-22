<?php
// TDTODO : A nettoyer et mettre au bon endroit
class myUtils{

    /**
     * Truncate label and add "..." if too long
     */
    static function truncate($str, $max, $append='...')
    {
        $len = mb_strlen($str);

        if( $len > $max )
        {
            return mb_substr($str, 0, $max) . ' ' . $append;
        }

        return $str;
    }

    static function listeMois(){
        $return[1] = "Janvier";
        $return[2] = "Février";
        $return[3] = "Mars";
        $return[4] = "Avril";
        $return[5] = "Mai";
        $return[6] = "Juin";
        $return[7] = "Juillet";
        $return[8] = "Août";
        $return[9] = "Septembre";
        $return[10] = "Octobre";
        $return[11] = "Novembre";
        $return[12] = "Décembre";
        return $return;
    }


    /**
     * Password generator
     */
    static function generatePassword($len=8)
    {
        // Create dictionnary
        $letters     = '1234567890abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $letters_len = strlen($letters);

        // Concatenate "$len" random letter from dictonary
        $result = '';
        for($i=0; $i < $len; $i++)
        {
            $result .= $letters[mt_rand(0,$letters_len)];
        }

        return $result;
    }



    static function affichePrix($prix){
        //printf ("%6.2f",3.39532);
        return str_replace(".",",",number_format(round($prix,2),2));
        //setlocale(LC_MONETARY, 'fr_FR');
        //return money_format('%!n &euro;', $prix);

        $currency = new Zend_Currency(
                array(
                        'value'    => $prix,
                        'precision' => 2,
                        'display' => Zend_Currency::NO_SYMBOL,
                        //'currency' => 'USD'
                        //'format'   => '#0',
                    )
                );
        return $currency;
    }



    // ****************************************************************
    // RÉSUMÉ d'un texte html + réparation des balises html
    // ****************************************************************
    // Création : juin 2009 en collectif : Xunil, jreaux62, s.n.a.f.u., FoxLeRenard, Doksuri, Patouche
    // http://www.developpez.net/forums/d757484-8/php/langage/contribuez/discussion-reparer-code-html/

    // $texte : le texte formaté (avec des balises html)
    // $nbreCar : le nombre de caractères texte à afficher (sans compter les balises html)
    // $min (minimum) : pour ne pas couper un mot, si true le compte s'arrêtera a l espace suivant, sinon à l'espace précédent
    // $brut : si true RÉSUMÉ BRUT d'un texte htmlHTML : SUPPRESSION des balises html
    // --------------------------------
    static function texte_truncate($texte, $nbreCar, $motifSuite = ' [......]', $min=false, $brut=false)
    {
        if($min){
               $ajustement = 0;
           }else{
               $ajustement = -1;
           }

        if($brut){
           // **********************************
           // SUPPRESSION des balises html
           // **********************************
           $texte = strip_tags($texte);
           // Explication strip_tags : voir http://fr.php.net/manual/fr/function.strip-tags.php

           // **********************************
           // COUPE DU TEXTE pour le RÉSUMÉ
           // **********************************
           // ajout d'un espace de fin au cas ou le texte n'en contiendrait pas...
           $texte .= ' ';
           // ----------------------------------
           $longueur = mb_strlen($texte);
           if($longueur > $nbreCar){
               // pour ne pas couper un mot, on va a l espace suivant
               $texte = mb_substr($texte, 0, mb_strpos($texte, ' ', $longueur > $nbreCar ? $nbreCar : $longueur));

               if(!$min){
                   $texte = mb_substr($texte, 0, mb_strrpos($texte, ' '));
               }

               $texte .= $motifSuite;
           }
           // ----------------------------------
           // On renvoie le résumé du texte correctement formaté.
           return $texte;
        }else{

           // longueur du texte brut sans html
           $LongueurTexteBrutSansHtml = mb_strlen(strip_tags($texte));

           if($LongueurTexteBrutSansHtml > $nbreCar){
               // **********************************
               // MASQUE de l'expression régulière
               // **********************************
               $MasqueHtmlSplit = '#</?([a-zA-Z1-6]+)(?: +[a-zA-Z]+="[^"]*")*( ?/)?>#';
               $MasqueHtmlMatch = '#<(?:/([a-zA-Z1-6]+)|([a-zA-Z1-6]+)(?: +[a-zA-Z]+="[^"]*")*( ?/)?)>#';
               // ----------------------------------
               // Explication du masque : recherche de TOUTES les balises html
               // ---------------
               // détail : </?([a-zA-Z1-6]+)
               // recherche de chaines commençant par un <
               // suivi optionnellement d'un / (==> balises "fermantes")
               // suivi de (caractères alphabétiques (insensible à la casse) ou numériques (1 à 6)) au moins une fois
               // Suivi optionnellement (0, 1fois ou plus) par un ou plusieurs attributs et leur valeur :
               // ---------------
               // détail : (?: +[a-zA-Z]+="[^"]*")*
               // caractère espace une fois ou plus [space]+
               // suivi d'au moins un caractère alphabétique [a-zA-Z]+
               // suivi d'un =
               // suivi d'une paire de guillemets contenant optionnellement (0, 1fois ou plus) tout caractère autre que guillemet "[^"]*"
               // ---------------
               // détail : ( ?/)?
               // caractère espace optionnel [space]?
               // suivi optionnellement d'un slash / (==> balises "orphelines")
               // NB : un :? suivant une parenthèse ouvrante signifie que l'on ne capture pas la parenthèse

               // **********************************
               // RECHERCHE DU TEXTE DU RÉSUMÉ
               // **********************************
               // ajout d'un espace de fin au cas ou le texte n'en contiendrait pas...
               $texte .= ' ';
               // ----------------------------------
               // Capture de tous les bouts de texte (en dehors des balises html)
               $BoutsTexte = preg_split($MasqueHtmlSplit, $texte, -1,  PREG_SPLIT_OFFSET_CAPTURE | PREG_SPLIT_NO_EMPTY);
               // ----------------------------------
               // Explication preg_split : voir http://fr.php.net/manual/fr/function.preg-split.php
               // => on obtient un tableau (array) :
               // $BoutsTexte[xx][0] : le bout de texte
               // $BoutsTexte[xx][1] : sa position (dans la chaine)
               // ----------------------------------
               // Nombre d'éléments du tableau
               $NombreBouts = count($BoutsTexte);

               // **********************************
               // CALCUL de la POSITION de la coupe
               // **********************************
               // Si seulement un seul élément dans l'array, c'est que le texte ne contient pas de balises :
               // on renvoie directement le texte tronqué

               if( $NombreBouts == 1 )
               {
                   $longueur = mb_strlen($texte);
                   // pour ne pas couper un mot, on va à l espace suivant
                   return self::texte_truncate($texte, $nbreCar, $motifSuite, $min, true);
                   //return mb_substr($texte, 0, mb_strpos($texte, ' ', $longueur > $nbreCar ? $nbreCar : $longueur));
               }
               // ----------------------------------
               // Variable contenant la longueur des bouts de texte
               $longueur = 0;
               // ----------------------------------
               // (position du dernier élément du tableau $chaines)
               $indexDernierBout = $NombreBouts - 1;
               // ----------------------------------
               // Position par défaut de la césure au cas où la longueur du texte serait inférieure au nombre de caractères à sélectionner
               // La position de la césure est égale à sa position [1] + la longueur du bout de texte [0] - 1 (dernier caractère)
               $position = $BoutsTexte[$indexDernierBout][1] + mb_strlen($BoutsTexte[$indexDernierBout][0]) - 1;
               // ----------------------------------
               $indexBout = $indexDernierBout;
               $rechercheEspace = true;
               // ----------------------------------
               // Boucle parcourant l'array et ayant pour fonction d'incrémenter au fur et à mesure la longueur des morceaux de texte,
               // et de calculer la position de césure de l'extrait dans le texte
               foreach( $BoutsTexte as $index => $bout )
               {
                   $longueur += mb_strlen($bout[0]);
                   // Si la longueur désirée de l'extrait à obtenir est atteinte
                   if( $longueur >= $nbreCar )
                   {
                       // On calcule la position de césure du texte (position de chaîne + sa longueur -1 )
                       $position_fin_bout = $bout[1] + mb_strlen($bout[0]) - 1;
                       // calcul de la position de césure
                       $position = $position_fin_bout - ($longueur - $nbreCar);
                       // On regarde si un espace est présent après la position dans le bout de texte
                       if( ($positionEspace = mb_strpos($bout[0], ' ', $position - $bout[1])) !== false  )
                       {
                           // Un espace est détecté dans le bout de texte APRÈS la position
                           $position = $bout[1] + $positionEspace;
                           $rechercheEspace = false;
                       }
                       // Si on ne se trouve pas sur le dernier élément
                       if( $index != $indexDernierBout )
                           $indexBout = $index + 1;
                       break;
                   }
               }
               // ----------------------------------
               // Donc il n'y avait pas d'espace dans le bout de texte où la position de césure sert de référence
               if( $rechercheEspace === true )
               {
                   // Recherche d'un espace dans les bouts de texte suivants
                   for( $i=$indexBout; $i<=$indexDernierBout; $i++ )
                   {
                       $position = $BoutsTexte[$i][1];
                       if( ($positionEspace = mb_strpos($BoutsTexte[$i][0], ' ')) !== false )
                       {
                           $position += $positionEspace;
                           break;
                       }
                   }
               }
               // **********************************
               // COUPE DU TEXTE pour le RÉSUMÉ
               // **********************************
               // On effectue la césure sur le texte suivant la position calculée
               $texte = mb_substr($texte, 0, $position);

               if(!$min){
                   $texte = mb_substr($texte, 0, mb_strrpos($texte, ' '));
               }

               // **********************************
               // RECHERCHE DES BALISES HTML
               // **********************************
               // Récupération de toutes les balises du texte et de leur position (PREG_OFFSET_CAPTURE)
               preg_match_all($MasqueHtmlMatch, $texte, $retour, PREG_OFFSET_CAPTURE);
               // ----------------------------------
               // Explication preg_match_all : voir http://fr.php.net/manual/fr/function.preg-match-all.php
               // $retour[0][xx][0] contient la balise html entière
               // $retour[0][xx][1] contient la position de la balise html entière
               // $retour[1][xx][0] contient le nom de la balise html fermante$rechercheEspace
               // $retour[2][xx][0] contient le nom de la balise html ouvrante
               // $retour[3][xx][0] contient le slash de fermeture de balise unique (cette variable n'existe pas si la balise n'est pas unique)
               // ----------------------------------
               // Array destiné à enregistrer les noms de balises ouvrantes
               $BoutsTag = array();
               // ----------------------------------
               foreach( $retour[0] as $index => $tag )
               {
                   // Si on se trouve sur une balise unique, on passe au tour suivant
                   if( isset($retour[3][$index][0]) )
                   {
                       continue;
                   }
                   // Si le caractère slash n'est pas détecté en seconde position dans la balise entière, on est sur une balise ouvrante
                   if( $retour[0][$index][0][1] != '/' )
                   {
                       // On empile l'élément en début de l'array
                       array_unshift($BoutsTag, $retour[2][$index][0]);
                   }
                   // Donc balise fermante
                   else
                   {
                       // suppression du premier élément de l'array
                       array_shift($BoutsTag);
                   }
               }
               // **********************************
               // RÉPARATION des balises html
               // **********************************
               // Il reste des tags à fermer ?
               // balises ouvertes, mais non fermées : on ajoute les balises fermantes a la fin du texte
               if( !empty($BoutsTag) )
               {
                   foreach( $BoutsTag as $tag )
                   {
                       $texte .= '</' . $tag . '>';
                   }
               }
               // ----------------------------------
               // si le texte brut est plus long que $nbreCar : on ajoute [...] a la fin
               if ($LongueurTexteBrutSansHtml > $nbreCar) {
                   $texte .= $motifSuite;
                   // si on a une balise fermante (/p ou /ul ou /div) a la fin :
                   $texte =  str_replace('</p>'.$motifSuite, $motifSuite.'</p>', $texte);
                   $texte =  str_replace('</ul>'.$motifSuite, $motifSuite.'</ul>', $texte);
                   $texte =  str_replace('</div>'.$motifSuite, $motifSuite.'</div>', $texte);
               }
           }
           // ----------------------------------
           // On renvoie le résumé du texte correctement formaté.
           return $texte;
        }
        return "";
    }

}


function errorToExceptionHandler($errNo, $errStr, $errFile, $errLine, $errContext)
{
    if (! ($errNo & error_reporting())) return false;

    switch ($errNo) {
            case E_NOTICE:
                $type = 'Notice';
                break;
            case E_USER_ERROR:
                $type = 'User Error';
                break;
            case E_USER_WARNING:
                $type = 'User Warning';
                break;
            case E_USER_NOTICE:
                $type = 'User Notice';
                break;
            case E_STRICT:
                $type = 'Strict';
                break;
            case E_WARNING:
                $type = 'Warning';
                break;
               case E_ERROR:
                $type = 'Fatal Error';
                    //throw new ErrorException($errStr, 0, $errNo, $errFile, $errLine);
            default:
                $type = 'Unknown ['.$errNo.']';
                break;
    }
    //self::$errors[] = array('type' => $type , 'message' => $errStr , 'file' => $errFile , 'line' => $errLine);
    if (ini_get('log_errors'))
        error_log(sprintf("%s: %s in %s on line %d", $type, $errStr, $errFile, $errLine));
    throw new ErrorException($errStr, 0, $errNo, $errFile, $errLine);
    return true;
}


function debug ($object, $label = '', $color="green", $die=false)
{
    App_Debug_Debug::debug($object, $label, $die, $color);
}

function logger($message, $type = Zend_Log::INFO)
{
    App_Debug_Debug::logger($message, $type);
}

function parcourirArbo($path){
	$arbo = array();
	$dir_iterator = new RecursiveDirectoryIterator($path);
	$iterator = new RecursiveIteratorIterator($dir_iterator);
	foreach ($iterator as $file) {
		echo $file."\n";
		$arbo[] = $file;
	}
}

function listControllers($repertoire,$racine=null,$files = array())
{
	if($racine === null){
		$racine = $repertoire;
	}
	$le_repertoire = opendir($repertoire) or die("Erreur le repertoire $repertoire existe pas");
	while($fichier = @readdir($le_repertoire))
	{
		// enlever les traitements inutile
		if ($fichier == "." || $fichier == "..") continue;
		if(is_dir($repertoire.'/'.$fichier))
		{
			$files = listControllers($repertoire.'/'.$fichier,$racine,$files);
		}
		else
		{
			if($racine == $repertoire){
				if (fnmatch('*.php', $fichier) && $fichier !== 'ErrorController.php') {
					$files[] = str_replace($racine,'',$repertoire). $fichier;
				}
			}else{
				$files[] = str_replace($racine.'/','',$repertoire). "/" . $fichier;
			}
		}
	}
	closedir($le_repertoire);
	return $files;
}

function array_key_exists_recursive($needle,$haystack)
{
    foreach($haystack as $key=>$val)
    {
        if(is_array($val))
        {
            if ( array_key_exists_recursive($needle,$val))
            {
                return TRUE;
            }
        }
           elseif ($val == $needle)
           {
               return TRUE;
           }
    }
    return FALSE;
}

function is_multidimensional_array($a)
{
    $rv = array_filter($a,'is_array');
    if (count($rv)>0)
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}

function array_equal($a, $b)
{
    return (is_array($a) && is_array($b) && array_diff($a, $b) === array_diff($b, $a));
}

function array_identical($a, $b)
{
    return (is_array($a) && is_array($b) && array_diff_assoc($a, $b) === array_diff_assoc($b, $a));
}

function pr($val)
{
    $debug_backtrace = debug_backtrace();

    echo 'Print called from ' . $debug_backtrace[0]['file'] . ' (line ' . $debug_backtrace[0]['line'] . ')';
    echo "<pre>";
    print_r($val);
    echo "</pre>";
}

function debug_redirect($url)
{
    $debug_backtrace = debug_backtrace();
    $file = '<strong> ' . $debug_backtrace[0]['file'] . '</strong>';
    $line = '<strong>' . $debug_backtrace[0]['line'] . '</strong>';

    echo '<div style="padding:15px 30px; margin:0px; text-align:center; font-size:16px; background-color:#ccc; ">Should redirect to: <a href="'. $url . '">' . $url . '</a></div>';
    echo '<div style="padding:15px 30px; margin:0px; text-align:center; font-size:16px; background-color:#ccc; ">Called from ' . $file . ', line ' . $line . '</div>';

    echo '<div style="background-color:yellow; border:1px solid red; padding:5px 10px; margin:20px 0px">';
    echo '<pre>COOKIES:';
    print_r($_COOKIES);
    echo '</pre>';

    echo '<pre>SESSION:';
    print_r($_SESSION);
    echo '</pre>';

    echo '<pre>SERVER:';
    print_r($_SERVER);
    echo '</pre>';

    echo '</div>';
    exit();
}



if(!function_exists('get_called_class')) {
    function get_called_class($bt = false,$l = 1) {
        if (!$bt) $bt = debug_backtrace();
        if (!isset($bt[$l])) throw new Exception("Cannot find called class -> stack level too deep.");
        if (!isset($bt[$l]['type'])) {
            throw new Exception ('type not set');
        }
        else switch ($bt[$l]['type']) {
            case '::':
                $lines = file($bt[$l]['file']);
                $i = 0;
                $callerLine = '';
                do {
                    $i++;
                    $callerLine = $lines[$bt[$l]['line']-$i] . $callerLine;
                } while (stripos($callerLine,$bt[$l]['function']) === false);
                preg_match('/([a-zA-Z0-9\_]+)::'.$bt[$l]['function'].'/',
                            $callerLine,
                            $matches);
                if (!isset($matches[1])) {
                    // must be an edge case.
                    throw new Exception ("Could not find caller class: originating method call is obscured.");
                }
                switch ($matches[1]) {
                    case 'self':
                    case 'parent':
                        return get_called_class($bt,$l+1);
                    default:
                        return $matches[1];
                }
                // won't get here.
            case '->': switch ($bt[$l]['function']) {
                    case '__get':
                        // edge case -> get class of calling object
                        if (!is_object($bt[$l]['object'])) throw new Exception ("Edge case fail. __get called on non object.");
                        return get_class($bt[$l]['object']);
                    default: return $bt[$l]['class'];
                }

            default: throw new Exception ("Unknown backtrace method type");
        }
    }
}


/*
 * Function to Convert stdClass Objects to Multidimensional Arrays
*/
function objectToArray($d) {
    if (is_object($d)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $d = get_object_vars($d);
    }

    if (is_array($d)) {
        /*
         * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return array_map(__FUNCTION__, $d);
    }
    else {
        // Return array
        return $d;
    }
}

/*
 * Function to Convert Multidimensional Arrays to stdClass Objects
*/
function arrayToObject($d) {
    if (is_array($d)) {
        /*
         * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return (object) array_map(__FUNCTION__, $d);
    }
    else {
        // Return object
        return $d;
    }
}

/**
 * Extrait les adresses e-mails présentes dans une chaine.
 * La fonction retourne un tableau des adresses e-mails.
 * Si des adresses e-mails se trouvent en doublon dans la chaine,
 * alors la fonction ne gardera dans le tableau qu'un seul exemplaire
 * des adresses e-mails.
 *
 * @param string $chaine la chaine contenant les e-mails
 * @return array $arrayEmails Tableau dédoublonné des e-mails
 */
function extractEmailsFromString($chaine) {
    $return = null;
    if(false !== preg_match_all('`\w(?:[-_.]?\w)*@\w(?:[-_.]?\w)*\.(?:[a-z]{2,4})`', $chaine, $arrayEmails)) {
        if(is_array($arrayEmails[0]) && count($arrayEmails[0])) {
            $tab = $arrayEmails[0];
            $return = array_unique($tab);
        }
    }
    return $return;
}


function flush_buffers(){
    /*ob_end_flush();
    ob_flush();
    flush();
    ob_start();*/
    //echo ini_get('max_execution_time');
    ob_flush();
    flush();
    }

    /**
     *
     * @param string $message
     * @param string $dest
     * @param array $environment si défini, envoi le message seulement dans ces environnements
     */
    function quickMailNotification($message,$dest=null,$environment=null){
    	$mailer = new App_Mail("FRAMEWORK.QUICK_NOTIFICATION");
    	$mailer->fullErrorMessage = $message;
    	$mailer->environment = Zend_Registry::get('Environment');
    	if($dest){
    		$mailer->AddAddress($dest);
    	}else{
    		$mailer->AddAddress(ParamCustom::param("MAIL.INCIDENT_ADDRESS","FRAMEWORK"));
    	}

    	if(is_array($environment) && count($environment)){
    		if (!in_array(Zend_Registry::get('Environment'), $environment)) {
    			return false;
    		}
    	}

    	//return false;
    	return $mailer->send();
    }

    function strToHex($string){
    	$hex = '';
    	for ($i=0; $i<strlen($string); $i++){
    		$ord = ord($string[$i]);
    		$hexCode = dechex($ord);
    		$hex .= substr('0'.$hexCode, -2);
    	}
    	return strToUpper($hex);
    }
    function hexToStr($hex){
    	$string='';
    	for ($i=0; $i < strlen($hex)-1; $i+=2){
    		$string .= chr(hexdec($hex[$i].$hex[$i+1]));
    	}
    	return $string;
    }

    function url_origin($s, $use_forwarded_host=false)
    {
    	$ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
    	$sp = strtolower($s['SERVER_PROTOCOL']);
    	$protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    	$port = $s['SERVER_PORT'];
    	$port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
    	$host = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
    	$host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
    	return $protocol . '://' . $host;
    }
    /**
     *
     * @param string $s
     * @param boolean $use_forwarded_host
     * @return string
     *
     * ex : $absolute_url = full_url($_SERVER);
     */
    function full_url($s, $use_forwarded_host=false)
    {
    	return url_origin($s, $use_forwarded_host) . $s['REQUEST_URI'];
    }

    // Generate random string of N chars
    function randomToken($length = 4, $result='', $case=null) {
        $caseParam = $case;
    	for($i = 0; $i < $length; $i++) {
    
    		if(is_null($caseParam)) $case = mt_rand(0, 1);
    		switch($case){
    
    			case 0:
    				$data = mt_rand(0, 9);
    				break;
    			case 1:
    				$alpha = range('a','z');
    				$item = mt_rand(0, 25);
    
    				$data = strtoupper($alpha[$item]);
    				break;
    		}
    
    		$result .= $data;
    	}
    
    	return $result;
    }
    
    //Fonction algorithme de Luhn
    function isLuhnNum($num)
    {
    	//longueur de la chaine $num
    	$length = strlen($num);
    
    	if($length==0){
    		return false;
    	}
    	
    	//resultat de l'addition de tous les chiffres
    	$tot = 0;
    	for($i=$length-1;$i>=0;$i--)
    	{
    		$digit = substr($num, $i, 1);
    
    		if ((($length - $i) % 2) == 0)
    		{
    			$digit = $digit*2;
    			if ($digit>9)
    			{
    				$digit = $digit-9;
    			}
    		}
    		$tot += $digit;
    	}
    
    	return (($tot % 10) == 0);
    }
    
    