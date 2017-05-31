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

use Magento\Framework\Model\AbstractModel;

class Log extends AbstractModel implements \MSP\SecuritySuiteCommon\Api\Data\LogInterface
{
    protected function _construct()
    {
        $this->_init('\MSP\SecuritySuiteCommon\Model\ResourceModel\Log');
    }

    public function getId()
    {
        return $this->getData(\MSP\SecuritySuiteCommon\Api\Data\LogInterface::ID);
    }

    public function getDatetime()
    {
        return $this->getData(\MSP\SecuritySuiteCommon\Api\Data\LogInterface::DATETIME);
    }

    public function getIp()
    {
        return $this->getData(\MSP\SecuritySuiteCommon\Api\Data\LogInterface::IP);
    }

    public function getModule()
    {
        return $this->getData(\MSP\SecuritySuiteCommon\Api\Data\LogInterface::MODULE);
    }

    public function getUser()
    {
        return $this->getData(\MSP\SecuritySuiteCommon\Api\Data\LogInterface::USER);
    }

    public function getMessage()
    {
        return $this->getData(\MSP\SecuritySuiteCommon\Api\Data\LogInterface::MESSAGE);
    }

    public function getUrl()
    {
        return $this->getData(\MSP\SecuritySuiteCommon\Api\Data\LogInterface::URL);
    }

    public function getCount()
    {
        return $this->getData(\MSP\SecuritySuiteCommon\Api\Data\LogInterface::COUNT);
    }

    public function getAction()
    {
        return $this->getData(\MSP\SecuritySuiteCommon\Api\Data\LogInterface::ACTION);
    }

    public function getAdditional()
    {
        return $this->getData(\MSP\SecuritySuiteCommon\Api\Data\LogInterface::ADDITIONAL);
    }

    public function setId($value)
    {
        $this->setData(\MSP\SecuritySuiteCommon\Api\Data\LogInterface::ID, $value);
        return $this;
    }

    public function setDatetime($value)
    {
        $this->setData(\MSP\SecuritySuiteCommon\Api\Data\LogInterface::DATETIME, $value);
        return $this;
    }

    public function setIp($value)
    {
        $this->setData(\MSP\SecuritySuiteCommon\Api\Data\LogInterface::IP, $value);
        return $this;
    }

    public function setModule($value)
    {
        $this->setData(\MSP\SecuritySuiteCommon\Api\Data\LogInterface::MODULE, $value);
        return $this;
    }

    public function setUser($value)
    {
        $this->setData(\MSP\SecuritySuiteCommon\Api\Data\LogInterface::USER, $value);
        return $this;
    }

    public function setMessage($value)
    {
        $this->setData(\MSP\SecuritySuiteCommon\Api\Data\LogInterface::MESSAGE, $value);
        return $this;
    }

    public function setUrl($value)
    {
        $this->setData(\MSP\SecuritySuiteCommon\Api\Data\LogInterface::URL, $value);
        return $this;
    }

    public function setCount($value)
    {
        $this->setData(\MSP\SecuritySuiteCommon\Api\Data\LogInterface::COUNT, $value);
        return $this;
    }

    public function setAction($value)
    {
        $this->setData(\MSP\SecuritySuiteCommon\Api\Data\LogInterface::ACTION, $value);
        return $this;
    }

    public function setAdditional($value)
    {
        $this->setData(\MSP\SecuritySuiteCommon\Api\Data\LogInterface::ADDITIONAL, $value);
        return $this;
    }
}
