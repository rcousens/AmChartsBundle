<?php

namespace RedEye\AmChartsBundle\AmCharts;

/**
 * This class is part of the Ob/HighchartsBundle
 * See Highcharts documentation at http://www.highcharts.com/ref/#chart
 */
class ChartOption
{
    private $option_name;

    private $option_value;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->option_name = $name;

        $this->option_value = null;
    }

    /**
     * @param string $name
     * @param array  $value
     *
     * @return $this
     */
    public function __call($name, $value)
    {
        $this->option_value = $value[0];
        return $this;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this->option_value;
    }
}
