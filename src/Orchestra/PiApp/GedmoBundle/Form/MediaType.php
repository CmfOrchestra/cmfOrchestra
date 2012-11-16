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
 * Description of the MediaType form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class MediaType extends AbstractType
{
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $_em;
	
	/**
	 * @var string
	 */
	protected $_status;	
	
	/**
	 * @var string
	 */
	protected $_class;	
	
	/**
	 * @var string
	 */
	protected $_simpleLink;	
	
	/**
	 * @var string
	 */
	protected $_labelLink;	
	
	/**
	 * Constructor.
	 *
	 * @param \Doctrine\ORM\EntityManager $em
	 * @param string $status	['file', 'image', 'youtube', 'dailymotion']
	 * @return void
	 */
	public function __construct(EntityManager $em, $status = "image", $class =  "media_collection", $simpleLink = "all", $labelLink = "")
	{
		$this->_em			= $em;
		$this->_status		= $status;
		$this->_class		= $class;
		$this->_simpleLink	= $simpleLink;
		$this->_labelLink	= $labelLink;
	}
		
    public function buildForm(FormBuilder $builder, array $options)
    {
    	$builder
    			->add('status', 'hidden', array(
	    			"data"		=> $this->_status,
	    			"label_attr" => array(
	    					"class"=> $this->_class,
	    			),
	    			'required'  => false,
    			))
    	;
    	
    	if($this->_simpleLink == "all"){
	        $builder            
	 			->add('enabled', 'checkbox', array(
	            		'data'  => true,
	 					'label'	=> 'pi.form.label.field.enabled',
	 					"label_attr" => array(
	 							"class"=> $this->_class,
	 					),
	            ))           
	 			->add('category', 'entity', array(
		        		'class' 		=> 'PiAppGedmoBundle:Category',
		        		'property' 		=> 'name',
		        		'empty_value' 	=> 'pi.form.label.select.choose.category',
		        		'multiple'		=> false,
		        		'required'  	=> false,
		        		"attr" => array(
		        				"class"=>"pi_simpleselect",
		        		),
	 					'label'	=> "pi.form.label.field.category",
	 					"label_attr" => array(
	 							"class"=> $this->_class,
	 					),
		        ))               
	 			->add('title', 'text', array(
	 					'label'			=> "pi.form.label.field.title",
	 					"label_attr" 	=> array(
	 							"class"=> $this->_class,
	 					),
	 					'required'  	=> false,
	 			))            
	 			->add('url', 'text', array(
	 					"label" 	=> "pi.form.label.field.url",
	 					"label_attr" => array(
	 							"class"=> $this->_class,
	 					),
	 					'required'  => false,
	 			))                     
	        ;
    	}elseif($this->_simpleLink == "simpleCategory"){
    		$builder
	    		->add('enabled', 'hidden', array(
	            		'data'  => true,
	 					"label_attr" => array(
	 							"class"=> $this->_class,
	 					),
	            ))   
	    		->add('category', 'entity', array(
			        		'class' => 'PiAppGedmoBundle:Category',
			        		'property' => 'name',
			        		'empty_value' => 'pi.form.label.select.choose.category',
			        		'multiple'	=> false,
			        		'required'  => false,
			        		"attr" => array(
			        				"class"=>"pi_simpleselect",
			        		),
	    					'label'	=> "pi.form.label.field.category",
		 					"label_attr" => array(
		 							"class"=> $this->_class,
		 					),
			    ))
    		;    
    	}elseif($this->_simpleLink == "simpleLink"){
    		$builder
    		->add('enabled', 'hidden', array(
	            		'data'  => true,
	 					"label_attr" => array(
	 							"class"=> $this->_class,
	 					),
	            ))
    		;
    	}
    	
  		if($this->_status == "file"){
 			if($this->_labelLink == "") $this->_labelLink = 'pi.form.label.media.file';
 			$builder->add('image', 'sonata_media_type', array(
 					'provider'  => 'sonata.media.provider.file',
 					'context'   => 'newcontext',
 					'label'		=> $this->_labelLink,
 					"label_attr" => array(
 							"class"=> $this->_class,
 					),
 					'required'  => false,
 			));		
 		}elseif($this->_status == "image"){
 			if($this->_labelLink == "") $this->_labelLink = 'pi.form.label.media.picture'; 			
 			$builder->add('image', 'sonata_media_type', array(
 					'provider' 	=> 'sonata.media.provider.image',
 					'context'  	=> 'newcontext',
 					'label'		=> $this->_labelLink,
 					"label_attr" => array(
 							"class"=> $this->_class,
 					),
 					'required'  => false,
 			));			
 		}elseif($this->_status == "youtube"){
 			if($this->_labelLink == "") $this->_labelLink = 'pi.form.label.media.youtube';
 			$builder->add('image', 'sonata_media_type', array(
 					'provider' 	=> 'sonata.media.provider.youtube',
 					'context'  	=> 'newcontext',
 					'label'		=> $this->_labelLink,
 					"label_attr" => array(
 							"class"=> $this->_class,
 					),
 					'required'  => false,
 			));
 		}elseif($this->_status == "dailymotion"){
 			if($this->_labelLink == "") $this->_labelLink = 'pi.form.label.media.dailymotion';
 			$builder->add('image', 'sonata_media_type', array(
 					'provider' 	=> 'sonata.media.provider.dailymotion',
 					'context'  	=> 'newcontext',
 					'label'		=> $this->_labelLink,
 					"label_attr" => array(
 							"class"=> $this->_class,
 					),
 					'required'  => false,
 			));
 		} 	


 		$builder->add('mediadelete', 'checkbox', array(
 				'data'  => false,
 				'required'  => false,
 				'help_block' => "Action to delete the {$this->_status} media",
 				'label'		=> "pi.delete",
 				"label_attr" => array(
 						"class"=> $this->_class,
 				),
 		)); 		
 		
    }

    public function getName()
    {
        return 'piapp_gedmobundle_mediatype';
    }
    
    public function getDefaultOptions(array $options)
    {
    	return array(
    			'data_class' => 'PiApp\GedmoBundle\Entity\Media',
    	);
    }       
}