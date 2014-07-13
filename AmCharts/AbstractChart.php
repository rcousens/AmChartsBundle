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
    public $valueAxes;

    public function __construct()
    {
        $complexOptions = array('config');

        $arrayOptions = array('dataProvider', 'valueAxes');

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
        if (property_exists($this, $name) && ! $this->$name instanceof ComplexOption && ! is_array($this->$name)) {
            $this->$name = $value[0];
        } else {
            $this->$name = $value;
        }

        return $this;
    }

    /**
     * @param string $name
     */
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

    protected function renderScalarWithCallback($scalarOption, $name)
    {
        $result = "";
        if (!empty($scalarOption)) {
            $result .= $name . ": " . Json::encode($scalarOption, false, array('enableJsonExprFinder' => true)) . ",\n";
        }

        return $result;
    }

    protected function renderArrayWithCallback($arrayOption, $name)
    {
        $result = "";

        if (!empty($complexOption)) {
            $result .= $name . ": " . Json::encode($arrayOption[0], false, array('enableJsonExprFinder' => true)) . ",\n";
        }

        return $result;
    }

    protected function renderObjectWithCallback($complexOption, $name)
    {
        $result = "";

        if (get_object_vars($complexOption)) {
            $result .= $name . ": " . Json::encode($complexOption->{$name}, false, array('enableJsonExprFinder' => true)) . ",\n";
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
