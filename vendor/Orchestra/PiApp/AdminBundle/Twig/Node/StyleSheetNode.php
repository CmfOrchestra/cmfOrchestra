<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Twig
 * @package    Extension_layoutHead
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Twig\Node;

/**
 * StyleSheet Node.
 *
 * @category   Admin_Twig
 * @package    Extension_layoutHead
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class StyleSheetNode extends \Twig_Node
{
	/**
	 * @var string $extensionName
	 */
	protected $extensionName;
		
    /**
     * @param 	\Twig_NodeInterface 	$value
     * @param 	\Twig_Node_Expression 	$order
     * @param 	integer 				$lineno
     * @param 	string 					$tag (optional)
     * @return 	void
     */
    public function __construct($extensionName, \Twig_NodeInterface $value, $lineno, $tag = null)
    {
    	$this->extensionName = $extensionName;
    	
        //parent::__construct(array('value' => $value, 'order' => $order), array(), $lineno, $tag);
        parent::__construct(array('value' => $value), array(), $lineno, $tag);
    }

    /**
     * @param \Twig_Compiler $compiler
     * @return void
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this);

        $compiler
            ->write(sprintf("echo \$this->env->getExtension('%s')->addCssFile(", $this->extensionName))
            ->subcompile($this->getNode('value'))
            //->raw(', ')
            //->subcompile($this->getNode('order'))
            ->raw(");\n");
    }
}
