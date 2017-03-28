<?php
namespace RC\AmChartsBundle\Twig;

use RC\AmChartsBundle\AmCharts\ChartInterface;

class AmChartsExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('amchart', array($this, 'renderAmChart'), array('is_safe' => array('html'))),
        );
    }

    public function renderAmChart(ChartInterface $chart)
    {
        return $chart->render();
    }

    public function getName()
    {
        return 'amcharts_extension';
    }
}
