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
          'required'  	=> false,        
 					"attr" => array(
 							"class"=>"resetRight required text",
              'data-validate' => 'Site Internet',
 					),
 			)) 
 			->add('media','file', array(
 					'required'  => false,        
 			))  // new \PiApp\GedmoBundle\Form\MediaType($this->_container, $this->_em, 'image', 'image_collection', "simpleLink", 'pi.form.label.media.picture'))
 			->add('media2','file', array(
 					'required'  => false,        
 			))  // new \PiApp\GedmoBundle\Form\MediaType($this->_container, $this->_em, 'image', 'image_collection', "simpleLink", 'pi.form.label.media.picture'))
            
 			->add('UserPhone','text', array(
 					"attr" => array(
 							"class"=>"required phone",
 					),
 			))
 			->add('Job','text', array(
 					"attr" => array(
 							"class"=>"required text",
 					),
 			))
      ->add('Email','text', array(
 					'required'  => false,        
 					"attr" => array(
 							"class"=>"required email",
 					),
 			))
      ->add('EmailPerso','text', array(
 					'required'  => false,        
 					"attr" => array(
 							"class"=>"email",
              'data-validate' => 'Email perso',
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
 							"class"=>"resetRight selectSize required",
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
 							"class"=>"resetRight selectSize",
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
 							"class" => "light-clr bold",
 					),
        ))       
 			->add('DetailActivity', 'text', array(
 					'required'  => true,        
          	"attr" => array(
 							"class"=>"required",
              'data-validate' => 'Détails activité*',
 					),
 			))
      ->add('ArgumentCommercial','textarea', array(
 					'required'  => false,        
 					"attr" => array(
 							"class"=>"full required",
 					),
 			))  
      ->add('Expertise','textarea', array(
 					'required'  => false,        
 					"attr" => array(
 							"class"=>"full required",
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
              "data-validate"=>"Raison sociale *",
 					),
 			))  
      ->add('CommercialName','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required text",
              "data-validate"=>"Nom commercial *",
 					),
 			))  
      ->add('Address','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"full required text",
              "data-validate"=>"Adresse*",
 					),
 			))  
      ->add('CP','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required postCode",
              "data-validate"=>"Code postal*",
 					),
 			))  
      ->add('City','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required text",
              "data-validate"=>"Ville*",
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
              "data-validate"=>"Téléphone*",
 					),
 			))  
      ->add('Fax','text', array(       
          'required'  => false,        
 					"attr" => array(
              "data-validate"=>"Fax*",
 					),
 			)) 
      ->add('InvoiceAddress','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"full required text",
              "data-validate"=>"Adresse*",
 					),
 			))  
      ->add('InvoiceCP','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required postCode",
              "data-validate"=>"Code postal*",
 					),
 			)) 
      ->add('InvoiceCity','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required text",
              "data-validate"=>"Ville*",
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
              "data-validate"=>"Téléphone*",
 					),
 			)) 
      ->add('InvoiceFax','text', array(       
          'required'  => false,        
 					"attr" => array(
              "data-validate"=>"Fax*",
 					),
 			)) 
      ->add('MotherAddress','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"full required text",
              "data-validate"=>"Adresse*",
 					),
 			)) 
      ->add('MotherCP','text', array(       
          			'required'  => false,        
 					"attr" => array(
 						"class"=>"required postCode",
              			"data-validate"=>"Code postal*",
 					),
 			)) 
      ->add('MotherCity','text', array(       
          			'required'  => false,        
 					"attr" => array(
 						"class"=>"required text",
              			"data-validate"=>"Ville*",
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
              				"data-validate"=>"Téléphone*",
 					),
 			))      
      ->add('MotherFax','text', array(       
          			'required'  => false,        
 					"attr" => array(
              			"data-validate"=>"Fax*",
 					),
 			)) 
      ->add('EffectifNational','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required text",
              "data-validate"=>"Effectif national en cours *",
 					),
 			)) 
      ->add('EffectifRegional','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required text",
              "data-validate"=>"Effectif regional en cours *",
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
 			)) 
      ->add('CodeNAF','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required text",
              "data-validate"=>"Code NAF*",
 					),
 			)) 
      ->add('Siret','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required text",
              "data-validate"=>"Siret*",
 					),
 			)) 
      ->add('CaNational','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"required text",
              "data-validate"=>"Ca National *",
 					),
 			))           
        ;
    }
    
    public function getName()
    {
        return 'piapp_gedmobundle_adhesion_corporationtype';
    }
        
}
