<?php

namespace RedEye\AmChartsBundle\AmCharts;

/**
 * This class is part of the Ob/HighchartsBundle
 * See Highcharts documentation at http://www.highcharts.com/ref/
 */
class AmLineChart extends AbstractChart implements ChartInterface
{
    public $categoryField;
    public $categoryAxis;
    public $graphs;
    public $chartScrollbar;
    public $startEffect = ">";
    public $startDuration = 1;

    public function __construct()
    {
        parent::__construct();

        $this->type('serial');
        $this->categoryField('category');


        $arrayOptions = array('graphs');

        foreach ($arrayOptions as $option) {
            $this->initArrayOption($option);
        }

        $this->graphs(array('valueField' => 'value'));

        $complexOptions = array('categoryAxis', 'chartScrollbar');

        foreach ($complexOptions as $option) {
            $this->initComplexOption($option);
        }

    }

    /**
     * @return string
     */
    public function render()
    {
        $chartJS = $this->renderStartIIFE();

        //$chartJS = $this->renderStartChart();
        $chartJS .= "    var " . $this->type . "chart = new AmCharts.makeChart(\"" . (isset($this->config->container) ? $this->config->container : 'chart') . "\", {\n";

        // Chart Option
        $chartJS .= $this->renderWithJavascriptCallback($this->type, "type");
        $chartJS .= $this->renderWithJavascriptCallback($this->theme, "theme");
        $chartJS .= $this->renderWithJavascriptCallback($this->pathToImages, "pathToImages");
        $chartJS .= $this->renderWithJavascriptCallback($this->startEffect, "startEffect");
        $chartJS .= $this->renderWithJavascriptCallback($this->startDuration, "startDuration");
        $chartJS .= $this->renderWithJavascriptCallback($this->categoryField, "categoryField");
        $chartJS .= $this->renderWithJavascriptCallback($this->categoryAxis, "categoryAxis");
        $chartJS .= $this->renderWithJavascriptCallback($this->chartScrollbar, "chartScrollbar");
        $chartJS .= $this->renderWithJavascriptCallback($this->graphs, "graphs");
        $chartJS .= $this->renderWithJavascriptCallback($this->valueAxes, "valueAxes");
        $chartJS .= $this->renderWithJavascriptCallback($this->dataProvider, "dataProvider");
        // trim last trailing comma and close parenthesis

        $chartJS = rtrim($chartJS, ",\n") . "\n    });\n";
        //$chartJS = $this->renderEndChart();

        $chartJS .= $this->renderEndIIFE();

        return trim($chartJS);
    }

    public function setSimpleDataProvider(array $data)
    {
        if (isset($this->graphs[0]->valueField)) {
            $dataProvider = array();
            foreach ($data as $d)
            {
                $dataProvider[] = array($this->categoryField => $d[0], $this->graphs[0]->valueField => $d[1]);
            }
            $this->dataProvider($dataProvider);
        } else {
            throw new \RuntimeException('No graph configured to obtain value field');
        }
    }
}
