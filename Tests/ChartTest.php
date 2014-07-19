<?php

require '../vendor/autoload.php';

$chart = new \RC\AmChartsBundle\AmCharts\AmLineChart();

$chart->addData(array('country' => 'USA', 'visits' => 3025, 'color' => '#FF0F00'));
$chart->addData(array('country' => 'Japan', 'visits' => 1625, 'color' => '#FF9E01'));
$chart->addValueAxis(array('axisAlpha' => 0, 'position' => 'left', 'title' => 'Visitors from country'));
$chart->addGraph(array('balloonText' => '<b>[[category]]: [[value]]</b>', 'lineAlpha' => 0.2, 'valueField' => 'visits'));
$chart->setCategoryField('country');

echo $chart->render();


$chart2 = new \RC\AmChartsBundle\AmCharts\AmColumnChart();

$chart2->addData(array('country' => 'USA', 'visits' => 3025, 'color' => '#FF0F00'));
$chart2->addData(array('country' => 'Japan', 'visits' => 1625, 'color' => '#FF9E01'));
$chart2->addValueAxis(array('axisAlpha' => 0, 'position' => 'left', 'title' => 'Visitors from country'));
$chart2->addGraph(array('balloonText' => '<b>[[category]]: [[value]]</b>', 'colorField' => 'color', 'fillAlphas' => 0.9, 'lineAlpha' => 0.2, 'valueField' => 'visits'));
$chart2->setCategoryField('country');

echo $chart2->render();

$chart3 = new \RC\AmChartsBundle\AmCharts\AmPieChart();

$chart3->setTitleField('category');
$chart3->setValueField('column-1');
$chart3->addData(array('category' => '1', 'value' => 10));
$chart3->addData(array('category' => '2', 'value' => 40));
$chart3->addData(array('category' => '3', 'value' => 30));

echo $chart3->render();

$chart4 = new \RC\AmChartsBundle\AmCharts\AmGaugeChart();
$chart4->addAxis(array('axisThickness' => 1, 'valueInterval' => 20, 'endValue' => 200));
$chart4->addArrow(array('value' => 30));

echo $chart4->render();