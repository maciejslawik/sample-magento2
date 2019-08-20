<?php
/**
 * File: SampleRepository.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\Model;

use Exception;
use MSlwk\Sample\Api\Data\SampleInterface;
use MSlwk\Sample\Api\Data\SampleRepositoryInterface;
use MSlwk\Sample\Api\Data\SampleSearchResultInterfaceFactory;
use MSlwk\Sample\Api\Data\SampleSearchResultInterface;
use MSlwk\Sample\Model\ResourceModel\Sample as SampleResource;
use MSlwk\Sample\Model\ResourceModel\Sample\Collection;
use MSlwk\Sample\Model\ResourceModel\Sample\CollectionFactory;
use MSlwk\Sample\Model\SampleFactory;
use MSlwk\Sample\Traits\RepositorySearchResultBuilderTrait;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Model\QuoteIdMaskFactory;
use Magento\Quote\Model\ResourceModel\Quote\QuoteIdMask as QuoteIdMaskResource;

//This is the implementation of the service contract of the module.
//Public methods are the provide the API of the class.
//
//Remember to
//* not use strict scalar parameters and return types
//* use fully-qualified class names
//* declare the parameter and return types only in PHPDoc
//* declare the return type in PHPDoc even if it's void
//It's because Magento scans the PHPDocs to determine all necessary data types.

/**
 * Class SampleRepository
 * @package MSlwk\Sample\Model
 */
class SampleRepository implements SampleRepositoryInterface
{
    use RepositorySearchResultBuilderTrait;

    /**
     * @var SampleResource
     */
    private $sampleResource;

    /**
     * @var SampleFactory
     */
    private $sampleFactory;

    /**
     * @var CollectionFactory
     */
    private $sampleCollectionFactory;

    /**
     * @var SampleSearchResultInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @var QuoteIdMaskFactory
     */
    private $quoteIdMaskFactory;

    /**
     * @var QuoteIdMaskResource
     */
    private $quoteIdMaskResource;

    /**
     * SampleRepository constructor.
     * @param SampleResource $sampleResource
     * @param SampleFactory $sampleFactory
     * @param CollectionFactory $sampleCollectionFactory
     * @param SampleSearchResultInterfaceFactory $searchResultFactory
     * @param QuoteIdMaskFactory $quoteIdMaskFactory
     * @param QuoteIdMaskResource $quoteIdMaskResource
     */
    public function __construct(
        SampleResource $sampleResource,
        SampleFactory $sampleFactory,
        CollectionFactory $sampleCollectionFactory,
        SampleSearchResultInterfaceFactory $searchResultFactory,
        QuoteIdMaskFactory $quoteIdMaskFactory,
        QuoteIdMaskResource $quoteIdMaskResource
    ) {
        $this->sampleResource = $sampleResource;
        $this->sampleFactory = $sampleFactory;
        $this->sampleCollectionFactory = $sampleCollectionFactory;
        $this->searchResultFactory = $searchResultFactory;
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->quoteIdMaskResource = $quoteIdMaskResource;
    }

    /**
     * @param SampleInterface $sample
     * @return void
     * @throws Exception
     * @throws AlreadyExistsException
     */
    public function save(SampleInterface $sample)
    {
        /** @var Sample $sampleModel */
        $sampleModel = $this->sampleFactory->create();
        if ($sample->getId()) {
            $this->sampleResource->load($sampleModel, $sample->getId());
        }
        $sampleModel->setTitle($sample->getTitle());
        $sampleModel->setDescription($sample->getDescription());
        $sampleModel->setQuoteId($sample->getQuoteId());
        $sampleModel->setOrderId($sample->getOrderId());
        $this->sampleResource->save($sampleModel);
    }

    /**
     * @param int $id
     * @return SampleInterface
     * @throws NoSuchEntityException
     */
    public function getById($id): SampleInterface
    {
        /** @var Sample $sampleModel */
        $sampleModel = $this->sampleFactory->create();
        $this->sampleResource->load($sampleModel, $id);
        if (!$sampleModel->getId()) {
            throw new NoSuchEntityException();
        }
        return $sampleModel;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SampleSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->sampleCollectionFactory->create();

        //Helper methods for translating search criteria to collection filters etc.
        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        /** @var SampleSearchResultInterface $searchResult */
        $searchResult = $this->searchResultFactory->create();
        return $this->buildSearchResult($searchCriteria, $searchResult, $collection);
    }

    /**
     * @param SampleInterface $sample
     * @return void
     * @throws Exception
     */
    public function delete(SampleInterface $sample)
    {
        $this->deleteById($sample->getId());
    }

    /**
     * @param int $id
     * @return void
     * @throws Exception
     */
    public function deleteById($id)
    {
        /** @var Sample $sampleModel */
        $sampleModel = $this->sampleFactory->create();
        $this->sampleResource->load($sampleModel, $id);
        $this->sampleResource->delete($sampleModel);
    }

    /**
     * @param int $cartId
     * @param SampleInterface $sample
     * @return void
     * @throws AlreadyExistsException
     */
    public function saveSampleFromCheckout(int $cartId, SampleInterface $sample)
    {
        try {
            $sampleToSave = $this->getByQuoteId($cartId);
            $sampleToSave->setTitle($sample->getTitle());
            $sampleToSave->setDescription($sample->getDescription());
        } catch (NoSuchEntityException $e) {
            $sampleToSave = $sample;
            $sampleToSave->setQuoteId($cartId);
        }
        $this->save($sampleToSave);
    }

    /**
     * @param string $cartId
     * @param SampleInterface $sample
     * @return void
     * @throws AlreadyExistsException
     */
    public function saveSampleFromGuestCheckout(string $cartId, SampleInterface $sample)
    {
        $quoteIdMask = $this->quoteIdMaskFactory->create();
        $this->quoteIdMaskResource->load($quoteIdMask, $cartId, 'masked_id');
        $this->saveSampleFromCheckout((int) $quoteIdMask->getQuoteId(), $sample);
    }

    /**
     * @param int $id
     * @return SampleInterface
     * @throws NoSuchEntityException
     */
    public function getByQuoteId($id)
    {
        /** @var Sample $sampleModel */
        $sampleModel = $this->sampleFactory->create();
        $this->sampleResource->load($sampleModel, $id, SampleInterface::QUOTE_ID);
        if (!$sampleModel->getId()) {
            throw new NoSuchEntityException();
        }
        return $sampleModel;
    }

    /**
     * @param int $id
     * @return SampleInterface
     * @throws NoSuchEntityException
     */
    public function getByOrderId($id)
    {
        /** @var Sample $sampleModel */
        $sampleModel = $this->sampleFactory->create();
        $this->sampleResource->load($sampleModel, $id, SampleInterface::ORDER_ID);
        if (!$sampleModel->getId()) {
            throw new NoSuchEntityException();
        }
        return $sampleModel;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addFiltersToCollection(
        SearchCriteriaInterface $searchCriteria,
        Collection $collection
    ) {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }
}
