<?php
/**
 * This file is part of the <Admin> project.
 * 
 * @category   Admin_Utils
 * @package    Util
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-09-20
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util;

use PiApp\AdminBundle\Builder\PiRegexManagerBuilderInterface;

/**
 * Standardizing the classroom management system regular expressions.
 *
 * <code>
 *     $RegexFormatter    = $container->get('pi_app_admin.regex_manager');
 *  $result            = $RegexFormatter->LimiteCaractere($text, '0', 25); // obtains a datetime instance
 * </code>
 *
 * @category   Admin_Utils
 * @package    Util
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiRegexManager implements PiRegexManagerBuilderInterface
{
    /**
     * removes the trailing slash
     *
     * @access public
     * @static
     * @param string $string
     * @return string
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function stripTrailingSlash($string)
    {
        return preg_replace("/\/$/", '', $string);
    }

    /**
     * note that this does not transfer any of the attributes
     *
     * @access public
     * @static
     * @param string $tag
     * @param string $replacement
     * @param string $content
     * @return string
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function replaceTag($tag, $replacement, $content, $attributes = null)
    {
        $content = preg_replace("/<{$tag}.*?>/", "<{$replacement} {$attributes}>", $content);
        $content = preg_replace("/<\/{$tag}>/", "</{$replacement}>", $content);
        return $content;
    }
    
    /**
     * Removes in one sentence :
     * hour: minute: second of a datetime. 
     * 
     * @access public
     * @static
     * @param  str $string la chaine
     * @return str   
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function simplifyDatetime($string)
    {
      return preg_replace("/([0-1][0-9]|2[0-4]):([0-5][0-9]):([0-5][0-9])/", "", $string);
    }    
    
    /**
     * Check if the given {@param $_string} is a datetime or not
     *  
     * @access public
     * @static
     * @param String $_string
     * @return bool
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function isDateTime($_string)
    {
        return preg_match('/([0-9][0-9][0-9][0-9])-(1[0-2]|0[0-9])-(3[0-1]|[0-2][0-9]) ([0-1][0-9]|2[0-4]):([0-5][0-9]):([0-5][0-9])/', $_string);
    }     
    
    /**
     * Check if the given {@param $_string} is a md5 hash or not
     *
     * @param String $_string
     * @return bool
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function isMd5($_string)
    {
        return preg_match('/^[A-Fa-f0-9]{32}$/', $_string);
    }    
    
    /**    
     * Returns an array form strings between the values ​​of the start and end data param
     * 
     * @access public
     * @static
     * @param  str $start   texte sur lequel tester le type d'expression régulière
      * @param  str $end        type d'expression régulière
      *                          
     * @return array         tableau des strings compris entre les deux valeurs de début et de fin.
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    public static function findinside($start, $end, $string) {
        preg_match_all('/' . preg_quote($start, '/') . '([^\.)]+)'. preg_quote($end, '/').'/i', $string, $matches, PREG_SET_ORDER);
        return $matches;
    }    
    
    /**    
     * Check a string with a typing carractères regular expression defined in the method.
     * 
     * @access public
     * @static
     * @param  str         $chaine            text on which to test the type of regular expression
     * @param  str         $typeExpression    type of regular expression
     *                                     syntaxe: $typeExpression = "num | letter | alphanum | nick | mail | url | file | name";
     *  
     * @return mixed     false if the string test is not verified by the regular expression required
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function verifByRegularExpression($chaine, $typeExpression = "no", $flags = PREG_SET_ORDER)
    {
            $w_var = \PiApp\AdminBundle\Util\PiStringManager::trimUltime($chaine);

            switch ($typeExpression)
            {
                case "no":
                    return $w_var;
                    
                case "num":
                    if (preg_match_all("/[0-9]+/",$w_var, $matches, $flags))
                    {
                        return $matches;
                    } else {
                        return false;
                    }
                    
                case "letter":
                    if (preg_match_all("/[a-zA-Z]+/",$w_var, $matches, $flags))
                    {
                        return $matches;
                    } else {
                        return false;
                    }
                    
                case "alphanum":
                    if (preg_match_all("/[a-zA-Z0-9]+/",$w_var, $matches, $flags))
                    {
                        return $matches;
                    } else {
                        return false;
                    }
                    
                case "nick":
                    if (preg_match_all("/[_a-zA-Z0-9.-]+/",$w_var, $matches, $flags))
                    {
                        return $matches;
                    } else {
                        return false;
                    }
                
                case "mail":
                    if (preg_match_all("/[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,3}/",$w_var, $matches, $flags))
                    {
                        return $matches;
                    } else {
                        return false;
                    }
                
                case "url":
                    if (preg_match_all("/[www.]+[_a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/",$w_var, $matches, $flags))
                    {
                        return $matches;
                    } else {
                        return false;
                    }
                
                case "file":
                    if (preg_match_all("/[_a-zA-Z0-9.-? /&é]+/",$w_var, $matches, $flags))
                    {
                        return $matches;
                    } else {
                        return false;
                    }
                    
                case "name":
                    if (preg_match_all("/[_a-zA-Z0-9.-? \'/&éea]+/",$w_var, $matches, $flags))
                    {
                        return $matches;
                    } else {
                        return false;
                    }

                // Extraction de tous les numéros de téléphone d'un texte                    
                case "phone":
                    if (preg_match_all("/\(?  (\d{3})?  \)?  (?(1)  [\-\s] ) \d{3}-\d{4}/x",$w_var, $matches, $flags))
                    {
                        return $matches;
                    } else {
                        return false;
                    }

                // Recherche les couples de balises HTML                 
                case "balise":
                    if (preg_match_all("|<[^>]+>(.*)</[^>]+>|U",$w_var, $matches, $flags))
                    {
                        return $matches;
                    } else {
                        return false;
                    }                
                                            
            } // end switch

    }

    /**    
     * Function for finding tags with an identifier associated.
     * 
     * @access public
     * @static
     * @param  str $chaine         text on which search
     * @param  str $tag         the search term
     * @return array             tags and ID required.  
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function searchIdByTag($chaine,$tag)
    {
        $w_var = \PiApp\AdminBundle\Util\PiStringManager::trimUltime($chaine);

        if (preg_match_all("|&lt;$tag(\d+)&gt;|U",$w_var, $matches, PREG_SET_ORDER ))
        {
            return $result = array('items' => $matches, 'split' => preg_split("|&lt;$tag(\d+)&gt;|U",$w_var));
        } else {
            return false;
        }    
    }     
    
    /**    
     * Function for finding tags with an identifier associated and other parameters.
     * 
     * @access public
     * @static
     * @param  str $chaine         text on which search
     * @param  str $tag         the search term
     * @return array             tags and ID required.
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function searchLinkByParam($chaine, $tag)
    {
        $w_var = \PiApp\AdminBundle\Util\PiStringManager::trimUltime($chaine);

        if (preg_match_all("|&lt;$tag(.*)&gt;|U",$w_var, $matches, PREG_SET_ORDER ))
        {
            return $result = array('items' => $matches, 'split' => preg_split("|&lt;$tag(.*)&gt;|U",$w_var));
        } else {
            return false;
        }    
    } 

    /**
     * Function for delete all contents of tags which are displayed none (and all tags which are inside).
     *
     * @access public
     * @static
     * @param  str $w_var         text on which delete
     * @param  str $tag         the search tag
     * @return string             lthe search
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function deleteDisplayNoneTag($w_var, $tag, $replaceTerm = '')
    {
        if (preg_match_all("/<\s*{$tag}\s+[^>]*style\s*=\s*[\"']?([^\"' >]*)display:none([^\"' >]*)[\"' >](.*)<\/{$tag}>/xsm", $w_var, $allTags, PREG_SET_ORDER))
        {
            return preg_replace("/<\s*{$tag}\s+[^>]*style\s*=\s*[\"']?([^\"' >]*)display:none([^\"' >]*)[\"' >](.*)<\/{$tag}>/xsm", $replaceTerm, $w_var);
        } else {
            return false;
        }    
    }    
    
    /**
     * Convert hex to rvb code.
     *
     * @access public
     * @static
     * @param  string     $color        the color value
     * @return array                 rbv code+
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    public static function hex2rgb($color){
        if (preg_match("@#[a-f0-9]{6}@i",$color)){
            /* On isole chaque caractère de la chaine hexadécimale par couleur */
            $r = substr($couleur, 1, 2);
            $v = substr($couleur, 3, 2);
            $b = substr($couleur, 5, 2);
            /* On récupère une valeur décimale */
            $rouge = hexdec($r);
            $vert  = hexdec($v);
            $bleu  = hexdec($b);
            /* On reconstruit la chaine en valeur rgb. */
            return array('r'=>$rouge,'g'=>$vert,'b'=>$bleu);
        }else
            return false;
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//                            Fonction depreciated                                                    //

