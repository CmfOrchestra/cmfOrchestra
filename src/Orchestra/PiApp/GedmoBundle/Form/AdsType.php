<?php
/**
 * This file is part of the <PI_CRUD> project.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 20XX-XX-XX
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\GedmoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Description of the AdsType form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class AdsType extends AbstractType
{
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $_em;
	
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	protected $_container;	
	
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
	public function __construct(EntityManager $em, ContainerInterface $container)
	{
		$this->_em 			= $em;
		$this->_locale		= $container->get('session')->getLocale();
		$this->_container 	= $container;
	}
		
    public function buildForm(FormBuilder $builder, array $options)
    {
    	//$choiceList = $this->_em->getRepository("bundle:entity")->getArrayAllCategory();
    	//if(!isset($choiceList) || !count($choiceList))
    	//	$choiceList = array();
    	
        $builder 			
 			->add('status') 			
 			->add('typology') 			
 			->add('title', 'text', array(
 					'label'	=> "pi.form.label.field.title",
 					"label_attr" => array(
 							"class"=>"text_collection",
 					),
 					'required'  => false,
 			)) 			
 			->add('content', 'textarea', array(
 					'label'	=> "pi.form.label.field.content",
 					"label_attr" => array(
 							"class"=>"text_collection",
 					), 	
 					"attr" => array(
 							"class"	=>"pi_editor_simple",
 					),
 					'required'  => false,
 			)) 			
 			->add('author') 			
 			->add('expired_at') 			
 			->add('created_at', 'date', array(
 					'widget' => 'single_text', // choice, text, single_text
 					'input' => 'datetime',
 					'format' => $this->_container->get('pi_app_admin.twig.extension.tool')->getDatePatternByLocalFunction($this->_locale),// 'dd/MM/yyyy', 'MM/dd/yyyy',
 					'required'  => false,
 					"attr" => array(
 							"class"=>"pi_datepicker",
 					),
 					'label'	=> 'pi.form.label.date.creation',
 			)) 			
 			->add('updated_at', 'date', array(
 					'widget' => 'single_text', // choice, text, single_text
 					'input' => 'datetime',
 					'format' => $this->_container->get('pi_app_admin.twig.extension.tool')->getDatePatternByLocalFunction($this->_locale),// 'dd/MM/yyyy', 'MM/dd/yyyy',
 					'required'  => false,
 					"attr" => array(
 							"class"=>"pi_datepicker",
 					),
 					'label'	=> 'pi.form.label.date.updating',
 			)) 			
 			->add('published_at', 'date', array(
 					'widget' => 'single_text', // choice, text, single_text
 					'input' => 'datetime',
 					'format' => $this->_container->get('pi_app_admin.twig.extension.tool')->getDatePatternByLocalFunction($this->_locale),// 'dd/MM/yyyy', 'MM/dd/yyyy',
 					'required'  => false,
 					"attr" => array(
 							"class"=>"pi_datepicker",
 					),
 					'label'	=> 'pi.form.label.date.publication',
 			)) 			
 			->add('archive_at', 'date', array(
 					'widget' => 'single_text', // choice, text, single_text
 					'input' => 'datetime',
 					'format' => $this->_container->get('pi_app_admin.twig.extension.tool')->getDatePatternByLocalFunction($this->_locale),// 'dd/MM/yyyy', 'MM/dd/yyyy',
 					'required'  => false,
 					"attr" => array(
 							"class"=>"pi_datepicker",
 					),
 					'label'	=> 'pi.form.label.date.archivage',
 			))        	
 			->add('enabled', 'checkbox', array(
            		'data'  => true,
 					'label'	=> 'pi.form.label.field.enabled',
            )) 			
 			->add('position') 			
 			->add('user') 			
 			->add('media', new \PiApp\GedmoBundle\Form\MediaType($this->_em, 'image', 'image_collection', "simpleLink", 'pi.form.label.media.picture'))
        ;
    }

    public function getName()
    {
        return 'piapp_gedmobundle_adstype';
    }
        
}
