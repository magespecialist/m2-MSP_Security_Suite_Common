<?php
/**
 * MageSpecialist
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@magespecialist.it so we can send you a copy immediately.
 *
 * @category   MSP
 * @package    MSP_SecuritySuiteCommon
 * @copyright  Copyright (c) 2017 Skeeller srl (http://www.magespecialist.it)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace MSP\SecuritySuiteCommon\Controller\Stop;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use MSP\SecuritySuiteCommon\Api\SessionInterface;

class Index extends Action
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(
        SessionInterface $session,
        PageFactory $pageFactory,
        Registry $registry,
        Context $context
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->registry = $registry;
        $this->session = $session;
    }

    public function execute()
    {
        $reason = $this->session->getEmergencyStopMessage();

        if (!$reason) {
            $this->_forward('defaultNoRoute');
            return null;
        }

        $this->getResponse()->setHttpResponseCode(500);
        $this->registry->register('msp_security_suite_reason', $reason);
        return $this->pageFactory->create();
    }
}
