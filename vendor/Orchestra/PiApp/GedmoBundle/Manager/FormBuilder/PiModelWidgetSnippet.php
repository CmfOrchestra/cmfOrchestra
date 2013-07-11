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
use PiApp\AdminBundle\Twig\Extension\PiWidgetExtension;
        
/**
* Description of the Form builder manager
*
* @category   Admin_Managers
* @package    Page
*
* @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
*/
class PiModelWidgetSnippet extends PiFormBuilderManager
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
        parent::__construct($containerService, 'WIDGET', 'snippet', $this::FORM_TYPE_NAME, $this::FORM_DECORATOR, $this::FORM_NAME);
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
     */
    public static function getContents()
    {
        return array(
                PiFormBuilderManager::CONTENT_RENDER_TITLE    => "Blocs métier",
                PiFormBuilderManager::CONTENT_RENDER_DESC   => "insérer un bloc métier",
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
        //$choiceList        = $this->_em->getRepository('PiAppAdminBundle:Widget')->findBy(array('block'=>null));
        $choiceList = $this->_em->getRepository('PiAppAdminBundle:Widget')->getAllSnippet(1, "ASC");
        
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
                    'label'    => "pi.form.label.field.choice",
                    "label_attr" => array(
                            "class"=>"select_choice",
                    ),
            ))        
            ->add('id_snippet', 'choice', array(
                    'choices'   => $result,
                    'multiple'    => false,
                    'required'  => true,
                    'empty_value' => 'pi.form.label.select.choose.block',
                    "attr" => array(
                            "class"=>"pi_simpleselect",
                    ),
                    "label_attr" => array(
                            "class"=>"insert_collection",
                    ),    
                    'label'     => 'Liste des blocs métier',
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
    public function renderScript(array $option) {
            // We open the buffer.
            ob_start ();
            ?>
                <script type="text/javascript">
                // <![CDATA[
                jQuery(document).ready(function(){        
                    var  create_content_form  = $(".snippet_collection");
                    var  insert_content_form  = $(".insert_collection");
    
                    create_content_form.parents('.clearfix').hide();
                    $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_id_snippet").attr("required", "required");
                    $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_configCssClass").removeAttr("required");
                    $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_plugin").removeAttr("required");
                    $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_action").removeAttr("required");
                    $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_configXml").removeAttr("required");

                    $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_choice").parents('.clearfix').hide();
    
                    $("input[id='piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_choice_0']").change(function () {
                        if ($(this).is(':checked')){
                            create_content_form.parents('.clearfix').hide();
                            insert_content_form.parents('.clearfix').show();
    
                            $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_id_snippet").attr("required", "required");
                            $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_configCssClass").removeAttr("required");
                            $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_plugin").removeAttr("required");
                            $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_action").removeAttr("required");
                            $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_configXml").removeAttr("required");
                        } else {
                            create_content_form.parents('.clearfix').show();
                            insert_content_form.parents('.clearfix').hide();
    
                            $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_id_snippet").removeAttr("required");
                            $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_configCssClass").attr("required", "required");
                            $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_plugin").attr("required", "required");
                            $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_action").attr("required", "required");
                            $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_configXml").attr("required", "required");
                        }
                       });
                    $("input[id='piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_choice_1']").change(function () {
                        if ($(this).is(':checked')){
                            create_content_form.parents('.clearfix').show();
                            insert_content_form.parents('.clearfix').hide();
    
                            $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_id_snippet").removeAttr("required");
                            $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_configCssClass").attr("required", "required");
                            $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_plugin").attr("required", "required");
                            $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_action").attr("required", "required");
                            $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_configXml").attr("required", "required");
                        } else {
                            create_content_form.parents('.clearfix').hide();
                            insert_content_form.parents('.clearfix').show();
    
                            $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_id_snippet").attr("required", "required");
                            $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_configCssClass").removeAttr("required");
                            $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_plugin").removeAttr("required");
                            $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_action").removeAttr("required");
                            $("#piappgedmobundlemanagerformbuilderpimodelwidgetsnippet_configXml").removeAttr("required");
                        }
                       });
                                          
                });
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
     * @return void
     *
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    public function preEventBindRequest(){
        $this->_createentity    =     new  \PiApp\AdminBundle\Entity\Widget();
        //$this->_form            = $this->container->get('form.factory')->create(new PiModelWidgetBlock($this->container));
    }    
    
    /**
     *
     *
     * @access public
     * @return void
     *
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    public function preEventActionForm(array $data){
        if ($data["choice"] == "create"){
            $this->_createentity->setEnabled(true);
            $this->_createentity->setConfigCssClass($this->_data['configCssClass']);
            $this->_createentity->setPlugin($this->_data['plugin']);
            $this->_createentity->setAction($this->_data['action']);
            $this->_createentity->setconfigXml($this->_data['configXml']);
            $this->_createentity->setCreatedAt(new \DateTime());
                
            $this->_em->persist($this->_createentity);
            $this->_em->flush();
                
            $this->_data['id_snippet'] = $this->_createentity->getId();
        }
    }

    /**
     *
     *
     * @access public
     * @return void
     *
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    public function postEventActionForm(array $data){}    
    
    /**
     *
     *
     * @access public
     * @return array        Xml config in array format to create/update a widget.
     *
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
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