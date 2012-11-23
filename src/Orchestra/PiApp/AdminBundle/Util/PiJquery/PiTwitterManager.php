<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * @author (c) <stephan mascarell> <stephan.mascarell@wanadoo.fr>
 * @since 2012-06-08
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util\PiJquery;

use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\Twig\Extension\PiJqueryExtension;
use PiApp\AdminBundle\Exception\ExtensionException;

/**
 * Backstretch Jquery plugin
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiTwitterManager extends PiJqueryExtension
{
	/**
	 * @var array
	 * @static
	 */
	static $actions = array('rendertwitter', 'rendertwitterwithrss');

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
	 * @author Stephan Mascarell <stephan.mascarell@wanadoo.fr>
	 */	
	protected function init() {
		// js
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/timeago/timeago.js");
	}

	/**
	 * Sets init.
	 *
	 * @access protected
	 * @return void
	 *
	 * @author Stephan Mascarell <stephan.mascarell@wanadoo.fr>
	 * @author <Adel Oustad> <adel.oustad@gmail.com>
	 */	
	protected function render($options = null)
	{
		if(!isset($options['action']) || empty($options['action']) || (isset($options['action']) && !in_array(strtolower($options['action']), self::$actions)))
			throw ExtensionException::optionValueNotSpecified('action', __CLASS__);

		$action = strtolower($options['action']) . "Action";
		
		if(method_exists($this, $action))
			return $articles = $this->$action($options);
		else
			throw ExtensionException::MethodUnDefined($action);		
	}
	
	/**
	 * 
	 * <code>
	 *
	 *  {% set options_twiter = {
	 *  	 'cachable':'true',
	 *  	 'twitter_id': 'Novediagroup',
	 *  	 'action':'rendertwitter',
	 *  	 'retrievalNumber':3,
	 *  	 'template':'twitter.novediagroup.html.twig',
	 *  	} 
	 *  %}
	 *  {{ renderJquery('TWITTER', 'tweets_blog', options_twiter )|raw }}
	 *
	 * <code>
	 * 
	 * @param	$options	tableau d'options.
	 * @access protected
	 * @return void
	 *
	 * @author Stephan Mascarell <stephan.mascarell@wanadoo.fr>
	 */
	protected function rendertwitterAction($options = null)
	{
		if(!isset($options['twitter_id']) || empty($options['twitter_id']))
			throw ExtensionException::optionValueNotSpecified('twitter_id', __CLASS__);
		if(!isset($options['template']) || empty($options['template']))
			throw ExtensionException::optionValueNotSpecified('template', __CLASS__);
				
		$template		 = $options['template'];
		$twitterId 		 = isset($options['twitter_id']) ?$options['twitter_id'] : 'Novediagroup' ;
		$order 			 = isset($options['order']) ? strtolower($options['order']) : "desc";
		$retrievalNumber = isset($options['retrievalNumber']) ?$options['retrievalNumber'] : 5 ;
		$refreshInterval = isset($options['refreshInterval']) ? $options['refreshInterval'] : 60000;
		$jsonUrl 		 = "https://api.twitter.com/1/statuses/user_timeline.json?include_entities=true&include_rts=true&screen_name=$twitterId&count=$retrievalNumber&callback=?";
	
		$response = $this->container
						->get('templating')
						->renderResponse("PiAppTemplateBundle:Template\\Twitter:$template", array('jsonUrl' => $jsonUrl, "order" => $order, 'refreshInterval' => $refreshInterval));
	
		return $_content = $response->getContent()." \n";
	}	

	/**
	 * @param	$options	tableau d'options.
	 * @access protected
	 * @return void
	 *
	 * @author Stephan Mascarell <stephan.mascarell@wanadoo.fr>
	 * @author <Adel Oustad> <adel.oustad@gmail.com>
	 */
	protected function rendertwitterwithrssAction($options = null)
	{
		if(!isset($options['twitter_id']) || empty($options['twitter_id']))
			throw ExtensionException::optionValueNotSpecified('twitter_id', __CLASS__);
		if(!isset($options['template']) || empty($options['template']))
			throw ExtensionException::optionValueNotSpecified('template', __CLASS__);
				
		$template		 = $options['template'];
		$twitterId 		 = isset($options['twitter_id']) ?$options['twitter_id'] : 'Novediagroup' ;
		$order 			 = isset($options['order']) ? strtolower($options['order']) : "desc";
		$retrievalNumber = isset($options['retrievalNumber']) ?$options['retrievalNumber'] : 5 ;
		$refreshInterval = isset($options['refreshInterval']) ? $options['refreshInterval'] : 60000;
		$method_rss		 = isset($options['method_rss']) ? strtolower($options['method_rss']) : "lire_rss_novedia";
		$jsonUrl 		 = "https://api.twitter.com/1/statuses/user_timeline.json?include_entities=true&include_rts=true&screen_name=$twitterId&count=$retrievalNumber&callback=?";
	
		if(method_exists($this, $method_rss))
			$entities_rss = $this->$method_rss();
		else
			$entities_rss = null;
	
		$response = $this->container
					->get('templating')
					->renderResponse("PiAppTemplateBundle:Template\\Twitter:$template", array('jsonUrl' => $jsonUrl, "order" => $order, 'refreshInterval' => $refreshInterval,'entities_rss' => $entities_rss));
	
		return $_content = $response->getContent()." \n";
	}

	/**
	 * Read the Novedia rss flux.
	 * 
	 * @access protected
	 * @return void
	 *
	 * @author <Adel Oustad> <adel.oustad@gmail.com>>
	 */	
	private function lire_rss_novedia()
	{
		$url  = "http://blogtechno.novediagroup.com/feed";
		$url2 = "http://blogmarketing.novediagroup.com/feed";
		
		$i=0;
		
		try {
			$xml = simplexml_load_file($url) ;
			foreach($xml->channel->item as $item) {
				if($i<=1){
					$i++;
					$txt=$item->description;
					$lien=$item->link;
					$auteur=$item->dc_creator;
					$titre=$item->title;
					$date=$item->pubDate;
					$tout[$i]['title']=$titre;
					$tout[$i]['lien']=$lien;
					$txt = explode('<!--fin-->', $txt);
					$tout[$i]['content']=$txt[2];
					$tout[$i]['auteur']=$txt[1];
					$tout[$i]['image']=$txt[0];
					$tout[$i]['getPublishedAt']=$date;
				}
			}
			$xml = simplexml_load_file($url2) ;
			foreach($xml->channel->item as $item) {
				if($i<=2){
					$i++;
					$txt=$item->description;
					$lien=$item->link;
					$auteur=$item->dc_creator;
					$titre=$item->title;
					$date=$item->pubDate;
					$tout[$i]['title']=$titre;
					$tout[$i]['lien']=$lien;
					$txt = explode('<!--fin-->', $txt);
					$tout[$i]['content']=$txt[2];
					$tout[$i]['auteur']=$txt[1];
					$tout[$i]['image']=$txt[0];
					$tout[$i]['getPublishedAt']=$date;
				}
			}
			return $tout;			
		} catch (\Exception $e) {
			return array();
		}
		
	}	
}