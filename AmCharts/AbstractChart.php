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
        $this->jsonSettings->dataProvider([]);
        $this->jsonSettings->theme('none');
        $this->jsonSettings->pathToImages('http://www.amcharts.com/lib/3/images/');
    }

    protected function renderStartIIFE()
    {
        return "$(function () {\n";
    }

    protected function renderEndIIFE()
    {
        return "});\n";
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
