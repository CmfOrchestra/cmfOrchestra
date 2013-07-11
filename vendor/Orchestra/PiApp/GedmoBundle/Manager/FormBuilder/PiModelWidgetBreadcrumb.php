<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Managers
 * @package    Page
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2013-03-10
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\GedmoBundle\Manager\FormBuilder;  

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormBuilderInterface;

use PiApp\AdminBundle\Manager\PiFormBuilderManager;
use PiApp\AdminBundle\Twig\Extension\PiWidgetExtension;
        
/**
* Description of the Form builder manager
*
* @category   Admin_Managers
* @package    Page
*
* @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
*/
class PiModelWidgetBreadcrumb extends PiFormBuilderManager
{
	/**
	 * Type form name.
	 */
	const FORM_TYPE_NAME = 'symfony';
	
	/**
	 * Template form name.
	 */
	const FORM_DECORATOR = 'model_form_builder.html.twig';

	/**
	 * Form name.
	 */
	const FORM_NAME = 'formbuilder';	
	
	/**
	 * Constructor.
	 *
	 * @param \Symfony\Component\DependencyInjection\ContainerInterface
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function __construct(ContainerInterface $containerService)
	{
		parent::__construct($containerService, 'WIDGET', 'breadcrumb', $this::FORM_TYPE_NAME, $this::FORM_DECORATOR, $this::FORM_NAME);
	}
	
	/**
	 * Return list of available content types for all type pages.
	 *
	 * @param  array	$options
	 * @return array
	 * @access public
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function getContents()
	{
		return array(
				PiFormBuilderManager::CONTENT_RENDER_TITLE	=> "Breadcrumb",
				PiFormBuilderManager::CONTENT_RENDER_DESC   => "Séléctionner un lien",
		);
	}

	/**
	 * Chargement du template de formulaire.
	 *
	 * @access protected
	 * @return string
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
    	$nodes 		= $this->_em->getRepository("PiAppGedmoBundle:Menu")->getAllTree($this->_locale, '', 'object', false, false, null);
    	
    	$result 	= array();
    	$_boucle 	= array();
    	if (is_array($nodes)) {
    		foreach ($nodes as $key => $node) {
    			try {
    				$nodes_parent	= $this->_em->getRepository("PiAppGedmoBundle:Menu")->getPath($node);
    				foreach($nodes_parent as $key => $parent){
    					$_boucle[] 	= $parent->getTitle();
    				}
    				 
    				$result[ $node->getId() ] = implode(" > ", $_boucle);
    				$_boucle = array();
    			} catch (\Exception $e) {
    			}
    		}
    	}

        $builder
        	->add('id_menu', 'choice', array(
	        		'choices'   => $result,
			        'multiple'	=> false,
			        'required'  => true,
			        'empty_value' => 'pi.form.label.select.choose.block',
			        "attr" => array(
			        		"class"=>"pi_simpleselect",
		        	),
        			"label_attr" => array(
        					"class"=>"insert_collection",
        			),    
        			'label'     => 'Liste des liens menu',
	        ))
	        ->add('template', 'choice', array(
	        		'choices'   => array(
	        				'organigram-breadcrumb.html.twig'			=> 'Default',
	        		),
	        		'multiple'	=> false,
	        		'required'  => true,
	        		'empty_value' => 'pi.form.label.select.choose.template',
	        		"attr" => array(
	        				"class"=>"pi_simpleselect",
	        		),
	        ))	        
        	;
    }
    
    /**
     * Sets JS script.
     *
     * @param	array $options
     * @access public
     * @return void
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function renderScript(array $option) {
	    	// We open the buffer.
	    	ob_start ();
	    	?>
    			<script type="text/javascript">
    			// <![CDATA[
    			// ]]>
    			</script> 
    		<?php
    		// We retrieve the contents of the buffer.
    		$_content = ob_get_contents ();
    		// We clean the buffer.
    		ob_clean ();
    		// We close the buffer.
    		ob_end_flush ();
    		
    		return $_content;
    }		

	/**
	 *
	 *
	 * @access public
	 * @return array		Xml config in array format to create/update a widget.
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */
	public function XmlConfigWidget(array $data)
	{
		return
		array(
				'plugin'	=> 'gedmo',
				'action'	=> 'organigram',
				'xml' 		=> Array (
						"widgets" 	=> Array (
								"gedmo"		=> Array (
										"controller"	=> 'PiAppGedmoBundle:Menu:org-tree-breadcrumb',
										"params"		=> Array (
												"node" 		=> $data['id_menu'],
												"template"	=> $data['template'],
												"cachable"	=> "true",
												"organigram"=> Array(
															"params"		=> Array (
																	"action"=> "renderDefault",
																	"menu"	=> "breadcrumb",
															)
												)
										)
								)
						)
				),
		);
	}	
	
	/**
	 *
	 *
	 * @access public
	 * @return void
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */
	public function preEventBindRequest(){}
	
	/**
	 *
	 *
	 * @access public
	 * @return void
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */
	public function preEventActionForm(array $data){}
	
	/**
	 *
	 *
	 * @access public
	 * @return void
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */
	public function postEventActionForm(array $data){}
		
}