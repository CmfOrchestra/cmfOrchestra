<?php
/**
 * This file is part of the <Translation> project.
 *
 * @category   BootStrap_Repositories
 * @package    Repository
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-03-09
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\TranslationBundle\Translator;

use Doctrine\Common\Collections\Collection;

/**
 * Proxy Translator
 *
 * @category   BootStrap_Repositories
 * @package    Repository
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class TranslationProxy
{
    protected $locale;
    protected $translatable;
    protected $fields = array();
    protected $class;
    protected $coll;

    /**
     * Initializes translations collection
     *
     * @param   Object      $translatable   object to translate
     * @param   string      $locale         translation name
     * @param   array       $fields            object $fields to translate
     * @param   string      $class          translation entity|document class
     * @param   Collection  $coll           translations collection
     */
    public function __construct($translatable, $locale, array $fields, $class, Collection $coll)
    {
        $this->translatable = $translatable;
        $this->locale       = $locale;
        $this->fields        = $fields;
        $this->class        = $class;
        $this->coll         = $coll;

        $translationClass = new \ReflectionClass($class);
        
        if (!$translationClass->isSubclassOf('Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation')) {
            throw new \InvalidArgumentException(sprintf(
                'Translation class should extend Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation, "%s" given',
                $class
            ));
        }
    }

    public function __call($method, $arguments)
    {
        $matches = array();
        if (preg_match('/^(set|get)(.*)$/', $method, $matches)) {
            $property = lcfirst($matches[2]);

            if (in_array($property, $this->fields)) {
                switch ($matches[1]) {
                    case 'get':
                        return $this->getTranslatedValue($property);
                    case 'set':
                        if (isset($arguments[0])) {
                            $this->setTranslatedValue($property, $arguments[0]);
                            return $this;
                        }
                }
            }
        }

        $return = call_user_func_array(array($this->translatable, $method), $arguments);

        if ($this->translatable === $return) {
            return $this;
        }

        return $return;
    }

    public function __get($field)
    {
        if (in_array($field, $this->fields)) {
            if (method_exists($this, $getter = 'get'.ucfirst($field))) {
                return $this->$getter;
            }

            return $this->getTranslatedValue($field);
        }

        return $this->translatable->$field;
    }

    public function __set($field, $value)
    {
        if (in_array($field, $this->fields)) {
            if (method_exists($this, $setter = 'set'.ucfirst($field))) {
                return $this->$setter($value);
            }

            return $this->setTranslatedValue($field, $value);
        }

        $this->translatable->$field = $value;
    }

    /**
     * Returns locale name for the current translation proxy instance.
     *
     * @return  string
     */
    public function getProxyLocale()
    {
        return $this->locale;
    }

    /**
     * Returns translated value for specific property.
     *
     * @param   string  $property   property name
     *
     * @return  mixed
     */
    public function getTranslatedValue($field)
    {
        return $this
            ->findOrCreateTranslationForProperty($field, $this->getProxyLocale())
            ->getContent();
    }

    /**
     * Sets translated value for specific property.
     *
     * @param   string  $property   property name
     * @param   string  $value      value
     */
    public function setTranslatedValue($field, $value)
    {
        $this
            ->findOrCreateTranslationForProperty($field, $this->getProxyLocale())
            ->setContent($value);
    }

    /**
     * Finds existing or creates new translation for specified property
     *
     * @param   string  $property   object property name
     * @param   string  $locale     locale name
     *
     * @return  Translation
     */
    private function findOrCreateTranslationForProperty($field, $locale)
    {
        foreach ($this->coll as $translation) {
            if ($locale === $translation->getLocale() && $field === $translation->getField()) {
                return $translation;
            }
        }

        $translation = new $this->class;
        $translation->setObject($this->translatable);
        $translation->setField($field);
        $translation->setLocale($locale);
        $this->coll->add($translation);

        return $translation;
    }
}
