<?php

namespace RedEye\AmChartsBundle\AmCharts;

/**
 * This class is part of the Ob/HighchartsBundle
 * See Highcharts documentation at http://www.highcharts.com/ref/
 */
class AmPieChart extends AbstractChart implements ChartInterface
{
    public $valueField;
    public $titleField;

    public function __construct()
    {
        parent::__construct();

        $this->type('pie');
        $this->valueField('value');
        $this->titleField('title');
    }

    /**
     * @param string $engine
     *
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
        $chartJS .= $this->renderWithJavascriptCallback($this->valueField, "valueField");
        $chartJS .= $this->renderWithJavascriptCallback($this->titleField, "titleField");
        $chartJS .= $this->renderWithJavascriptCallback($this->dataProvider, "dataProvider");
        // trim last trailing comma and close parenthesis

        $chartJS = rtrim($chartJS, ",\n") . "\n    });\n";
        //$chartJS = $this->renderEndChart();

        $chartJS .= $this->renderEndIIFE();

        return trim($chartJS);
    }
}
