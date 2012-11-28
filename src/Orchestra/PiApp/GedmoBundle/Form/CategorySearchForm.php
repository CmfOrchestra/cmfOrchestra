<?php
/**
 * This file is part of the <PI_CRUD> project.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-04-20
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\GedmoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormBuilder;

/**
 * Description of the OrganigramType form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
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
    	if($this->_entity == 'Menu')	$choiceList = 5;
    	if($this->_entity == 'Slider')	$choiceList = 4;
    	if($this->_entity == 'Content')	$choiceList = 3;
    	if($this->_entity == 'Media')	$choiceList = 2;
    	if($this->_entity == 'Block')	$choiceList = 1;
    	if($this->_entity == 'Contact')	$choiceList = 0;
    	
        $builder
        	->add('category', 'entity', array(
	        		'class' => 'PiAppGedmoBundle:Category',
	        		'query_builder' => function(EntityRepository $er) use($choiceList) {
	        			return $er->createQueryBuilder('k')
	        			->select('k')
	        			->where('k.type = :type')
	        			->orderBy('k.name', 'ASC')
	        			->setParameter('type', $choiceList);
	        		},
	        		'property' => 'name',
	        		'empty_value' => 'pi.form.label.select.choose.category',
	        		'label'	=> "pi.form.label.field.category",
	        		'multiple'	=> false,
	        		'required'  => false,
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