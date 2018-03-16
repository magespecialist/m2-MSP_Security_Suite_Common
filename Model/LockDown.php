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

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ActionFlag;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\ObjectManagerInterface;
use MSP\SecuritySuiteCommon\Api\LockDownInterface;
use Magento\Framework\App\Response\Http;
use Magento\Framework\UrlInterface;
use Magento\Framework\Phrase;

class LockDown implements LockDownInterface
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var Http
     */
    private $http;

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * @var ActionFlag
     */
    private $actionFlag;

    /**
     * LockDown constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param ObjectManagerInterface $objectManager
     * @param ActionFlag $actionFlag
     * @param UrlInterface $url
     * @param Http $http
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ObjectManagerInterface $objectManager,
        ActionFlag $actionFlag,
        UrlInterface $url,
        Http $http
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->http = $http;
        $this->actionFlag = $actionFlag;
        $this->url = $url;
        $this->objectManager = $objectManager;
    }

    /**
     * @inheritdoc
     * @deprecated
     */
    public function getStealthMode()
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function doHttpLockdown(Phrase $message)
    {
        $this->http->setStatusCode(LockDownInterface::HTTP_LOCKDOWN_CODE);
        $this->http->setBody(LockDownInterface::HTTP_LOCKDOWN_BODY);

        return $this->http;
    }

    /**
     * @inheritdoc
     */
    public function doActionLockdown(Action $action, Phrase $message)
    {
        $this->actionFlag->set('', Action::FLAG_NO_DISPATCH, true);

        $action->getResponse()->setHttpResponseCode(LockDownInterface::HTTP_LOCKDOWN_CODE);
        $action->getResponse()->setBody(LockDownInterface::HTTP_LOCKDOWN_BODY);
    }
}
