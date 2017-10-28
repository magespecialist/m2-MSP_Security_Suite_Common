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

interface AlertInterface
{
    const EVENT_PREFIX = 'msp_securitysuite';

    const LEVEL_INFO = 'info';
    const LEVEL_WARNING = 'warn';
    const LEVEL_ERROR = 'error';
    const LEVEL_SECURITY_ALERT = 'security_alert';

    const ACTION_LOG = 'log';
    const ACTION_LOCKDOWN = 'lockdown';

    /**
     * Trigger a security suite event
     * @param string $module
     * @param string $message
     * @param string $level
     * @param string $username
     * @param string $action
     * @param array|string $payload
     * @return boolean
     */
    public function event($module, $message, $level = null, $username = null, $action = null, $payload = null);
}