////////////////////////////////////////////////////////////////////////////////////////////////////////////

//        Fonction ereg recherche d'un motif dans une chaîne
//
//        Exemple :
//
//         if (ereg($motif, $texte))
    //
//            * Fonction strpos
//
//         if (strpos($texte, $motif)!==false)
    //
//              A noter : le test !== pour ne pas être piégé par la valeur 0 (debut de chaine) qui reste vrai.
//            * Fonction strstr
//
//         if (strstr($texte, $motif))
    //
//              Cette version est peut-être plus lisible, mais sans doute moins performante.
//            * Fonction preg_match
//
//         if (preg_match("/$motif/", $texte))
    //
//        A noter : avec cette fonction, le motif doit être entouré d'un délimiteur (/ dans mon exemple).
//
//        Corrigé dans GLPI : #7682, #7683, #7683.
//        Fonction eregi recherche d'un motif dans une chaîne
//
//        Cette fonction se distingue de la précédente par la recherche sans distinction de la casse. Exemple :
//
//         if (eregi($motif, $texte))
//
//            * Fonction stripos
//
//         if (stripos($texte, $motif)!==false)
    //
//            * Fonction preg_match
//
//         if (preg_match("/$motif/i", $texte))
    //
//        A noter : l'option i après le délimiteur de fin.
//
//        Corrigé dans GLPI : #7681.
//        Fonction ereg_replace remplacement d'un motif dans une chaîne
//
//        Exemple :
//
//         ereg_replace($cherche, $remplace, $texte);
//
//            * Fonction str_replace
//
//         str_replace($cherche, $remplace, $texte);
//
//            * Fonction preg_replace
//
//         preg_replace("/$cherche/", $remplace, $texte);
//
//        A noter : avec cette fonction, le motif doit être entouré d'un délimiteur (/ dans mon exemple).
//
//        Corrigé dans GLPI : #7675.
//        Fonction eregi_replace remplacement d'un motif dans une chaîne
//
//        Cette fonction se distingue de la précédente par la recherche sans distinction de la casse. Exemple :
//
//         eregi_replace($cherche, $remplace, $texte);
//
//            * Fonction str_ireplace
//
//         str_ireplace($cherche, $remplace, $texte);
//
//            * Fonction preg_replace
//
//         preg_replace("/$cherche/i", $remplace, $texte);
//
//        A noter : l'option i après le délimiteur de fin.
//
//        Corrigé dans GLPI : #7672, #7673.
//        Fonction split scinde une chaîne en un tableau
//
//        Exemple :
//
//         $resultat = split ($motif, $chaine);
//
//            * Fonction explode
//
//         $resultat = explode ($motif, $chaine);
//
//            * Fonction preg_split
//
//         $resultat = preg_split ("/$motif/", $chaine);
//
//        A noter : avec cette fonction, le motif doit être entouré d'un délimiteur (/ dans mon exemple).
//
//        Corrigé dans GLPI : #7671.
//        Fonction spliti scinde une chaîne en un tableau
//
//        Cette fonction se distingue de la précédente par la recherche sans distinction de la casse. Exemple :
//
//         $resultat = split ($motif, $chaine);
//
//            * Fonction preg_split
//
//         $resultat = preg_split ("/$motif/i", $chaine);


