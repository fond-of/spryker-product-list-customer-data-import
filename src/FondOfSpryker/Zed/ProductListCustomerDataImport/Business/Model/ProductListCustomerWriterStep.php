<?php

namespace FondOfSpryker\Zed\ProductListCustomerDataImport\Business\Model;

use FondOfSpryker\Zed\ProductListCustomerDataImport\Business\Model\DataSet\ProductListCustomerDataSetInterface;
use Orm\Zed\ProductList\Persistence\SpyProductListCustomerQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class ProductListCustomerWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $this->saveProductListCustomer($dataSet);
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    protected function saveProductListCustomer(DataSetInterface $dataSet): void
    {
        $productListCustomerEntity = SpyProductListCustomerQuery::create()
            ->filterByFkCustomer($dataSet[ProductListCustomerDataSetInterface::ID_CUSTOMER])
            ->filterByFkProductList($dataSet[ProductListCustomerDataSetInterface::ID_PRODUCT_LIST])
            ->findOneOrCreate();

        if ($productListCustomerEntity->isNew() === true) {
            $productListCustomerEntity
                ->setFkProductList($dataSet[ProductListCustomerDataSetInterface::ID_PRODUCT_LIST])
                ->setFkCustomer($dataSet[ProductListCustomerDataSetInterface::ID_CUSTOMER])
                ->save();
        }
    }
}
