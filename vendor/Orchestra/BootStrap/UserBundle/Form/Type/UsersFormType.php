<?php
/**
 * This file is part of the <User> project.
 *
 * @category   User_Form
 * @package    Form
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-11-14
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints;

class UsersFormType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
            ->add('enabled', 'checkbox', array(
            		'data'  => true,
            		'label'	=> 'pi.form.label.field.enabled',
            ))      
            ->add('username', 'text', array(
                    'label' => 'pi.form.label.field.username',
                    'constraints' => array(
                    		new Constraints\NotBlank(),
                    ),
            ))
            ->add('email', 'email', array(
                    'label' => 'pi.form.label.field.email',
                    'constraints' => array(
                    		new Constraints\NotBlank(),
                    		new Constraints\Email(),
                    ),
            ))
            ->add('langCode', 'entity', array(
             		'class' => 'PiAppAdminBundle:Langue',
             		'query_builder' => function(EntityRepository $er) {
             			return $er->createQueryBuilder('k')
             			->select('k')
             			->where('k.enabled = :enabled')
             			->orderBy('k.label', 'ASC')
             			->setParameter('enabled', 1);
             		},
             		'property' => 'label',
             		"label"    => "pi.form.label.field.language",
             		"attr" => array(
             				"class"=>"pi_simpleselect",
             		),
            ))     
            ->add('name', 'text', array(
                    'label' => 'pi.form.label.field.name',
                    'constraints' => array(
                    		new Constraints\NotBlank(),
                    ),
            ))
            ->add('nickname', 'text', array(
                    'label' => 'pi.form.label.field.nickname',
                    'constraints' => array(
                    		new Constraints\NotBlank(),
                    ),
            ))
            ->add('groups','entity', array(
                    'label' => 'pi.form.label.field.usergroup',
 					'class' => 'BootStrapUserBundle:Group',
 					'query_builder' => function(EntityRepository $er) {
 						return $er->createQueryBuilder('k')
 						->select('k')
 						->where('k.enabled = :enabled')
 						->orderBy('k.name', 'ASC')
 						->setParameter('enabled', 1);
 					},
 					'property' => 'name',
 					'multiple'	=> true,
                    'expanded'  => false,
 					'required'  => true,
            ))
            ->add('permissions', 'bootstrap_security_permissions', array( 'multiple' => true, 'required' => false))
            ->add('plainPassword', 'repeated', array(
            		'type' => 'password',
            		'options' => array('translation_domain' => 'FOSUserBundle'),
            		'first_options' => array('label' => 'form.password'),
            		'second_options' => array('label' => 'form.password_confirmation'),
            		'invalid_message' => 'fos_user.password.mismatch',
            ))            
          ; 	

            
            $builder
            ->add('accessArticle', 'choice', array(
            		'required'  => false,'expanded' => true,'multiple' => true,
            		'label' => 'Gestion des Articles de contenu',
            		'choices'   => array(
            				'CREATE'=> 'pi.create',
            				'UPDATE' => 'pi.update',
            				'DELETE' => 'pi.delete',
            		),
            		"label_attr" => array("class"=> "content_collection", 'style'=>"padding-top:40px;")
            ))
            ->add('accessDiaporama', 'choice', array(
            		'required'  => false,'expanded' => true,'multiple' => true,
            		'label' => 'Gestion des Diaporamas de contenu',
            		'choices'   => array(
            				'CREATE'=> 'pi.create',
            				'UPDATE' => 'pi.update',
            				'DELETE' => 'pi.delete',
            		),
            		"label_attr" => array("class"=> "content_collection")
            ))
            ->add('accessTest', 'choice', array(
            		'required'  => false,'expanded' => true,'multiple' => true,
            		'label' => 'Gestion des Tests de contenu',
            		'choices'   => array(
            				'CREATE'=> 'pi.create',
            				'UPDATE' => 'pi.update',
            				'DELETE' => 'pi.delete',
            		),
            		"label_attr" => array("class"=> "content_collection")
            ))
            ->add('accessPage', 'choice', array(
            		'required'  => false,'expanded' => true,'multiple' => true,
            		'label' => 'Gestion des Pages CMS',
            		'choices'   => array(
            				'CREATE'=> 'pi.create',
            				'UPDATE' => 'pi.update',
            				'DELETE' => 'pi.delete',
            		),
            		"label_attr" => array("class"=> "content_collection")
            ))
            ->add('accessTag', 'choice', array(
            		'required'  => false,'expanded' => true,'multiple' => true,
            		'label' => 'Gestion des Tags',
            		'choices'   => array(
            				'CREATE'=> 'pi.create',
            				'UPDATE' => 'pi.update',
            				'DELETE' => 'pi.delete',
            		),
            		"label_attr" => array("class"=> "content_collection")
            ))
            ->add('accessRubcont', 'choice', array(
            		'required'  => false,'expanded' => true,'multiple' => true,
            		'label' => 'Gestion des Rubriques de contenu',
            		'choices'   => array(
            				'CREATE'=> 'pi.create',
            				'UPDATE' => 'pi.update',
            				'DELETE' => 'pi.delete',
            		),
            		"label_attr" => array("class"=> "content_collection")
            ));
            
            
            $builder
            ->add('accessProvider', 'choice', array(
            		'required'  => false,'expanded' => true,'multiple' => true,
            		'label' => 'Gestion des Enseignes prestataires',
            		'choices'   => array(
            				'CREATE'=> 'pi.create',
            				'UPDATE' => 'pi.update',
            				'DELETE' => 'pi.delete',
            		),
            		"label_attr" => array("class"=> "provider_collection", 'style'=>"padding-top:40px;")
            ))
            ->add('accessProviderPtv', 'choice', array(
            		'required'  => false,'expanded' => true,'multiple' => true,
            		'label' => 'Gestion des Points de ventes prestataires',
            		'choices'   => array(
            				'CREATE'=> 'pi.create',
            				'UPDATE' => 'pi.update',
            				'DELETE' => 'pi.delete',
            		),
            		"label_attr" => array("class"=> "provider_collection")
            ))
            ->add('accessProviderPdx', 'choice', array(
            		'required'  => false,'expanded' => true,'multiple' => true,
            		'label' => "Gestion des Produits d'un prestataire",
            		'choices'   => array(
            				'CREATE'=> 'pi.create',
            				'UPDATE' => 'pi.update',
            				'DELETE' => 'pi.delete',
            		),
            		"label_attr" => array("class"=> "provider_collection")
            ))
            ->add('accessProviderRegion', 'choice', array(
            		'required'  => false,'expanded' => true,'multiple' => true,
            		'label' => 'Pavé régionalisé',
            		'choices'   => array(
            				'CREATE'=> 'pi.create',
            				'UPDATE' => 'pi.update',
            				'DELETE' => 'pi.delete',
            		),
            		"label_attr" => array("class"=> "provider_collection")
            ))
            ->add('accessRubprest', 'choice', array(
            		'required'  => false,'expanded' => true,'multiple' => true,
            		'label' => 'Gestion des Rubriques prestataires',
            		'choices'   => array(
            				'CREATE'=> 'pi.create',
            				'UPDATE' => 'pi.update',
            				'DELETE' => 'pi.delete',
            		),
            		"label_attr" => array("class"=> "provider_collection")
            ))
            ;
            
            
            $builder
            ->add('accessBlog', 'choice', array(
            		'required'  => false,'expanded' => true,'multiple' => true,
            		'label' => 'Gérer les blogs',
            		'choices'   => array(
            				'CREATE'=> 'pi.create',
            				'UPDATE' => 'pi.update',
            				'DELETE' => 'pi.delete',
            		),
            		"label_attr" => array("class"=> "blog_collection", 'style'=>"padding-top:40px;")
            ))
            ->add('accessCom', 'choice', array(
            		'required'  => false,'expanded' => true,'multiple' => true,
            		'label' => 'Modérer les commentaires',
            		'choices'   => array(
            				'CREATE'=> 'pi.create',
            				'UPDATE' => 'pi.update',
            				'DELETE' => 'pi.delete',
            		),
            		"label_attr" => array("class"=> "blog_collection")
            ));            

	}
	public function getName()
	{
		return 'users_form';
	}
}