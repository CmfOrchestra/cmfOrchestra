<?php
/**
 * This file is part of the <Admin> project.
 * 
 * @category   Admin_Utils
 * @package    Util
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-01-19
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util;

/**
 * Description of string cut manager
 *
 * <code>
 * 	$HtmlCutter	= $container->get('pi_app_admin.string_cut_manager');
 *  $HtmlCutter->setOptions($text, 200);
 *  echo $HtmlCutter->run();
 * </code>
 * 
 * @category   Admin_Utils
 * @package    Util
 * 
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class PiStringCutManager {
	
	/*
	Chaine d'origine
	*/
	private $strChaineOrigine;
	
	/*
	Chaine coupée à la longueur donnée
	*/
	private $strChaineCoupee;
	
	/*
	Caractère ou doit se faire la césure
	Par défaut, un espace
	*/
	private $strCaractereCesure = ' ';
	
	/*
	Messages d'erreur
	*/
	private $strErreur;
	
	/*
	Position de la césure
	*/
	private $intCesurePos;
	
	/*
	 Position du début de la césure
	*/
	private $otherText;	
	private $strChaineotherText = '';
	
	/*
	Position du dernier espace de la chaine coupée
	*/
	private $intDernierCaracCesure;
	
	/*
	Valeur de décrémentation de la taille de la chaine si on est dans une balise
	*/
	private $intDecrementationCesurePos = 5;
	
	/*
	Indique si la césure est bien faite en dehors d'une balise
	Par défaut on considère qu'elle est effectuée au milieu d'une balise
	*/
	private $blnCesureHorsBalise = 0;
	
	/*
	Indique si la chaine est plus courte que la longueur de césure
	Par défaut la chaine est plus longue
	*/
	private $blnChaineTropCourte = 0;
	
	/*
	Pile des balises ouvertes
	*/
	private $t_strBalisesOuvertes;
	
	public function setOptions($strChaineOrigine, $intCesurePos, $otherText = false) {
		$this->strChaineOrigine = $strChaineOrigine;
		$this->intCesurePos		= $intCesurePos;
		$this->otherText		= $otherText;
	}
	
	public function setParams($strCaractereCesure, $intDecrementationCesurePos) {
		$this->strCaractereCesure 			= $strCaractereCesure;
		$this->intDecrementationCesurePos 	= $intDecrementationCesurePos;
	}	

	public function run() {
		$this->VerifierLongueurChaine();
	
		if(!$this->blnChaineTropCourte) {
			$this->ObtenirChaineCoupeeJuste();
			$this->findTags();
			$this->closeTags();
			$strRetour = $this->strChaineCoupee;
		}
		else {
			$strRetour = $this->strChaineOrigine;
		}
	
		if(strlen($this->strErreur) > 2)
			return $this->strErreur;
		else
			return $strRetour;
	}	
	
	/*
	Coupe la chaine d'origine au dernier espace avant la longueur voulue
	*/
	private function CutString(){
		/* Coupe la chaine à la longuer maximale */
		$this->strChaineCoupee = substr($this->strChaineOrigine, 0, $this->intCesurePos);
		/* Extrait la position du dernier caractère de césure de la chaine coupée */
		$this->intDernierCaracCesure = strrpos($this->strChaineCoupee, $this->strCaractereCesure);
		
		/* Si le caractère de césure a été trouvé */
		if($this->intDernierCaracCesure)
			/* Coupe la chaine au dernier espace de sa longueur maximale */
			$this->strChaineCoupee = substr($this->strChaineOrigine, 0, $this->intDernierCaracCesure);
		
		if($this->otherText){
			$this->strChaineotherText = str_replace($this->strChaineCoupee, '', $this->strChaineOrigine);
		}
	}
	
	/*
	Vérifie que la césure n'aie pas été effectuée au milieu d'une balise
	*/
	private function VerifierCesure() {

		/* Parcours toute la chaine depuis la fin */
		for($i=strlen($this->strChaineCoupee)-1; $i>=0; $i--) {

			/* Si on tombe sur une fermeture de balise */
			if($this->strChaineCoupee[$i] == '>' && $this->strChaineCoupee[$i-1] != '\\') {
				/* Alors on est pas dans une balise */
				$this->blnCesureHorsBalise = 1;
				break;
			}
			/* Si on tombe sur une ouverture de balise, alors on est dans une balise */
			elseif($this->strChaineCoupee[$i] == '<' && $this->strChaineCoupee[$i-1] != '\\') {
				/* On le respécifie même si la valeur est censée être à 0 */
				$this->blnCesureHorsBalise = 0;
				break;
			}
			
			/* Si c'est le premier caractère de la chaine */
			if($i==0)
				/* Alors c'est qu'il n'y avait pas de balises du tout */
				$this->blnCesureHorsBalise = 1;
		}
	}
	
	/*
	Vérifie que la chaine soit plus longue que la position de césure
	*/
	private function VerifierLongueurChaine(){
		/* Si la chaine est vide */
		if(strlen($this->strChaineOrigine) == 0)
			/* Indiquer que la chaine est trop courte */
			$this->blnChaineTropCourte = 1;
		/* Si la chaine est plus petite que la position de césure */
		elseif(strlen($this->strChaineOrigine) <= $this->intCesurePos)
			/* Indiquer que la chaine est trop courte */
			$this->blnChaineTropCourte = 1;
		/* Si la chaine est plus grande */
		else
			/* Indiquer que la chaine n'est pas trop courte */
			$this->blnChaineTropCourte = 0;
	}
	
	/*
	Obtient la chaine coupée à un espace en dehors d'une balise
	*/
	private function ObtenirChaineCoupeeJuste() {
		/* Tant que la césure n'est pas effectuée en dehors d'une balise */
		while(!$this->blnCesureHorsBalise) {
			/* Couper la chaine */
			$this->CutString();

			/* Réduire la longueur de la chaine coupée */
			if($this->intCesurePos - $this->intDecrementationCesurePos >= 0) {
				$this->intCesurePos -= $this->intDecrementationCesurePos;
			}
			/* Si on a réduit la position de césure au point de couper toute la chaine, on affiche une erreur */
			/* Peut arriver si la position de césure est courte et qu'il y a une très longue balise au début */
			else {
				$this->strErreur = 'Erreur : la position de la césure est trop courte par rapport à la taille de la chaine.';		
				break;
			}
			$this->VerifierCesure();
		}
	}
	
	private function findTags() {
		
		/* Place toutes les balises ouvrantes dans un tableau */
		$strBalisesOuvrantes = preg_match_all('|<([a-z]+)[^>]*>|i', $this->strChaineCoupee, $t_strBalisesOuvrantes);		
		
		/* Place le résultat dans le tableau de la classe */
		$this->t_strBalisesOuvertes = $t_strBalisesOuvrantes[1];
		
		/* Place toutes les balises fermantes dans un tableau */
		$strBalisesFermantes = preg_match_all('|</([a-z]+)[^>]*>|i', $this->strChaineCoupee, $t_strBalisesFermantes);	
		
		/* Inverse le tableau des balises ouvrantes (vu qu'elles doivent se fermer en ordre inverse) */
		$this->t_strBalisesOuvertes = array_reverse($this->t_strBalisesOuvertes);
		
		/* Parcours le tableau des balises fermantes */
		foreach($t_strBalisesFermantes[1] as $Index => $strBaliseFermante) {
			/* Parcours le tableau des balises ouvrantes */
			foreach($this->t_strBalisesOuvertes as $Index => $strBaliseOuvrante) {
				/* Si le nom de la balise est identique */
				if($strBaliseOuvrante == $strBaliseFermante) {
					/* Supprime la balise de la liste des balises ouvrantes */
					unset($this->t_strBalisesOuvertes[$Index]);
					break;
				}
			}
		}
	}
	
	private function closeTags() {
		/* Pour chaque balise ouverte restante */
		foreach($this->t_strBalisesOuvertes as $strBaliseOuverte)
			/* Ferme la balise */
			$this->strChaineCoupee .= '</' . $strBaliseOuverte . '>';
	}
}

