<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector;

use FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Dependency\Facade\SplittableCheckoutRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeBridge;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableCheckoutRestApiCompanyUnitAddressConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_COMPANY_UNIT_ADDRESS = 'FACADE_COMPANY_UNIT_ADDRESS';

    /**
     * @var string
     */
    public const PROPEL_QUERY_COMPANY_UNIT_ADDRESS_TO_COMPANY_BUSINESS_UNIT = 'PROPEL_QUERY_COMPANY_UNIT_ADDRESS_TO_COMPANY_BUSINESS_UNIT';

    /**
     * @var string
     */
    public const PROPEL_QUERY_COMPANY_UNIT_ADDRESS = 'PROPEL_QUERY_COMPANY_UNIT_ADDRESS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        return $this->addCompanyUnitAddressFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUnitAddressFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_UNIT_ADDRESS] = static function (Container $container) {
            return new SplittableCheckoutRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeBridge(
                $container->getLocator()->companyUnitAddress()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container = $this->addCompanyUnitAddressQuery($container);

        return $this->addCompanyUnitAddressToCompanyBusinessUnitQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUnitAddressQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_COMPANY_UNIT_ADDRESS] = static function () {
            return SpyCompanyUnitAddressQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUnitAddressToCompanyBusinessUnitQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_COMPANY_UNIT_ADDRESS_TO_COMPANY_BUSINESS_UNIT] = static function () {
            return SpyCompanyUnitAddressToCompanyBusinessUnitQuery::create();
        };

        return $container;
    }
}
