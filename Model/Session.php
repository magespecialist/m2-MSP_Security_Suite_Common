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

namespace MSP\SecuritySuiteCommon\Model;

use Magento\Framework\Session\SessionManager;
use MSP\SecuritySuiteCommon\Api\SessionInterface;

class Session extends SessionManager implements SessionInterface
{
    /**
     * Set emergency stop message
     * @param string $message
     */
    public function setEmergencyStopMessage($message)
    {
        $this->storage->setData('message', $message);
    }

    /**
     * Get emergency stop message
     * @return string
     */
    public function getEmergencyStopMessage()
    {
        return $this->storage->getData('message');
    }
}