// resumé :

//ereg("salut","Hello veut dire salut");
//eregi("salut","Hello veut dire salut");
//eregi_replace("(\/en\/){1}","/fr/",$_SERVER["REQUEST_URI"]);
//ereg_replace("(\/en\/){1}","/fr/",$_SERVER["REQUEST_URI"]);
//deviendront respectivement :
//preg_match("@salut@","Hello veut dire salut");
//preg_match("@salut@i","Hello veut dire salut");
//preg_replace("@(\/en\/){1}@i","/fr/",$_SERVER["REQUEST_URI"]);
//preg_replace("@(\/en\/){1}@","/fr/",$_SERVER["REQUEST_URI"]);


//////////////////////////////////////////////////////////////////////////////////////////////////////////
//                            EXPRESSION REGULIERE                                                        //

//////////////options de recherche --  Options disponibles pour les expressions rationnelles//////////

//        i (PCRE_CASELESS)
//        Effectue une recherche insensible à la casse.
//        Permet de ne pas tenir compte de la casse. Ainsi, les masques [a-z], [A-Z] et toutes leurs variantes sont
//        équivalents. Il est inutile de préciser [a-zA-Z], ce qui peut être pratique dans de nombreux cas.
//
//        m (PCRE_MULTILINE)
//        Par défaut, PCRE traite la chaîne sujet comme une seule ligne (même si cette chaîne contient des retours chariot). Le méta-caractère "début de ligne" (^) ne sera valable qu'une seule fois, au début de la ligne, et le méta-caractère "fin de ligne " ($) ne sera valable qu'à la fin de la chaîne, ou avant le retour chariot final (à moins que l'option D ne soit activée). C'est le même fonctionnement qu'en Perl.
//
//        Lorsque cette option est activée, " début de ligne " et " fin de ligne " correspondront alors aux caractères suivant et précédent immédiatement un caractère de nouvelle ligne, en plus du début et de la fin de la chaîne. C'est le même fonctionnement que l'option Perl /m. S'il n'y a pas de caractère de nouvelle ligne "\n" dans la chaîne sujet, ou s'il n'y a aucune occurrence de ^ ou $ dans le masque, cette option ne sert à rien.
//
//        s (PCRE_DOTALL)
//        Avec cette option, le méta-caractère point (.) remplace n'importe quel caractère, y compris les nouvelles lignes. Sans cette option, le caractère point ne remplace pas les nouvelles lignes. Cette option est équivalente à l'option Perl /s. Une classe de caractères négative telle que [^a] acceptera toujours les caractères de nouvelles lignes, indépendamment de cette option.
//
//        x (PCRE_EXTENDED)
//        Avec cette option, les caractères d'espacement sont ignorés, sauf lorsqu'ils sont échappés, ou à l'intérieur d'une classe de caractères, et tous les caractères entre # non échappés et en dehors d'une classe de caractères, et le prochain caractère de nouvelle ligne sont ignorés. C'est l'équivalent Perl de l'option /x : elle permet l'ajout de commentaires dans les masques compliqués. Notez bien, cependant, que cela ne s'applique qu'aux caractères de données. Les caractères d'espacement ne doivent jamais apparaître dans les séquences spéciales d'un masque, par exemple dans la séquence (?( qui introduit une parenthèse conditionnelle.
//
//        e
//        Avec cette option, preg_replace() effectue la substitution normale des références arrières dans la chaîne de remplacement, puis l'évalue comme un code PHP, et utilise le résultat pour remplacer la chaîne de recherche. Les simples et doubles quotes sont échappées avec des anti-slashes (\) dans les références arrières substituées.
//
//        Seule preg_replace() utilise cette option. Elle est ignorée par les autres.
//
//        Note : Cette option n'est pas valable en PHP 3.
//
//
//        A (PCRE_ANCHORED)
//        Avec cette option, le masque est ancré de force, c'est-à-dire que le masque doit s'appliquer juste au début de la chaîne sujet pour être considéré comme trouvé. Il est possible de réaliser le même effet en ajoutant les méta-caractères adéquats, ce qui est la seule manière de le faire en Perl.
//
//        D (PCRE_DOLLAR_ENDONLY)
//        Avec cette option, le méta-caractère $ ne sera valable qu'à la fin de la chaîne sujet. Sans cette option, $ est aussi valable avant une nouvelle ligne, si cette dernière est le dernier caractère de la chaîne. Cette option est ignorée si l'option m est activée. Il n'y a pas d'équivalent en Perl.
//
//        S
//        Lorsqu'un masque est utilisé plusieurs fois, cela vaut la peine de passer quelques instants de plus pour l'analyser et optimiser le code pour accélérer les traitements ultérieurs. Cette option force cette analyse plus poussée. Actuellement, cette analyse n'est utile que pour les masques non ancrés, qui ne commencent pas par un caractère fixe.
//        Permet de demander au point de contenir également les sauts de ligne. Par défaut, ce n'est pas le cas.
//
//        U (PCRE_UNGREEDY)
//        Cette option inverse la tendance à la gourmandise des expressions rationnelles. Vous pouvez aussi inverser cette tendance au coup par coup avec un ?. De même, si cette option est activée, le ? rendra gourmand une séquence. Cette option n'est pas compatible avec Perl. Elle peut aussi être mise dans le masque avec l'option ?U dans le pattern ou par un point d'interrogation avant le quantifieur (.e.g. .*?).
//        "Ungreedy", c'est-à-dire non gourmand. Cela signifie que l'expression trouvera des résultats aussi petits que possible.
//
//        X (PCRE_EXTRA)
//        Cette option ajoute d'autres fonctionnalités incompatibles avec le PCRE de Perl. Tous les anti-slashs suivis d'une lettre qui n'aurait pas de signification particulière causent une erreur, permettant la réservation de ces combinaisons pour des ajouts fonctionnels ultérieurs. Par défaut, comme en Perl, les anti-slashs suivis d'une lettre sans signification particulière sont traités comme des valeurs littérales. Actuellement, cette option ne déclenche pas d'autres fonctions.
//
//        u (PCRE8)
//        Cette option désactive les fonctionnalités additionnelles de PCRE qui ne sont pas compatibles avec Perl. Les chaînes sont traitées comme des chaînes UTF-8. Cette option est disponible en PHP 4.1.0 et plus récent sur plate-forme Unix et en PHP 4.2.3 et plus récent sur plate-forme Windows.

