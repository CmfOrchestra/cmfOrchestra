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
namespace PiApp\AdminBundle\Twig\TokenParser;

use PiApp\AdminBundle\Twig\Node\JavascriptsNode;

/**
 * Javascripts Token Parser.
 *
 * @category   Admin_Twig
 * @package    Extension_layoutHead
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class JavascriptsTokenParser extends \Twig_TokenParser
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
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();
        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new JavascriptsNode($this->extensionName, $lineno, $this->getTag());
    }

    /**
     * Gets the tag name associated with this token parser.
     *
     * @param string The tag name
     */
    public function getTag()
    {
        return 'javascripts';
    }
}
