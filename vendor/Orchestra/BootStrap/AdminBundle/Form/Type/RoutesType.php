<?php
/**
 * This file is part of the <Admin> project.
 * 
 * @category   Admin_Form
 * @package    Form
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2011-11-17
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\Options;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Routes
 *
 * @category   Admin_Form
 * @package    Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class RoutesType extends AbstractType
{
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	private $container;

	/**
	 * Constructor.
	 *
	 * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
	 */	
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	parent::buildForm($builder, $options);
    }
    
    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
    	parent::buildView($view, $form, $options);
    
    	$attr = $view->vars['attr'];
    	$view->vars['attr'] = $attr;
    }    

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
    	parent::setDefaultOptions($resolver);
        	
        $routeCollection = $this->container->get('router')->getRouteCollection();
    	$routes = array();
    	foreach ($routeCollection->all() as $name => $route) {
    		$routes[$name] = $name; // $route->compile();
    	}
    	krsort($routes);
        
    	$resolver->setDefaults(array(
    			'choices' => function (Options $options, $parentChoices) use ($routes) {
    				return empty($parentChoices) ? $routes : array();
    			},
    	));
    }
    
    public function getParent()
    {
    	return 'choice';
    }    
    
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
    	return 'bootstrap_routes';
    }    
}