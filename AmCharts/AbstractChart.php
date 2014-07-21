<?php

namespace RC\AmChartsBundle\AmCharts;

use RC\AmChartsBundle\AmCharts\Settings\JsonSettings;
use RC\AmChartsBundle\AmCharts\Settings\ConfigSettings;

abstract class AbstractChart implements ChartInterface, \JsonSerializable
{
    protected $jsonSettings;
    protected $configSettings;
    protected $type = '';

    public function __construct()
    {
        $this->jsonSettings = new JsonSettings();
        $this->configSettings = new ConfigSettings();
        $this->jsonSettings->theme('none');
        $this->jsonSettings->pathToImages('/bundles/rcamcharts/js/amcharts/images/');
        $this->jsonSettings->dataProvider([]);
    }

    public function __get($name)
    {
        return $this->jsonSettings->{$name};
    }

    public function __call($name, $value)
    {
        return $this->jsonSettings->{$name}($value[0]);
    }

    public function addData(array $data)
    {
        $this->jsonSettings->dataProvider((object)$data);
    }

    public function jsonSerialize()
    {
        return $this->jsonSettings;
    }

    public function setTheme($theme)
    {
        $this->jsonSettings->theme($theme);
    }

    public function renderTo($container)
    {
        $this->configSettings->setContainer($container);
    }

    public function setHeight($height)
    {
        $this->configSettings->setHeight($height);
    }

    public function getHeight()
    {
        return $this->configSettings->getHeight();
    }

    public function setWidth($width)
    {
        $this->configSettings->setWidth($width);
    }

    public function getWidth()
    {
        return $this->configSettings->getWidth();
    }

    protected function renderStartIIFE()
    {
        return "$(function () {\n";
    }

    protected function renderEndIIFE()
    {
        return "});\n";
    }

    public function render()
    {
        $chartJS = $this->renderStartIIFE();

        $chartJS .= "    var " . $this->type . "chart = new AmCharts.makeChart(\"" . $this->configSettings->getContainer() . "\",";

        $chartJS .= json_encode($this, JSON_PRETTY_PRINT);

        $chartJS .= ");\n";

        $chartJS .= $this->renderEndIIFE();

        return $chartJS;
    }
}
