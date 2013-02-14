<?php
/**
 * This Locale is part of the <Admin> project.
 *
 * @category   Admin_Builders
 * @package    Builder
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2013-02-05
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Builder;

/**
 * PiMailerManagerBuilderInterface interface.
 *
 * @category   Admin_Builders
 * @package    Builder
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
interface PiMailerManagerBuilderInterface
{
	public function getMessage();
	public function send($from, $to, $subject, $body, $cc = null, $bcc = null, $replayto = null, $filespath = null, $is_pictureEmbed = false, $is_Html2Text = false);
	public function init(\Swift_Mime_Message $message, $from, $to, $cc, $bcc, $replayto, $subject, $body);
	public function push(\Swift_Mime_Message $message);
	public function attach(\Swift_Mime_Message $message, $file);
	public function pictureEmbed(\Swift_Mime_Message $message);
	public function Html2Text(\Swift_Mime_Message $message);
	
}