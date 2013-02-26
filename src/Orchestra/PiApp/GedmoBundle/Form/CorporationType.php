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
		        		'data'  => true,
		        		'label'	=> 'pi.form.label.field.enabled',
		        ))
		        ->add('highlighted', 'checkbox', array(
		        		'required'  => false,
		        		'data'  => true,
		        		'label'	=> 'pi.partner.form.field.highlighted1',
		        ))
	 			->add('Name','text', array(
	         		 	'required'  	=> false,
	 					"attr" => array(
	 						"class"=>"required text",
	              			'data-validate' => 'Nom*',
	 					),
	 			))
	      		->add('UserName','text', array(
	 					'label'  => 'Choisissez votre Identifiant*',
	          			'required'  	=> false,        
	         			"attr" => array(
	 						"class"=>"required text",
	              			'data-validate' => 'Identifiant',
	 					),
	 			))
	 			->add('Nickname','text', array(
	          			'required'  	=> false,        
	 					"attr" => array(
	 						"class"=>"resetRight required text",
	              			'data-validate' => 'Prénom*',
	 					),
	 			))  
	 			->add('Civility', 'choice', array(
	 					'required'  => false,        
			          	'choices'   => array(
				            '1' => 'Mr', 
				            '2' => 'Mme', 
				            '3' => 'Mlle'
			            ),
	          			'empty_value'  => 'Civilité*', 
	 					"attr" => array(
	 							"class"=>"required selectSize inputSame",
	 					),
	 			))  
	 			->add('url','text', array(
	          			'required'  	=> true,        
	 					"attr" => array(
	 						"class"=>"resetRight required text",
	              			'data-validate' => 'Site Internet',
	 					),
	 			))	            
	 			->add('UserPhone','text', array(
	 					"attr" => array(
	 						"class"=>"required phone",
	              			'data-validate' => 'Téléphone*',
	 					),
	 					
	 			))
	      		->add('Email','text', array(
	 					'required'  => true,        
	 					"attr" => array(
	 						"class"=>"required email",
	              			'data-validate' => 'Email pro*',
	 					),
	 			))
	      		->add('EmailPerso','text', array(
	 					'required'  => true,        
	 					"attr" => array(
	 						"class"=>"email",
	             			'data-validate' => 'Email perso',
	 					),
	 			))

	 			
	 			->add('Job','text', array(
	 					'required'  => true,
	 					"label_attr" => array(
	 							"class"=>"job_collection",
	 					),
	 			))
	 			->add('Profile', 'choice', array(
	 					'required'  => false,
	 					'expanded' => true,
	 					'choices'   => array('fournisseur' => 'Fournisseur TIC', 'user' => 'Utilisateur TIC'),
	 					"attr" => array(
	 							"class" => "required",
	 					),
	 					"label_attr" => array(
	 							"class"=>"job_collection",
	 					),
	 						
	 			))			
	 			->add('Activity', 'choice', array(
	 					'required'  => true,
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
	 			
	 			
	 			
	      		->add('Facebook','text', array(   
	          			'required'  => false,     
	 					"attr" => array(
	 						"class"=>"fleft",
	 					),
	      				"label_attr" => array(
	      						"class"=>"social_collection",
	      				),
	 			))
	      		->add('GooglePlus','text', array( 
	          			'required'  => false,        
	 					"attr" => array(
	 						"class"=>"fleft",
	 					),
	      				"label_attr" => array(
	      						"class"=>"social_collection",
	      				),
	 			))
	      		->add('Twitter','text', array(    
	         	 		'required'  => false,        
	 					"attr" => array(
	 						"class"=>"fleft",
	 					),
	      				"label_attr" => array(
	      						"class"=>"social_collection",
	      				),
	 			))
	      		->add('LinkedIn','text', array(     
	         			'required'  => false,        
	 					"attr" => array(
	 						"class"=>"fleft",
	 					),
	      				"label_attr" => array(
	      						"class"=>"social_collection",
	      				),
	 			))
	      		->add('Viadeo','text', array(       
	          			'required'  => false,        
	 					"attr" => array(
	 						"class"=>"fleft",
	 					),
	      				"label_attr" => array(
	      						"class"=>"social_collection",
	      				),
	 			))  
	 			
	 			
	 			

	      		->add('Address','text', array(       
	          			'required'  => false,        
	 					"attr" => array(
	 						"class"=>"full required text",
	              			"data-validate"=>"Adresse*",
	 					),
	      				"label_attr" => array(
	      						"class"=>"contact_entre_collection",
	      				),
	 			))  
	      		->add('CP','text', array(       
	          		'required'  => false,        
	 					"attr" => array(
	 						"class"=>"required postCode",
	              			"data-validate"=>"Code postal*",
	 					),
	      				"label_attr" => array(
	      						"class"=>"contact_entre_collection",
	      				),
	 			))  
	      		->add('City','text', array(       
	          			'required'  => false,        
	 					"attr" => array(
	 						"class"=>"required text",
	              			"data-validate"=>"Ville*",
	 					),
	      				"label_attr" => array(
	      						"class"=>"contact_entre_collection",
	      				),
	 			))  
	      		->add('Country','choice', array(
	 					  'required'  => true,    
				          'empty_value'  => 'Pays*',    
				          'choices'   => array(
				            '1' => 'Campagne adhésion', 
				            '2' => 'Contact Mêlée', 
				            '3' => 'Contact spontané', 
				            '4' => 'Historique',
				            '5' => 'Motivation inscription à une commission', 
				            '6' => 'Parrainage', 
				            '7' => 'Partenaire',
				            '8' => 'Visiteur évènement',
				            '9' => 'Autre',            
				            ),
		 					"attr" => array(
		 							"class"=>"resetRight required",
		 					),
	      				"label_attr" => array(
	      						"class"=>"contact_entre_collection",
	      				),
	 			))  
	      		->add('Phone','text', array(       
	          			'required'  => false,        
	 					"attr" => array(
	 						"class"=>"required phone",
	              			"data-validate"=>"Téléphone*",
	 					),
	      				"label_attr" => array(
	      						"class"=>"contact_entre_collection",
	      				),
	 			))  
	      		->add('Fax','text', array(       
	          			'required'  => false,        
	 					"attr" => array(
	              			"data-validate"=>"Fax*",
	 					),
	      				"label_attr" => array(
	      						"class"=>"contact_entre_collection",
	      				),
	 			)) 
	 			
	 			
	 			
	 			
	      		->add('MotherAddress','text', array(       
	          			'required'  => false,        
	 					"attr" => array(
	 						"class"=>"full required text",
	              		"data-validate"=>"Adresse*",
	 					),
	      				"label_attr" => array(
	      						"class"=>"contact_mother_collection",
	      				),
	 			)) 
	      		->add('MotherCP','text', array(       
	          			'required'  => false,        
	 					"attr" => array(
	 						"class"=>"required postCode",
	              		"data-validate"=>"Code postal*",
	 					),
	      				"label_attr" => array(
	      						"class"=>"contact_mother_collection",
	      				),
	 			)) 
	      		->add('MotherCity','text', array(       
	          			'required'  => false,        
	 					"attr" => array(
	 						"class"=>"required text",
	              		"data-validate"=>"Ville*",
	 					),
	      				"label_attr" => array(
	      						"class"=>"contact_mother_collection",
	      				),
	 			)) 
	      		->add('MotherCountry','choice', array(
	 					'required'  => true,    
				          'empty_value'  => 'Pays*',    
				          'choices'   => array(
				            '1' => 'Campagne adhésion', 
				            '2' => 'Contact Mêlée', 
				            '3' => 'Contact spontané', 
				            '4' => 'Historique',
				            '5' => 'Motivation inscription à une commission', 
				            '6' => 'Parrainage', 
				            '7' => 'Partenaire',
				            '8' => 'Visiteur évènement',
				            '9' => 'Autre',            
				            ),
		 					"attr" => array(
		 							"class"=>"resetRight required",
		 					),
	      				"label_attr" => array(
	      						"class"=>"contact_mother_collection",
	      				),
	 			))  
	      		->add('MotherPhone','text', array(       
	          			'required'  => false,        
	 					"attr" => array(
	 						"class"=>"required phone",
	              			"data-validate"=>"Téléphone*",
	 					),
	      				"label_attr" => array(
	      						"class"=>"contact_mother_collection",
	      				),
	 			))      
	      		->add('MotherFax','text', array(       
	          			'required'  => false,        
	 					"attr" => array(
	              			"data-validate"=>"Fax*",
	 					),
	      				"label_attr" => array(
	      						"class"=>"contact_mother_collection",
	      				),
	 			)) 
	 			
	 			
	 			
	 			
	 			->add('InvoiceAddress','text', array(
	 					'required'  => false,
	 					"attr" => array(
	 							"class"=>"full required text",
	 							"data-validate"=>"Adresse*",
	 					),
	 					"label_attr" => array(
	 							"class"=>"contact_facuration_collection",
	 					),
	 			))
	 			->add('InvoiceCP','text', array(
	 					'required'  => false,
	 					"attr" => array(
	 							"class"=>"required postCode",
	 							"data-validate"=>"Code postal*",
	 					),
	 					"label_attr" => array(
	 							"class"=>"contact_facuration_collection",
	 					),
	 			))
	 			->add('InvoiceCity','text', array(
	 					'required'  => false,
	 					"attr" => array(
	 							"class"=>"required text",
	 							"data-validate"=>"Ville*",
	 					),
	 					"label_attr" => array(
	 							"class"=>"contact_facuration_collection",
	 					),
	 			))
	 			->add('InvoiceCountry','choice', array(
	 					'required'  => true,
	 					'empty_value'  => 'Pays*',
	 					'choices'   => array(
	 							'1' => 'Campagne adhésion',
	 							'2' => 'Contact Mêlée',
	 							'3' => 'Contact spontané',
	 							'4' => 'Historique',
	 							'5' => 'Motivation inscription à une commission',
	 							'6' => 'Parrainage',
	 							'7' => 'Partenaire',
	 							'8' => 'Visiteur évènement',
	 							'9' => 'Autre',
	 					),
	 					"attr" => array(
	 							"class"=>"resetRight required",
	 					),
	 					"label_attr" => array(
	 							"class"=>"contact_facuration_collection",
	 					),
	 			))
	 			->add('InvoicePhone','text', array(
	 					'required'  => false,
	 					"attr" => array(
	 							"class"=>"required phone",
	 							"data-validate"=>"Téléphone*",
	 					),
	 					"label_attr" => array(
	 							"class"=>"contact_facuration_collection",
	 					),
	 			))
	 			->add('InvoiceFax','text', array(
	 					'required'  => false,
	 					"attr" => array(
	 							"data-validate"=>"Fax*",
	 					),
	 					"label_attr" => array(
	 							"class"=>"contact_facuration_collection",
	 					),
	 			))

	 			
	 			

	 			->add('CorporationName','text', array(
	 					'required'  => false,
	 					"attr" => array(
	 							"class"=>"required text",
	 							"data-validate"=>"Raison sociale *",
	 					),
	 					"label_attr" => array(
	 							"class"=>"info1_collection",
	 					),
	 			))
	 			->add('CommercialName','text', array(
	 					'required'  => false,
	 					"attr" => array(
	 							"class"=>"required text",
	 							"data-validate"=>"Nom commercial *",
	 					),
	 					"label_attr" => array(
	 							"class"=>"info1_collection",
	 					),
	 			))	 			
	 			->add('DetailActivity', 'text', array(
	 					'required'  => true,
	 					"attr" => array(
	 							"class"=>"required",
	 							'data-validate' => 'Détails activité*',
	 					),
	 					"label_attr" => array(
	 							"class"=>"info1_collection",
	 					),
	 			))
	 			->add('ArgumentCommercial','textarea', array(
	 					'required'  => true,
	 					"attr" => array(
	 							"class"=>"full required",
	 					),
	 					"label_attr" => array(
	 							"class"=>"info1_collection",
	 					),
	 			))
	 			->add('Expertise','textarea', array(
	 					'required'  => false,
	 					"attr" => array(
	 							"class"=>"full required",
	 					),
	 					"label_attr" => array(
	 							"class"=>"info1_collection",
	 					),
	 			))
	 			
	 			->add('Speaker', 'choice', array(
	 					'required'  => false,
	 					'expanded' => true,
	 					'choices'   => array('oui' => 'Oui', 'non' => 'Non', 'potentiel' => 'Potentiel'),
	 					"attr" => array(
	 							"class" => "required",
	 					),
	 					"label_attr" => array(
	 							"class" => "light-clr bold",
	 					),
	 					"label_attr" => array(
	 							"class"=>"info1_collection",
	 					),
	 			))
	 			->add('OriginContact','choice', array(
	 					'required'  => true,
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
	 					"attr" => array(
	 							"class"=>"required origin",
	 					),
	 					"label_attr" => array(
	 							"class"=>"info1_collection",
	 					),
	 			))
	 			->add('OriginContactOther','text', array(
	 					'required'  => false,
	 					"attr" => array(
	 							"class"=>"required text hidden otherOrigin",
	 					),
	 					"label_attr" => array(
	 							"class"=>"info1_collection",
	 					),
	 			))
	 			->add('OriginContactSponsor','text', array(
	 					'required'  => false,
	 					"attr" => array(
	 							"class"=>"required text hidden sponsorOrigin",
	 					),
	 					"label_attr" => array(
	 							"class"=>"info1_collection",
	 					),
	 			))
	 			
	 			

	 			
	 			
	      		->add('EffectifNational','text', array(       
	          			'required'  => false,        
	 					"attr" => array(
	 						"class"=>"required text",
	              			"data-validate"=>"Effectif national en cours *",
	 					),
	      				"label_attr" => array(
	      						"class"=>"info2_collection",
	      				),
	 			)) 
	      		->add('EffectifRegional','text', array(       
	          			'required'  => false,        
	 					"attr" => array(
	 						"class"=>"required text",
	              			"data-validate"=>"Effectif regional en cours *",
	 					),
	      				"label_attr" => array(
	      						"class"=>"info2_collection",
	      				),
	 			)) 
	      		->add('LegalForm','choice', array(
	 					  'required'  => true,    
				          'empty_value'  => 'Forme juridique *',    
				          'choices'   => array(
				            '1' => 'Campagne adhésion', 
				            '2' => 'Contact Mêlée', 
				            '3' => 'Contact spontané', 
				            '4' => 'Historique',
				            '5' => 'Motivation inscription à une commission', 
				            '6' => 'Parrainage', 
				            '7' => 'Partenaire',
				            '8' => 'Visiteur évènement',
				            '9' => 'Autre',            
				            ),
		 					"attr" => array(
		 							"class"=>"resetRight required",
		 					),
	      				"label_attr" => array(
	      						"class"=>"info2_collection",
	      				),
	 			)) 
	      		->add('CodeNAF','text', array(       
	          			'required'  => false,        
	 					"attr" => array(
	 						"class"=>"required text",
	              			"data-validate"=>"Code NAF*",
	 					),
	      				"label_attr" => array(
	      						"class"=>"info2_collection",
	      				),
	 			)) 
	      		->add('Siret','text', array(       
	          			'required'  => false,        
	 					"attr" => array(
	 						"class"=>"required text",
	              			"data-validate"=>"Siret*",
	 					),
	      				"label_attr" => array(
	      						"class"=>"info2_collection",
	      				),
	 			)) 
	      		->add('CaNational','text', array(       
	          			'required'  => false,        
	 					"attr" => array(
	 						"class"=>"required text",
	              			"data-validate"=>"Ca National *",
	 					),
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
 			// 		 	  ->add('url', 'text', array(
 			// 		 				"label" 	=> "pi.form.label.field.or",
 			// 		 				"label_attr" => array(
 			// 		 						"class"=>"page_collection",
 			// 		 				),
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