//        Les options PCRE_CASELESS, PCRE_MULTILINE, PCRE_DOTALL, PCRE_UNGREEDY, PCRE_EXTRA et PCRE_EXTENDED peuvent être changées à l'intérieur du masque lui-même, avec des séquences mises entre "(?" et ")". Les options sont :
//
//        Tableau 2. Internal option letters
//
//        i pour PCRE_CASELESS
//        m pour PCRE_MULTILINE
//        s pour PCRE_DOTALL
//        x pour PCRE_EXTENDED
//        U pour PCRE_UNGREEDY
//        X Pour PCRE_EXTRA

//        Répétitions
//        Les répétitions sont spécifiées avec des quantificateurs, qui peuvent être placés à la suite des caractères suivants :
//
//
//        a
//        Un caractère unique, même s'il s'agit d'un méta-caractère
//
//        .
//        Un méta-caractère
//
//        [abc]
//        Une classe de caractères
//
//        \2
//        Une référence de retour (voir section suivante)
//
//        (a|b|c)
//        Un sous-masque avec parenthèses (à moins que ce ne soit une assertion, voir plus loin)




//////////////Méta-caractères///////////
//        ^ Accent circonflexe
//        Le début de la chaîne sujet (ou de ligne, en mode multi-lignes)
//
//        $ Dollar
//        La fin de la chaîne sujet (ou de ligne, en mode multi-lignes)
//
//        . Point
//        Remplace n'importe quel caractère, hormis le caractère de nouvelle ligne (par défaut) ;
//
//        [ Crochet ouvrant
//        Caractère de début de définition de classe
//
//        ] Crochet fermant
//        Caractère de fin de définition de classe
//
//        | Barre verticale
//        Caractère de début d'alternative
//
//        ( Parenthèse ouvrante
//        Caractère de début de sous-masque
//
//        ) Parenthèse fermante
//        Caractère de fin de sous-masque
//
//        ? Point d'interrogation
//        Etend le sens de (; quantificateur de 0 ou 1; quantificateur de minimisation
//
//        * Etoile
//        Quantificateur de 0 ou plus
//
//        + Plus
//        Quantificateur de 1 ou plus
//
//        { Accolade ouvrante
//        Caractère de début de quantificateur minimum/maximum
//
//        } Accolade fermante
//        Caractère de fin de quantificateur minimum/maximum
//
//        La partie du masque qui est entourée de crochets est appelée classe de caractères. Dans les classes de caractères, les seuls méta-caractères autorisés sont :
//
//        \ Anti-slash
//        Caractère d'échappement, avec de multiples usages
//
//        ^ Accent circonflexe
//        Négation de la classe, mais uniquement si placé tout au début de la classe
//
//        - Moins
//        Indique un intervalle de caractères
//
//        ] Crochet fermant
//        Termine la classe de caractères

