<?php
function file_getExtension($filename)
{
    $tab_extension = explode(".", $filename);
    $extension = array_pop($tab_extension);
    return $extension;
}

function file_getName($filename)
{
    $tab_path = explode("/", $filename);
    $name = array_pop($tab_path);
    return $name;
}

/*
 * return an array whose elements are shuffled in random order.
*/
function my_shuffle($my_array = array(),$keepKey=false) {
    $copy = array();

    if($keepKey){
        while (count($my_array)) {
            // takes a rand array elements by its key
            $element = array_rand($my_array);
            // assign the array and its value to an another array
            $copy[$element] = $my_array[$element];
            //delete the element from source array
            unset($my_array[$element]);
        }
    }else{
        shuffle($my_array);
        $copy = $my_array;
    }
    return $copy;
}

/**
 * Fonction qui supprime tous les fichiers et répertoires d'un dossier qui ont plus d'un certain age
 *
 * @param string $rep Chemin absolu du répertoire à nettoyer
 * @param integer $heures Durée en heures (par défaut 24)
 *
 */
function my_CleanFolder($rep,$heures = 24, $filter="none",$print=false){
    $rep .= "/";
    $dir = opendir($rep);
    $time = time();
    while ($f = readdir($dir)) {
        if($f<>"." && $f<>".." && $f<>".svn" && $f<>".cvs" ) {
            $diff = ($time - filemtime($rep.$f))/3600;
            if($diff > $heures){
                if(is_file($rep.$f)){
                    my_Remover($rep.$f,"file",$filter,$print);
                }elseif(is_dir($rep.$f)){
                    my_Remover($rep.$f,"dir",$filter,$print);
                }
            }
        }
    }
}

/**
 * Fonction de suppression générique (fichier ou répertoire)
 * Fichier :                        remover($chemin_fichier)
 * Répertoire et son contenu :        remover($chemin_rep,"dir")
 * Fichiers .txt d'un répertoire :    remover($chemin_rep,"dir","txt")
 *
 * @param string $path
 * @param string $type
 * @param string $filter
 * @param boolean $print
 */
function my_Remover($path, $type="file", $filter="none", $print=false) {
    if($type=="file") {
        if(!file_exists($path))    {
            if($print) echo "Fichier $path <i>inexistant</i><br />";
            return ;
        }
        else {
            if(unlink($path))
                if($print) echo "Fichier $path <b>supprimé</b><br />";
        }
    }
    if($type=="dir") {
        if(!is_dir($path)) {
            if($print) echo "Répertoire $path <i>inexistant</i><br />";
            return ;
        }
        else {
            if($filter=="none") {
                my_RmdirRecursive($path);
                if($print) echo "Répertoire $path <b>supprimé</b><br />";
            }
            else {
                my_RmdirRecursive($path,$filter);
            }
        }
    }
}


/**
 * Fonction de suppression récurssive d'un répertoire
 *
 * @param string $path
 * @param string $filter
 * @return string
 */
function my_RmdirRecursive($path,$filter="none") {

    $dir = opendir($path) ;
    while ( $entry = readdir($dir) ) {

        $ext = str_replace('.','',strstr("$path/$entry", '.'));
        if ( ($filter=="none" && is_file( "$path/$entry" )) || ($filter!="none" && $ext==$filter) ) {
            my_Remover( "$path/$entry" );
        } elseif ( is_dir( "$path/$entry" ) && $entry!='.' && $entry!='..' && $filter=="none") {
            my_RmdirRecursive( "$path/$entry" ) ;
        }
    }
    closedir($dir) ;
    if ($filter=="none")
        return rmdir($path);
    else
        return ;
}
