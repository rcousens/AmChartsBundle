<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 24/06/2014
 * Time: 1:18 PM
 */

namespace RedEye\AmChartsBundle\AmCharts;


class AmGaugeChart extends AbstractChart implements ChartInterface
{
    public $startEffect = "easeInSine";
    public $startDuration = 1;

    public function __construct()
    {
        parent::__construct();

        $this->type('gauge');

        $arrayOptions = array('arrows', 'axes');
        $complexOptions = array();

        foreach ($arrayOptions as $option) {
            $this->initArrayOption($option);
        }

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
        $chartJS .= $this->renderWithJavascriptCallback($this->arrows, "arrows");
        $chartJS .= $this->renderWithJavascriptCallback($this->axes, "axes");
        // trim last trailing comma and close parenthesis

        $chartJS = rtrim($chartJS, ",\n") . "\n    });\n";
        //$chartJS = $this->renderEndChart();

        $chartJS .= $this->renderEndIIFE();

        return trim($chartJS);
    }
}
