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
 * Security Permissions
 *
 * @category   Admin_Form
 * @package    Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class SecurityPermissionsType extends AbstractType
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

        $permissions = array();
            
           //$query = $this->pool->getContainer()->get('bootstrap.user.repository')->findAllEnabled('permission');
           $query = $this->container->get('bootstrap.user.repository')->getRepository('permission')->getAvailablePermissions();
        foreach ($query as $field => $value) {
           if (isset($value['name']) && !isset($permission[ $value['name'] ])) {
               $permissions[ $value['name'] ] = $value['name'];
           }
        }
           
        $resolver->setDefaults(array(
                'choices' => function (Options $options, $parentChoices) use ($permissions) {
                    return empty($parentChoices) ? $permissions : array();
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
        return 'bootstrap_security_permissions';
    }    
}