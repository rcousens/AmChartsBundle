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

        $this->jsonSettings->type('serial');
        $this->jsonSettings->categoryField('category');
        $this->jsonSettings->valueAxes([]);
        $this->jsonSettings->graphs([]);
    }

    public function setCategoryField($field)
    {
        $this->jsonSettings->categoryField($field);
    }

    public function addGraph(array $graph)
    {
        $this->jsonSettings->graphs((object)$graph);
    }

    public function addValueAxis(array $valueAxis)
    {
        $this->jsonSettings->valueAxes((object)$valueAxis);
    }


    public function render()
    {
        $chartJS = $this->renderStartIIFE();

        //$chartJS = $this->renderStartChart();
        $chartJS .= "    var " . $this->type . "chart = new AmCharts.makeChart(\"" . $this->configSettings->getContainer() . "\",";

        $chartJS .= json_encode($this, JSON_PRETTY_PRINT);

        $chartJS .= ");\n";

        $chartJS .= $this->renderEndIIFE();

        return $chartJS;
    }

}
