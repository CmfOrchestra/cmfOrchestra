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
class PiModelWidgetConnexion extends PiFormBuilderManager
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
        parent::__construct($containerService, 'WIDGET', 'connexion', $this::FORM_TYPE_NAME, $this::FORM_DECORATOR, $this::FORM_NAME);
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
                PiFormBuilderManager::CONTENT_RENDER_TITLE    => "Connexion",
                PiFormBuilderManager::CONTENT_RENDER_DESC   => "Formulaire de connexion",
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
        $builder
            ->add('template', 'choice', array(
                    'choices'   => array(
                            'connexion.html.twig'                => 'Connexion',
                            'connexion-ajax.html.twig'            => 'Connexion AJAX',
                    ),
                    'multiple'    => false,
                    'required'  => true,
                    'empty_value' => 'pi.form.label.select.choose.template',
                    "attr" => array(
                            "class"=>"pi_simpleselect",
                    ),
            ))
            ->add('choice', 'choice', array(
                    'choices'   => array("true"=>"pi.form.label.field.yes", "false"=>"pi.form.label.field.no"),
                    'data'  => "true",
                    'required'  => false,
                    'multiple'    => false,
                    'expanded' => true,
                    'label'    => "pi.form.label.field.choice",
                    "label_attr" => array(
                            "class"=>"select_choice",
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
     * @return array        Xml config in array format to create/update a widget.
     *
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    public function XmlConfigWidget(array $data)
    {
        return
        array(
                'plugin'    => 'user',
                'action'    => 'connexion',
                'xml'         => Array (
                        "widgets"     => Array (
                                "user"        => Array (
                                        "controller"    => 'BootStrapUserBundle:User:_connexion_default',
                                        "params"        => Array (
                                                "template"             => "PiAppTemplateBundle:Template\\Login\\Security:" . $data['template'],
                                                "referer_redirection"=> $data['choice'],
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