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

interface LogManagementInterface
{
    const EVENT_ACTIVITY = 'msp_securitysuite_activity_detected';
    const XML_PATH_LOGGING_PERSISTENCE = 'msp_securitysuite_general/logging/days_peristence';

    /**
     * Log a security suite event
     * @param string $moduleName
     * @param string $message
     * @param string $action
     * @param string $additional = null
     * @param string $user = null
     * @return void
     */
    public function logEvent($moduleName, $message, $action, $additional = null, $user = null);

    /**
     * Clean old events
     * @return void
     */
    public function clean();
}
