<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 24/06/2014
 * Time: 1:18 PM
 */

namespace RedEye\AmChartsBundle\AmCharts;


class AmPieChart extends AbstractChart
{
    protected $type = 'pie';

    public function __construct()
    {
        parent::__construct();
        $this->jsonSettings->type('pie');
        $this->jsonSettings->titleField('category');
        $this->jsonSettings->valueField('value');
    }

    public function setTitleField($field)
    {
        $this->jsonSettings->titleField($field);
    }

    public function setValueField($field)
    {
        $this->jsonSettings->valueField($field);
    }

}
