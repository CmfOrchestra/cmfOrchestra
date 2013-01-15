<?php
/**
 * This file is part of the <PI_CRUD> project.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 20XX-XX-XX
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\GedmoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Description of the IndividualType form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class IndividualType extends AbstractType
{
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $_em;
	
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	protected $_container;	
	
	/**
	 * @var string
	 */
	protected $_locale;	
	
	/**
	 * Constructor.
	 *
	 * @param \Doctrine\ORM\EntityManager $em
	 * @param string	$locale
	 * @return void
	 */
	public function __construct(EntityManager $em, ContainerInterface $container)
	{
		$this->_em 			= $em;
		$this->_locale		= $container->get('session')->getLocale();
		$this->_container 	= $container;
	}
		
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder 			   				
	 		  ->add('enabled', 'checkbox', array(
	 				'data'  => true,
	 				'label'	=> 'pi.form.label.field.enabled',
	 		  ))
	 		  ->add('highlighted', 'checkbox', array(
	 		  		'required'  => false,
	 		  		'data'  => true,
	 		  		'label'	=> 'pi.partner.form.field.highlighted1',
	 		  ))
			  ->add('Name','text', array(
		      		'required'  	=> true,
		 			))
		      ->add('UserName','text', array(
		      		'label'  => 'Identifiant',
		      		'required'  	=> true,        
		 	  ))
		 	  ->add('Nickname','text', array(
		      		'required'  	=> true,        
		 			))

		 	  
		 	  
		 	  ->add('Phone','text', array(
		 			'required'  => true,   
		 	  		"label_attr" => array(
		 	  				"class"=>"contact_collection",
		 	  		),
		 	  ))
		      ->add('Email','text', array(
		 			'required'  => true,
		      		"label_attr" => array(
		      				"class"=>"contact_collection",
		      		),
		 	  ))
		      ->add('EmailPerso','text', array(
		 			'required'  => true,
		      		"label_attr" => array(
		      				"class"=>"contact_collection",
		      		),
		 	  ))    

		 	  
		 	  
		 	  ->add('Company','text', array(
		 			'required'  => true,
		 	  		"label_attr" => array(
		 	  				"class"=>"job_collection",
		 	  		),
		 	  )) 		
		 	  ->add('Job','text', array(
		 			'required'  => true,
		 			"label_attr" => array(
		 				"class"=>"job_collection",
		 			),
		 	  ))
		 	  ->add('Activity', 'choice', array(
		 			'required'  => true,        
				    'choices'   => array(
				            '0' => 'Activité*', 
				            'tic' => 'TIC', 
				            'admin' => 'Administration/Audit/Conseil',
				            'aero' => 'Aéronautique',
				            'agro' => 'Agro-alimentaire',
				            'banque' => 'Banque/Finance',
				            'biens' => 'Biens de consommation',
				            'chimie' => 'Chimie/Pharma/Biotechnologies',
				            'com' => 'Communication/Médias',
				            'divert' => 'Divertissement',
				            'env' => 'Environnement',
				            'fab' => 'Fabrication produits',
				            'elect' => 'Electronique',
				            'indus-def' => 'Industrie Défense/Spatial',
				            'auto' => 'Automobile',
				            'distrib' => 'Distribution',
				            'loisir' => 'Loisirs/Tourisme',
				            'assur' => 'Assurances',
				            'sante' => 'Santé/Hôpitaux',
				            'educ' => 'Education',
				            'ing' => 'Ingénierie',
				            'asso' => 'Associatif',
				            'indus' => 'Industrie',
				            'energie' => 'Energie',
				            'public' => 'Secteur public',
				            'r&d' => 'R & D',
				            'btp' => 'BTP',
				            'service' => 'Service à la personne',
				            'rh' => 'RH',
				            'service-pro' => 'Services aux entreprises',
				            'techno' => 'Technologie',
				            'trans' => 'Transport et logistique',
				            'autre' => 'Autre',
				            ),
		 			"attr" => array(
		 				"class"=>"pi_simpleselect",
		 			),
		 			"label_attr" => array(
		 				"class"=>"job_collection",
		 			),
		 	  )) 
		 	  ->add('Engineering', 'choice', array(
		 			'required'  => false,        
				    'choices'   => array(
				            'telecom'=>'Télécom',
				            'service-info'=>'Services en informatique',
				            'ressources-h'=>'Ressources humaines',
				            'ingenierie-savoirs'=>'Ingénierie des savoirs et de la connaissance',
				            'infra'=>'Infrastructures et reseaux',
				            'info-tech'=>'Informatique technique et métiers',
				            'info-gestion'=>'Informatique de gestion',
				            'form'=>'Formation recherche et développement',
				            'finance'=>'Financement',
				            'entreprise-tic'=>'Entreprise TIC et information sur les TIC',
				            'editeur'=>'Editeur de logiciel',
				            'dev-web'=>'Développement web',
				            'multimedia'=>'Contenu multimédia',
				            'materiel'=>'Constructeur et distributeur de matériel',
				            'conseil'=>'Conseil',
				            'autre'=>'Autre',
				            ),
		 			"attr" => array(
		 				"class"=>"pi_simpleselect",
		 			),
		 			"label_attr" => array(
		 				"class"=>"job_collection",
		 			),
		 	  ))        
		
		 			
		 			
		      ->add('Facebook','text', array(   
		          	'required'  => false,     
		 			"label_attr" => array(
		 				"class"=>"social_collection",
		 			),
		 		))
		      ->add('GooglePlus','text', array( 
		          	'required'  => false,        
		 			"label_attr" => array(
		 				"class"=>"social_collection",
		 			),
		 		))
		      ->add('Twitter','text', array(    
		          	'required'  => false,        
		 			"label_attr" => array(
		 				"class"=>"social_collection",
		 			),
		 		))
		      ->add('LinkedIn','text', array(     
		          	'required'  => false,        
			      	"label_attr" => array(
			      		"class"=>"social_collection",
			      	),      		
		 		))
		      ->add('Viadeo','text', array(       
		          	'required'  => false,        
				    "label_attr" => array(
				    	"class"=>"social_collection",
				    ),      		
		 		))
		 		
		 		
		 	  ->add('pageurl', 'entity', array(
		 				'class' => 'PiAppAdminBundle:Page',
		 				'query_builder' => function(EntityRepository $er) {
		 					return $er->getAllPageHtml();
		 				},
		 				'property' => 'route_name',
		 				'empty_value' => 'pi.form.label.select.choose.option',
		 				"label" 	=> "pi.form.label.field.url",
		 				"label_attr" => array(
		 						"class"=>"page_collection",
		 				),
		 				"attr" => array(
		 						"class"=>"pi_simpleselect",
		 				),
		 				'multiple'	=> false,
		 				'required'  => false,
		 	  ))
		 	  ->add('url', 'text', array(
		 				"label" 	=> "pi.form.label.field.or",
		 				"label_attr" => array(
		 						"class"=>"page_collection",
		 				),
		 				'required'  => false,
		 	  )) 		
		
		 	  //->add('user', new \BootStrap\UserBundle\Form\Type\RegistrationFormType('collection'))
		 	  ->add('media', new \PiApp\GedmoBundle\Form\MediaType($this->_em, 'image', 'image_collection', "simpleLink", 'pi.form.label.media.picture'))
        ;
    }

    public function getName()
    {
        return 'piapp_gedmobundle_individualtype';
    }
        
}
