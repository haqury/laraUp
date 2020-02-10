<?php
namespace App\Service;


class FormService
{
    public $config = [
        'TINYINT' => [
            'input' => 'input',
            'inputType' => 'text',
        ],
        'INT' => [
            'input' => 'input',
            'inputType' => 'text',
        ],
        'BIGINT' => [
            'input' => 'input',
            'inputType' => 'text',
        ],
        'FLOAT' => [
            'input' => 'input',
            'inputType' => 'text',
        ],
        'DOUBLE' => [
            'input' => 'checkbox',
            'default' => 'false',
        ],
        'NUMERIC' => [
            'input' => 'input',
            'inputType' => 'text',
        ],
        'DATE' => [
            'input' => '',
            'inputType' => '',
        ],
        'DATETIME' => [
            'input' => '',
            'inputType' => '',
        ],
        'TIMESTAMP' => [
            'input' => '',
            'inputType' => '',
        ],
        'TIME' => [
            'input' => '',
            'inputType' => '',
        ],
        'VARCHAR' => [
            'input' => 'input',
            'inputType' => 'text',
        ],
        'TINYTEXT' => [
            'input' => 'textArea',
            'inputType' => 'text',
        ],
        'TEXT' => [
            'input' => 'textArea',
            'inputType' => 'text',
        ],
        'ENUM' => [
            'input' => 'select',
        ],
    ];
    public function getSchemaModelBase($model)
    {
        return \DB::select(\DB::raw(
            "SELECT 
                information_schema.columns.*
            FROM 
                information_schema.columns
            WHERE 
                1=1
                AND table_name = '" . $model->getTable() . "' 
                AND table_schema = 'boxberry'"));
    }

    private function getSchemaField($field)
    {
        return [
            'type' => $this->config[strtoupper($field->DATA_TYPE)]['input'],
            'inputType' => $this->config[strtoupper($field->DATA_TYPE)]['inputType'] ?? '',
            'max' => !empty($field->CHARACTER_MAXIMUM_LENGTH) ? $field->CHARACTER_MAXIMUM_LENGTH : '',
            'label' => ucfirst($field->COLUMN_NAME),
            'model' => $field->COLUMN_NAME,
            'readonly' => $field->EXTRA == 'auto_increment' ? true : false,
            'disabled' => $field->EXTRA == 'auto_increment' ? true : false,
            'required' => $field->COLUMN_NAME == 'password' ? true : false,
        ];
    }

    public function getConfig($model, $disableColumn = [], $editConfigColumn = [])
    {
        $schema = $this->getSchemaModelBase($model);
        $config = [];
        $config['schema']['fields'] = [];
        foreach ($schema as $field) {
            if (empty($this->config[strtoupper($field->DATA_TYPE)]['input'])
                || (!empty($disableColumn) && array_search($field->COLUMN_NAME, $disableColumn))
            ) {
                continue;
            }
            $config['model'][$field->COLUMN_NAME] = $field->COLUMN_DEFAULT;

            $config['schema']['fields'][] = empty($editConfigColumn) && empty($editConfigColumn[$field->COLUMN_NAME])
                ? $this->getSchemaField($field)
                : array_merge($this->getSchemaField($field), $editConfigColumn[$field->COLUMN_NAME]);
        }
        return $config;
    }

    /**
     * @param $modelClass
     * @param array $model
     * @param array $disableColumn
     * @param array $editConfigColumn
     * @return array
     */
    public function getFormConfig($modelClass, $model = [], $disableColumn = [], $editConfigColumn = [])
    {
        $modelBase = new $modelClass();
        $config = $this->getConfig($modelBase, $disableColumn, $editConfigColumn);
        if (!empty($model)) {
            $config['model'] = is_array($model) ? $model : $model->toArray();
        }
        $config['formOptions'] = [
            'validateAfterLoad' => 'true',
            'validateAfterChanged' => 'true',
            'validateAsync' => 'true',
        ];
        return $config;
    }
}