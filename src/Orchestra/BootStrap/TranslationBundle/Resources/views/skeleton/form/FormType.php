<?php
/**
 * This file is part of the <PI_CRUD> project.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 20XX-XX-XX
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace {{ namespace }}\Form{{ entity_namespace ? '\\' ~ entity_namespace : '' }};

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Description of the {{ form_class }} form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class {{ form_class }} extends AbstractType
{
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $_em;
	
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
	public function __construct(EntityManager $em, $locale)
	{
		$this->_em 		= $em;
		$this->_locale	= $locale;
	}
		
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
        {%- for field in fields %}
            
        	{%- if field in ['enabled'] %}
        	
 			->add('enabled', 'checkbox', array(
            		'data'  => true,
            ))
            
 			{%- elseif field in ['created_at'] %}
 			
 			->add('created_at', 'date', array(
 					'widget' => 'single_text', // choice, text, single_text
 					'input' => 'datetime',
 					'format' => 'MM/dd/yyyy',
 					"attr" => array(
 							"class"=>"pi_datepicker",
 					),
 					'label'	=> 'pi.form.label.date.creation',
 			))
 						
 			{%- elseif field in ['updated_at'] %}
 			
 			->add('updated_at', 'date', array(
 					'widget' => 'single_text', // choice, text, single_text
 					'input' => 'datetime',
 					'format' => 'MM/dd/yyyy',
 					"attr" => array(
 							"class"=>"pi_datepicker",
 					),
 					'label'	=> 'pi.form.label.date.updating',
 			))
 						
 			{%- elseif field in ['published_at'] %}
 			
 			->add('published_at', 'date', array(
 					'widget' => 'single_text', // choice, text, single_text
 					'input' => 'datetime',
 					'format' => 'MM/dd/yyyy',
 					"attr" => array(
 							"class"=>"pi_datepicker",
 					),
 					'label'	=> 'pi.form.label.date.publication',
 			))
 					
 			{%- elseif field in ['archive_at'] %}
 			
 			->add('archive_at', 'date', array(
 					'widget' => 'single_text', // choice, text, single_text
 					'input' => 'datetime',
 					'format' => 'MM/dd/yyyy',
 					"attr" => array(
 							"class"=>"pi_datepicker",
 					),
 					'label'	=> 'pi.form.label.date.archivage',
 			))
 					
 			{%- elseif field in ['image', 'image1', 'image2', 'image3', 'image4'] %}
 			
 			->add('{{ field }}', 'sonata_media_type', array(
 					'provider' => 'sonata.media.provider.image',
 					'context'  => 'default',
 					'label'	=> 'pi.form.label.media.picture',
 			))
 			
 			{%- elseif field in ['file', 'file1', 'file2', 'file3', 'file4'] %}
 			
 			->add('{{ field }}', 'sonata_media_type', array(
 					'provider' => 'sonata.media.provider.file',
 					'context'  => 'default',
 					'label'	=> 'pi.form.label.media.file',
 			))
 				 			
 			{%- else %}
 			
 			->add('{{ field }}')
 			
 			{%- endif %}

        {%- endfor %}

        ;
    }

    public function getName()
    {
        return '{{ form_type_name }}';
    }
        
}