//        * équivalent à {0,}
//        + équivalent à {1,}
//        ? équivalent à {0,1}

//////////////Anti-slash///////////
//        \a
//        alarme, c'est-à-dire le caractère BEL (hex 07)
//
//        \cx
//        "contrôle-x", avec x qui peut être n'importe quel caractère.
//
//        \e
//        escape (hex 1B)
//
//        \f
//        formfeed (hex 0C)
//
//        \n
//        nouvelle ligne (hex 0A)
//
//        \r
//        retour chariot (hex 0D)
//
//        \t
//        tabulation (hex 09)
//
//        \xhh
//        caractère en hexadécimal, de code hh
//
//        \ddd
//        caractère en octal, de code ddd, ou référence arrière

//        \040
//        une autre manière d'écrire un espace
//
//        \40
//        identique, dans la mesure où il n'y a pas 40 parenthèses ouvrantes auparavant
//
//        \7
//        est toujours une référence arrière
//
//        \11
//        peut être une référence de retour, ou une tabulation
//
//        \011
//        toujours une tabulation
//
//        \0113
//        est une tabulation suivie du caractère "3"
//
//        \113
//        est le caractère 113 (étant donné qu'il ne peut y avoir plus de 99 références arrières)
//
//        \377
//        est un octet dont tous les bits sont à 1
//
//        \81
//        peut être soit une référence arrière, soit un zéro binaire suivi des caractères "8" et "1"

