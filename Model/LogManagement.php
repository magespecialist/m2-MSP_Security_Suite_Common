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

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;
use MSP\SecuritySuiteCommon\Api\Data\LogInterfaceFactory;
use MSP\SecuritySuiteCommon\Api\LogManagementInterface;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use MSP\SecuritySuiteCommon\Api\LogRepositoryInterface;

class LogManagement implements LogManagementInterface
{
    /**
     * @var LogInterfaceFactory
     */
    private $logInterfaceFactory;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var DateTime
     */
    private $dateTime;

    /**
     * @var RemoteAddress
     */
    private $remoteAddress;

    /**
     * @var LogRepositoryInterface
     */
    private $logRepository;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    public function __construct(
        LogInterfaceFactory $logInterfaceFactory,
        DateTime $dateTime,
        RequestInterface $request,
        RemoteAddress $remoteAddress,
        ScopeConfigInterface $scopeConfig,
        LogRepositoryInterface $logRepository
    ) {
        $this->logInterfaceFactory = $logInterfaceFactory;
        $this->request = $request;
        $this->dateTime = $dateTime;
        $this->remoteAddress = $remoteAddress;
        $this->logRepository = $logRepository;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Log a security suite event
     * @param string $moduleName
     * @param string $message
     * @param string $action
     * @param string $additional = null
     * @param string $user = null
     * @return void
     */
    public function logEvent($moduleName, $message, $action, $additional = null, $user = null)
    {
        if (is_null($user)) {
            $user = '-';
        }

        $ip = $this->remoteAddress->getRemoteAddress();
        $url = $this->request->getRequestUri();

        $log = $this->logInterfaceFactory->create();
        $log->setUrl($url);
        $log->setDatetime($this->dateTime->date('Y-m-d H:i:s'));
        $log->setIp($ip);
        $log->setMessage($message);
        $log->setModule($moduleName);
        $log->setAction($action);
        $log->setAdditional(serialize($additional));
        $log->setUser($user);

        $this->logRepository->save($log);
    }

    /**
     * Clean old events
     * @return void
     */
    public function clean()
    {
        $days = max(1, intval($this->scopeConfig->getValue(
            LogManagementInterface::XML_PATH_LOGGING_PERSISTENCE
        )));
        $this->logRepository->cleanOldEntries($days);
    }
}
