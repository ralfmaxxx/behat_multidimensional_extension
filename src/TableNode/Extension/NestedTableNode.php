<?php

namespace TableNode\Extension;

use Behat\Gherkin\Node\TableNode;

class NestedTableNode extends TableNode
{
    /**
     * It returns multidimensional arrays for
     * indexes like model.name.something
     *
     * @return array
     */
    public function getNestedHash()
    {
        $nestedArray = [];
        $id = 0;

        $rows = $this->getColumnsHash();
        foreach ($rows as $row) {
            $nestedArray[$id] = [];
            foreach ($row as $name => $value) {
                $this->prepareMultiDimensionalArray($nestedArray[$id], $name, $value);
            }
            ++$id;
        }
        return $nestedArray;
    }

    /**
     * @param array $arraySource
     * @param string $key
     * @param string $value
     *
     * @return array
     */
    protected function prepareMultiDimensionalArray(array &$arraySource, $key, $value)
    {
        $keys = explode('.', $key);

        while (count($keys) > 1) {
            $key = array_shift($keys);
            $arraySource = &$arraySource[$key];
        }

        $arraySource[array_shift($keys)] = $value;
    }
}