/*
<?
	$page_len=30; //longueur d'une page (en caractères)
	
	//chaîne à diviser en plusieurs pages
	$string="<div>
	azerty<p>
	qsdf,%<b>oiu</b> poi<u>uyt<a href=''>wxcvb 567
	lkjh</a>jhg jhuytrhg kjhkk u ttrrf h.</u>fdsq<br />
	loloploklo
	
	</p></div>a";
	
	//fonctions de division de chaîne
	function callback_empty_tags($in) {
		//echo "'".$in[1]."'|".strlen($in[1])."#";
		return str_pad("",strlen($in[1]));
	}
	function callback_insert_words($in) {
		return (str_pad("",strlen($in[1])).$in[2].str_pad("",strlen($in[3])));
	}
	function callback_add_splitter($in) {
		return ">".wordwrap($in[1],100,"<a></a>")."<";
	}
	function strip_tags_offset(&$string) {
		$string_without_tags=preg_replace_callback("`(<[^>]+>)`","callback_empty_tags",$string);
		return $string_without_tags;
	}
	function string_add_splitters(&$string) {
		$string_splitters=preg_replace_callback("`>([^<]+)<`","callback_add_splitter",$string);
		return $string_splitters;
	}
	function show_page($string,$page_len) {
		$string=string_add_splitters(preg_replace("`(\n|\r)`"," ","<a></a>".$string."<a></a>"));
		$string_without_tags=strip_tags_offset(&$string);
		preg_match_all("`(<[^>]+>)`",$string,$b,PREG_OFFSET_CAPTURE);
		$num0=end($b[1]);
		$num=($num0[1]>$num1[1])?$num0[1]:$num1[1];
		//reset($b[1]);
		$page_total=ceil($num/$page_len);
		$p=1;
		while ($p<=$page_total) {
			$c=$string_without_tags;
			$c=preg_replace_callback("`(.{".($page_len*($p-1))."})(.{0,".$page_len."})(.*)`","callback_insert_words",$c);
			foreach ($b[1] as $k=>$v) {
				$c=substr_replace($c,$v[0],$v[1],strlen($v[0]));
			}
			$out[$p]=preg_replace("`> +<`","><",preg_replace("` {2,}`"," ",$c));
			$p++;
		}
		return $out;
	}
	//
	$out=show_page($string,$page_len);
	echo "<pre>";print_r($out);echo "</pre>";

*/