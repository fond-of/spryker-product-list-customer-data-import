<?php

namespace FondOfSpryker\Zed\ProductListCustomerDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\ProductListCustomerDataImport\Business\ProductListCustomerDataImportBusinessFactory getFactory()
 */
class ProductListCustomerDataImportFacade extends AbstractFacade implements ProductListCustomerDataImportFacadeInterface
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
    public function importProductListCustomer(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null): DataImporterReportTransfer
    {
        return $this->getFactory()
            ->createProductListCustomerDataImport()
            ->import($dataImporterConfigurationTransfer);
    }
}
