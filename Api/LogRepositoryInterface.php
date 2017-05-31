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

interface LogRepositoryInterface
{
    /**
     * Save object
     * @param \MSP\SecuritySuiteCommon\Api\Data\LogInterface $object
     * @return void
     */
    public function save(\MSP\SecuritySuiteCommon\Api\Data\LogInterface $object);

    /**
     * Get object by id
     * @param int $id
     * @param $forceReload
     * @return \MSP\SecuritySuiteCommon\Api\Data\LogInterface
     */
    public function getById($id, $forceReload = false);

    /**
     * Delete object
     * @param \MSP\SecuritySuiteCommon\Api\Data\LogInterface $object
     * @return void
     */
    public function delete(\MSP\SecuritySuiteCommon\Api\Data\LogInterface $object);

    /**
     * Delete object by id
     * @param $id
     * @return void
     */
    public function deleteById($id);

    /**
     * Get a list of object
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \MSP\SecuritySuiteCommon\Api\Data\LogSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}
