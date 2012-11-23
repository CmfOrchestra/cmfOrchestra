<?php
/**
 * This file is part of the <Translation> project.
 *
 * @category   BootStrap_Model
 * @package    Model
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-03-08
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\TranslationBundle\Model;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

use Gedmo\Translatable\Translatable;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation;

/**
 * abstract class for Translation management.
 *
 * @category   BootStrap_Model
 * @package    Model
 * @abstract
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
abstract class AbstractTranslation implements Translatable
{
	/**
	 * @Gedmo\Locale
	 * Used locale to override Translation listener`s locale
	 * this is not a mapped field of entity metadata, just a simple property
	 */
	protected $locale;
		
    /**
     * Constructor
     */    
    public function __construct()
    {
    	$this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    } 	
    
    /**
     *  Get the translations proxy
     *  
     *  <code>
     *  	$entity->translate("fr")->setTitle('Mon Titre');  
     *      $entity->translate("fr")->getTitle();
     *  <code>
     *
     * @return \BootStrap\TranslationBundle\Translator\TranslationProxy
     * @final
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    final public function translate($locale = null)
    {
    	return new \BootStrap\TranslationBundle\Translator\TranslationProxy($this,
    	/* Locale                            */ $locale,
    	/* List of translatable fileds:  */ 	$this->_fields,
    	/* Translation entity class:         */ $this->_translationClass,
    	/* Translations collection property: */ $this->translations
    	);
    }    
    
	/**
	 * Set $locale
	 *
	 * @param string $locale
     * @final
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	final public function setTranslatableLocale($locale)
	{
		$this->locale = $locale;
	}
	
	/**
	 * Get locale
	 *
	 * @return string
     * @final
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	final public function getTranslatableLocale()
	{
		return $this->locale;
	}	
	
	/**
	 *  Get the collection of related translations
	 *
	 * @return \Doctrine\Common\Collections\ArrayCollection
     * @final
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	final public function getTranslations()
	{
		return $this->translations;
	}
	
	/**
	 * Set the collection of related translations
	 *
	 * @param \Doctrine\Common\Collections\ArrayCollection
     * @final
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	final public function setTranslations(\Doctrine\Common\Collections\ArrayCollection $translations)
	{
		$this->translations = $translations;
	}
	
	/**
	 * Add a translation to the collection of related translations
	 *
	 * @param \Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation
     * @final
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	final public function addTranslation(AbstractPersonalTranslation $translation)
	{
		if ($this->translations && !$this->translations->contains($translation)) {
			$this->translations->add($translation);
			$translation->setObject($this);
		}
	}
	
	/**
	 * Remove a translation from the collection of related translations
	 *
	 * @param \Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation
     * @final
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	final public function removeTranslation(AbstractPersonalTranslation $translation)
	{
		if ($this->translations && !$this->translations->contains($translation)) {
			$this->translations->removeElement($translation);
		}
	}
    
}