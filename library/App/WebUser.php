<?php

class App_WebUser {

    public $Environment = array();

    public function getSessionId(){
        return Zend_Session::getId();
    }

    /**
     * Retourne l'ip du visiteur
     *
     * @return string
     */
    function get_ip(){
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }elseif(isset($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function get_userAgent(){
        if(!array_key_exists('httpUserAgent', $this->Environment)){
            $userAgent = "";
            if(array_key_exists('HTTP_USER_AGENT', $_SERVER)) $userAgent = $_SERVER['HTTP_USER_AGENT'];
            $this->Environment['httpUserAgent'] = $userAgent;
        }
        return $this->Environment['httpUserAgent'];
    }

    public function get_httpReferrer(){
        if(!array_key_exists('HTTP_REFERER', $this->Environment)){
            $HTTP_REFERER = "";
            if(array_key_exists('HTTP_REFERER', $_SERVER)) $HTTP_REFERER = $_SERVER['HTTP_REFERER'];
            $this->Environment['HTTP_REFERER'] = $HTTP_REFERER;
        }
        return $this->Environment['HTTP_REFERER'];
    }

    // Inspiré de http://www.contao.org/extension-list/view/botdetection.en.html
    public function isBot($UserAgent = false){
        if ($UserAgent === false) {
            if(!array_key_exists('httpUserAgent', $this->Environment)) $this->get_userAgent();
            if ($this->Environment['httpUserAgent']) {
                $UserAgent = trim($this->Environment['httpUserAgent']);
            } else {
                return false; // No return address, no search.
            }
        }
        $BotsRough = array(
                'bot',
                'spider',
                'spyder',
                'crawl',
                'slurp',
                'robo',
                'yahoo',
                'VoilaBot',
                'Mediapartners-Google'
        );
        $CheckUserAgent = str_ireplace($BotsRough, '#', $UserAgent);
        if ($UserAgent != $CheckUserAgent) { // found
            return true;
        }
        $BotsFine = array(
                'agentname',
                'altavista',
                'al_viewer',
                'appie',
                'appengine-google', //http://code.google.com/appengine
                'arachnoidea',
                'archiver',
                'asterias',
                'ask jeeves',
                'beholder',
                'bingsearch',
                'bumblebee',
                'bramptonmoose',
                'bbtest-net',	//Hobbit bbtest-net/4.2.0
                'cherrypicker',
                'crescent',
                'cosmos',
                'docomo',
                'emailsiphon',
                'emailwolf',
                'extractorpro',
                'exalead ng',
                'ezresult',
                'facebook',
                'feedfetcher', //Feedfetcher-Google
                'fido',
                'fireball',
                'gazz',
                'gigabaz',
                'google talk',
                'google-site-verification', // Google Webmaster Tools
                'gulliver',
                'harvester',
                'hcat',
                'heritrix',
                'hloader',
                'hoge (',
                'incywincy',
                'infoseek',
                'inktomi',
                'indy library',
                'informant',
                'internetami',
                'internetseer',
                'link',
                'larbin',
                'libweb',
                'libwww',
                'mata hari',
                'medicalmatrix',
                'mercator',
                'microsoft url control', //Harvester mit Spamflotte
                'miixpc',
                'moget',
                'msnptc',
                'muscatferret',
                'netcraftsurveyagent',
                'openxxx',
                'pecl::http', // PECL::HTTP
                'pioneer internet',
                'piranha',
                'pldi.net',
                'p357x',
                'quosa',
                'rambler',		// russisch
                'scan',
                'scooter',
                'sly',
                'suchen',
                'spy',
                'swisssearch',
                'sqworm',
                'trivial',
                't-h-u-n-d-e-r-s-t-o-n-e',
                'teoma',
                'twiceler',
                'ultraseek',
                'validator',
                'webbandit',
                'webmastercoffee',
                'wget',
                'wisewire',
                'yandex',		// russisch
                'zyborg'
        );
        // Fine search
        $CheckUserAgent = str_ireplace($BotsFine, '#', $UserAgent);
        if ($UserAgent != $CheckUserAgent) { // found
            return true;
        }
        return false;

    }

}

