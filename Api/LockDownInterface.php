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

namespace MSP\SecuritySuiteCommon\Api;

interface LockDownInterface
{
    const XML_PATH_LOCKDOWN_MODE = 'msp_securitysuite_general/lockdown/stealth';

    const HTTP_LOCKDOWN_CODE = 500;
    const HTTP_LOCKDOWN_BODY = '<h1>500 Internal Server Error</h1>';
    const HTTP_LOCKDOWN_PATH = 'msp_security_suite/stop/index';

    /**
     * Return true if stealth mode is enabled
     * @return bool
     */
    public function getStealthMode();

    /**
     * Return an HTTP for lockdown
     * @param \Magento\Framework\Phrase $message
     * @return \Magento\Framework\App\Response\Http
     */
    public function doHttpLockdown(\Magento\Framework\Phrase $message);

    /**
     * Inject lockdown into action
     * @param \Magento\Framework\App\Action\Action $action
     * @param \Magento\Framework\Phrase $message
     * @return \MSP\SecuritySuiteCommon\Api\LockDownInterface
     */
    public function doActionLockdown(\Magento\Framework\App\Action\Action $action, \Magento\Framework\Phrase $message);
}
