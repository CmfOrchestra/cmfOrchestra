<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Controllers
 * @package    Controller
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-03
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace OrApp\OrAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use PiApp\AdminBundle\Exception\ControllerException;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

use JMS\SecurityExtraBundle\Annotation\Secure;
use JMS\SecurityExtraBundle\Annotation\SatisfiesParentSecurityPolicy;

use PiApp\AdminBundle\Entity\Enquiry;
use PiApp\AdminBundle\Form\EnquiryType;
use PiApp\AdminBundle\Entity\Page as Page;
use PiApp\AdminBundle\Entity\TranslationPage;
use PiApp\AdminBundle\Controller\FrontendController as baseFrontendController;


/**
 * Frontend controller.
 *
 * @category   Admin_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class FrontendController extends baseFrontendController
{}
