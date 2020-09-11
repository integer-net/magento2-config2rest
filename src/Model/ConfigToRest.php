<?php

namespace IntegerNet\ConfigToRest\Model;

use IntegerNet\ConfigToRest\Api\ConfigToRestInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;


/**
 * Class ConfigToRest
 * Expose custom magento config item values via REST API
 */
class ConfigToRest implements ConfigToRestInterface
{

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * ConfigToRest constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return array
     */
    private function getConfigPathsToExport(): array
    {
        $serializedConfigPaths = [];
        $configPaths =
            $this->scopeConfig->getValue(
                'configtorest/setup/paths',
                ScopeInterface::SCOPE_STORE
            );

        $configPathsItems = json_decode($configPaths, true) ?: [];
        foreach ($configPathsItems as $configPathItem) {
            $serializedConfigPaths[] = $configPathItem['path'];
        }

        return $serializedConfigPaths;
    }

    /**
     * @param array $configPaths
     * @param bool $flat
     * @return array
     */
    private function getConfigPathValues(array $configPaths, bool $flat): array
    {
        $configValues = [];
        foreach ($configPaths as $configPath) {
            $scopeConfigValue = $this->scopeConfig->getValue(
                $configPath,
                ScopeInterface::SCOPE_STORE
            );
            if ($flat){
                // { "item: {"magento/config/path": value} }
                $configValues['config'][][$configPath] = $scopeConfigValue;
            } else {
                // { "item: {"magento": {"config": {"path": value}}}}
                $path = explode('/', $configPath);
                $configValues['config'][$path[0]][$path[1]][$path[2]] = $scopeConfigValue;
            }
        }
        return $configValues;
    }

    /**
     * @return string
     */
    public function getStoreConfig(): string
    {
        $configPaths = $this->getConfigPathsToExport();
        $configPathValues = $this->getConfigPathValues($configPaths, false);

        return json_encode($configPathValues);
    }

    /**
     * @return string
     */
    public function getStoreConfigFlat(): string
    {
        $configPaths = $this->getConfigPathsToExport();
        $configPathValues = $this->getConfigPathValues($configPaths, true);

        return json_encode($configPathValues);
    }
}
