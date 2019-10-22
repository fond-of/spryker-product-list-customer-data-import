<?php

namespace FondOfSpryker\Zed\ProductListCustomerDataImport\Business;

use FondOfSpryker\Zed\ProductListCustomerDataImport\Business\Model\ProductListCustomerWriterStep;
use FondOfSpryker\Zed\ProductListCustomerDataImport\Business\Model\Step\CustomerEmailToIdCustomerStep;
use FondOfSpryker\Zed\ProductListCustomerDataImport\Business\Model\Step\ProductListTitleToIdProductListStep;
use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\ProductListDataImport\Business\Model\ProductListWriterStep;
use Spryker\Zed\ProductListDataImport\Business\Model\Step\ProductListKeyToIdProductListStep;

/**
 * @method \FondOfSpryker\Zed\ProductListCustomerDataImport\ProductListCustomerDataImportConfig getConfig()
 */
class ProductListCustomerDataImportBusinessFactory extends DataImportBusinessFactory
{
    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImporterAfterImportAwareInterface|\Spryker\Zed\DataImport\Business\Model\DataImporterBeforeImportAwareInterface|\Spryker\Zed\DataImport\Business\Model\DataImporterInterface|\Spryker\Zed\DataImport\Business\Model\DataSet\DataSetStepBrokerAwareInterface
     */
    public function createProductListCustomerDataImport()
    {
        $dataImporter = $this->getCsvDataImporterFromConfig(
            $this->getConfig()->getProductListCustomerDataImporterConfiguration()
        );

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker->addStep($this->createProductListTitleToIdProductListStep());
        $dataSetStepBroker->addStep($this->createCustomerEmailToIdCustomerStep());
        $dataSetStepBroker->addStep(new ProductListCustomerWriterStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createProductListTitleToIdProductListStep(): DataImportStepInterface
    {
        return new ProductListTitleToIdProductListStep();
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createCustomerEmailToIdCustomerStep(): DataImportStepInterface
    {
        return new CustomerEmailToIdCustomerStep();
    }

}
