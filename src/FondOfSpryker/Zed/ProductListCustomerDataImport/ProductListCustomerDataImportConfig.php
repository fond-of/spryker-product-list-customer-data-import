<?php

namespace FondOfSpryker\Zed\ProductListCustomerDataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Spryker\Zed\DataImport\DataImportConfig;

class ProductListCustomerDataImportConfig extends DataImportConfig
{
    public const IMPORT_TYPE_PRODUCT_LIST_CUSTOMER = 'product-list-customer';

    /**
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getProductListCustomerDataImporterConfiguration(): DataImporterConfigurationTransfer
    {
        return $this->buildImporterConfiguration(
            $this->getDataImportRootPath() . 'product_list_customer.csv',
            static::IMPORT_TYPE_PRODUCT_LIST_CUSTOMER
        );
    }
}