//        \d
//        tout caractère décimal
//
//        \D
//        tout caractère qui n'est pas un caractère décimal
//
//        \s
//        tout caractère blanc
//
//        \S
//        tout caractère qui n'est pas un caractère blanc
//
//        \w
//        tout caractère de "mot"
//
//        \W
//        tout caractère qui n'est pas un caractère de "mot"

////////////////////////////////////////////////////////////////////////////////////////////////////////

//    [[:print:]] [ -~] Caractères imprimables, exceptés ceux de contrôle
//    [[:cntrl:]] [\x00-\x19\x7F] Caractères d’échappement
//    [[:space:]] [ \t\v\f] Tout type d’espace
//    [[:punct:]] [!-/:-@[-’{-~] Caractères de ponctuation
//    [[:upper:]] [A-Z] Caractères en majuscule
//    [[:lower:]] [a-z] Caractères en minuscule
//    [[:graph:]] [!-~] Caractères affichables et imprimables
//    [[:xdigit:]] [0-9a-fA-F] Caractères hexadécimaux
//    [[:blank:]] [\x09] Espaces ou tabulations
//    [[:digit:]] [0-9] Caractères numériques
//    [[:alpha:]] [A-Za-z] Caractères alphabétiques
//    [[:alnum:]] [A-Za-z0-9] Caractères alphanumériques

// exemple standard :
//   #^http$# => La chaîne "http".
//   #http$# => La chaîne "http" en fin de chaîne.
//   #^http# => La chaîne "http" en début de chaîne.
//
//   /[a-z]/ => Il suffit d'une lettre minuscule dans la chaîne.
//
//   #^[a-z:/.-]+$# => Un ou plusieurs caractères parmi les lettres de l'alphabet, les deux points,la barre oblique, le point et le trait d'union
//
//   #^[^ ]+$# => N'importe quel caractère mais pas une seule espace dans la chaîne.
//
//   [a-z.-]+ : Au moins un caractère parmi les lettres de l'alphabet, le point et le trait d'union
//   \.[a-z]{2,4} : Un point suivi de deux à quatre lettres de l'alphabet
//   ([a-z-]+) : Un ou plusieurs caractères parmi les lettres et le trait d'union
//   \.([a-z]+) : Un point suivi d'une ou plusieurs lettres.
//   (?:\.([a-z]+)){2} : Un point suivi d'un ou plusieurs caractères parmi les lettres et le trait d'union. Ce bloc est répété une fois.
//   #[./]([a-z-]+)# => Un point ou une barre oblique, puis au moins une lettre de l'alphabet.
//   ([a-z-]+)\. : Une ou plusieurs lettres de l'alphabet (ou traits d'union) suivies d'un point
//   [a-z]+\s : Une ou plusieurs lettres de l'alphabet suivies d'une espace
//   (?:[a-z]+['\s])? : Une ou plusieurs lettres de l'alphabet suivies soit d'une espace soit d'une apostrophe (ce bloc est facultatif)
//   ([a-z]+(?:es|ons|ez|ent|e)) : Tout mot terminant par "e", "es", "ons", "ez" ou "ent" (on capture le mot entier)
//
//   #<b>(.*)</b>#U => N'importe quelle suite de caractères encadrée d'une balise de mise en gras.
//   #<i>(.*)</i>#s => N'importe quelle suite de caractères encadrée d'une balise de mise en italique.
//     #http://(?!www)# => La chaîne "http://" non suivie de "www"
//     #http://(?!php)# => La chaîne "http://" non suivie de "php"
//     #(?<!www)\.developpez# = La chaîne ".developpez" non précédée de "www"
//     #(?<!php)\.developpez# = La chaîne ".developpez" non précédée de "php"
//     #\[b\](.*)\[/b\]# => Un bloc BBCode [b] et [/b] encadre n'importe quelle suite de caractères

