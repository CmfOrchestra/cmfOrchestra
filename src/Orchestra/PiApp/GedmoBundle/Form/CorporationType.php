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
 * Description of the CorporationType form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class CorporationType extends AbstractType
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
		       		'data'  	=> true,
		       		'label'		=> 'pi.form.label.field.enabled',
		       ))
		      ->add('highlighted', 'checkbox', array(
		       		'required'  => false,
		       		'data'  	=> true,
		       		'label'		=> 'pi.partner.form.field.highlighted1',
		      ))
		      ->add('UserName','text', array(
		      		'label'		=> 'Login',
		      		'required'  => true,        
		 	  ))
	 		  ->add('Name','text', array(
			  		'label'		=> 'pi.form.label.field.name',
		      		'required'  => true,
		 	  ))
		 	  ->add('Nickname','text', array(
		 	  		'label'		=> 'pi.form.label.field.nickname',
		      		'required'  => true,        
		 	  )) 
		 	  ->add('Profile', 'choice', array(
		 	  		'label'	=> 'pi.form.label.field.profile',
		 	  		'required'  => false,
		 	  		'choices'   => array('fournisseur' => 'Fournisseur TIC', 'user' => 'Utilisateur TIC'),
		 	  ))
		 	  ->add('Job','text', array(
		 	  		'label'	=> 'pi.form.label.field.employment.job',
		 	  		'required'  => false,
		 	  ))
	 		  ->add('Civility', 'choice', array(
	 		  			'label'		=> 'pi.form.label.field.civility',
	 					'required'  => false,   
	 		  		    'expanded' => true,
			          	'choices'   => array(
				            '1' => 'Mr', 
				            '2' => 'Mme', 
				            '3' => 'Mlle'
			            ),
	 		  ))  
	 		  ->add('UserPhone','text', array(
	 		  		'label'	=> 'pi.form.label.field.adress.phone',
	 		  		'required'  => false,
	 		  ))
		      ->add('Email','text', array(
		      		'label'	=> 'pi.form.label.field.email',
		      		'required'  => false,
		 	  ))
		      ->add('EmailPerso','text', array(
		      		'label'	=> 'pi.form.label.field.email.perso',
		      		'required'  => false,
		 	  ))
		 	  ->add('url', 'text', array(
		 	  		"label" 	=> "pi.form.label.field.website",
		 	  		'required'  => false,
		 	  ))
 			  
	 			
	 			
	 			
			  ->add('Facebook','text', array( 
		      		'label'	=> 'pi.form.label.field.social.facebook',
		          	'required'  => false,     
		 			"label_attr" => array(
		 				"class"=>"social_collection",
		 			),
		 	  ))
		      ->add('GooglePlus','text', array( 
		      		'label'	=> 'pi.form.label.field.social.googleplus',
		          	'required'  => false,        
		 			"label_attr" => array(
		 				"class"=>"social_collection",
		 			),
		 	  ))
		      ->add('Twitter','text', array(    
		      		'label'	=> 'pi.form.label.field.social.twitter',
		          	'required'  => false,        
		 			"label_attr" => array(
		 				"class"=>"social_collection",
		 			),
		      ))
		      ->add('LinkedIn','text', array(     
		      		'label'	=> 'pi.form.label.field.social.linkedin',
		          	'required'  => false,        
			      	"label_attr" => array(
			      		"class"=>"social_collection",
			      	),      		
		 	  ))
		      ->add('Viadeo','text', array(       
		      		'label'	=> 'pi.form.label.field.social.viadeo',
		          	'required'  => false,        
				    "label_attr" => array(
				    	"class"=>"social_collection",
				    ),      		
		 	  )) 
	 			
	 			
	 			

	      		->add('Address','text', array(    
	      				'label'	=> 'pi.form.label.field.adress.main',
	          			'required'  => false,        
	      				"label_attr" => array(
	      						"class"=>"contact_entre_collection",
	      				),
	 			))  
	      		->add('CP','text', array(    
	      				'label'	=> 'pi.form.label.field.adress.cp',
	          			'required'  => false,        
	      				"label_attr" => array(
	      						"class"=>"contact_entre_collection",
	      				),
	 			))  
	      		->add('City','text', array(     
	      				'label'	=> 'pi.form.label.field.adress.city',
	          			'required'  => false,        
	      				"label_attr" => array(
	      						"class"=>"contact_entre_collection",
	      				),
	 			))  
	      		->add('Country','choice', array(
	      				'label'	=> 'pi.form.label.field.adress.country',
	 					'required'  => false,    
				        'choices'   => \PiApp\AdminBundle\Util\PiStringManager::allCountries($this->_locale),
	      				"attr" => array(
	      						"class"=>"pi_simpleselect",
	      				),
	      				"label_attr" => array(
	      					"class"=>"contact_entre_collection",
	      				),
	 			))  
	      		->add('Phone','text', array(     
	      				'label'	=> 'pi.form.label.field.adress.phone',
	          			'required'  => false,        
	      				"label_attr" => array(
	      						"class"=>"contact_entre_collection",
	      				),
	 			))  
	      		->add('Fax','text', array(       
	      				'label'	=> 'pi.form.label.field.adress.fax',
	          			'required'  => false,        
	      				"label_attr" => array(
	      						"class"=>"contact_entre_collection",
	      				),
	 			)) 
	 			
	 			
	 			
	 			
	      		->add('MotherAddress','text', array(     
	      				'label'	=> 'pi.form.label.field.adress.main',
	          			'required'  => false,        
	      				"label_attr" => array(
	      						"class"=>"contact_mother_collection",
	      				),
	 			)) 
	      		->add('MotherCP','text', array(      
	      				'label'	=> 'pi.form.label.field.adress.cp',
	          			'required'  => false,        
	      				"label_attr" => array(
	      						"class"=>"contact_mother_collection",
	      				),
	 			)) 
	      		->add('MotherCity','text', array(       
	      				'label'	=> 'pi.form.label.field.adress.city',
	          			'required'  => false,        
	      				"label_attr" => array(
	      						"class"=>"contact_mother_collection",
	      				),
	 			)) 
	      		->add('MotherCountry','choice', array(
	      				'label'	=> 'pi.form.label.field.adress.country',
	 					'required'  => false,    
				        'choices'   => \PiApp\AdminBundle\Util\PiStringManager::allCountries($this->_locale),
	      				"attr" => array(
	      						"class"=>"pi_simpleselect",
	      				),
	      				"label_attr" => array(
	      						"class"=>"contact_mother_collection",
	      				),
	 			))  
	      		->add('MotherPhone','text', array(       
	      				'label'	=> 'pi.form.label.field.adress.phone',
	          			'required'  => false,        
	      				"label_attr" => array(
	      						"class"=>"contact_mother_collection",
	      				),
	 			))      
	      		->add('MotherFax','text', array(
	      				'label'	=> 'pi.form.label.field.adress.fax',
	          			'required'  => false,        
	      				"label_attr" => array(
	      						"class"=>"contact_mother_collection",
	      				),
	 			)) 
	 			
	 			
	 			
	 			
	 			->add('InvoiceAddress','text', array(
	 					'label'	=> 'pi.form.label.field.adress.main',
	 					'required'  => false,
	 					"label_attr" => array(
	 							"class"=>"contact_facuration_collection",
	 					),
	 			))
	 			->add('InvoiceCP','text', array(
	 					'label'	=> 'pi.form.label.field.adress.cp',
	 					'required'  => false,
	 					"label_attr" => array(
	 							"class"=>"contact_facuration_collection",
	 					),
	 			))
	 			->add('InvoiceCity','text', array(
	 					'required'  => false,
	 					"label_attr" => array(
	 							"class"=>"contact_facuration_collection",
	 					),
	 			))
	 			->add('InvoiceCountry','choice', array(
	 					'label'	=> 'pi.form.label.field.adress.country',
	 					'required'  => false,
	 					'choices'   => \PiApp\AdminBundle\Util\PiStringManager::allCountries($this->_locale),
	 					"attr" => array(
	 							"class"=>"pi_simpleselect",
	 					),
	 					"label_attr" => array(
	 							"class"=>"contact_facuration_collection",
	 					),
	 			))
	 			->add('InvoicePhone','text', array(
	 					'label'	=> 'pi.form.label.field.adress.phone',
	 					'required'  => false,
	 					"label_attr" => array(
	 							"class"=>"contact_facuration_collection",
	 					),
	 			))
	 			->add('InvoiceFax','text', array(
	 					'label'	=> 'pi.form.label.field.adress.fax',
	 					'required'  => false,
	 					"label_attr" => array(
	 							"class"=>"contact_facuration_collection",
	 					),
	 			))

	 			
	 			

	 			->add('CorporationName','text', array(
	 					'label'	=> 'pi.form.label.field.corporation.name',
	 					'required'  => false,
	 					"label_attr" => array(
	 							"class"=>"job_collection",
	 					),
	 			))
	 			->add('CommercialName','text', array(
	 					'label'	=> 'pi.form.label.field.corporation.name.commercial',
	 					'required'  => false,
	 					"label_attr" => array(
	 							"class"=>"job_collection",
	 					),
	 			))	 			
	 			->add('Activity', 'choice', array(
	 					'label'	=> 'pi.form.label.field.corporation.activity',
	 					'required'  => false,
	 					'choices'   => array(
	 							'0' 								=> 'Activité*',
	 							'TIC' 								=> 'TIC',
	 							'Administration/Audit/Conseil' 		=> 'Administration/Audit/Conseil',
	 							'Aéronautique' 						=> 'Aéronautique',
	 							'Agro-alimentaire' 					=> 'Agro-alimentaire',
	 							'Banque/Finance' 					=> 'Banque/Finance',
	 							'Biens de consommation' 			=> 'Biens de consommation',
	 							'Chimie/Pharma/Biotechnologies' 	=> 'Chimie/Pharma/Biotechnologies',
	 							'Communication/Médias' 				=> 'Communication/Médias',
	 							'Divertissement' 					=> 'Divertissement',
	 							'Environnement' 					=> 'Environnement',
	 							'Fabrication produits' 				=> 'Fabrication produits',
	 							'Electronique' 						=> 'Electronique',
	 							'Industrie Défense/Spatial' 		=> 'Industrie Défense/Spatial',
	 							'Automobile' 						=> 'Automobile',
	 							'Distribution' 						=> 'Distribution',
	 							'Loisirs/Tourisme' 					=> 'Loisirs/Tourisme',
	 							'Assurances'						=> 'Assurances',
	 							'Santé/Hôpitaux'					=> 'Santé/Hôpitaux',
	 							'Education'							=> 'Education',
	 							'Ingénierie'						=> 'Ingénierie',
	 							'Associatif'						=> 'Associatif',
	 							'Industrie'							=> 'Industrie',
	 							'Energie'							=> 'Energie',
	 							'Secteur public'					=> 'Secteur public',
	 							'rR & Dd'							=> 'R & D',
	 							'BTP'								=> 'BTP',
	 							'Service à la personne'				=> 'Service à la personne',
	 							'RH'								=> 'RH',
	 							'Services aux entreprises'			=> 'Services aux entreprises',
	 							'Technologie'						=> 'Technologie',
	 							'Transport et logistique'			=> 'Transport et logistique',
	 							'Autre'								=> 'Autre',
	 					),
	 					"attr" => array(
	 							"class"=>"pi_simpleselect",
	 					),
	 					"label_attr" => array(
	 							"class"=>"job_collection",
	 					),
	 			))
	 			->add('Engineering', 'choice', array(
	 					'label'	=> 'pi.form.label.field.corporation.engineering',
	 					'required'  => false,
	 					'choices'   => array(
	 							'Télécom'										=>'Télécom',
	 							'Services en informatique'						=>'Services en informatique',
	 							'Ressources humaines'							=>'Ressources humaines',
	 							'Ingénierie des savoirs et de la connaissance'	=>'Ingénierie des savoirs et de la connaissance',
	 							'Infrastructures et reseaux'					=>'Infrastructures et reseaux',
	 							'Informatique technique et métiers'				=>'Informatique technique et métiers',
	 							'Informatique de gestion'						=>'Informatique de gestion',
	 							'Formation recherche et développement'			=>'Formation recherche et développement',
	 							'Financement'									=>'Financement',
	 							'Entreprise TIC et information sur les TIC'		=>'Entreprise TIC et information sur les TIC',
	 							'Editeur de logiciel'							=>'Editeur de logiciel',
	 							'Développement web'								=>'Développement web',
	 							'Contenu multimédia'							=>'Contenu multimédia',
	 							'Constructeur et distributeur de matériel'		=>'Constructeur et distributeur de matériel',
	 							'Conseil'										=>'Conseil',
	 							'Autre'											=>'Autre',
	 					),
	 					"attr" => array(
	 							"class"=>"pi_simpleselect",
	 					),
	 					"label_attr" => array(
	 							"class"=>"job_collection",
	 					),
	 			))	 			
	 			->add('DetailActivity', 'text', array(
	 					'label'	=> 'pi.form.label.field.corporation.detailactivity',
	 					'required'  => false,
	 					"label_attr" => array(
	 							"class"=>"job_collection",
	 					),
	 			))
	 			->add('LegalForm','choice', array(
	 					'label'	=> 'pi.form.label.field.corporation.legalform',
	 					'required'  => false,
	 					'choices'   => array(
				            '1' => 'SCOP ou assimilés', 
				            '2' => 'Syndicat', 
				            '3' => 'SA', 
				          	'4' => 'SARL',
				            '5' => 'SAS',
				            '6' => 'Etablissement public', 
				            '7' => 'Entreprise individuelle', 
				            '8' => 'Association',
				            '9' => 'Autre ',
	 					),
	 					"label_attr" => array(
	 							"class"=>"job_collection",
	 					),
	 			))

	 			
	 			
	 			
	 			->add('EffectifNational','text', array(
	 					'label'	=> 'pi.form.label.field.corporation.effectif.national',
	 					'required'  => false,
	 					"label_attr" => array(
	 							"class"=>"info1_collection",
	 					),
	 			))
	 			->add('EffectifRegional','text', array(
	 					'label'	=> 'pi.form.label.field.corporation.effectif.regional',
	 					'required'  => false,
	 					"label_attr" => array(
	 							"class"=>"info1_collection",
	 					),
	 			))
	 			
	 			->add('CodeNAF','text', array(
	 					'label'	=> 'pi.form.label.field.corporation.code.naf',
	 					'required'  => false,
	 					"label_attr" => array(
	 							"class"=>"info1_collection",
	 					),
	 			))
	 			->add('Siret','text', array(
	 					'label'	=> 'pi.form.label.field.corporation.siret',
	 					'required'  => false,
	 					"label_attr" => array(
	 							"class"=>"info1_collection",
	 					),
	 			))
	 			->add('CaNational','text', array(
	 					'label'	=> 'pi.form.label.field.corporation.ca.national',
	 					'required'  => false,
	 					"label_attr" => array(
	 							"class"=>"info1_collection",
	 					),
	 			))	 			
	 			
	 			
	 			
	 			
	 			->add('ArgumentCommercial','textarea', array(
	 					'label'	=> 'pi.form.label.field.corporation.argument.commercial',
	 					'required'  => false,
	 					"label_attr" => array(
	 							"class"=>"info2_collection",
	 					),
	 			))
	 			->add('Expertise','textarea', array(
	 					'label'	=> 'pi.form.label.field.corporation.expertise',
	 					'required'  => false,
	 					"label_attr" => array(
	 							"class"=>"info2_collection",
	 					),
	 			))
	 			->add('Speaker', 'choice', array(
	 					'label'	=> 'pi.form.label.field.corporation.speaker',
	 					'required'  => false,
	 					'expanded' => true,
	 					'choices'   => array('oui' => 'Oui', 'non' => 'Non', 'potentiel' => 'Potentiel'),
	 					"label_attr" => array(
	 							"class"=>"info2_collection",
	 					),
	 			))
	 			->add('OriginContact','choice', array(
	 					'label'	=> 'pi.form.label.field.corporation.origin.contact',
	 					'required'  => false,
	 					'empty_value'  => 'Contact*',
	 					'choices'   => array(
	 							'campagne' => 'Campagne adhésion',
	 							'contact' => 'Contact Mêlée',
	 							'spontane' => 'Contact spontané',
	 							'historique' => 'Historique',
	 							'motivation' => 'Motivation inscription à une commission',
	 							'sponsor' => 'Parrainage',
	 							'partenaire' => 'Partenaire',
	 							'visiteur' => 'Visiteur évènement',
	 							'other' => 'Autre',
	 					),
	 					"label_attr" => array(
	 							"class"=>"info2_collection",
	 					),
	 			))
	 			->add('OriginContactOther','text', array(
	 					'label'	=> 'pi.form.label.field.other',
	 					'required'  => false,
	 					"label_attr" => array(
	 							"class"=>"info2_collection",
	 					),
	 			))
	 			->add('OriginContactSponsor','text', array(
	 					'label'	=> 'pi.form.label.field.corporation.origin.contact.sponsor',
	 					'required'  => false,
	 					"label_attr" => array(
	 							"class"=>"info2_collection",
	 					),
	 			))
	 			
	 			

 			// 		 	  ->add('pageurl', 'entity', array(
 			// 		 				'class' => 'PiAppAdminBundle:Page',
 			// 		 				'query_builder' => function(EntityRepository $er) {
 			// 		 					return $er->getAllPageHtml();
 			// 		 				},
 			// 		 				'property' => 'route_name',
 			// 		 				'empty_value' => 'pi.form.label.select.choose.option',
 			// 		 				"label" 	=> "pi.form.label.field.url",
 			// 		 				"label_attr" => array(
 			// 		 						"class"=>"page_collection",
 			// 		 				),
 			// 		 				"attr" => array(
 			// 		 						"class"=>"pi_simpleselect",
 			// 		 				),
 			// 		 				'multiple'	=> false,
 			// 		 				'required'  => false,
 			// 		 	  ))
        
 			//->add('user', new \BootStrap\UserBundle\Form\Type\RegistrationFormType('collection'))
 			->add('media', new \PiApp\GedmoBundle\Form\MediaType($this->_container, $this->_em, 'image', 'image_collection', "simpleLink", 'pi.form.label.media.picture'))
 			->add('media2', new \PiApp\GedmoBundle\Form\MediaType($this->_container, $this->_em, 'image', 'image_collection', "simpleLink", 'pi.form.label.media.picture'))
 			
        ;
    }

    public function getName()
    {
        return 'piapp_gedmobundle_corporationtype';
    }
        
}
