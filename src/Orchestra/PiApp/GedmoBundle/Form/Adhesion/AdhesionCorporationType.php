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
namespace PiApp\GedmoBundle\Form\Adhesion;

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
class AdhesionCorporationType extends AbstractType
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
 			->add('Name','text', array(
          'required'  	=> false,
 					"attr" => array(
 							"class"=>"required text",
 					),
 			))
      ->add('UserName','text', array(
          'required'  	=> false,   
 					'label'  => 'Choisissez votre Identifiant*',        
         	"attr" => array(
 							"class"=>"required text",
 					),
 			))
 			->add('Nickname','text', array(
          'required'  	=> false,        
 					"attr" => array(
 							"class"=>"resetRight required text",
 					),
 			))  
 			->add('Civility', 'choice', array(
 					'required'  => false,     
 					'empty_value' => 'pi.form.label.select.choose.civility',
					'choices'   => array(
	 		  				'pi.form.label.field.civility.type.mr' 	=> 'pi.form.label.field.civility.type.mr',
	 		  				'pi.form.label.field.civility.type.mme' => 'pi.form.label.field.civility.type.mme',
	 		  				'pi.form.label.field.civility.type.mlle'=> 'pi.form.label.field.civility.type.mlle'
	 		  		),
					'empty_value'  => 'Civilité*', 
 					"attr" => array(
 							"class"=>"required selectSize inputSame",
 					),
 			))           
 			->add('url','text', array(
          			'required'  	=> false,        
 					"attr" => array(
 						"class"=>"resetRight text",
 					),
 			)) 
 			->add('media','file', array(
 					'required'  => false,        
 			))  // new \PiApp\GedmoBundle\Form\MediaType($this->_container, $this->_em, 'image', 'image_collection', "simpleLink", 'pi.form.label.media.picture'))
 			->add('media2','file', array(
 					'required'  => false,   
 					"attr" => array(
 							"class"=>"required text",
 					),
 			))  // new \PiApp\GedmoBundle\Form\MediaType($this->_container, $this->_em, 'image', 'image_collection', "simpleLink", 'pi.form.label.media.picture'))
            
 			->add('UserPhone','text', array(
					"required"  => false,        
 					"attr" => array(
 							"class"=>"required phone",
 					),
 			))
 			->add('Job','text', array(
					"required"  => false,        
 					"attr" => array(
 							"class"=>"required text",
 					),
 			))
      ->add('Email','text', array(
 					"required"  => false,        
 					"attr" => array(
 							"class"=>"required email",
 					),
 			))
      ->add('EmailPerso','text', array(
 					'required'  => false,        
 					"attr" => array(
 							"class"=>"email",
 					),
 			))               
 			->add('Activity', 'choice', array(
 					'required'  => false,        
 					'empty_value' => 'pi.form.label.select.choose.activity',
					'choices'   => array(
 							  'pi.form.label.field.corporation.activity.tic' 		=> 'pi.form.label.field.corporation.activity.tic', 
							  'pi.form.label.field.corporation.activity.admin' 		=> 'pi.form.label.field.corporation.activity.admin',
							  'pi.form.label.field.corporation.activity.aero' 		=> 'pi.form.label.field.corporation.activity.aero',
							  'pi.form.label.field.corporation.activity.agro' 		=> 'pi.form.label.field.corporation.activity.agro',
							  'pi.form.label.field.corporation.activity.bank' 		=> 'pi.form.label.field.corporation.activity.bank',
							  'pi.form.label.field.corporation.activity.biens' 		=> 'pi.form.label.field.corporation.activity.biens',
							  'pi.form.label.field.corporation.activity.chimie' 	=> 'pi.form.label.field.corporation.activity.chimie',
							  'pi.form.label.field.corporation.activity.com' 		=> 'pi.form.label.field.corporation.activity.com',
							  'pi.form.label.field.corporation.activity.divert' 	=> 'pi.form.label.field.corporation.activity.divert',
							  'pi.form.label.field.corporation.activity.env' 		=> 'pi.form.label.field.corporation.activity.env',
							  'pi.form.label.field.corporation.activity.fab' 		=> 'pi.form.label.field.corporation.activity.fab',
							  'pi.form.label.field.corporation.activity.elect' 		=> 'pi.form.label.field.corporation.activity.elect',
							  'pi.form.label.field.corporation.activity.indus.def' 	=> 'pi.form.label.field.corporation.activity.indus.def',
							  'pi.form.label.field.corporation.activity.auto' 		=> 'pi.form.label.field.corporation.activity.auto',
							  'pi.form.label.field.corporation.activity.distrib' 	=> 'pi.form.label.field.corporation.activity.distrib',
							  'pi.form.label.field.corporation.activity.loisir' 	=> 'pi.form.label.field.corporation.activity.loisir',
							  'pi.form.label.field.corporation.activity.assur' 		=> 'pi.form.label.field.corporation.activity.assur',
							  'pi.form.label.field.corporation.activity.sante' 		=> 'pi.form.label.field.corporation.activity.sante',
							  'pi.form.label.field.corporation.activity.educ' 		=> 'pi.form.label.field.corporation.activity.educ',
							  'pi.form.label.field.corporation.activity.ing' 		=> 'pi.form.label.field.corporation.activity.ing',
							  'pi.form.label.field.corporation.activity.asso' 		=> 'pi.form.label.field.corporation.activity.asso',
							  'pi.form.label.field.corporation.activity.indus' 		=> 'pi.form.label.field.corporation.activity.indus',
							  'pi.form.label.field.corporation.activity.energie' 	=> 'pi.form.label.field.corporation.activity.energie',
							  'pi.form.label.field.corporation.activity.public' 	=> 'pi.form.label.field.corporation.activity.public',
							  'pi.form.label.field.corporation.activity.rd' 		=> 'pi.form.label.field.corporation.activity.rd',
							  'pi.form.label.field.corporation.activity.btp' 		=> 'pi.form.label.field.corporation.activity.btp',
							  'pi.form.label.field.corporation.activity.service' 	=> 'pi.form.label.field.corporation.activity.service',
							  'pi.form.label.field.corporation.activity.rh' 		=> 'pi.form.label.field.corporation.activity.rh',
							  'pi.form.label.field.corporation.activity.service.pro'=> 'pi.form.label.field.corporation.activity.service.pro',
							  'pi.form.label.field.corporation.activity.techno' 	=> 'pi.form.label.field.corporation.activity.techno',
							  'pi.form.label.field.corporation.activity.trans' 		=> 'pi.form.label.field.corporation.activity.trans',
							  'pi.form.label.field.other' 							=> 'pi.form.label.field.other',
					  ),
 					"attr" => array(
 							"class"=>"resetRight selectSize required",
 					),
 			)) 
 			->add('Engineering', 'choice', array(
 					  'required'  => false,
 					  'empty_value' => 'Choisir une sous-activité',
			          'choices'   => array(
							  'pi.form.label.field.corporation.engineering.telecom'				=> 'pi.form.label.field.corporation.engineering.telecom',
							  'pi.form.label.field.corporation.engineering.info.service'		=> 'pi.form.label.field.corporation.engineering.info.service',
							  'pi.form.label.field.corporation.engineering.rh'					=> 'pi.form.label.field.corporation.engineering.rh',
							  'pi.form.label.field.corporation.engineering.ingenierie.savoirs'	=> 'pi.form.label.field.corporation.engineering.ingenierie.savoirs',
							  'pi.form.label.field.corporation.engineering.infra'				=> 'pi.form.label.field.corporation.engineering.infra',
							  'pi.form.label.field.corporation.engineering.info.tech'			=> 'pi.form.label.field.corporation.engineering.info.tech',
							  'pi.form.label.field.corporation.engineering.info.gestion'		=> 'pi.form.label.field.corporation.engineering.info.gestion',
							  'pi.form.label.field.corporation.engineering.form'				=> 'pi.form.label.field.corporation.engineering.form',
							  'pi.form.label.field.corporation.engineering.finance'				=> 'pi.form.label.field.corporation.engineering.finance',
							  'pi.form.label.field.corporation.engineering.entreprise.tic'		=> 'pi.form.label.field.corporation.engineering.entreprise.tic',
							  'pi.form.label.field.corporation.engineering.editeur'				=> 'pi.form.label.field.corporation.engineering.editeur',
							  'pi.form.label.field.corporation.engineering.dev.web'				=> 'pi.form.label.field.corporation.engineering.dev.web',
							  'pi.form.label.field.corporation.engineering.multimedia'			=> 'pi.form.label.field.corporation.engineering.multimedia',
							  'pi.form.label.field.corporation.engineering.materiel.constr.dest'=> 'pi.form.label.field.corporation.engineering.materiel.constr.dest',
							  'pi.form.label.field.corporation.engineering.conseil'				=> 'pi.form.label.field.corporation.engineering.conseil',
							  'pi.form.label.field.other' 										=> 'pi.form.label.field.other',
			            ),
	 					"attr" => array(
	 							"class"=>"resetRight selectSize",
	 							'data-validate' => 'sous-activité*',
	 					),
 			))                          
 			->add('Profile', 'choice', array(
 					'required'  => false,
          			'expanded' => true,    
 					'empty_value' => 'Votre profil',
          			'choices'   => array(
			 	  			  'pi.form.label.field.profile.type.fournisseur.tic' 	=> 'pi.form.label.field.profile.type.fournisseur.tic',
			 	  			  'pi.form.label.field.profile.type.user.tic' 			=> 'pi.form.label.field.profile.type.user.tic',
		 	  		),
 					"attr" => array(
 							"class" => "required",
 					),
          			"label_attr" => array(
 							"class" => "light-clr bold",
 					),
	        ))       
 			->add('DetailActivity', 'text', array(
 					'required'  => false,        
          			"attr" => array(
 							"class"=>"required",
 					),
 			))
      ->add('ArgumentCommercial','textarea', array(
 					'required'  => false,        
 					"attr" => array(
 							"class"=>"full required",
 							"maxlength" => "1500",
 					),
 			))  
      ->add('Expertise','textarea', array(
 					'required'  => false,        
 					"attr" => array(
 							"class"=>"full",
 					),
 			))
                  
 			->add('Speaker', 'choice', array(
 					'required'  => false,   
          			'expanded' => true,
          			'choices'   => array(
	 						'pi.form.label.field.yes' 		=> 'pi.form.label.field.yes',
	 						'pi.form.label.field.no' 		=> 'pi.form.label.field.no',
	 						'pi.form.label.field.potential' => 'pi.form.label.field.potential'
	 				),
 					"attr" => array(
 							"class" => "required",
 					),
          			"label_attr" => array(
 							"class" => "light-clr bold",
 					),
 			))
      ->add('OriginContact','choice', array(
 				  'required'  => false,    
		          'empty_value'  => 'Contact*',    
		          'choices'   => array(
 							'pi.form.label.field.corporation.origin.contact.type.campagne' 		=> 'pi.form.label.field.corporation.origin.contact.type.campagne',
 							'pi.form.label.field.corporation.origin.contact.type.lamelee' 		=> 'pi.form.label.field.corporation.origin.contact.type.lamelee',
 							'pi.form.label.field.corporation.origin.contact.type.spontane' 		=> 'pi.form.label.field.corporation.origin.contact.type.spontane',
 							'pi.form.label.field.corporation.origin.contact.type.historique' 	=> 'pi.form.label.field.corporation.origin.contact.type.historique',
 							'pi.form.label.field.corporation.origin.contact.type.motivation' 	=> 'pi.form.label.field.corporation.origin.contact.type.motivation',
 							'pi.form.label.field.corporation.origin.contact.type.sponsor' 		=> 'pi.form.label.field.corporation.origin.contact.type.sponsor',
 							'pi.form.label.field.corporation.origin.contact.type.partenaire' 	=> 'pi.form.label.field.corporation.origin.contact.type.partenaire',
 							'pi.form.label.field.corporation.origin.contact.type.visiteur.event'=> 'pi.form.label.field.corporation.origin.contact.type.visiteur.event',
 							'pi.form.label.field.other'											=> 'pi.form.label.field.other',            
		            ),
 					"attr" => array(
 							"class"=>"required origin",
 					),
 			))
      ->add('OriginContactOther','text', array(
 					'required'  => false,    
 					"attr" => array(
 							"class"=>"required text hidden otherOrigin",
 					),
 			))   
      ->add('OriginContactSponsor','text', array(
 					'required'  => false,    
 					"attr" => array(
 							"class"=>"required text hidden sponsorOrigin",
 					),
 			))           
      ->add('Facebook','text', array(   
          'required'  => false,     
 					"attr" => array(
 							"class"=>"fleft",
 					),
 			))
      ->add('GooglePlus','text', array( 
          'required'  => false,        
 					"attr" => array(
 							"class"=>"fleft",
 					),
 			))
      ->add('Twitter','text', array(    
          'required'  => false,        
 					"attr" => array(
 							"class"=>"fleft",
 					),
 			))
      ->add('LinkedIn','text', array(     
          'required'  => false,        
 					"attr" => array(
 							"class"=>"fleft",
 					),
 			))
      ->add('Viadeo','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"fleft",
 					),
 			))  
      ->add('CorporationName','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required text",
 					),
 			))  
      ->add('CommercialName','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required text",
 					),
 			))  
      ->add('Address','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"full required text",
 					),
 			))  
      ->add('CP','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required postCode",
 					),
 			))  
      ->add('City','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required text",
 					),
 			))  
      ->add('Country','choice', array(
 					'required'  => true,    
          			'empty_value'  => 'Pays*',   
          			'choices'   => \PiApp\AdminBundle\Util\PiStringManager::allCountries($this->_locale),
 					"attr" => array(
 							"class"=>"resetRight required",
 					),
 			))  
      ->add('Phone','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required phone",
 					),
 			))  
      ->add('Fax','text', array(       
          'required'  => false,        
 					"attr" => array(
 					),
 			)) 
      ->add('InvoiceAddress','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"full required text",
 					),
 			))  
      ->add('InvoiceCP','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required postCode",
 					),
 			)) 
      ->add('InvoiceCity','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required text",
 					),
 			)) 
      ->add('InvoiceCountry','choice', array(
 					'required'  => false,    
          			'empty_value'  => 'Pays*',    
          			'choices'   => \PiApp\AdminBundle\Util\PiStringManager::allCountries($this->_locale),
 					"attr" => array(
 							"class"=>"resetRight required",
 					),
 			)) 
      ->add('InvoicePhone','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required phone",
 					),
 			)) 
      ->add('InvoiceFax','text', array(       
          'required'  => false,        
 					"attr" => array(
 					),
 			)) 
      ->add('MotherAddress','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"full required text",
 					),
 			)) 
      ->add('MotherCP','text', array(       
          			'required'  => false,        
 					"attr" => array(
 						"class"=>"required postCode",
 					),
 			)) 
      ->add('MotherCity','text', array(       
          			'required'  => false,        
 					"attr" => array(
 						"class"=>"required text",
 					),
 			)) 
      ->add('MotherCountry','choice', array(
 					'required'  => false,    
          			'empty_value'  => 'Pays*',    
	          		'choices'   => \PiApp\AdminBundle\Util\PiStringManager::allCountries($this->_locale),
 					"attr" => array(
 							"class"=>"resetRight required",
 					),
 			))  
      ->add('MotherPhone','text', array(       
          			'required'  => false,        
 					"attr" => array(
 							"class"=>"required phone",
 					),
 			))      
      ->add('MotherFax','text', array(       
          			'required'  => false,   
 			)) 
      ->add('EffectifNational','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required text",
 					),
 			)) 
      ->add('EffectifRegional','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required text",
 					),
 			)) 
      ->add('LegalForm','choice', array(
 					'required'  => false,    
			          'empty_value'  => 'Forme juridique *',    
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
 					"attr" => array(
 							"class"=>"resetRight required",
 					),
 			)) 
      ->add('CodeNAF','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required text",
 					),
 			)) 
      ->add('Siret','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required text",
 					),
 			)) 
      ->add('CaNational','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required text",
 					),
 			))           
        ;
    }
    
    public function getName()
    {
        return 'piapp_gedmobundle_adhesion_corporationtype';
    }
        
}
