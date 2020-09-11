<?php

namespace IntegerNet\ConfigToRest\Api;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\Store;

/**
 * Interface for exposing Magento Config Values via REST API.
 * @api
 */
interface ConfigToRestInterface
{
    /**
     * @return string
     */
    public function getStoreConfig();

    /**
     * @return string
     */
    public function getStoreConfigFlat();
}
