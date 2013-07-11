<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Managers
 * @package    Page
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-06-26
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\GedmoBundle\Manager\FormBuilder;  

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormBuilderInterface;
use PiApp\AdminBundle\Manager\PiFormBuilderManager;
        
/**
* Description of the Form builder manager
*
* @category   Admin_Managers
* @package    Page
*
* @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
*/
class PiModelWidgetSlide extends PiFormBuilderManager
{
    /**
     * Type form name.
     */
    const FORM_TYPE_NAME = 'symfony';
    
    /**
     * Default decorator file name
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
        parent::__construct($containerService, 'WIDGET', 'slide', $this::FORM_TYPE_NAME, $this::FORM_DECORATOR, $this::FORM_NAME);
    }
    
    /**
     * Return list of available content types for all type pages.
     *
     * @param  array    $options
     * @return array
     * @access public
     * @static
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-06-27
     */
    public static function getContents()
    {
        return array(
                PiFormBuilderManager::CONTENT_RENDER_TITLE    => "Widget Slide",
                PiFormBuilderManager::CONTENT_RENDER_DESC   => "call for inserting a slider",
        );
    }    

    /**
     * Chargement du template de formulaire.
     *
     * @access protected
     * @return string
     *
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     * @since 2012-09-11
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choiceList        = $this->_em->getRepository('PiAppAdminBundle:Widget')->findBy(array('block'=>null));
         
        $result = array();
        if (is_array($choiceList)) {
            foreach ($choiceList as $key => $field) {
                $result[ $field->getId() ] = $field->getConfigCssClass();
            }
        }
    
        $builder
        ->add('choice', 'choice', array(
                'choices'   => array("insert"=>"Insert", "create"=>"Create"),
                'data'  => "insert",
                'required'  => false,
                'multiple'    => false,
                'expanded' => true,
                "label_attr" => array(
                        "class"=>"select_choice",
                ),
        ))
        ->add('id_snippet', 'choice', array(
                'choices'   => $result,
                'multiple'    => false,
                'required'  => true,
                'empty_value' => 'Choice a content',
                "attr" => array(
                        "class"=>"pi_simpleselect",
                ),
                "label_attr" => array(
                        "class"=>"insert_collection",
                ),
        ))
        ->add('configCssClass', 'text', array(
                'label'     => 'Class Name / Snippet Name',
                'required'  => true,
                "label_attr" => array(
                        "class"=>"snippet_collection",
                ),
        ))
        ->add('plugin', 'choice', array(
                'choices'   => PiWidgetExtension::getAvailableWidgetPlugins(),
                'required'  => true,
                'multiple'    => false,
                'expanded'  => false,
                "label_attr" => array(
                        "class"=>"snippet_collection",
                ),
        ))
        ->add('action', 'text', array(
                'required'  => true,
                "label_attr" => array(
                        "class"=>"snippet_collection",
                ),
        ))
        ->add('configXml', 'textarea', array(
                'data'  => PiWidgetExtension::getDefaultConfigXml(),
                'required'  => true,
                "label_attr" => array(
                        "class"=>"snippet_collection",
                ),
        ))
        ;
    }
    
    /**
     * Sets JS script.
     *
     * @param    array $options
     * @access public
     * @return void
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function renderScript(array $option) {}        
    
    /**
     *
     *
     * @access public
     * @return void
     *
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     * @since 2012-09-11
     */
    public function preEventBindRequest(){}    
    
    /**
     *
     *
     * @access public
     * @return void
     *
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     * @since 2012-09-11
     */
    public function preEventActionForm(array $data){
    }

    /**
     *
     *
     * @access public
     * @return void
     *
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     * @since 2012-09-11
     */
    public function postEventActionForm(array $data){}    
    
    /**
     *
     *
     * @access public
     * @return array        Xml config in array format to create/update a widget.
     *
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     * @since 2012-09-11
     */
    public function XmlConfigWidget(array $data)
    {
        return
        array(
                'plugin'    => 'gedmo',
                'action'    => 'snippet',
                'xml'         => Array (
                        "widgets"     => Array (
                                "gedmo"        => Array (
                                        "id"        => $data['id_snippet'],
                                        "snippet"    => 'true'
                                )
                        )
                ),
        );
    }        

}
