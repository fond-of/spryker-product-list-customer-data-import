<?php

namespace FondOfSpryker\Zed\ProductListCustomerDataImport\Business\Model\Step;

use FondOfSpryker\Zed\ProductListCustomerDataImport\Business\Model\DataSet\ProductListCustomerDataSetInterface;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Spryker\Zed\DataImport\Business\Exception\EntityNotFoundException;
use Spryker\Zed\DataImport\Business\Exception\InvalidDataException;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class CustomerEmailToIdCustomerStep implements DataImportStepInterface
{
    /**
     * @var int[]
     */
    protected $idCustomerListCache = [];

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @throws \Spryker\Zed\DataImport\Business\Exception\InvalidDataException
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $customerEmail = $dataSet[ProductListCustomerDataSetInterface::EMAIL];
        if (!$customerEmail) {
            throw new InvalidDataException(sprintf('"%s" is required.', ProductListCustomerDataSetInterface::EMAIL));
        }

        $dataSet[ProductListCustomerDataSetInterface::ID_CUSTOMER] = $this->getIdCustomerByEmail($customerEmail);
    }

    /**
     * @param string $customerEmail
     *
     * @throws \Spryker\Zed\DataImport\Business\Exception\EntityNotFoundException
     *
     * @return int
     */
    protected function getIdCustomerByEmail(string $customerEmail): int
    {
        if (!isset($this->idCustomerListCache[$customerEmail])) {
            $customerQuery = SpyCustomerQuery::create()->select(SpyCustomerTableMap::COL_ID_CUSTOMER);

            /** @var int|null $idCustomer */
            $idCustomer = $customerQuery->findOneByEmail($customerEmail);

            if (!$idCustomer) {
                throw new EntityNotFoundException(sprintf('Could not find Customer by email "%s"', $customerEmail));
            }
            $this->idCustomerListCache[$customerEmail] = $idCustomer;
        }

        return $this->idCustomerListCache[$customerEmail];
    }
}
