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

namespace MSP\SecuritySuiteCommon\Cron;

use MSP\SecuritySuiteCommon\Api\LogManagementInterface;

class Clean
{
    /**
     * @var LogManagementInterface
     */
    private $logManagement;

    public function __construct(
        LogManagementInterface $logManagement
    ) {
        $this->logManagement = $logManagement;
    }

    public function execute()
    {
        $this->logManagement->clean();
        return $this;
    }
}
