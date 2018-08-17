<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Zed\CodeGenerator\Business\Generator\Yves\Controller;

use Zend\Filter\Word\CamelCaseToDash;
use Spryker\Zed\CodeGenerator\Business\Engine\GeneratorEngineInterface;
use Spryker\Zed\CodeGenerator\Business\Generator\Yves\AbstractYvesControllerCodeGenerator;

class YvesControllerProviderCodeGenerator extends AbstractYvesControllerCodeGenerator
{
    /**
     * @var string
     */
    protected $providerNameSpace;

    /**
     * YvesControllerProviderCodeGenerator constructor.
     *
     * @param string $bundle
     * @param \Spryker\Zed\CodeGenerator\Business\Engine\GeneratorEngineInterface $generatorEngine
     * @param string $controller
     * @param string $providerNameSpace
     * @param array $requiredGenerators
     */
    public function __construct(
        string $bundle,
        GeneratorEngineInterface $generatorEngine,
        string $controller,
        string $providerNameSpace,
        array $requiredGenerators = []
    )
    {
        parent::__construct($bundle, $generatorEngine, $controller, $requiredGenerators);
        $this->providerNameSpace = $providerNameSpace;
    }

    /**
     * @return string
     */
    public function getSourceFile()
    {
        return 'Yves/Plugin/Provider/ControllerProvider.php.twig';
    }

    /**
     * @return string
     */
    public function getCodeGeneratorName()
    {
        return 'YvesControllerProvider';
    }

    /**
     * @return string
     */
    public function getClassname()
    {
        return sprintf(
            '%sControllerProvider',
            $this->getBundle()
        );
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return sprintf(
            '%s\Plugin\Provider',
            parent::getNamespace()
        );
    }

    /**
     * @return array
     */
    public function getVars()
    {
        $vars = [
                'bundleDashed'      => $this->getBundleDashed(),
                'providerNameSpace' => $this->getProviderNameSpace(),
            ] + parent::getVars();

        return $vars;
    }

    /**
     * @return string
     */
    protected function getBundleDashed()
    {
        $bundle = $this->getBundle();
        $bundle = $this->getCamelCaseToDashedFilter()->filter($bundle);

        return strtolower($bundle);
    }

    /**
     * @return \Zend\Filter\FilterInterface
     */
    protected function getCamelCaseToDashedFilter()
    {
        $filter = new CamelCaseToDash();

        return $filter;
    }

    /**
     * @return string
     */
    protected function getProviderNameSpace(): string
    {
        return $this->providerNameSpace;
    }
}
