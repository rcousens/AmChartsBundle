<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 24/06/2014
 * Time: 1:18 PM
 */

namespace RedEye\AmChartsBundle\AmCharts;


abstract class AbstractSerialChart extends AbstractChart implements ChartInterface
{
    public function __construct()
    {
        parent::__construct();

//        $this->type('serial');
//        $this->categoryField('category');
//
//        $arrayOptions = array('graphs');
//
//        $complexOptions = array('chartScrollbar');
//
//        foreach ($arrayOptions as $option) {
//            $this->initArrayOption($option);
//        }
//
//        foreach ($complexOptions as $option) {
//            $this->initComplexOption($option);
//        }
    }

    public function setOptions()
    {
        parent::setOptions();
        $this->options->addScalarOption('type', 'serial');
        $this->options->addScalarOption('categoryField', 'category');
        $this->options->addArrayOption('graphs');
        $this->options->addObjectOption('chartScrollbar');
        $this->options->addArrayOption('dataProvider');
        $this->options->addArrayOption('valueAxes');
    }

    public function render()
    {
        $chartJS = $this->renderStartIIFE();

        //$chartJS = $this->renderStartChart();
        $chartJS .= "    var " . $this->options->type . "chart = new AmCharts.makeChart(\"" . $this->config->container . "\",";

        $chartJS .= $this->options->render();

        $chartJS .= ");\n";

        $chartJS .= $this->renderEndIIFE();

        return trim($chartJS);
    }

}
