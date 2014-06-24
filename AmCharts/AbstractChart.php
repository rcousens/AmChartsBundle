<?php

namespace RedEye\AmChartsBundle\AmCharts;

use Zend\Json\Json;

abstract class AbstractChart
{
    // Default options
    public $type;
    public $theme = 'none';
    public $config;
    public $dataProvider;

    public function __construct()
    {
        $complexOptions = array('config');

        $arrayOptions = array('dataProvider');

        foreach ($complexOptions as $option) {
            $this->initComplexOption($option);
        }

        foreach ($arrayOptions as $option) {
            $this->initArrayOption($option);
        }
    }

    abstract public function render();

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     */
    public function __call($name, $value)
    {
        $this->$name = $value;

        return $this;
    }

    protected function initComplexOption($name)
    {
        $this->{$name} = new ComplexOption($name);
    }

    /**
     * @param string $name
     */
    protected function initArrayOption($name)
    {
        $this->{$name} = array();
    }

    /**
     * @param ChartOption|array $chartOption
     * @param string            $name
     *
     * @return string
     */
    protected function renderWithJavascriptCallback($chartOption, $name)
    {
        $result = "";

        if (gettype($chartOption) === 'array') {
            $result .= $this->renderArrayWithCallback($chartOption, $name);
        }

        if (gettype($chartOption) === 'object') {
            $result .= $this->renderObjectWithCallback($chartOption, $name);
        }

        if (in_array(gettype($chartOption), array('string', 'integer'))) {
            $result .= $this->renderScalarWithCallback($chartOption, $name);
        }

        return $result;
    }

    protected function renderScalarWithCallback($chartOption, $name)
    {
        $result = "";
        if (!empty($chartOption)) {
            $result .= $name . ": " . Json::encode($chartOption, false, array('enableJsonExprFinder' => true)) . ",\n";
        }

        return $result;
    }

    /**
     * @param array  $chartOption
     * @param string $name
     *
     * @return string
     */
    protected function renderArrayWithCallback($chartOption, $name)
    {
        $result = "";

        if (!empty($chartOption)) {
            $result .= $name . ": " . Json::encode($chartOption[0], false, array('enableJsonExprFinder' => true)) . ", \n";
        }

        return $result;
    }

    /**
     * @param ChartOption $chartOption
     * @param string      $name
     *
     * @return string
     */
    protected function renderObjectWithCallback($chartOption, $name)
    {
        $result = "";

        if (get_object_vars($chartOption)) {
            $result .= $name . ": " . Json::encode($chartOption, false, array('enableJsonExprFinder' => true)) . ",\n";
        }

        return $result;
    }


    protected function renderStartIIFE()
    {
        return "$(function () {\n";
    }

    protected function renderEndIIFE()
    {
        return "});\n";
    }
}
