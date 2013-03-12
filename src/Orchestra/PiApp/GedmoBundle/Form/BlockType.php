<?php
/**
 * This file is part of the <PI_CRUD> project.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-07-31
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
 * Description of the BlockType form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class BlockType extends AbstractType
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
	 * @return void
	 */
	public function __construct(EntityManager $em, $locale, ContainerInterface $container)
	{
		$this->_em 			= $em;
		$this->_container 	= $container;
		$this->_locale		= $locale;		
	}
		
    public function buildForm(FormBuilder $builder, array $options)
    {
    	$is_enabled		= true;
    	$is_category	= true;
    	$is_title		= true;
    	$is_descriptif	= true;
    	$is_content		= true;
    	$is_author		= true;
    	$is_page		= true;
    	$is_media		= true;
    	$is_media1		= true;
    	    	
    	$template   	= $this->_container->get('request')->query->get('template');
    	
    	if(in_array($template, array('_tmp_show-block-tpl1.html.twig','_tmp_show-block-tpl3.html.twig','_tmp_show-block-tpl4.html.twig'))){
	    	$is_enabled		= false;
	    	$is_category	= false;
	    	$is_title		= false;
	    	$is_descriptif	= false;
	    	$is_author		= false;
	    	$is_page		= false;
	    	$is_media1		= false;
    	}
    	if(in_array($template, array('_tmp_show-block-tpl2.html.twig','_tmp_show-block-tpl5.html.twig'))){
    		$is_enabled		= false;
    		$is_category	= false;
    		$is_title		= false;
    		$is_descriptif	= false;
    		$is_author		= false;
    		$is_page		= false;
    	}   
    	if(in_array($template, array('_tmp_show-block-descriptif-left-picture.html.twig','_tmp_show-block-descriptif-right-picture.html.twig','_tmp_lamelee_block_share.html.twig'))){
	    	$is_enabled		= false;
	    	$is_category	= false;
	    	$is_content		= false;
	    	$is_author		= false;
	    	$is_media1		= false;
    	}    	 	
    	if(in_array($template, array('_tmp_show-block-video-left.html.twig','_tmp_show-block-video-right.html.twig','_tmp_mid_block_abo.html.twig','_tmp_mid_block_annonce.html.twig','_tmp_lamelee_block_register_auth.html.twig','_tmp_lamelee_block_register.html.twig'))){
	    	$is_enabled		= false;
	    	$is_category	= false;
	    	$is_content		= false;
	    	$is_author		= false;
	    	$is_media		= false;
	    	$is_media1		= false;
    	}
    	if(in_array($template, array('_tmp_lamelee_block_pub_cubic.html.twig','_tmp_lamelee_block_pub_horiz.html.twig'))){
	    	$is_enabled		= false;
	    	$is_category	= false;
	    	$is_descriptif	= false;
	    	$is_content		= false;
	    	$is_author		= false;
	    	$is_media1		= false;
    	} 
    	if(in_array($template, array('_tmp_lamelee_block_header_thematic.html.twig','_tmp_lamelee_block_header_partner.html.twig'))){
    		$is_enabled		= false;
    		$is_category	= false;
    		$is_content		= false;
    		$is_author		= false;
    		$is_page		= false;
    		$is_media		= false;
    		$is_media1		= false;
    	}
    	if(in_array($template, array('_tmp_mid_block_header_archive.html.twig'))){
	    	$is_enabled		= false;
	    	$is_category	= false;
	    	$is_title		= false;
	    	$is_descriptif	= false;
	    	$is_content		= false;
	    	$is_author		= false;
	    	$is_media		= false;
	    	$is_media1		= false;
    	}    	
    	
    	if($is_enabled)
        	$builder            
 			->add('enabled', 'checkbox', array(
            		'data'  => true,
 					'label'	=> 'pi.form.label.field.enabled',
 					"label_attr" => array(
 							"class"=>"block_collection",
 					),
            )); 
 		else
 			$builder            
 			->add('enabled', 'hidden');      
        
 		if($is_category)
 			$builder
 			->add('category', 'entity', array(
	        		'class' => 'PiAppGedmoBundle:Category',
 					'query_builder' => function(EntityRepository $er) {
 						return $er->createQueryBuilder('k')
 						->select('k')
 						->where('k.type = :type')
 						->orderBy('k.name', 'ASC')
 						->setParameter('type', 1);
 					},
	        		'property' => 'name',
	        		'empty_value' => 'pi.form.label.select.choose.category',
 					'label'	=> "pi.form.label.field.category",
	        		'multiple'	=> false,
	        		'required'  => false,
	        		"attr" => array(
	        				"class"=>"pi_simpleselect",
	        		),
 					"label_attr" => array(
 							"class"=>"block_collection",
 					),
	        ));
 		
 		if($is_title)
 			$builder
 			->add('title', 'text', array(
 					'label'	=> "pi.form.label.field.title",
 					"label_attr" => array(
 							"class"=>"block_collection",
 					),
 			));

 		if($is_descriptif)
 			$builder
 			->add('descriptif', 'textarea', array(
 					'required'  => false,
 					'label'	=> 'pi.form.label.field.description',
 					"attr" => array(
 							"class"	=>"pi_editor_simple_easy",
 					),
 					"label_attr" => array(
 							"class"=>"block_collection",
 					),
 			));

 		if($is_content)
 			$builder
 			->add('content', 'textarea', array(
 					'required'  => false,
            		"attr" => array(
            				"class"	=>"pi_editor_simple_easy",
            		),
 					'label'	=> "pi.form.label.field.content",
 					"label_attr" => array(
 							"class"=>"block_collection",
 					),
            ));

 		if($is_author)
 			$builder
 			->add('author', 'text', array(
 					'required'  => false,
 					"label" 	=> "pi.form.label.field.author",
 					"label_attr" => array(
 							"class"=>"block_collection",
 					), 					
 			));

 		if($is_page)
 			$builder
 			->add('pageurl', 'entity', array(
 					'class' => 'PiAppAdminBundle:Page',
 					'query_builder' => function(EntityRepository $er) {
 						return $er->getAllPageHtml();
 					},
 					'property' => 'route_name',
 					'empty_value' => 'pi.form.label.select.choose.option',
 					'multiple'	=> false,
 					'required'  => false,
 					"label" 	=> "pi.form.label.field.url",
 					"attr" => array(
 							"class"=>"pi_simpleselect",
 					),
 					"label_attr" => array(
 							"class"=>"url_collection",
 					),
 			)) 			           
 			->add('url', 'text', array(
 					'required'  => false,
 					"label" 	=> "pi.form.label.field.or",
 					"label_attr" => array(
 							"class"=>"url_collection",
 					), 					
 			))  
 			->add('url_title', 'text', array(
 					"label" => 'pi.form.label.field.title',
 					"label_attr" => array(
 							"class"=>"url_collection",
 					),
 					'required'  => false,
 			));
 			
 		if($is_media)
 			$builder
 			->add('media', new \PiApp\GedmoBundle\Form\MediaType($this->_container, $this->_em, 'image', 'image_collection', "simpleLink", 'pi.form.label.media.picture'));
 		else
 			$builder
 			->add('media', new \PiApp\GedmoBundle\Form\MediaType($this->_container, $this->_em, 'image', 'image_collection', "hidden", 'pi.form.label.media.picture'));
 			 			                     
 		if($is_media1)
 			$builder
 			->add('media1', new \PiApp\GedmoBundle\Form\MediaType($this->_container, $this->_em, 'image', 'image_collection', "simpleLink", 'pi.form.label.media.picture'));
 		else
 			$builder
 			->add('media1', new \PiApp\GedmoBundle\Form\MediaType($this->_container, $this->_em, 'image', 'image_collection', "hidden", 'pi.form.label.media.picture'));
        
    }

    public function getName()
    {
        return 'piapp_gedmobundle_blocktype';
    }
    
    public function getDefaultOptions(array $options)
    {
    	return array(
    			'data_class' => 'PiApp\GedmoBundle\Entity\Block',
    	);
    }   
        
}
