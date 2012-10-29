<?php
/**
 * AF Application
 *
 * @category   Library
 * @package    FormeElement
 * @subpackage Number
 * @version    $Id: Number.php 2009-11-19 00:00:00 pi_etienne $
 *
 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
 */


/**
 * Classe Element Number par default.
 *
 *<code>
 *	$date_test = new Zend_Form_Element_Email('email');
 *	$date_test->setLabel('E-mail')->setRequired(true);
 *</code>
 * @example	application\modules\admin\... Comment utiliser cette fonction.
 * @uses Zend_Form_Element
 * @category   Library
 * @package    FormeElement
 * @subpackage Number
 *
 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
 */
class Zend_Form_Element_Number extends Zend_Form_Element_Text
{
	public $helper = 'formText';
	
	public function init()
	{
		$this->addValidator('Float');
	}	
	
    /**
     * Render form element
     *
     * @param  Zend_View_Interface $view
     * @return string
     */
    public function render(Zend_View_Interface $view = null)
    {
        if ($this->_isPartialRendering) {
            return '';
        }

        if (null !== $view) {
            $this->setView($view);
        }

        $content = '';
        foreach ($this->getDecorators() as $decorator) {
            $decorator->setElement($this);
            $content = $decorator->render($content);
        }
        
        $message 		= $content;
        $terms			= 'type="text"';
        $replacement 	= 'type="number"';
        $content 		= preg_replace("/(^|[^a-zA-Z])($terms)([^a-zA-Z]|$)/si",'\\1'.$replacement.'\\3',$message);
        
        return $content;
    }		
}