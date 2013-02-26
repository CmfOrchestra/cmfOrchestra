<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-05-3
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util\PiJquery;

use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\Twig\Extension\PiJqueryExtension;
use PiApp\AdminBundle\Exception\ExtensionException;
use PiApp\AdminBundle\Manager\PiPageManager;
use PiApp\AdminBundle\Manager\PiSliderManager;

/**
 * Slider of the FlexSlider Jquery plugin.
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiFlexSliderManager extends PiJqueryExtension
{
	/**
	 * @var array
	 * @static
	 */
	static $menus = array('default', 'entity', 'listentities');
	
	/**
	 * @var array
	 * @static
	 */
	static $actions = array('renderdefault', 'rendermultislider');
	
		
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
	 * Sets init.
	 *
	 * @access protected
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */	
	protected function init($options = null)
	{
		// css
		//$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/slider/flexslider/css/flexcrollstyles.css");
		
		// js
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/slider/flexslider/js/jquery.flexslider-min.js");
	}	
	
    /**
      * Set progress text for Progress flash dialog.
      *
      * @param	$options	tableau d'options.
      * @access protected
      * @return void
      *
      * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com> 
      */
	protected function render($options = null)
	{
		if(!isset($options['action']) || empty($options['action']) || (isset($options['action']) && !in_array(strtolower($options['action']), self::$actions)) )
			throw ExtensionException::optionValueNotSpecified('action', __CLASS__);
		if(!isset($options['menu']) || empty($options['menu']) || (isset($options['menu']) && !in_array(strtolower($options['menu']), self::$menus)) )
			throw ExtensionException::optionValueNotSpecified('menu', __CLASS__);
		
		$method = strtolower($options['menu']) . "Menu";
		$action = strtolower($options['action']) . "Action";
		
		if(method_exists($this, $method))
			$sliders = $this->$method($options);
		else
			throw ExtensionException::MethodUnDefined($method);

		return $this->$action($sliders, $options);
	}
	
	/**
	 * render chart with a click event.
	 *
	 * @param string	$sliders
	 * @param array		$options
	 * @access private
	 * @return string
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */
	private function renderdefaultAction($sliders, $options = null)
	{
		$em = $this->container->get('doctrine')->getEntityManager();
		
		if(isset($options['params']) && is_array($options['params']) && (count($options['params']) >= 1) ){
			$results = array_map(function($key, $value) {
				if(in_array($value, array("true", "false")))
					return $key .":".$value;
				elseif (preg_match_all("/[a-zA]+/",$value, $matches, PREG_SET_ORDER))
	  				return $key .':"'.$value.'"';
				elseif (preg_match_all("/[0-9]+/",$value, $matches, PREG_SET_ORDER))
					return $key .":".$value;
			}, array_keys($options['params']),array_values($options['params']));
			$params = implode(", \n", $results);
		}else
			$params = '
                    animation: "slide",
                    direction: "horizontal",
                    redirection: false,
					startAt: 0,
                    slideshow: true,
					slideshowSpeed: 6000,
                    animationSpeed: 800,
                    directionNav: true,
                    controlNav: true,
                    pausePlay: true,
					minItems: 1,
					maxItems: 1,						
			';
		
		$startAt = "";
		$match	= $this->container->get('bootstrap.RouteTranslator.factory')->getLocaleRoute($this->locale, array('result' => 'match'));
		$route	= $match['_route'];
		if(isset($GLOBALS['ROUTE']['SLUGGABLE'][ $route ]) && !empty($GLOBALS['ROUTE']['SLUGGABLE'][ $route ])){
			$sluggable_entity 		= $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['entity'];
			$sluggable_field_search = $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_search'];
			$sluggable_title 		= $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_title'];
			$sluggable_resume 		= $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_resume'];
			$sluggable_keywords		= $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_keywords'];
		
			$sluggable_title_tab = array_map(function($value) {
				return ucwords($value);
			}, array_values(explode('_', $sluggable_title)));
			$sluggable_resume_tab = array_map(function($value) {
				return ucwords($value);
			}, array_values(explode('_', $sluggable_resume)));
			$sluggable_keywords_tab = array_map(function($value) {
				return ucwords($value);
			}, array_values(explode('_', $sluggable_keywords)));
		
			$method_title	 	= "get".implode('', $sluggable_title_tab);
			$method_resume 		= "get".implode('', $sluggable_resume_tab);
			$method_keywords 	= "get".implode('', $sluggable_keywords_tab);
				
			if( ($sluggable_field_search == 'id') && isset($match['id']) && !empty($match['id']) ){
				$entity 		= $this->container->get('doctrine')->getEntityManager()->getRepository($sluggable_entity)->findOneByEntity($this->locale, $match['id'], 'object');
	
				if(!is_null($entity)){
					$position 	= $entity->getPosition() - 1;
					if(isset($options['params']['maxItems']) && !empty($options['params']['maxItems']) && ($options['params']['maxItems'] != 0)){
						$mod		= $options['params']['maxItems'];
						$position	= ($position - ($position % $mod)) / $mod;
					}
					$startAt = ",startAt:$position";
				}
			}elseif(array_key_exists($sluggable_field_search, $match) && !empty($match[$sluggable_field_search]) ){
				$object =  $this->container->get('doctrine')->getEntityManager()->getRepository($sluggable_entity)->getContentByField($this->locale, array('content_search' => array($sluggable_field_search =>$match[$sluggable_field_search]), 'field_result'=>$sluggable_title), false);
				if(is_object($object)){
					$id		= $object->getObject()->getId();
					$entity = $this->container->get('doctrine')->getEntityManager()->getRepository($sluggable_entity)->findOneByEntity($this->locale, $id, 'object');
					if(!is_null($entity)){
						$position = $entity->getPosition() - 1;
						if(isset($options['params']['maxItems']) && !empty($options['params']['maxItems']) && ($options['params']['maxItems'] != 0)){
							$mod		= $options['params']['maxItems'];
							$position	= ($position - ($position % $mod)) / $mod;
						}
						$startAt = ",startAt:$position";
					}
				}
			}
		}	
		
		$insert_js = true;
		if(isset($options['id']) && !empty($options['id'])){
			$id_c = "id='{$options['id']}'";
			$id   = "#{$options['id']}";
		}elseif(isset($options['class']) && !empty($options['class'])){
			$id_c = "class='{$options['class']}'";
			$id   = ".{$options['class']}";
		}else{
			$insert_js = false;
		}

		$templateContent = $this->container->get('twig')->loadTemplate("PiAppTemplateBundle:Template\\Slider:{$options['template']}");
		if($templateContent->hasBlock("body")){
			$slider_result	= $templateContent->renderBlock("body", array_merge($options, array('slides'=>$sliders))) . " \n";
		}else{
			$slider_result  = "<div $id_c >";
			$slider_result .= "	<ul class='slides'>";
			if(is_array($sliders['boucle']))
				$slider_result .= 		$sliders['boucle'];
			else
				$slider_result .= 		$sliders['boucle'];
			$slider_result .= "	</ul>";
			$slider_result .= "</div>";
		}
		
		$slider_result	= utf8_decode(mb_convert_encoding($slider_result, "UTF-8", "HTML-ENTITIES"));
		
		// We open the buffer.
		ob_start ();
		?>
			<?php echo $slider_result; ?>
			
			<?php if($insert_js): ?>
			<script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready(function() {
				$("<?php echo $id; ?>").flexslider({
                    <?php echo $params; ?>
                    <?php echo $startAt; ?>

                   <?php if(isset($options['params']['redirection']) && ($options['params']['redirection'] == "true")){ ?>
                    , after: function(){
                        var id = $('#<?php echo $options['id']; ?> .flex-control-nav li a.flex-active').text()-1;

                        <?php foreach($sliders['routenames'] as $pos => $routename){ 
                        if(!empty($routename) && isset($options['params']['startAt']) && ($pos != $options['params']['startAt'])){
                        ?>
                        	if(id==<?php echo $pos; ?>){document.location.href = "<?php echo $this->container->get('router')->generate($routename) ?>";}
                        <?php 
							} 
						}
						?>
                    }
                    <?php } ?>
				});

			});
			//]]>
			</script>
			<?php endif; ?>
		
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
	 * render multi entities by slide
	 *
	 * @param string	$sliders
	 * @param array		$options
	 * @access private
	 * @return string
	 *
	 * @author Stéphan Mascarell <stephan.mascarell@wanadoo.fr>
	 */
	private function rendermultisliderAction($sliders, $options = null)
	{
		if( !isset($options['id']) || empty($options['id']) )
			throw ExtensionException::optionValueNotSpecified('id', __CLASS__);
				
		if(isset($options['params']) && is_array($options['params']) && (count($options['params']) >= 1) ){
			$results = array_map(function($key, $value) {
						if(in_array($value, array("true", "false")))
							return $key .":".$value;
						elseif (preg_match_all("/[a-zA]+/",$value, $matches, PREG_SET_ORDER))
			  				return $key .':"'.$value.'"';
						elseif (preg_match_all("/[0-9]+/",$value, $matches, PREG_SET_ORDER))
							return $key .":".$value;
					  }, array_keys($options['params']),array_values($options['params']));
			$params = implode(", \n", $results);
		}else
			$params = '
                    animation: "slide",
                    direction: "horizontal",
                    redirection: false,
					startAt: 0,
                    slideshow: true,
					slideshowSpeed: 6000,
                    animationSpeed: 800,
                    directionNav: true,
                    controlNav: true,
                    pausePlay: true,
					minItems: 1,
					maxItems: 1,		
			';
		
		$templateContent = $this->container->get('twig')->loadTemplate("PiAppTemplateBundle:Template\\Slider:{$options['template']}");
		if($templateContent->hasBlock("body")){
			$slider_result	= $templateContent->renderBlock("body", array_merge($options, array('content'=>$sliders))) . " \n";
		}else{
			$slider_result  = "<div id='{$options['id']}' >";
			$slider_result .= "	<ul class='slides'>";
			if(is_array($sliders['boucle']))
				$slider_result .= 		$sliders['boucle'];
			else
				$slider_result .= 		$sliders['boucle'];
			$slider_result .= "	</ul>";
			$slider_result .= "</div>";
		}		

		// We open the buffer.
		ob_start ();
		?>
			<?php echo $slider_result; ?>
			
			<script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready(function() {
				$("#<?php echo $options['id']; ?>").flexslider({
					 <?php echo $params; ?>
				});
			});
			//]]>
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
	 * Define all slides of a category of a slider entity.
	 *
	 * <code>
	 *
	 *  {% set options_slider = {
	 *  	 'action':'renderDefault',
	 *  	 'menu': 'default',
	 *  	 'imgs':{
	 *  				'0':{'title':'title', 'url':'{{ asset('bundles/piappadmin/images/layout/novedia/FOCUS/focus-novedia.png') }}' },
	 * 					'1':{'title':'title', 'url':'{{ asset(bundles/piappadmin/images/layout/novedia/FOCUS/focus-canalplus.jpg') }}' },
	 * 					'2':{'title':'title', 'url':'{{ asset(bundles/piappadmin/images/layout/novedia/FOCUS/focus-fnac.jpg') }}' },
	 *  			},
	 *  	 'id':'orga' } %}
	 *  {{ renderJquery('SLIDER', 'slide-default', options_slider )|raw }}
	 *
	 * <code>
	 *
	 * @param	array $options
	 * @access public
	 * @return string
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */
	public function defaultMenu($options = null)
	{
		if( !isset($options['imgs']) || empty($options['imgs']) )
			throw ExtensionException::optionValueNotSpecified('imgs', __CLASS__);

		$content = "";
		foreach($options['imgs'] as $key => $img){
			$content .= "<li><img src='".$img['url']."' title='".$img['title']."' /></li>";
		}	
		
		return $content;
	}	
	
	/**
	 * Define all slides of a category of a slider entity.
	 *
	 * <code>
	 *
	 *  {% set options_slider = {
	 *  	 'entity':'Slider',
	 *  	 'category':'Menuwrapper',
	 *  	 'action':'renderDefault',
	 *  	 'menu': 'default',
	 *  	 'id':'orga' } %}
	 *  {{ renderJquery('SLIDER', 'slide-default', options_slider )|raw }}
	 *
	 * <code>
	 * 
	 * @param	array $options
	 * @access public
	 * @return string
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */
	public function entityMenu($options = null)
	{
		if( !isset($options['entity']) || empty($options['entity']) )
			throw ExtensionException::optionValueNotSpecified('entity', __CLASS__);
		if( !isset($options['category']) )
			throw ExtensionException::optionValueNotSpecified('category', __CLASS__);
		
		if( !isset($options['locale']) )
			$locale	= $this->container->get('session')->getLocale();
		else
			$locale = $options['locale'];
		
		if( !isset($options['template']) || empty($options['template']) )
			$options['template']	= 'slide.html.twig';		

		// we take slides ​​depending on options
		$SliderManager 	= $this->container->get('pi_app_admin.manager.slider');
		if($SliderManager instanceof PiSliderManager){
			return $SliderManager->getSlider($locale, $options['entity'], $options['category'], $options['template'], $options);
		}else
			throw ExtensionException::serviceUndefined('PiSliderManager');		
	}	
	
	/**
	 * renders entities Slider
	 *
	 * @param array		$options
	 * @access public
	 * @return string
	 *
	 * @author Stéphan Mascarell <stephan.mascarell@wanadoo.fr>
	 */
	
	public function listentitiesMenu($options = null)
	{
		if( !isset($options['listenerentity']) || empty($options['listenerentity']) )
			throw ExtensionException::optionValueNotSpecified('listenerentity', __CLASS__);
		else
			$myentity = $options['listenerentity'];
		
		$container		= $this->container;
		$em 			= $container->get('doctrine');
		$lang			= $container->get('session')->getLocale();
		$langParameter  = $lang;
		$entities   	= $em->getRepository($myentity)->getAllEnabled($langParameter, 'object');
	
		$count			= count($entities);
		$content		= "";
		
		foreach($entities as $key => $entity){
			$itemsLeft= $count-$key;
			$endSlider = $key+1 === $count ? true : false ;
	
			if ( $key === 0 || $key%8 === 0){
				$liLoopComplete = true;
				$content.= "<li> \n";
				$content .= "<center> \n";
			}else
				$liLoopComplete = false;
	
			if( $key === 0 || $key%4 === 0 ){
				if( $itemsLeft <4){
					if( $liLoopComplete === true){
						$content .="<section class='slide-line center'> \n";
					}else
						$content .="<section class='slide-line left'> \n";
				}else
					$content .="<section class='slide-line'> \n";
			}
	
			if(method_exists($entity, 'getPage') && ($entity->getPage() instanceof \PiApp\AdminBundle\Entity\Page)){
				$routeName	 = $entity->getPage()->getRouteName();
				$link 		 = $container->get('bootstrap.RouteTranslator.factory')->getRoute($routeName);
				$picture	 = $container->get('sonata.media.twig.extension')->media($entity->getImage(), 'default_small', array('alt' => ''));
			}else{
				$link 		 = "#";
				$picture 	 = "";
			}
			
			if(method_exists($entity, 'getTitle')){
				$title 	 = $entity->translate($langParameter)->getTitle();
			}else{
				$title 	 = "";
			}			
			
			$content 	.= "<a href='$link'>";
			$content 	.= $picture;
			$content 	.= "<div class='infoNews'>{$title}</div>";
			$content 	.= "</a> \n";
	
			if( ($key+1)%4 === 0 || $endSlider === true)
				$content .= "</section> \n";
	
			if( ($key+1)%8 === 0 || $endSlider === true){
				$content .= "</center>";
				$content .= "</li> \n";
			}			
		}
	
		return $content;
	}	
}