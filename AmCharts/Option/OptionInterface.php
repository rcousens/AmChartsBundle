<?php

namespace RedEye\AmChartsBundle\AmCharts\Option;

interface OptionInterface
{
    public function render();

    public function setValue($value);

    public function getValue();

    public function getName();

    public function renderNamed();

    public function renderNameless();
}