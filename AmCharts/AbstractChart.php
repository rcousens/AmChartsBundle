<?php

namespace RedEye\AmChartsBundle\AmCharts;

use RedEye\AmChartsBundle\AmCharts\Option\OptionCollection;

abstract class AbstractChart implements ChartInterface
{
    public $options;
    public $config;

    public function __construct()
    {
        $this->options = new OptionCollection();
        $this->config = (object) array('container' => 'chart', 'height' => 400, 'width' => 400);
        $this->setOptions();
    }

    public function setOptions()
    {
        $this->options->addScalarOption('theme', 'none');
        $this->options->addScalarOption('pathToImages', '/bundles/redeyeamcharts/js/amcharts/images/');
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
