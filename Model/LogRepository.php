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

class LogRepository implements \MSP\SecuritySuiteCommon\Api\LogRepositoryInterface
{
    protected $objectResource;
    protected $objectFactory;
    protected $searchResultsFactory;
    protected $collectionFactory;

    protected $registry = [];

    public function __construct(
        \MSP\SecuritySuiteCommon\Api\Data\LogInterfaceFactory $objectFactory,
        \MSP\SecuritySuiteCommon\Model\ResourceModel\Log $objectResource,
        \MSP\SecuritySuiteCommon\Model\ResourceModel\Log\CollectionFactory $collectionFactory,
        \MSP\SecuritySuiteCommon\Api\Data\LogSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->searchResultsFactory = $searchResultsFactory;
        $this->objectFactory = $objectFactory;
        $this->objectResource = $objectResource;
        $this->collectionFactory = $collectionFactory;
    }

    protected function clearRegistry($id)
    {
        if (isset($this->registry[$id])) {
            unset($this->registry[$id]);
        }
    }

    public function save(\MSP\SecuritySuiteCommon\Api\Data\LogInterface $object)
    {
        $this->objectResource->save($object);
        $this->clearRegistry($object->getId());

        return $object;
    }

    public function getById($id, $forceReload = false)
    {
        if (!isset($this->registry[$id]) || $forceReload) {
            $object = $this->objectFactory->create();
            $this->objectResource->load($object, $id);

            $this->registry[$id] = $object;
        }

        return $this->registry[$id];
    }

    public function delete(\MSP\SecuritySuiteCommon\Api\Data\LogInterface $object)
    {
        $this->objectResource->delete($object);
        $this->clearRegistry($object->getId());
    }

    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        $collection = $this->objectFactory->create()->getCollection();
        $this->applySearchCriteriaToCollection($searchCriteria, $collection);

        $vendors = $this->convertCollectionToDataItemsArray($collection);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($vendors);

        return $searchResults;
    }

    protected function addFilterGroupToCollection(
        \Magento\Framework\Api\Search\FilterGroup $filterGroup,
        \MSP\SecuritySuiteCommon\Model\ResourceModel\Log\Collection $collection
    ) {
        $fields = [];
        $conditions = [];
        foreach ($filterGroup->getFilters() as $filter) {
            $condition = $filter->getConditionType() ?: 'eq';
            $fields[] = $filter->getField();

            $conditions[] = [$condition => $filter->getValue()];
        }

        if ($fields) {
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    protected function convertCollectionToDataItemsArray(\MSP\SecuritySuiteCommon\Model\ResourceModel\Log\Collection $collection)
    {
        $vendors = array_map(function (\MSP\SecuritySuiteCommon\Api\Data\LogInterface $vendor) {
            $dataObject = $this->objectFactory->create();
            $dataObject->setData($vendor->getData());
            return $dataObject;
        }, $collection->getItems());

        return $vendors;
    }

    protected function applySearchCriteriaToCollection(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria,
        \MSP\SecuritySuiteCommon\Model\ResourceModel\Log\Collection $collection
    ) {
        $this->applySearchCriteriaFiltersToCollection($searchCriteria, $collection);
        $this->applySearchCriteriaSortOrdersToCollection($searchCriteria, $collection);
        $this->applySearchCriteriaPagingToCollection($searchCriteria, $collection);
    }

    protected function applySearchCriteriaFiltersToCollection(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria,
        \MSP\SecuritySuiteCommon\Model\ResourceModel\Log\Collection $collection
    ) {
        foreach ($searchCriteria->getFilterGroups() as $group) {
            $this->addFilterGroupToCollection($group, $collection);
        }
    }

    protected function applySearchCriteriaSortOrdersToCollection(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria,
        \MSP\SecuritySuiteCommon\Model\ResourceModel\Log\Collection $collection
    ) {
        $sortOrders = $searchCriteria->getSortOrders();
        if ($sortOrders) {
            foreach ($sortOrders as $sortOrder) {
                $isAscending = $sortOrder->getDirection() == \Magento\Framework\Api\SortOrder::SORT_ASC;
                $collection->addOrder($sortOrder->getField(), $isAscending ? 'ASC' : 'DESC');
            }
        }
    }

    protected function applySearchCriteriaPagingToCollection(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria,
        \MSP\SecuritySuiteCommon\Model\ResourceModel\Log\Collection $collection
    ) {
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());
    }

    /**
     * Clean old entries
     * @param int $days
     * @return void
     */
    public function cleanOldEntries($days)
    {
        $this->objectResource->cleanOldEntries($days);
    }
}