//     /^[A-Z]/ => La chaîne commence par une majuscule de l'alphabet
//     /[A-Z][a-z]+/ => Une lettre majuscule de l'alphabet puis au moins une lettre minuscule.
//     /[,&\s()]/ => Utiliser la virgule, l'esperluette, les caractères d'espacement et les parenthèses pour découper une chaîne.
//     #\[b\](.*)\[/b\]#e => N'importe quelle suite de caractères encadrée d'une balise BBCode de mise en gras.


//    /^([^@\s<&>]+)@(?:([-a-z0-9]+)\.)+([a-z]{2,})$/iD
//    Détail :
//    • ^([^@\s<&>]+)@ : Au début de la chaîne, tous les caractères qui ne sont pas espace, arobase, <, & et > ;
//    s'ensuit l'arobase
//    • (?:([-a-z0-9]+)\.)+ : Les lettres, chiffres et traits d'union ; le tout est suivi d'un point
//    • ([a-z]{2,})$ : À partir de deux lettres
//    • iD : Insensible à la casse, pas de caractère de fin de ligne en fin de chaîne



//  #\[colou?r="([a-z]+)"\](.*)\[/colou?r\]#
//  Détail :
//  • \[colou?r="([a-z]+)"\] : Un bloc [color=""] ou [colour=""] contient un nom de couleur (à partir d'une lettre)
//  • (.*) : N'importe quels caractères (voire aucun) et on les capture
//  • \[/colou?r\] : Un bloc [color] ou [colour]



//  Working with regular expressions: HREF URL Extractor
//  The regular expression: <\s*a\s+[^>]*href\s*=\s*[\"']?([^\"' >]+)[\"' >]
//
// $href_regex ="<"; // 1 start of the tag
// $href_regex .="\s*"; // 2 zero or more whitespace
// $href_regex .="a"; // 3 the a of the tag itself
// $href_regex .="\s+"; // 4 one or more whitespace
// $href_regex .="[^>]*"; // 5 zero or more of any character that is _not_ the end of the tag
// $href_regex .="href"; // 6 the href bit of the tag
// $href_regex .="\s*"; // 7 zero or more whitespace
// $href_regex .="="; // 8 the = of the tag
// $href_regex .="\s*"; // 9 zero or more whitespace
// $href_regex .="[\"']?"; // 10 none or one of " or '
// $href_regex .="("; // 11 opening parenthesis, start of the bit we want to capture
// $href_regex .="[^\"' >]+"; // 12 one or more of any character _except_ our closing characters
// $href_regex .=")"; // 13 closing parenthesis, end of the bit we want to capture
// $href_regex .="[\"' >]"; // 14 closing chartacters of the bit we want to capture

// $regex = "/"; // regex start delimiter
// $regex .= $href_regex; //
// $regex .= "/"; // regex end delimiter
// $regex .= "i"; // Pattern Modifier - makes regex case insensative
// $regex .= "s"; // Pattern Modifier - makes a dot metacharater in the pattern
// // match all characters, including newlines
// $regex .= "U"; // Pattern Modifier - makes the regex ungready

// $html = "......";

// //if preg_match was used here, it would only find the first match for the regular expression
// if (preg_match_all($regex, $html, $links)) {

//     print("<P>Links: <pre>");
//     print_r($links[1]);
//     print("</pre></P>");
// }

// else {
//     print("No links.");
// }





// we delete all contents of tags which are displayed none (and all tags which are inside).
// IMPRTANT§ /xms permet de récupérer les balises imbriquées dans une balise.
//
// $body = preg_replace("/<\s*[a-zA-Z]{2,3}\s+[^>]*style\s*=\s*[\"']?([^\"' >]*)display:none([^\"' >]*)[\"' >](.*)<\/[a-zA-Z]{2,3}>/xsm", '', $body);


////////////////////////////////////////////////////////////////////////////////////////////////////////