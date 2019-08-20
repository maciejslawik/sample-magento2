<?php
/**
 * File: SampleFixture.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

/** @var \MSlwk\Sample\Api\Data\SampleInterface $sample */
$sample = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()
    ->create('MSlwk\Sample\Api\Data\SampleInterface');

/** @var \MSlwk\Sample\Api\Data\SampleRepositoryInterface $sampleRepository */
$sampleRepository = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()
    ->create('MSlwk\Sample\Api\Data\SampleRepositoryInterface');

$sample->setTitle('Sample title for sample model');
$sample->setDescription('Sample description for sample model');

$sampleRepository->save($sample);
