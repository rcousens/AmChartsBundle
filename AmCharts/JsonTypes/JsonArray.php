<?php

namespace RedEye\AmChartsBundle\AmCharts\JsonTypes;

class JsonArray implements \JsonSerializable
{
    protected $elements;

    public function __construct(array $elements = array())
    {
        $this->elements = $elements;
    }

    public function addElement($element)
    {
        if (is_array($element)) {
            $this->elements[] = new JsonArray();
        } elseif (is_object($element)) {
            $this->elements[] = new JsonObject($element);
        } else {
            $this->elements[] = $element;
        }
    }


    public function jsonSerialize()
    {
        return $this->elements;
    }
}
