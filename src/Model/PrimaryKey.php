<?php

namespace Emanci\MysqlCompareFixer\Model;

class PrimaryKey
{
    use ColumnTrait;

    /**
     * PrimaryKey construct.
     *
     * @param array $columns
     */
    public function __construct(array $columns)
    {
        foreach ($columns as $column) {
            $this->addColumn($column);
        }
    }

    /**
     * @return string
     */
    public function getDefinitionScript()
    {
        $primaryKeysString = implode('`, `', $this->getPrimaryKeys());

        return sprintf('PRIMARY KEY (`%s`)', $primaryKeysString);
    }

    /**
     * @return array
     */
    protected function getPrimaryKeys()
    {
        return array_map(function ($primaryKeyColumn) {
            return $primaryKeyColumn->getField();
        }, $this->columns);
    }
}