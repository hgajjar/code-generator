<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Zed\CodeGenerator;

use Spryker\Zed\CodeGenerator\Business\GeneratorProjectTypeResolver\GeneratorProjectTypeResolverInterface;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class CodeGeneratorConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const CODE_GENERATOR_TYPE_SUITE = 'CODE_GENERATOR_TYPE_SUITE';

    /**
     * @var string
     */
    public const CODE_GENERATOR_TYPE_DEMOSHOP = 'CODE_GENERATOR_TYPE_DEMOSHOP';

    /**
     * @var string
     */
    public const YVES_CONTROLLER_PROVIDER_CLASS = 'Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin';

    /**
     * @api
     *
     * @return string
     */
    public function getDefaultYvesController(): string
    {
        return 'Index';
    }

    /**
     * @api
     *
     * @return string
     */
    public function getDefaultYvesControllerTargetAction(): string
    {
        return 'index';
    }

    /**
     * @api
     *
     * @return string
     */
    public function getDemoShopDefaultYvesControllerSource(): string
    {
        return 'index-demoshop';
    }

    /**
     * @api
     *
     * @return string
     */
    public function getSuitDefaultYvesControllerSource(): string
    {
        return 'index-suite';
    }

    /**
     * @api
     *
     * @return string
     */
    public function getDemoShopProviderNamespace(): string
    {
        return 'Pyz\Yves\Application\Plugin\Provider\AbstractYvesControllerProvider';
    }

    /**
     * @api
     *
     * @return string
     */
    public function getSuitProviderNamespace(): string
    {
        return static::YVES_CONTROLLER_PROVIDER_CLASS;
    }

    /**
     * @api
     *
     * @param \Spryker\Zed\CodeGenerator\Business\GeneratorProjectTypeResolver\GeneratorProjectTypeResolverInterface $typeResolver
     *
     * @return string
     */
    public function getDefaultYvesControllerSourceAction(GeneratorProjectTypeResolverInterface $typeResolver): string
    {
        if ($typeResolver->isDemoShop()) {
            return $this->getDemoShopDefaultYvesControllerSource();
        }

        return $this->getSuitDefaultYvesControllerSource();
    }

    /**
     * @api
     *
     * @param \Spryker\Zed\CodeGenerator\Business\GeneratorProjectTypeResolver\GeneratorProjectTypeResolverInterface $typeResolver
     *
     * @return string
     */
    public function getProviderNameSpace(GeneratorProjectTypeResolverInterface $typeResolver): string
    {
        if ($typeResolver->isDemoShop()) {
            return $this->getDemoShopProviderNamespace();
        }

        return $this->getSuitProviderNamespace();
    }

    /**
     * @api
     *
     * @return string
     */
    public function getProjectType(): string
    {
        if (class_exists(static::YVES_CONTROLLER_PROVIDER_CLASS)) {
            return static::CODE_GENERATOR_TYPE_SUITE;
        }

        return static::CODE_GENERATOR_TYPE_DEMOSHOP;
    }

    /**
     * @api
     *
     * @return array
     */
    public function getTemplatePaths(): array
    {
        return [
            'vendor/spryker/code-generator/templates',
        ];
    }
}
