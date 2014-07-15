<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 24/06/2014
 * Time: 1:18 PM
 */

namespace RedEye\AmChartsBundle\AmCharts;


class AmColumnChart  extends AbstractChart implements ChartInterface
{
    public $valueField;
    public $titleField;
    public $categoryField;
    public $chartScrollbar;
    public $graphs;
    public $rotate = false;

    public function __construct()
    {
        parent::__construct();

        $this->type('serial');
        $this->categoryField('category');

        $arrayOptions = array('graphs');

        $complexOptions = array('chartScrollbar');

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
        $chartJS .= $this->renderWithJavascriptCallback($this->categoryField, "categoryField");
        $chartJS .= $this->renderWithJavascriptCallback($this->chartScrollbar, "chartScrollbar");
        $chartJS .= $this->renderWithJavascriptCallback($this->rotate, "rotate");
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
        $dataProvider = array();
        foreach ($data as $d)
        {
            $dataProvider[] = array($this->titleField => $d[0], $this->valueField => $d[1]);
        }
        $this->dataProvider($dataProvider);
    }
}
