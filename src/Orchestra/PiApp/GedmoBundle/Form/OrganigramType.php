<?php
/**
 * This file is part of the <PI_CRUD> project.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 20XX-XX-XX
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\GedmoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Description of the OrganigramType form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class OrganigramType extends AbstractType
{
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $_em;
	
	/**
	 * Constructor.
	 *
	 * @param \Doctrine\ORM\EntityManager $em
	 * @return void
	 */
	public function __construct(EntityManager $em)
	{
		$this->_em = $em;
	}
		
    public function buildForm(FormBuilder $builder, array $options)
    {
    	$choiceList = $this->_em->getRepository("PiAppGedmoBundle:Organigram")->getArrayAllCategory();
    	if(!isset($choiceList) || !count($choiceList))
    		$choiceList = array();
    	
        $builder            
 			->add('enabled', 'checkbox', array(
	        		'data'  => true,
	        ))          
        	//->add('slug')            
	        ->add('page', 'entity', array(
            		'class' => 'PiAppAdminBundle:Page',
            		'query_builder' => function(EntityRepository $er) {
	            		return $er->getAllPageHtml();
		            },
		            'property' => 'route_name',
		            'empty_value' => 'Choose an option',
		            'multiple'	=> false,
		            'required'  => false,
		            "attr" => array(
		            		"class"=>"pi_simpleselect",
		            ),		            
            ))
	        ->add('category', 'choice', array(
	        		'choices'   => $choiceList,
			        'multiple'	=> false,
			        'required'  => false,
			        'empty_value' => 'Choose a type',
			        "attr" => array(
			        		"class"=>"pi_simpleselect",
		        	),
	        ))
	        ->add('categoryother', 'text', array(
	        		'label'=>'ou',
	        		'required'  => false,
	        ))           
 			->add('parent', 'entity', array(
	        		'class' => 'PiAppGedmoBundle:Organigram',
	        		'query_builder' => function(EntityRepository $er) {
	        		return $er->createQueryBuilder('k')
		        		->select('k')
		        		->orderBy('k.lft', 'ASC');
			        },
			        'empty_value' => 'Choose an option',
			        'multiple'	=> false,
			        'required'  => false,
			        "attr" => array(
			        		"class"=>"pi_simpleselect",
			        ),
	        ))
	        ->add('title')
	        ->add('descriptif')
	        ->add('question')
	        ->add('content', 'textarea', array(
	        		"attr" => array(
	        				"class"	=>"pi_editor",
	        		),
	        ))	        
	        ->add('media', new \PiApp\GedmoBundle\Form\MediaType($this->_em, 'image', 'image_collection', "simpleLink", 'pi.menu.form.picture'))
        ;
    }

    public function getName()
    {
        return 'piapp_gedmobundle_organigramtype';
    }
        
}
