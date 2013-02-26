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
class AdhesionIndividualType extends AbstractType
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
 					'label'  => 'Choisissez votre Identifiant*',
					'required'  	=> false,        
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
 			)) 
 			->add('media','file')//, new \PiApp\GedmoBundle\Form\MediaType($this->_container, $this->_em, 'image', 'image_collection', "simpleLink", 'pi.form.label.media.picture'))
            
 			->add('Phone','text', array(
					'required'  	=> false,
 					"attr" => array(
 							"class"=>"required phone",
 					),
 			))
 			->add('Job','text', array(
					'required'  	=> false,
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
 					),
 			))      
      ->add('CP','text', array(       
					'required'  => false,        
 					"attr" => array(
 							"class"=>"required postCode",
							"data-validate"=>"Code postal*",
 					),
 			))           
 			->add('Company','text', array(
 					'required'  => false,        
 					"attr" => array(
 							"class"=>"resetRight required text",
							"data-validate"=>"Société *",
 					),
 			))
 			->add('Effectif','text', array(
 					'required'  => false,        
 					"attr" => array(
 							"class"=>"resetRight required text",
							"data-validate"=>"Effectif *",
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
					'empty_value' => 'Choisir une sous-activité',
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
 					'required'  => true,        
					'empty_value' => 'Votre profil',
					'choices'   => array('cadre' => 'cadre', 'salarie' => 'salarié', 'other' => 'Autres'),
 					"attr" => array(
 							"class" => "resetRight selectSize origin",
 					),
 			))   
      ->add('ProfileOther','text', array(
 					'required'  => false,    
 					"attr" => array(
 							"class"=>"required text hidden otherOrigin",
 					),
 			))
                  
 			->add('DetailActivity', 'text', array(
 					'required'  => true,        
					"attr" => array(
 							"class"=>"required",
							'data-validate' => 'Détails activité*',
 					),
 			))
      ->add('ArgumentActivity','textarea', array(
 					'required'  => true,        
 					"attr" => array(
 							"class"=>"full required",
							'data-validate' => 'Argumentaire commercial*',
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
 							"class"=>"light-clr bold",
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
        ;
    }
    
    public function getName()
    {
        return 'piapp_gedmobundle_adhesion_individualtype';
    }
        
}
