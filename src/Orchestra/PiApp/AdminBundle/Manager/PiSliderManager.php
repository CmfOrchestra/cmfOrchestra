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
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-04-25
	 */
	public function renderSource($id, $lang = '', $params = null)
	{
		str_replace('~', '~', $id, $count);
		if($count == 2)
			list($entity, $method, $category) = explode('~', $id);
		elseif($count == 1)
			list($entity, $method) = explode('~', $id);
		else
			throw new \InvalidArgumentException("you have not configure correctly the attibute id");
		
		if(is_array($params)){
			$this->recursive_map($params);
		}else{
			$params	= $this->paramsDecode($params);
		}
		
		//print_r($params);exit;
		
		$params['locale']	= $lang;
		
		if( isset($GLOBALS['JQUERY']['SLIDER'][$method]) && $this->container->has($GLOBALS['JQUERY']['SLIDER'][$method]) )
			return $this->container->get('pi_app_admin.twig.extension.jquery')->FactoryFunction('SLIDER', $method, $params);
		else
			throw new \InvalidArgumentException("you have not configure correctly the attibute id");
	}
	
	/**
	 * Return the build slide result of a slider entity
	 *
	 * @param string	$locale
	 * @param string	$entity
	 * @param string	$category
	 * @param string	$template
	 * @return string
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-05-03
	 */
	public function getSlider($locale, $entity, $category, $template, $parameters = null)
	{
		$em		   = $this->container->get('doctrine')->getEntityManager();
		
		if(isset($parameters['orderby_date']) && !empty($parameters['orderby_date']))
			$ORDER_PublishDate = $parameters['orderby_date'];
		else
			$ORDER_PublishDate = '';
		
		if(isset($parameters['orderby_position']) && !empty($parameters['orderby_position']))
			$ORDER_Position = $parameters['orderby_position'];
		else
			$ORDER_Position = '';		
		
		if(empty($ORDER_PublishDate) && empty($ORDER_Position)){
			$ORDER_Position = 'ASC';
		}
		
		$query		= $em->getRepository("PiAppGedmoBundle:$entity")->getAllByCategory($category, null, $ORDER_PublishDate, $ORDER_Position, true)->getQuery();
		$allslides  = $em->getRepository("PiAppGedmoBundle:$entity")->findTranslationsByQuery($locale, $query, 'object', false);
		//$allslides = $em->getRepository("PiAppGedmoBundle:$entity")->getAllByCategory($locale, $category, 'object');
		
		$_content 	= "";
		$RouteNames = null;
		foreach($allslides as $key => $slide){
			$position	   = $slide->getPosition() - 1;			
			if(method_exists($slide, 'getPage') && ($slide->getPage() instanceof \PiApp\AdminBundle\Entity\Page) ){
				$RouteNames[$position]  = $slide->getPage()->getRouteName();
			}else
				$RouteNames[$position] = "";
			
			$parameters['slide']  = $slide;
			$parameters['lang']	  = $locale;
			
			$templateContent = $this->container->get('twig')->loadTemplate("PiAppTemplateBundle:Template\\Slider:$template");
			if($templateContent->hasBlock("boucle")){
				$_content	.= $templateContent->renderBlock("boucle", $parameters) . " \n";
			}else{
				$response 	 = $this->container->get('templating')->renderResponse("PiAppTemplateBundle:Template\\Slider:$template", $parameters);
				$_content 	.= $response->getContent() . " \n";
			}			
		}
		
		return array('content'=>$_content, 'routenames'=>$RouteNames);		
	}	
}