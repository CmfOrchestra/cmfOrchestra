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
	 				'data'  	=> true,
	 				'label'		=> 'pi.form.label.field.enabled',
	 		  ))
	 		  ->add('highlighted', 'checkbox', array(
	 		  		'required'  => false,
	 		  		'data'  	=> true,
	 		  		'label'		=> 'pi.partner.form.field.highlighted1',
	 		  ))
	 		  ->add('Civility', 'choice', array(
	 		  		'label'		=> 'pi.form.label.field.civility',
	 		  		'empty_value' => 'pi.form.label.select.choose.civility',
	 		  		'required'  => false,
	 		  		'expanded' => false,
	 		  		'choices'   => array(
	 		  				'pi.form.label.field.civility.type.mr' 	=> 'pi.form.label.field.civility.type.mr',
	 		  				'pi.form.label.field.civility.type.mme' => 'pi.form.label.field.civility.type.mme',
	 		  				'pi.form.label.field.civility.type.mlle'=> 'pi.form.label.field.civility.type.mlle'
	 		  		),
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
		 	  ->add('Job','text', array(
		 	  		'label'	=> 'pi.form.label.field.employment.job',
		 	  		'required'  => false,
		 	  ))		 	  
		 	  ->add('Profile', 'choice', array(
		 	  		'label'	=> 'pi.form.label.field.profile',
		 	  		'required'  => false,
		 	  		'empty_value' => 'pi.form.label.select.choose.profile',
		 	  		'choices'   => array(
		 	  				  'pi.form.label.field.profile.type.cadre.salarie' 				=> 'pi.form.label.field.profile.type.cadre.salarie',
		 	  				  'pi.form.label.field.profile.type.autoentrepreneur'			=> 'pi.form.label.field.profile.type.autoentrepreneur',
		 	  				  'pi.form.label.field.profile.type.other.adherent.individual'	=> 'pi.form.label.field.profile.type.other.adherent.individual',
		 	  		),
		 	  ))	
		 	  ->add('ProfileOther','text', array(
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

		 	  
		 	  
		 	  ->add('Phone','text', array(
		 	  		'label'	=> 'pi.form.label.field.adress.phone',
		 			'required'  => true,   
		 	  		"label_attr" => array(
		 	  				"class"=>"contact_collection",
		 	  		),
		 	  ))
		 	  ->add('CP','text', array(
		 	  		'required'  => false,
		 	  		"label_attr" => array(
		 	  				"class"=>"contact_collection",
		 	  		),
		 	  ))		 	  
		      ->add('Email','text', array(
		      		'label'	=> 'pi.form.label.field.email',
		 			'required'  => true,
		      		"label_attr" => array(
		      				"class"=>"contact_collection",
		      		),
		 	  ))
		      ->add('EmailPerso','text', array(
		      		'label'	=> 'pi.form.label.field.email.perso',
		 			'required'  => false,
		      		"label_attr" => array(
		      				"class"=>"contact_collection",
		      		),
		 	  ))  

		 	  
		 	  
		 	  
		 	  ->add('Company','text', array(
		 	  		'label'	=> 'pi.form.label.field.employment.company',
		 			'required'  => true,
		 	  		"label_attr" => array(
		 	  				"class"=>"job_collection",
		 	  		),
		 	  )) 		
		 	  ->add('Activity', 'choice', array(
	 					'label'	=> 'pi.form.label.field.corporation.activity',
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
	 							"class"=>"pi_simpleselect",
	 					),
	 					"label_attr" => array(
	 							"class"=>"job_collection",
	 					),
	 		  ))
		 	  ->add('Engineering', 'choice', array(
		 	  		'label'	=> 'pi.form.label.field.employment.engineering',
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
		 				"class"=>"pi_simpleselect",
		 			),
		 			"label_attr" => array(
		 				"class"=>"job_collection",
		 			),
		 	  ))        
	 		  ->add('DetailActivity', 'text', array(
	 				'required'  => false,        
		 	  		"label_attr" => array(
		 	  				"class"=>"job_collection",
		 	  		),
	 		  ))
			  ->add('ArgumentActivity','textarea', array(
	 				'required'  => false,        
		 	  		"label_attr" => array(
		 	  				"class"=>"job_collection",
		 	  		),
	 		  ))  
	 		  ->add('Effectif','text', array(
	 		  		'required'  => false,
		 	  		"label_attr" => array(
		 	  				"class"=>"job_collection",
		 	  		),
	 		  ))	 		  
		 	  ->add('Expertise','textarea', array(
		 	  		'label'	=> 'pi.form.label.field.corporation.expertise',
		 	  		'required'  => false,
		 	  		"label_attr" => array(
		 	  				"class"=>"job_collection",
		 	  		),
		 	  ))
		 	  ->add('Speaker', 'choice', array(
		 	  		'label'	=> 'pi.form.label.field.corporation.speaker',
		 	  		'required'  => false,
		 	  		'expanded' => false,
		 	  		'choices'   => array(
	 						'pi.form.label.field.yes' 		=> 'pi.form.label.field.yes',
	 						'pi.form.label.field.no' 		=> 'pi.form.label.field.no',
	 						'pi.form.label.field.potential' => 'pi.form.label.field.potential'
	 				),
		 	  		"label_attr" => array(
		 	  				"class"=>"job_collection",
		 	  		),
		 	  ))
		 	  ->add('OriginContact','choice', array(
		 	  		'label'	=> 'pi.form.label.field.corporation.origin.contact',
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
 							'pi.form.label.field.other' 										=> 'pi.form.label.field.other',
		 	  		),
		 	  		"attr" => array(
		 	  				"class"=>"pi_simpleselect",
		 	  		),
		 	  		"label_attr" => array(
		 	  				"class"=>"job_collection",
		 	  		),
		 	  ))
		 	  ->add('OriginContactOther','text', array(
		 	  		'label'	=> 'pi.form.label.field.other',
		 	  		'required'  => false,
		 	  		"label_attr" => array(
		 	  				"class"=>"job_collection",
		 	  		),
		 	  ))
		 	  ->add('OriginContactSponsor','text', array(
		 	  		'label'	=> 'pi.form.label.field.corporation.origin.contact.sponsor',
		 	  		'required'  => false,
		 	  		"label_attr" => array(
		 	  				"class"=>"job_collection",
		 	  		),
		 	  ))
		
		 	  //->add('user', new \BootStrap\UserBundle\Form\Type\RegistrationFormType('collection'))
		 	  ->add('media', new \PiApp\GedmoBundle\Form\MediaType($this->_container, $this->_em, 'image', 'image_collection', "simpleLink", 'pi.form.label.media.picture'))
        ;
    }

    public function getName()
    {
        return 'piapp_gedmobundle_individualtype';
    }
        
}
