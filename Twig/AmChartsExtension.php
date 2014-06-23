<?php
namespace RedEye\AmChartsBundle\Twig;

use RedEye\AmChartsBundle\AmCharts\ChartInterface;

class AmChartsExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            'chart' => new \Twig_Function_Method($this, 'chart', array('is_safe' => array('html'))),
        );
    }

    public function chart(ChartInterface $chart, $engine = 'jquery')
    {
        return $chart->render($engine);
    }

    public function getName()
    {
        return 'amcharts_extension';
    }
}
