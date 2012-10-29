<?php
/**
 * This file is part of the <Admin> project.
 * 
 * @category   Admin_Twig
 * @package    Extension_layoutHead
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-01-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Twig\Node;

/**
 * Javascripts Node.
 *
 * @category   Admin_Twig
 * @package    Extension_layoutHead
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class JavascriptsNode extends \Twig_Node
{
	/**
	 * @var string $extensionName
	 */
	protected $extensionName;
		
    /**
     * @param 	integer 							$lineno
     * @param 	string 								$tag (optional)
     * @return 	void
     */
    public function __construct($extensionName, $lineno, $tag = null)
    {
    	$this->extensionName = $extensionName;
    	
        parent::__construct(array(), array(), $lineno, $tag);
    }

    /**
     * @param \Twig_Compiler $compiler
     * @return void
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this);

        $compiler
            ->write("echo \$this->env->getExtension('".$this->extensionName."')->renderScript();\n");
    }
}
