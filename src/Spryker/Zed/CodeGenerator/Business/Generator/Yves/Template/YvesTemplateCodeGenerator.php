<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Zed\CodeGenerator\Business\Generator\Yves\Template;

use Spryker\Zed\CodeGenerator\Business\Engine\GeneratorEngineInterface;
use Spryker\Zed\CodeGenerator\Business\Generator\Yves\AbstractYvesCodeGenerator;
use Zend\Filter\Word\CamelCaseToDash;

class YvesTemplateCodeGenerator extends AbstractYvesCodeGenerator
{
    /**
     * @var string
     */
    protected $controller;

    /**
     * @var string
     */
    protected $action;

    /**
     * @param string $bundle
     * @param \Spryker\Zed\CodeGenerator\Business\Engine\GeneratorEngineInterface $generatorEngine
     * @param string $controller
     * @param string $action
     * @param array $requiredGenerators
     */
    public function __construct(
        $bundle,
        GeneratorEngineInterface $generatorEngine,
        $controller,
        $action,
        array $requiredGenerators = []
    ) {
        parent::__construct(
            $bundle,
            $generatorEngine,
            $requiredGenerators
        );

        $this->controller = $controller;
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getController()
    {
        $controller = $this->getCamelCaseToDashedFilter()->filter($this->controller);

        return strtolower($controller);
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
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
    public function getSourceFile()
    {
        return sprintf(
            'Yves/Theme/default/%s/%s.twig.twig',
            $this->getController(),
            $this->getAction()
        );
    }

    /**
     * @return string
     */
    public function getTargetFile()
    {
        return $this->joinPath([
            $this->translateNamespaceToPath($this->getNamespace()),
            sprintf(
                'Theme/default/%s/%s.twig',
                $this->getController(),
                $this->getAction()
            ),
        ]);
    }

    /**
     * @return string
     */
    public function getClassname()
    {
        return $this->getTargetFile();
    }

    /**
     * @return string
     */
    public function getCodeGeneratorName()
    {
        return sprintf(
            'Yves%s%sCodeGeneator',
            ucfirst($this->getController()),
            ucfirst($this->getAction())
        );
    }
}
