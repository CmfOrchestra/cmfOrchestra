<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Managers
 * @package    Manager
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-04-25
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response as Response;

use PiApp\AdminBundle\Builder\PiSliderManagerBuilderInterface;
use PiApp\AdminBundle\Manager\PiCoreManager;
use PiApp\AdminBundle\Entity\Widget;

/**
 * Description of the slider Widget manager
 *
 * @category   Admin_Managers
 * @package    Manager
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiSliderManager extends PiCoreManager implements PiSliderManagerBuilderInterface 
{    
    /**
     * Constructor.
     *
     * @param ContainerInterface $container The service container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    /**
     * Call the slider render source method.
     *
     * @param string $id
     * @param string $lang
     * @param string $params
     * @return string
     * @access    public
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     * @since 2012-04-25
     */
    public function renderSource($id, $lang = '', $params = null)
    {
        str_replace('~', '~', $id, $count);
        if ($count == 2)
            list($entity, $method, $category) = explode('~', $this->_Decode($id));
        elseif ($count == 1)
            list($entity, $method) = explode('~', $this->_Decode($id));
        else
            throw new \InvalidArgumentException("you have not configure correctly the attibute id");
        
        if (!is_array($params))
            $params        = $this->paramsDecode($params);
        else
            $this->recursive_map($params);
        
        $params['locale']    = $lang;
        
        if ( isset($GLOBALS['JQUERY']['SLIDER'][$method]) && $this->container->has($GLOBALS['JQUERY']['SLIDER'][$method]) )
            return $this->container->get('pi_app_admin.twig.extension.jquery')->FactoryFunction('SLIDER', $method, $params);
        else
            throw new \InvalidArgumentException("you have not configure correctly the attibute id");
    }
    
    /**
     * Return the build slide result of a slider entity
     *
     * @param string    $locale
     * @param string    $entity
     * @param string    $category
     * @param string    $template
     * @return string
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-05-03
     */
    public function getSlider($locale, $controller, $category, $template, $parameters = null)
    {
        $em           = $this->container->get('doctrine')->getEntityManager();
        
        if (isset($parameters['boucle_array']) && !empty($parameters['boucle_array']))
            $boucle_array = $parameters['boucle_array'];
        else
            $boucle_array = "false";
        
        // we construct the query.
        if (isset($parameters['query_function']) && !empty($parameters['query_function']))
            $query_function = $parameters['query_function'];
        else
            $query_function = null;        
        
        // we construct the query.
        if (isset($parameters['orderby_date']) && !empty($parameters['orderby_date']))
            $ORDER_PublishDate = $parameters['orderby_date'];
        else
            $ORDER_PublishDate = '';
        
        if (isset($parameters['orderby_position']) && !empty($parameters['orderby_position']))
            $ORDER_Position = $parameters['orderby_position'];
        else
            $ORDER_Position = '';        
        
        if (isset($parameters['MaxResults']) && !empty($parameters['MaxResults']))
            $MaxResults = (int)$parameters['MaxResults'];
        else
            $MaxResults = null;        
        
        if (isset($parameters['enabled']) && !empty($parameters['enabled']))
            $enabled = (int)$parameters['enabled'];
        else
            $enabled = true;        
        
        if (empty($ORDER_PublishDate) && empty($ORDER_Position)){
            $ORDER_Position = 'ASC';
        }
        
        $em->getRepository($controller)->setContainer($this->container);
        if (is_null($query_function)){
            $query    = $em->getRepository($controller)->getAllByCategory($category, $MaxResults, $ORDER_PublishDate, $ORDER_Position, $enabled, false);
        }elseif (method_exists($em->getRepository($controller), $query_function)){
            $query  = $em->getRepository($controller)->$query_function($category, $MaxResults, $ORDER_PublishDate, $ORDER_Position, $enabled);
        }else
            throw new \InvalidArgumentException("The metohd 'query_function' does not exist in the entity's repository {$controller}");
        
        if (isset($parameters['searchFields']) && !empty($parameters['searchFields'])){
            if (count($parameters['searchFields']) == 2 && isset($parameters['searchFields']['nameField'])){
                $query->andWhere('a.'.$parameters['searchFields']['nameField'] .' LIKE :value')
                      ->setParameters(array(
                              'value'   => $parameters['searchFields']['valueField']
                          ));
            }else {
                foreach ($parameters['searchFields'] as $searchFields){
                    $query->andWhere('a.'.$searchFields['nameField'] .' LIKE :'.$searchFields['nameField'])
                          ->setParameters(array(
                                $searchFields['nameField']   => $searchFields['valueField'],
                            ));
                }
            }
        }
        $allslides  = $em->getRepository($controller)->findTranslationsByQuery($locale, $query->getQuery(), 'object', false);        
        
        // we construct all boucles.
        $_boucle     = array();
        $_boucle1     = array();
        $_boucle2     = array();
        $_boucle3     = array();
        $RouteNames = array();
        
        end($allslides);
        $last_key_value = key($allslides);
        reset($allslides);
        foreach($allslides as $key => $slide){
            if (method_exists($slide, 'getPosition')){
                $position       = $slide->getPosition() - 1;            
                if (method_exists($slide, 'getPage') && ($slide->getPage() instanceof \PiApp\AdminBundle\Entity\Page) ){
                    $RouteNames[$position]  = $slide->getPage()->getRouteName();
                }else
                    $RouteNames[$position] = "";
            }
            
            $parameters['slide']  = $slide;
            $parameters['lang']      = $locale;
            $parameters['locale'] = $locale;
            $parameters['key']      = $key;
            $parameters['last']      = $last_key_value;
            
            $templateContent = $this->container->get('twig')->loadTemplate("PiAppTemplateBundle:Template\\Slider:$template");
            
            if ($templateContent->hasBlock("boucle")){
                $_boucle[]    = $templateContent->renderBlock("boucle", $parameters) . " \n";
            }
            if ($templateContent->hasBlock("boucle1")){
                $_boucle1[]    = $templateContent->renderBlock("boucle1", $parameters) . " \n";
            }            
            if ($templateContent->hasBlock("boucle2")){
                $_boucle2[]    = $templateContent->renderBlock("boucle2", $parameters) . " \n";
            }    
            if ($templateContent->hasBlock("boucle3")){
                $_boucle3[]    = $templateContent->renderBlock("boucle3", $parameters) . " \n";
            }

            if (!$templateContent->hasBlock("boucle") 
                && !$templateContent->hasBlock("boucle1")
                && !$templateContent->hasBlock("boucle2")
                && !$templateContent->hasBlock("boucle3")
                ){
                $response     = $this->container->get('templating')->renderResponse("PiAppTemplateBundle:Template\\Slider:$template", $parameters);
                $_boucle[]     = $response->getContent() . " \n";
            }            
        }
        
        if ($boucle_array == "true"){
            return array('boucle'=>$_boucle, 'boucle1'=>$_boucle1, 'boucle2'=>$_boucle2, 'boucle3'=>$_boucle3, 'routenames'=>$RouteNames);
        } else {
            return array('boucle'=>implode(" \n", $_boucle), 'boucle1'=>implode(" \n", $_boucle1), 'boucle2'=>implode(" \n", $_boucle2), 'boucle3'=>implode(" \n", $_boucle3), 'routenames'=>$RouteNames);
        }
    }    
}