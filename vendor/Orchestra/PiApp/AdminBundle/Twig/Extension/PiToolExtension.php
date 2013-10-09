<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Twig
 * @package    Extension
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use PiApp\AdminBundle\Exception\ExtensionException;

/**
 * Tool Filters and Functions used in twig
 *
 * @category   Admin_Twig
 * @package    Extension
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiToolExtension extends \Twig_Extension
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;
    
    /**
     * Constructor.
     *
     * @param ContainerInterface $container The service container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
        
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getName() {
        return 'admin_tool_extension';
    }
        
    /**
     * Returns a list of filters to add to the existing list.
     * 
     * <code>
     *     {{ comment.content|html }}
     *  {{ 'pi.page.translation.title'|trans|limite('0', 25) }}
     *  {{ "%s Result"|translate_plural("%s Results", entitiesByMonth|count)}}
     * </code> 
     * 
     * @return array An array of filters
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    public function getFilters() {
        return array(
                
                // default
                'php_funct'        => new \Twig_Filter_Method($this, 'phpFilter'),
                
                // debug
                'dump'             => new \Twig_Filter_Method($this, 'dumpFilter'),
                'print_r'         => new \Twig_Filter_Method($this, 'print_rFilter'),
                'get_class'     => new \Twig_Filter_Method($this, 'get_classFilter'),
    
                // markup
                'nl2br'         => new \Twig_Filter_Method($this, 'nl2brFilter'),
                'join'             => new \Twig_Filter_Method($this, 'joinFilter'),
    
                // escape
                'htmlspecialchars'     => new \Twig_Filter_Method($this, 'htmlspecialcharsFilter'),
                'addslashes'         => new \Twig_Filter_Method($this, 'addslashesFilter'),
                'htmlentities'        => new \Twig_Filter_Method($this, 'htmlentitiesFilter'),
                
                // text
                'substr'            => new \Twig_Filter_Method($this, 'substrFilter'),
                'ucfirst'            => new \Twig_Filter_Method($this, 'ucfirstFilter'),
                'ucwords'            => new \Twig_Filter_Method($this, 'ucwordsFilter'),
                'cleanWhitespace'    => new \Twig_Filter_Method($this, 'cleanWhitespaceFilter'),
                'sanitize'            => new \Twig_Filter_Method($this, 'sanitizeFilter'),    
                'slugify'            => new \Twig_Filter_Method($this, 'slugifyFilter'),
                'departement'       => new \Twig_Filter_Method($this, 'departementFilter'),

                'limite'            => new \Twig_Filter_Method($this, 'limitecaractereFilter'),
                'splitText'         => new \Twig_Filter_Method($this, 'splitTextFilter'),
                'splitHtml'         => new \Twig_Filter_Method($this, 'splitHtmlFilter'),
                'truncateText'        => new \Twig_Filter_Method($this, 'truncateFilter'),
                'cutText'            => new \Twig_Filter_Method($this, 'cutTextFilter'),
                
                //array
                'count'                => new \Twig_Filter_Method($this, 'countFilter'),
                'reset'                => new \Twig_Filter_Method($this, 'resetFilter'),
                'steps'                => new \Twig_Filter_Method($this, 'stepsFilter'),
                'sliceTab'            => new \Twig_Filter_Method($this, 'arraysliceFilter'),
                'end'                => new \Twig_Filter_Method($this, 'endFilter'),
                'XmlString2array'    => new \Twig_Filter_Method($this, 'XmlString2arrayFilter'),
                
                //translation
                'translate_plural'    => new \Twig_Filter_Method($this, 'translatepluralFilter'),
                'pluralize'            => new \Twig_Filter_Method($this, 'pluralizeFilter'),
                'depluralize'        => new \Twig_Filter_Method($this, 'depluralizeFilter'),
                
                // SEO
                'obfuscateLink'     => new \Twig_Filter_Method($this, 'obfuscateLinkFilter'),            

                // cryptage
                'encrypt'            => new \Twig_Filter_Method($this, 'encryptFilter'),
                'decrypt'            => new \Twig_Filter_Method($this, 'decryptFilter'),
                
                // status
                'status'         => new \Twig_Filter_Method($this, 'statusFilter'),
        );
    }

    /**
     * Returns a list of functions to add to the existing list.
     * 
     * <code>
     *  {{ link(label, path, array('style' = >'width:11px')) }}
     * </code>
     * 
     * @return array An array of functions
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getFunctions() {
        return array(
                'link'                         => new \Twig_Function_Method($this, 'linkFunction'),
                'in_paths'                     => new \Twig_Function_Method($this, 'inPathsFunction'),
                'get_img_flag_By_country'     => new \Twig_Function_Method($this, 'getImgFlagByCountryFunction'),
                'metas_page'                => new \Twig_Function_Method($this, 'getMetaPageFunction'),
                'title_page'                => new \Twig_Function_Method($this, 'getTitlePageFunction'),
                'file_form'                    => new \Twig_Function_Method($this, 'getFileFormFunction'),
                'get_pattern_by_local'        => new \Twig_Function_Method($this, 'getDatePatternByLocalFunction'),  
                'clean_name'				=> new \Twig_Function_Method($this, 'getCleanNameFunction'),
                
                // picure
                'picture_form'                => new \Twig_Function_Method($this, 'getPictureFormFunction'),
                'picture_index'                => new \Twig_Function_Method($this, 'getPictureIndexFunction'),
                'picture_crop'                => new \Twig_Function_Method($this, 'getPictureCropFunction'),
                
        );
    }   
     
    
    /**
     * Functions
     */
    
    /**
     * this function cleans up the filename
     *
     * @param string $fileName
     * @access public
     * @return string
     * @static
     *
     * @author Riad Hellal <r.hellal@novediagroup.com>
     */
    public static function getCleanNameFunction($fileName)
    {
    	$fileName = strtolower($fileName);
    	$string = substr($fileName, 0, strlen($fileName)- 4);
    	$code_entities_match 	= array( '-' ,'_' ,'.');
    	$code_entities_replace 	= array(' ' ,' ' ,' ');
    	$name 					= str_replace($code_entities_match, $code_entities_replace, $string);
    
    	return $name;
    }    
    
    /**
     * moving an image.
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getPictureFormFunction($media, $nameForm, $format = 'reference', $style = "display: block; text-align:center;margin: 30px auto;", $idForm = "", $ClassName = '') 
    {
        if ($media instanceof \BootStrap\MediaBundle\Entity\Media) {
            $id = $media->getId();
            if ($format != 'reference') {
                $mediaCrop = $this->container->get('sonata.media.twig.extension')->path($media, $format);

                if(file_exists($src = $this->container->get('kernel')->getRootDir() . '/../web'.$mediaCrop)) {
                    $img_balise = '<img title="' . $media->getAuthorname() . '" src="' . $mediaCrop . '?' . time() . '" width="auto" height="auto" alt="' . $media->getAuthorname() . '" style="' . $style . '" >';
                } else {
                    $img_balise = 'Aucune image pour ce format';
                }
                $content = "<div id='picture_" . $id . "_" . $format . "' class='".$format."  ".$ClassName."' > \n";
            } else {
                $img_balise = $this->container->get('sonata.media.twig.extension')->media($media, $format, array(
                    'title' => $media->getAuthorname(),
                    'alt' => $media->getAuthorname(),
                    'style' => $style,
                    'id' => $idForm,
                    'width' => 'auto',
                    'height' => 'auto'
                ));
                $content = "<div id='picture_" . $id . "_" . $format . "' class='".$format." ".$ClassName."' > \n";
            }
            $content .= $img_balise;
            $content .= "</div> \n";
            $content .= "<script type='text/javascript'> \n";
            $content .= "//<![CDATA[ \n";
            $content .= "$('#{$nameForm}').before($('#picture_" . $id . "_" . $format . "')); \n";
            $content .= "//]]> \n";
            $content .= "</script> \n";
            
            return $content;
        }
    }

    /**
     * moving a file.
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getFileFormFunction($media, $nameForm, $style = "display: block; text-align:center;margin: 30px auto;z-index:99999999999", $is_by_mimetype = true)
    {
        if ($media instanceof \BootStrap\MediaBundle\Entity\Media){
            $id         = $media->getId();

            try {
                    $file_url = $this->container->get('sonata.media.twig.extension')->path($id, "reference");

                    if ($is_by_mimetype){
                       $mime = str_replace('/','-',$media->getContentType());
                       $picto = '/bundles/piappadmin/images/icons/mimetypes/'.$mime.'.png';
                    } else {
                        $ext = substr(strtolower(strrchr(basename($file_url), ".")), 1);
                        $picto = '/bundles/piappadmin/images/icons/form/download-'.$ext.'.png';
                    }

                    if (!file_exists('.'.$picto)) {
                        $picto = '/bundles/piappadmin/images/icons/form/download-32.png';
                    }
            } catch (\Exception $e) {
                return "";
            }

            $content     = "<div id='file_$id'> \n";
            $content    .= "<a href='{$file_url}' target='_blanc' style='{$style}'> <img src='$picto' /> ".$media->getName()."</a>";
            $content    .= "</div> \n";

            $content    .= "<script type='text/javascript'> \n";
            $content    .= "//<![CDATA[ \n";
            $content    .= "$('#file_$id').detach().appendTo('#{$nameForm}'); \n";
            $content    .= "//]]> \n";
            $content    .= "</script> \n";

            return $content;
        }
    }

    public function getPictureIndexFunction($media, $format = '', $width='', $height='')
    {
        if ($media instanceof \BootStrap\MediaBundle\Entity\Media) {
            $id = $media->getId();

            $mediaCrop = $this->container->get('sonata.media.twig.extension')->path($media, $format);

            if(file_exists($src = $this->container->get('kernel')->getRootDir() . '/../web'.$mediaCrop))
                $img_balise = '<img title="' . $media->getAuthorname() . '" src="' . $mediaCrop . '?' . time() . '" width="auto" height="auto" alt="' . $media->getAuthorname() . '"/>';
            else
                $img_balise = 'Aucune image ce format ';

            $content ="<div>Dimensions de ".$format." = " .$width."x".$height."</div>";
            $content .= "<div id='picture_" . $id . $format . "' class='".$format." default_crop' > \n";
            $content .= $img_balise;
            $content .= "</div></br></br> \n";
            return $content;
        }
    }
    
    public function getPictureCropFunction($media, $format = "PiAppTemplateBundle:Template\\Crop:default.html.twig", $nameForm = "")
    {
        if ($format == "default") {
            $format = "PiAppTemplateBundle:Template\\Crop:default.html.twig";
        }
    	if ($media instanceof \BootStrap\MediaBundle\Entity\Media) {
            $response     = $this->container->get('templating')->renderResponse(
                                $format, 
                                array(
                                    "media"=>$media,
                                    "nameForm"=>$nameForm,
                                )
            );
            
            return $response->getContent();
    	}
    }    
        
    /**
     * Creating a link.
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    public function linkFunction( $label, $path, $options = array() ) {
        $attributes = '';
        foreach( $options as $key=>$value )
            $attributes .= ' ' . $key . '="' . $value . '"';

        return '<a href="' . $path . '"' . $attributes . '>' . $label . '</a>';
    }
    
    /**
     * Return the $returnTrue value if the route of the page is include in $paths value, else return the $returnFalse value.
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    public function inPathsFunction($paths, $returnTrue = '', $returnFalse = '')
    {
        $route = (string) $this->container->get('request')->get('_route');
        $names = explode(':', $paths);
        $is_true = false;
        
        if (is_array($names)){
            foreach($names as $k => $path){
                if ($route == $path)
                    $is_true = true;
            }
            if ($is_true)
                return $returnTrue;
            else
                return $returnFalse;            
        } else {
            if ($route == $paths)
                return $returnTrue;
            else
                return $returnFalse;            
        }
    }    
    
    /**
     * Return the image flag of a country.
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    public function getImgFlagByCountryFunction($country, $type ="img", $taille="16")
    {
        $locale                = $this->container->get('request')->getLocale();
        $all_countries         = $this->container->get('pi_app_admin.string_manager')->allCountries($locale);       
        $all_countries_en     = $this->container->get('pi_app_admin.string_manager')->allCountries("en_GB");
        
        if (isset($all_countries[strtolower($country)])){
            $img_country  = str_replace(' ', '-', $all_countries_en[strtolower($country)]) . "-Flag-".$taille.".png";
            $name_country = $all_countries[strtolower($country)]; // locale_get_display_name(strtolower($entity->getCountry()), strtolower($locale))
            $src          = $this->container->getParameter('kernel.http_host') . "/bundles/piappadmin/images/flags/png/" . $img_country;
        } else {
            $img_country  = "Default-Flag-".$taille.".png";
            $name_country = $country;
            $src          = $this->container->getParameter('kernel.http_host') . "/bundles/piappadmin/images/flags/default/Default-flag-".$taille.".png";
        }


        if ($type == "img_counry") return $img_country;
        elseif ($type == "name_country") return $name_country;
        elseif ($type == "balise") {
            return "<img src='{$src}' alt='{$name_country} flag' title='{$name_country} flag'/>";
        }
        
    }    
    
    /**
     * Return the meta title of a page.
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    public function getTitlePageFunction($title)
    {
        if (empty($title)) {
            $title     = $this->container->getParameter('pi_app_admin.layout.meta.title');
        }
                
        try {
            $lang          = $this->container->get('request')->getLocale();
            $pathInfo	= $this->container->get('request')->getPathInfo();
            $match        = $this->container->get('be_simple_i18n_routing.router')->match($pathInfo);
            $route        = $match['_route'];
            
            if (isset($GLOBALS['ROUTE']['SLUGGABLE'][ $route ]) && !empty($GLOBALS['ROUTE']['SLUGGABLE'][ $route ])) {
                $sluggable_entity         = $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['entity'];
                $sluggable_field_search = $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_search'];
                $sluggable_title         = $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_title'];
                $sluggable_resume         = $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_resume'];
                $sluggable_keywords        = $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_keywords'];
                
                if (isset($GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_name']) && !empty($GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_name'])) {
                    $sluggable_field_name    = $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_name'];
                } else {    
                    $sluggable_field_name    =   $sluggable_field_search;  
                }
                
                $sluggable_title_tab = array_map(function($value) {
                    return ucwords($value);
                }, array_values(explode('_', $sluggable_title)));
                $sluggable_resume_tab = array_map(function($value) {
                    return ucwords($value);
                }, array_values(explode('_', $sluggable_resume)));
                $sluggable_keywords_tab = array_map(function($value) {
                    return ucwords($value);
                }, array_values(explode('_', $sluggable_keywords)));                    
                
                $method_title         = "get".implode('', $sluggable_title_tab);
                $method_resume         = "get".implode('', $sluggable_resume_tab);
                $method_keywords     = "get".implode('', $sluggable_keywords_tab);    

                if ( ($sluggable_field_search == 'id') && isset($match['id']) ) {
                    $entity         = $this->container->get('doctrine')->getManager()->getRepository($sluggable_entity)->findOneByEntity($lang, $match['id'], 'object');
                    if (is_object($entity) && method_exists($entity, $method_title)) {
                        $title = $entity->$method_title();
                    }
                } elseif (array_key_exists($sluggable_field_search, $match)) {
                    $result = $this->container->get('doctrine')->getManager()->getRepository($sluggable_entity)->getContentByField($lang, array('content_search' => array($sluggable_field_name =>$match[$sluggable_field_search]), 'field_result'=>$sluggable_title), false);
                    if (is_object($result)) {
                        $title = $result->getContent();
                    }
                }
            }            
        } catch (\Exception $e) {
        }
        
        return strip_tags($this->container->get('translator')->trans($title));
    }
    
    /**
     * Return the metas of a page.
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    public function getMetaPageFunction(array $options)
    {
        // we get the param.
        $lang               = $this->container->get('request')->getLocale();
        $Uri             = $this->container->get('request')->getUri();
        $BasePath        = $this->container->get('request')->getUriForPath('');
        $author             = str_replace(array('"',"’"), array("'","'"), $this->container->getParameter('pi_app_admin.layout.meta.author'));
        $copyright        = str_replace(array('"',"’"), array("'","'"), $this->container->getParameter('pi_app_admin.layout.meta.copyright'));
        $description     = str_replace(array('"',"’"), array("'","'"), $this->container->getParameter('pi_app_admin.layout.meta.description'));
        $keywords         = str_replace(array('"',"’"), array("'","'"), $this->container->getParameter('pi_app_admin.layout.meta.keywords'));
        $og_type        = str_replace(array('"',"’"), array("'","'"), $this->container->getParameter('pi_app_admin.layout.meta.og_type'));
        $og_image        = str_replace(array('"',"’"), array("'","'"), $this->container->getParameter('pi_app_admin.layout.meta.og_image'));
        $og_site_name     = str_replace(array('"',"’"), array("'","'"), $this->container->getParameter('pi_app_admin.layout.meta.og_site_name'));
        // if the file doesn't exist, we call an exception
        $og_image = strip_tags($this->container->get('translator')->trans($og_image));
        $is_file_exist = realpath($this->container->get('kernel')->getRootDir(). '/../web/' . $og_image);
        if (!$is_file_exist) {
            throw ExtensionException::FileUnDefined('img',__CLASS__);
        }        
        $og_image = $this->container->get('templating.helper.assets')->getUrl($og_image);
        // description management
        $metas[] = "    <meta charset='".$this->container->get('twig')->getCharset()."'/>";
        $metas[] = "    <meta http-equiv='Content-Type'/>";
        $metas[] = "    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>";
        $metas[] = "    <meta name='generator' content=\"Orchestra\"/>";
        // we create all meta tags.
        if (isset($copyright) && !empty($copyright)) {
            $copyright = strip_tags($this->container->get('translator')->trans($copyright));
            $metas[] = "<link rel='copyright' href=\"".$copyright."\"/>";
        }
        $metas[] = "    <meta property='og:url' content=\"{$Uri}\"/>";
        try {
            // title management
            $pathInfo	= $this->container->get('request')->getPathInfo();
            $match        = $this->container->get('be_simple_i18n_routing.router')->match($pathInfo);
            $route        = $match['_route'];
            if (isset($GLOBALS['ROUTE']['SLUGGABLE'][ $route ]) && !empty($GLOBALS['ROUTE']['SLUGGABLE'][ $route ])) {
                $sluggable_entity         = $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['entity'];
                $sluggable_field_search = $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_search'];
                $sluggable_title         = $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_title'];
                $sluggable_resume         = $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_resume'];
                $sluggable_keywords        = $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_keywords'];
                $sluggable_title_tab = array_map(function($value) {
                    return ucwords($value);
                }, array_values(explode('_', $sluggable_title)));
                $sluggable_resume_tab = array_map(function($value) {
                    return ucwords($value);
                }, array_values(explode('_', $sluggable_resume)));
                $sluggable_keywords_tab = array_map(function($value) {
                    return ucwords($value);
                }, array_values(explode('_', $sluggable_keywords)));                    
                $method_title         = "get".implode('', $sluggable_title_tab);
                $method_resume         = "get".implode('', $sluggable_resume_tab);
                $method_keywords     = "get".implode('', $sluggable_keywords_tab);                
                if ( ($sluggable_field_search == 'id') && isset($match['id']) ) {
                    $entity = $this->container->get('doctrine')->getManager()->getRepository($sluggable_entity)->findOneByEntity($lang, $match['id'], 'object');
                    if (is_object($entity) && method_exists($entity, $method_title) && method_exists($entity, $method_resume) && method_exists($entity, $method_keywords)) {
                        $og_title                 = str_replace(array('"',"’"), array("'","'"), $entity->$method_title());
                        $new_meta                = "    <meta property='og:title' content=\"{$og_title}\"/>";
                        $options['description'] = str_replace(array('"',"’"), array("'","'"), strip_tags($this->container->get('translator')->trans($entity->$method_resume())));
                        $options['keywords']    = str_replace(array('"',"’"), array("'","'"), strip_tags($this->container->get('translator')->trans($entity->$method_keywords())));
                    }
                } elseif (array_key_exists($sluggable_field_search, $match)) {
                    $meta_title                        = $this->container->get('doctrine')->getManager()->getRepository($sluggable_entity)->getContentByField($lang, array('content_search' => array($sluggable_field_search =>$match[$sluggable_field_search]), 'field_result'=>$sluggable_title), false);
                    $meta_resume                    = $this->container->get('doctrine')->getManager()->getRepository($sluggable_entity)->getContentByField($lang, array('content_search' => array($sluggable_field_search =>$match[$sluggable_field_search]), 'field_result'=>$sluggable_resume), false);
                    $meta_keywords                    = $this->container->get('doctrine')->getManager()->getRepository($sluggable_entity)->getContentByField($lang, array('content_search' => array($sluggable_field_search =>$match[$sluggable_field_search]), 'field_result'=>$sluggable_keywords), false);
                    
                    if(is_object($meta_title)){
                        $og_title                     = str_replace(array('"',"’"), array("'","'"), $meta_title->getContent());
                        $new_meta                    = "<meta property='og:title' content=\"{$og_title}\"/>";
                    }
                    if (is_object($meta_resume)) {
                        $options['description']     = str_replace(array('"',"’"), array("'","'"), strip_tags($this->container->get('translator')->trans($meta_resume->getContent())));
                    }
                    if (is_object($meta_keywords)) {
                        $options['keywords']        = str_replace(array('"',"’"), array("'","'"), strip_tags($this->container->get('translator')->trans($meta_keywords->getContent())));
                    }
                }
            }
            if (empty($new_meta) && isset($options['title']) && !empty($options['title'])) {
                $options['title'] = str_replace(array('"',"’"), array("'","'"), strip_tags($this->container->get('translator')->trans($options['title'])));
                $metas[] = "    <meta property='og:title' content=\"{$options['title']}\"/>";
            } elseif (!empty($new_meta)) {
                $metas[] = $new_meta;
            }
        } catch (\Exception $e) {
            if(isset($options['title']) && !empty($options['title'])){
                $options['title'] = str_replace(array('"',"’"), array("'","'"), strip_tags($this->container->get('translator')->trans($options['title'])));
                $metas[]           = "    <meta property='og:title' content=\"{$options['title']}\"/>";
            }            
        }
        if (isset($og_type) && !empty($og_type)) {
            $og_type = strip_tags($this->container->get('translator')->trans($og_type));
            $metas[] = "    <meta property='og:type' content=\"{$og_type}\"/>";
        }
        if (isset($og_image) && !empty($og_image)) {
            $og_image = strip_tags($this->container->get('translator')->trans($og_image));
            $metas[] = "    <meta property='og:image' content=\"{$BasePath}{$og_image}\"/>";
        }
        if (isset($og_site_name) && !empty($og_site_name)) {
            $og_site_name = strip_tags($this->container->get('translator')->trans($og_site_name));
            $og_site_name = str_replace('https://', '', $og_site_name);
            $og_site_name = str_replace('http://', '', $og_site_name);
            $metas[] = "    <meta property='og:site_name' content=\"{$og_site_name}\"/>";
        }
        if (isset($author) && !empty($author)) {
            $author = strip_tags($this->container->get('translator')->trans($author));
            $metas[] = "    <meta name='author' content=\"".$author."\"/>";
        }
        if (isset($options['description']) && !empty($options['description'])) {
            $metas[] = "    <meta name='description' content=\"".$options['description']."\"/>";
        } elseif (isset($description) && !empty($description)) {
            $metas[] = "    <meta name='description' content=\"".strip_tags($this->container->get('translator')->trans($description))."\"/>";
        }
        if (isset($options['keywords']) && !empty($options['keywords'])) {
            $metas[] = "    <meta name='keywords' content=\"".$options['keywords']."\"/>";
        } elseif (isset($keywords) && !empty($keywords)) {
            $metas[] = "    <meta name='keywords' content=\"".strip_tags($this->container->get('translator')->trans($keywords))."\"/>";
        }
        // mobile management
        //$metas[] = "<meta name='apple-mobile-web-app-capable' content='yes'/>";
        //$metas[] = "<meta name='apple-mobile-web-app-status-bar-style' content='black'/>";
        //$metas[] = "<meta name='viewport'    id='viewport'  content='target-densitydpi=device-dpi, user-scalable=no' />";
        //$metas[] = "<meta name='viewport' content='initial-scale=1.0; user-scalable=0; minimum-scale=1.0; maximum-scale=1.0;' />";
        $metas[] = "<!-- Mobile viewport optimized: h5bp.com/viewport -->";
        $metas[] = "<meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1'>";
        //Empécher Microsoft de générer des "smart tags" sur notre page web.
        //$metas[] = "meta name='MSSmartTagsPreventParsing' content='TRUE'/>";
        // robot management
        $metas[] = "    <meta name='robots' content='ALL'/>";
        $metas[] = "    <meta name='robots' content='index, follow'/>";
        $metas[] = "    <meta name='robots' content='noodp'/>";
        //$metas[] = "    <base href='/'>";
                
        return implode(" \n", $metas);
    }
    
    /**
     * translation of date.
     *
     * @author riad hellal <r.hellal@novediagroup.com>
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getDatePatternByLocalFunction($locale, $fileName = 'i18n_date.json')
    {
        $root_file         = realpath($this->container->getParameter("kernel.cache_dir") . '/../'.$fileName);
        if (!$root_file) {
        	$isGood = $this->updateCulturesJsFilesFunction($fileName);
        	$root_file  = realpath($this->container->getParameter("kernel.cache_dir") . '/../'.$fileName);
        }
        // we parse the data file of all formats
        $dates         = array();
        $dates        = json_decode(file_get_contents($root_file));
        // we set the locale value
        $locale = strtolower(substr($locale, 0, 2));
        $root_file         = realpath($this->container->getParameter("kernel.root_dir") . "/../web/bundles/piappadmin/js/ui/i18n/jquery.ui.datepicker-{$locale}.js");
        if (!$root_file) {
        	$locale = "en-GB";
        }
        // we return the locale format of the date
        if (isset($dates->{$locale})) {
            return $dates->{$locale};
        } else {
            return "dd/MM/yy";  // "MM/dd/yyyy";
        }
    }
    
    /**
     * parsing translaion js files.
     *
     * @author riad hellal <r.hellal@novediagroup.com>
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    private function updateCulturesJsFilesFunction($fileName = 'i18n_date.json')
    {
        $root_dir = realpath($this->container->getParameter("kernel.cache_dir"). '/../');
        $rout_i18n_files = realpath($this->container->getParameter("kernel.root_dir") . "/../web/bundles/piappadmin/js/ui/i18n/");
        $MyDirectory = opendir($rout_i18n_files) or die('Erreur');
        $fp = fopen($root_dir.'/'.$fileName, 'w');
        while($Entry = @readdir($MyDirectory)) {
            if ($Entry != '.' && $Entry != '..') {
                $ch = file_get_contents($rout_i18n_files."/".$Entry, FILE_USE_INCLUDE_PATH);
                preg_match('/dateFormat:([ ]*)\'(.+)\',/', $ch, $match);
                preg_match('#datepicker.regional\[[\'"]{1}(?P<value>(.*))[\'"]{1}\]#sU', $ch, $locale);
                if (isset($locale['value'])) {
                    $ln = $locale['value'];
                } else {
                    print_r($rout_i18n_files."/".$Entry);exit;
                }
                
                $posts[$ln] =  str_replace('m','M',$match[2]);
            }
        }
        fwrite($fp, json_encode($posts));
        fclose($fp);
        closedir($MyDirectory);
            
        return true;
    }    
        
    
    /**
     * divers Filters
     */
    
    public function statusFilter($entity)
    {
    	if (is_object($entity)) {
    		$enabled = $entity->getEnabled();
    		$archivedAt = $entity->getArchiveAt();
    		$archived = $entity->getArchived();
    	} else {
    		$enabled = $entity['enabled'];
    		$archivedAt = $entity['archive_at'];
    		$archived = $entity['archived'];
    	}
    	if ( ($enabled  == true ) && ($archived == false) ) {
    		$status = 'Actif' ;
    	} elseif(!empty($archivedAt) && ($archived == true)) {
    		$status = 'Supprimé';
    	} elseif ( ($enabled  == false ) && ($archived == false) ) {
    		$status = "En attente d'activation";
    	}
    
    	return $status;
    }    
        
    public function phpFilter($var, $function) {
        return $function($var);
    }
        
    public function joinFilter( $objects, $glue = ', ', $lastGlue = null ) {
        null === $lastGlue && $lastGlue = $glue;
    
        $last = '';
        if ( 2 < count($objects) )
            $last = $lastGlue . array_pop($objects);
    
        return implode($glue, $objects) . $last;
    }
    
    public function dumpFilter($var) {
        var_dump($var);
        return '';
    }
    
    public function print_rFilter($var) {
        return print_r($var, 1);
    }
    
    public function get_classFilter($object) {
        return get_class($object);        
    }
    
    public function nl2brFilter($string) {
        return nl2br($string);
    }

    public function htmlspecialcharsFilter( $string ) {
        $flags = ENT_COMPAT;
        defined('ENT_HTML5') && $flags |= ENT_HTML5;
    
        return htmlspecialchars($string, $flags, 'UTF-8');
    }
    
    public function htmlentitiesFilter( $string ) {
        $flags = ENT_COMPAT;
        defined('ENT_HTML5') && $flags |= ENT_HTML5;
        
        return htmlentities($string, $flags, 'UTF-8');
    }
    
    public function addslashesFilter( $string ) {
        return addslashes($string);
    }    
    
    public function substrFilter( $string, $first, $last = null){
        if (is_null($last))
            return substr($string, $first);
        else
            return substr($string, $first, $last);
    }
    
    /**
     * array filters
     */    
    public function countFilter($array) {
        return count($array);
    }
    
    public function resetFilter($array) {
        reset($array);
        return $array;
    }

    public function endFilter($array) {
        end($array);
        return $array;
    }    

    public function stepsFilter($array, $step) {
        $count = count($array);
        
        if ($count >= $step){
            reset($array);
            for ($i=1; $i<=$step; $i++) {
                next($array);
            }
            return current($array);
        }else
            return '';
    }    
    
    public function arraysliceFilter($array, $first, $last = null) {
        if (is_null($last))
            $result = array_slice($array, $first); 
        else
            $result = array_slice($array, $first, $last);
        
        if (count($result) >= 1)
            return $result;
        else
            return '';
    }

    public function XmlString2arrayFilter($string){
        return $this->container->get('pi_app_admin.array_manager')->XmlString2array($string);
    }
    
    /**
     * translation filters
     */    
    public function translatepluralFilter($single, $plural, $number, $domain = "messages") {
        if ($number > 1) 
            return $this->container->get('translator')->trans(sprintf($plural, $number), array('%s'=>$number), $domain);
        else
            return $this->container->get('translator')->trans(sprintf($single, $number), array('%s'=>$number), $domain);
    }    
    
    public function pluralizeFilter($string, $number = null) {
        if ($number && ($number == 1))
            return $string;
        else
            return $this->container->get('pi_app_admin.string_manager')->pluralize($string);
    }    
    
    public function depluralizeFilter($string, $number = null) {
        if ($number && ($number > 1))
            return $string;
        else
            return $this->container->get('pi_app_admin.string_manager')->depluralize($string);
    }    
    
    
    /**
     * text filters
     */
    public function ucfirstFilter($string) {
        return ucfirst($string);
    }

    public function ucwordsFilter($string) {
        return ucwords($string);
    }
    
    public function cleanWhitespaceFilter($string) {
        return $this->container->get('pi_app_admin.string_manager')->cleanWhitespace($string);
    }    
    
    public function sanitizeFilter($string, $force_lowercase = true, $anal = false, $trunc = 100) {
        return $this->container->get('pi_app_admin.string_manager')->sanitize($string, $force_lowercase, $anal, $trunc);
    }
    
    public function slugifyFilter($string) {
        return $this->container->get('pi_app_admin.string_manager')->slugify($string);
    }

    public function departementFilter($id) {
        $em = $this->container->get('doctrine')->getManager();
        $departement  = $em->getRepository('M1MProviderBundle:Region')->findOneBy(array('id' => $id));
        return $departement;
    }


    public function limitecaractereFilter($string, $mincara, $nbr_cara) {
        return $this->container->get('pi_app_admin.string_manager')->LimiteCaractere($string, $mincara, $nbr_cara);
    }    
    
    public function splitTextFilter($string){
        return $this->container->get('pi_app_admin.string_manager')->splitText($string);
    }
    public function splitHtmlFilter($string){
        return $this->container->get('pi_app_admin.string_manager')->splitHtml($string);
    }
    
    public function truncateFilter($string, $length = 100, $ending = "...", $exact = false, $html = true) {
        return $this->container->get('pi_app_admin.string_manager')->truncate($string, $length, $ending, $exact, $html);
    }    
    
    public function cutTextFilter($string, $intCesurePos, $otherText = false, $strCaractereCesure = ' ', $intDecrementationCesurePos = 5){
        $HtmlCutter    = $this->container->get('pi_app_admin.string_cut_manager');
        $HtmlCutter->setOptions($string, $intCesurePos, $otherText);
        $HtmlCutter->setParams($strCaractereCesure, $intDecrementationCesurePos);
        return $HtmlCutter->run();
    }
    
    /**
     * encrypt string
     *
     * @param string $string
     * @param string $key
     */
    public function encryptFilter($string, $key = "0A1TG4GO")
    {
        $key = $key . "0A1TG4GO";
        $result = '';
        for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)+ord($keychar));
            $result.=$char;
        }
        return strtr(base64_encode($result), '+/=', '-_,');
    }
    
    /**
     * decrypt string
     *
     * @param string $string
     * @param string $key
     */
    public function decryptFilter($string, $key = "0A1TG4GO")
    {
        $key = $key . "0A1TG4GO";
        $result = '';
        $string = base64_decode(strtr($string, '-_,', '+/='));
        for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)-ord($keychar));
            $result.=$char;
        }
        return $result;
    }  
    
    /**
     * Obfuscate link. SEO worst practice.
     * Code by @position
     *
     * @param string $url
     */
    public function obfuscateLinkFilter($url)
    {
        $_base16 = "0A12B34C56D78E9F";
    
        $output = "";
        for ($i = 0; $i < strlen($url); $i++) {
            $cc = ord($url[$i]);
            $ch = $cc >> 4;
            $cl = $cc - ($ch * 16);
            $output .= $_base16[$ch] . $_base16[$cl];
        }
        return $output;
    }    
    
}