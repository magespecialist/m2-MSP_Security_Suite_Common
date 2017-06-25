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

namespace MSP\SecuritySuiteCommon\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use MSP\SecuritySuiteCommon\Api\Data\LogInterface;

class Log extends AbstractDb
{
    /**
     * @var DateTime
     */
    private $dateTime;

    public function __construct(
        Context $context,
        DateTime $dateTime,
        $connectionName = null
    ) {
        parent::__construct($context, $connectionName);
        $this->dateTime = $dateTime;
    }

    protected function _construct()
    {
        $this->_init('msp_securitysuite_log', 'msp_securitysuite_log_id');
    }

    public function save(\Magento\Framework\Model\AbstractModel $object)
    {
        $ip = $object->getIp();
        $url = $object->getUrl();
        $message = $object->getMessage();
        $module = $object->getModule();
        $user = $object->getUser();
        $action = $object->getAction();
        $additional = $object->getAdditional();

        $connection = $this->getConnection();

        $thresholdTs = $this->dateTime->timestamp() - LogInterface::REPETITION_TIMEOUT_INTERVAL;
        $thresholdDate = $this->dateTime->date('Y-m-d H:i:s', $thresholdTs);

        $tableName = $connection->getTableName($this->getMainTable());
        $qry = $connection->select()->from($tableName)
            ->where(LogInterface::IP . '=?', $ip)
            ->where(LogInterface::URL . '=?', $url)
            ->where(LogInterface::MESSAGE . '=?', $message)
            ->where(LogInterface::MODULE . '=?', $module)
            ->where(LogInterface::USER . '=?', $user)
            ->where(LogInterface::ACTION . '=?', $action)
            ->where(LogInterface::ADDITIONAL . '=?', $additional)
            ->where(LogInterface::DATETIME . '>=?', $thresholdDate)
            ->limit(1);

        $row = $connection->fetchRow($qry);
        if ($row) {
            $connection->update($tableName, [
                LogInterface::COUNT => $row[LogInterface::COUNT] + 1,
                LogInterface::DATETIME => $this->dateTime->date('Y-m-d H:i:s'),
            ], LogInterface::ID . ' = ' . $row[LogInterface::ID]);
            return $this;
        }

        $object->setCount(1);
        return parent::save($object);
    }

    /**
     * Clean old entries
     * @param int $days
     */
    public function cleanOldEntries($days)
    {
        $ts = $this->dateTime->date('Y-m-d H:i:s', $this->dateTime->timestamp() - $days * 86400);

        $connection = $this->getConnection();
        $tableName = $connection->getTableName($this->getMainTable());

        $connection->delete($tableName, LogInterface::DATETIME . ' < ' . $connection->quote($ts));
    }
}
