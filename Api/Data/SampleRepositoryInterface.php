<?php
/**
 * File: SampleRepositoryInterface.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\Api\Data;

//This is the service contract of the module.
//It provides a consistent API for handling Data Objects.

/**
 * Interface SampleRepositoryInterface
 * @package MSlwk\Sample\Api\Data
 */
interface SampleRepositoryInterface
{
    /**
     * @param \MSlwk\Sample\Api\Data\SampleInterface $sample
     * @return void
     */
    public function save(\MSlwk\Sample\Api\Data\SampleInterface $sample);

    /**
     * @param int $id
     * @return \MSlwk\Sample\Api\Data\SampleInterface
     */
    public function getById($id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \MSlwk\Sample\Api\Data\SampleSearchResultInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param \MSlwk\Sample\Api\Data\SampleInterface $sample
     * @return void
     */
    public function delete(\MSlwk\Sample\Api\Data\SampleInterface $sample);

    /**
     * @param int $id
     * @return \MSlwk\Sample\Api\Data\SampleSearchResultInterface
     */
    public function deleteById($id);

    /**
     * @param int $cartId
     * @param SampleInterface $sample
     * @return void
     */
    public function saveSampleFromCheckout(int $cartId, SampleInterface $sample);

    /**
     * @param string $cartId
     * @param SampleInterface $sample
     * @return void
     */
    public function saveSampleFromGuestCheckout(string $cartId, SampleInterface $sample);

    /**
     * @param int $id
     * @return \MSlwk\Sample\Api\Data\SampleInterface
     */
    public function getByQuoteId($id);

    /**
     * @param int $id
     * @return \MSlwk\Sample\Api\Data\SampleInterface
     */
    public function getByOrderId($id);
}
