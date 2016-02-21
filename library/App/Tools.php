<?php
class App_Tools {

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
    static function extractEmailsFromString($chaine) {
        $return = null;
        if(false !== preg_match_all('`\w(?:[-_.]?\w)*@\w(?:[-_.]?\w)*\.(?:[a-z]{2,4})`', $chaine, $arrayEmails)) {
            if(is_array($arrayEmails[0]) && count($arrayEmails[0])) {
                $tab = $arrayEmails[0];
                $return = array_unique($tab);
            }
        }
        return $return;
    }


    static function human_filesize($bytes, $decimals = 2) {
        $sz = 'BKMGTP';
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }
}


