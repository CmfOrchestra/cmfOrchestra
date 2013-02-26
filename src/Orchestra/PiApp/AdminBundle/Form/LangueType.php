<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Form
 * @package    CMS_Form
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-07
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * Description of the LangueType form.
 *
 * @category   Admin_Form
 * @package    CMS_Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class LangueType extends AbstractType
{
	/**
	 * @var string
	 */
	protected $_locale;
	
	/**
	 * Constructor.
	 *
	 * @param \Doctrine\ORM\EntityManager $em
	 * @param string	$locale
	 * @return void
	 */
	public function __construct($locale)
	{
		$this->_locale	= $locale;
	}
		
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
        	->add('enabled', 'checkbox', array(
            		'data'  => true,
 					'label'	=> 'pi.form.label.field.enabled',
            ))
            ->add('id', 'choice', array(
            		'choices'   => \PiApp\AdminBundle\Util\PiStringManager::allLocales($this->_locale), //array('fr_FR'=>'fr', 'en_GB'=>'en'),
            		'multiple'	=> false,
            		'required'  => true,
            		'empty_value' => 'pi.form.label.select.choose.option',
            		"attr" => array(
            				"class"=>"pi_simpleselect",
            		),
            		'read_only'	=> true,
            ))
            ->add('label')
        ;
    }

    public function getName()
    {
        return 'piapp_adminbundle_languetype';
    }
}
