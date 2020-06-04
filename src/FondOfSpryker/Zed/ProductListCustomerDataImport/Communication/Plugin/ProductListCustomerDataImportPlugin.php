<?php

namespace FondOfSpryker\Zed\ProductListCustomerDataImport\Communication\Plugin;

use FondOfSpryker\Zed\ProductListCustomerDataImport\ProductListCustomerDataImportConfig;
use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Spryker\Zed\DataImport\Dependency\Plugin\DataImportPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\ProductListCustomerDataImport\Business\ProductListCustomerDataImportFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\ProductListCustomerDataImport\ProductListCustomerDataImportConfig getConfig()
 */
class ProductListCustomerDataImportPlugin extends AbstractPlugin implements DataImportPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfigurationTransfer
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function import(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null): DataImporterReportTransfer
    {
        return $this->getFacade()->importProductListCustomer($dataImporterConfigurationTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getImportType(): string
    {
        return ProductListCustomerDataImportConfig::IMPORT_TYPE_PRODUCT_LIST_CUSTOMER;
    }
}
