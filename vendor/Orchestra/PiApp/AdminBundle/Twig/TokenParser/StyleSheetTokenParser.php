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
namespace PiApp\AdminBundle\Twig\TokenParser;
 
use PiApp\AdminBundle\Twig\Node\StyleSheetNode;

/**
 * StyleSheet Token Parser.
 *
 * @category   Admin_Twig
 * @package    Extension_layoutHead
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class StyleSheetTokenParser extends \Twig_TokenParser
{
	/**
	 * @var string $extensionName
	 */
	protected $extensionName;
	
	/**
	 * Constructor.
	 *
	 * @param string $extensionName The extension name
	 */
	public function __construct($extensionName)
	{
		$this->extensionName = $extensionName;
	}
		
    /**
     * Parses a token and returns a node.
     *
     * @param \Twig_Token $token A \Twig_Token instance
     *
     * @return \Twig_NodeInterface A \Twig_NodeInterface instance
     */
    public function parse(\Twig_Token $token)
    {
        $value  = $this->parser->getExpressionParser()->parseExpression();
        //$this->parser->getStream()->next();
        //$order  = $this->parser->getExpressionParser()->parseExpression();    
        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);

        //return new StyleSheetNode($this->extensionName, $value, $order, $token->getLine(), $this->getTag());
        return new StyleSheetNode($this->extensionName, $value, $token->getLine(), $this->getTag());
    }

    /**
     * Gets the tag name associated with this token parser.
     *
     * @param string The tag name
     */
    public function getTag()
    {
        return 'stylesheet';
    }
}
