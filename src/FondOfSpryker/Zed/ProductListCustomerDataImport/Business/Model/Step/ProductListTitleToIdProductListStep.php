<?php

namespace FondOfSpryker\Zed\ProductListCustomerDataImport\Business\Model\Step;

use FondOfSpryker\Zed\ProductListCustomerDataImport\Business\Model\DataSet\ProductListCustomerDataSetInterface;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListTableMap;
use Orm\Zed\ProductList\Persistence\SpyProductListQuery;
use Spryker\Zed\DataImport\Business\Exception\EntityNotFoundException;
use Spryker\Zed\DataImport\Business\Exception\InvalidDataException;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;


class ProductListTitleToIdProductListStep implements DataImportStepInterface
{
    /**
     * @var int[]
     */
    protected $idProductListCache = [];

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     * 
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\DataImport\Business\Exception\EntityNotFoundException
     * @throws \Spryker\Zed\DataImport\Business\Exception\InvalidDataException
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $productListTitle = $dataSet[ProductListCustomerDataSetInterface::PRODUCT_LIST];
        if (!$productListTitle) {
            throw new InvalidDataException(sprintf('"%s" is required.', ProductListCustomerDataSetInterface::PRODUCT_LIST));
        }

        $dataSet[ProductListCustomerDataSetInterface::ID_PRODUCT_LIST] = $this->getIdProductListByTitle($productListTitle);
    }

    /**
     * @param string $productListTitle
     *
     * @return int
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\DataImport\Business\Exception\EntityNotFoundException
     */
    protected function getIdProductListByTitle(string $productListTitle): int
    {
        if (!isset($this->idProductListCache[$productListTitle])) {
            /** @var \Orm\Zed\ProductList\Persistence\SpyProductListQuery $productListQuery */
            $productListQuery = SpyProductListQuery::create()->select(SpyProductListTableMap::COL_ID_PRODUCT_LIST);

            /** @var int|null $idProductList */
            $idProductList = $productListQuery->findOneByTitle($productListTitle);

            if (!$idProductList) {
                throw new EntityNotFoundException(sprintf('Could not find Product List by title "%s"', $productListTitle));
            }
            $this->idProductListCache[$productListTitle] = $idProductList;
        }

        return $this->idProductListCache[$productListTitle];
    }
}
