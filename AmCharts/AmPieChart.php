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
    public $type = 'pie';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $engine
     *
     * @return string
     */
    public function render()
    {
        $chartJS = "";

        $chartJS = $this->renderStartIIFE();

        //$chartJS = $this->renderStartChart();
        $chartJS .= "    var " . $this->type . "chart = new AmCharts.makeChart(\"" . (isset($this->config->container) ? $this->config->container : 'chart') . "\", {\n";

        // Chart Option
        $chartJS .= $this->renderWithJavascriptCallback($this->type, "type");

//        // Colors
//        if (!empty($this->colors)) {
//            $chartJS .= "        colors: " . json_encode($this->colors) . ",\n";
//        }
//
//        // Credits
//        if (get_object_vars($this->credits->credits)) {
//            $chartJS .= "        credits: " . json_encode($this->credits->credits) . ",\n";
//        }
//
//        // Exporting
//        $chartJS .= $this->renderWithJavascriptCallback($this->exporting->exporting, "exporting");
//
//        // Global
//        if (get_object_vars($this->global->global)) {
//            $chartJS .= "        global: " . json_encode($this->global->global) . ",\n";
//        }
//
//        // Labels
//        // Lang
//
//        // Legend
//        $chartJS .= $this->renderWithJavascriptCallback($this->legend->legend, "legend");
//
//        // Loading
//        // Navigation
//        // Pane
//        if (get_object_vars($this->pane->pane)) {
//            $chartJS .= "        pane: " . json_encode($this->pane->pane) . ",\n";
//        }
//
//        // PlotOptions
//        $chartJS .= $this->renderWithJavascriptCallback($this->plotOptions->plotOptions, "plotOptions");
//
//        // Series
//        $chartJS .= $this->renderWithJavascriptCallback($this->series, "series");
//
//        // Subtitle
//        if (get_object_vars($this->subtitle->subtitle)) {
//            $chartJS .= "        subtitle: " . json_encode($this->subtitle->subtitle) . ",\n";
//        }
//
//        // Symbols
//
//        // Title
//        if (get_object_vars($this->title->title)) {
//            $chartJS .= "        title: " . json_encode($this->title->title) . ",\n";
//        }
//
//        // Tooltip
//        $chartJS .= $this->renderWithJavascriptCallback($this->tooltip->tooltip, "tooltip");
//
//        // xAxis
//        if (gettype($this->xAxis) === 'array') {
//            $chartJS .= $this->renderWithJavascriptCallback($this->xAxis, "xAxis");
//        } elseif (gettype($this->xAxis) === 'object') {
//            $chartJS .= $this->renderWithJavascriptCallback($this->xAxis->xAxis, "xAxis");
//        }
//
//        // yAxis
//        if (gettype($this->yAxis) === 'array') {
//            $chartJS .= $this->renderWithJavascriptCallback($this->yAxis, "yAxis");
//        } elseif (gettype($this->yAxis) === 'object') {
//            $chartJS .= $this->renderWithJavascriptCallback($this->yAxis->yAxis, "yAxis");
//        }
//
        // trim last trailing comma and close parenthesis

        $chartJS = rtrim($chartJS, ",\n") . "\n    });\n";
        //$chartJS = $this->renderEndChart();

        $chartJS = $this->renderEndIIFE();

        return trim($chartJS);
    }
}
