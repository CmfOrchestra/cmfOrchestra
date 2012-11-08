<?php
/**
 * This file is part of the <PI_CRUD> project.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-04-20
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\GedmoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormBuilder;

/**
 * Description of the OrganigramType form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class CategorySearchForm extends AbstractType
{
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $_em;
	
	/**
	 * @var string
	 */
	protected $_entity;	
	
	/**
	 * Constructor.
	 *
	 * @param \Doctrine\ORM\EntityManager $em
	 * @return void
	 */
	public function __construct(EntityManager $em, $entity)
	{
		$this->_em 		= $em;
		$this->_entity 	= ucfirst(strtolower($entity));
	}
		
    public function buildForm(FormBuilder $builder, array $options)
    {       
    	$choiceList = $this->_em->getRepository("PiAppGedmoBundle:$this->_entity")->getArrayAllCategory();
    	if(!isset($choiceList) || !count($choiceList))
    		$choiceList = array();
    	    	 
        $builder
        	->add('category', 'choice', array(
	        		'choices'   => $choiceList,
			        'multiple'	=> false,
			        'required'  => false,
			        'empty_value' => 'pi.form.label.select.choose.category',
        			'label'	=> "pi.form.label.field.category",
			        "attr" => array(
			        		"class"=>"pi_simpleselect",
		        	),
	        ));
    }
	
    public function getName()
    {
        return 'categorysearch';
    }	
}