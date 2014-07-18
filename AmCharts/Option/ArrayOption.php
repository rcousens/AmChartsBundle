<?php

namespace RedEye\AmChartsBundle\AmCharts\Option;

class ArrayOption extends AbstractOption
{
    public function __construct($name, $value = null)
    {
        if ($name instanceof OptionInterface || is_array($name)) {
            parent::__construct(null, $name);
        } else {
            parent::__construct($name, $value);
        }

    }

    public function renderNameless()
    {
        $render = "[";
        if (is_array($this->_value)) {
            foreach ($this->_value as $element) {
                if ($element instanceof OptionInterface) {
                    $render .= $element->render() . ',';
                } else {
                    $render .= json_encode($element) . ',';
                }
            }
            $render = rtrim($render, ',');
        } elseif ($this->_value instanceof OptionInterface) {
            $render .= $this->_value->render();
        } elseif (! (null === $this->_value)) {
            $render .= json_encode($this->_value);
        }
        $render .= "]";
        return $render;

    }

    public function renderNamed()
    {
        $render = "\"$this->_name\": [";
        if (is_array($this->_value)) {
            foreach ($this->_value as $element) {
                if ($element instanceof OptionInterface) {
                    echo "hi\n";
                    $render .= $element->render() . ',';
                } else {
                    $render .= json_encode($element) . ',';
                }
            }
            $render = rtrim($render, ',');

        } elseif ($this->_value instanceof OptionInterface) {
            $render .= $this->_value->render();
        } elseif (! (null === $this->_value)) {
            $render .= json_encode($this->_value);
        }
        $render .= "]";
        return $render;
    }
}