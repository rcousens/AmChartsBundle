<?php
namespace RC\AmChartsBundle\Twig;

use RC\AmChartsBundle\AmCharts\ChartInterface;

class AmChartsExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            'amchart' => new \Twig_Function_Method($this, 'chart', array('is_safe' => array('html'))),
        );
    }

    public function chart(ChartInterface $chart)
    {
        return $chart->render();
    }

    public function getName()
    {
        return 'amcharts_extension';
    }
}
