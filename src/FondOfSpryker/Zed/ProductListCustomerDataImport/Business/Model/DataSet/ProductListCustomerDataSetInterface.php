<?php

namespace FondOfSpryker\Zed\ProductListCustomerDataImport\Business\Model\DataSet;

interface ProductListCustomerDataSetInterface
{
    public const PRODUCT_LIST = 'product_list';
    public const EMAIL = 'email';

    public const ID_PRODUCT_LIST = 'fk_product_list';
    public const ID_CUSTOMER = 'fk_customer';
}
