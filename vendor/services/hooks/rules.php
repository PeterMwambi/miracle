<?php


namespace Vendor\Services\Hooks;

use Vendor\Services\Data\Data;

/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Thu Aug 31 2023 10:28:51 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Service\Modules
 * @abstract Rule Formatter - Formats rules defined in string fashion to an array
 */
class Rules
{


    /**
     * #### Rule Keys Registrar
     * - This property stores rule keys for the rules to be formatted
     * @var array $keys - Rule keys for defined rules
     */
    private array $keys = [];

    /**
     * #### Rules Registrar
     * - This property stores the rules to be formatted
     * @var array $rules - Rules to be formatted
     */
    private array $rules = [];

    /**
     * #### Rule Values Registrar
     *  - This property stores rule values for the rules to be formatted
     * @var array $values - Rule values for defined rules 
     */
    private array $values = [];

    /**
     * #### Formatted Rules Registrar
     * - This property stores processed and formatted rules
     * @var array $formattedRules - The formatted rules
     */
    private array $formattedRules = [];

    /**
     * #### Get Keys
     * - This method gets ruke keys registered in rule key registrar
     * @return array
     */
    private function getKeys(): array
    {
        return $this->keys;
    }

    /**
     * #### Set Keys
     * - This method registers rule keys to the rule key registrar 
     * @param string $keys 
     * @return self
     */
    private function setKeys(string $keys): self
    {
        $this->keys[] = $keys;
        return $this;
    }

    /**
     * #### Get Rules
     * - This method gets registered rules from the rule registrar
     * @return array
     */
    private function getRules(): array
    {
        return $this->rules;
    }

    /**
     * #### Set Rules
     * - This method registers rules to the rule registrar
     * @param array $rules 
     * @return self
     */
    private function setRules(array $rules): self
    {
        $this->rules = $rules;
        return $this;
    }

    /**
     * #### Get Values
     * - This method gets rule values from the rule value registrar
     * @return array
     */
    private function getValues(): array
    {
        return $this->values;
    }

    /**
     * #### Set Values
     * - This method registers rule values to the rule value registrar
     * @param array|string $values 
     * @return self
     */
    public function setValues(array|string $values): self
    {
        $this->values[] = $values;
        return $this;
    }

    /**
     * #### Get Formatted Rules
     * - This method gets registered formatted rules from the Formatted rules registrar
     * @return array
     */
    private function getFormattedRules(): array
    {
        return $this->formattedRules;
    }

    /**
     * #### Set Formatted Rules
     * - This method registers formatted rules to the formatted rules registrar
     * @param array $formattedRules 
     * @return self
     */
    private function setFormattedRules(array $formattedRules): self
    {
        $this->formattedRules = $formattedRules;
        return $this;
    }

    /**
     * #### Get Rule Items
     * - This method registers rule keys and rule values and allows us to pull in rule formatting actions
     * @return self
     */
    private function getRuleItems(): self
    {
        foreach ($this->getRules() as $key => $value) {
            $this->setKeys($key);
            $this->setValues($value);
        }
        return $this;
    }


    /**
     * #### Format Rules
     * - This method performs rule formatting.
     * - For the method to work, rules must be defined as strings in key value pairs separated by `:` between keys and values and delimited by `|` to separate each pair.
     * - For example `username => "required:true|min:5|max:10"`
     * @return self
     */
    private function formatRules(): self
    {
        $rules = [];
        foreach (Data::arrayValues($this->getValues()) as $value) {
            $items = explode("|", $value);
            $keys = [];
            $values = [];
            for ($x = 0; $x < count($items); $x++) {
                $newRules = explode(":", $items[$x]);
                if (array_key_exists(0, $newRules) && array_key_exists(1, $newRules)) {
                    switch ($newRules[0]) {
                        case 'values':
                            $array = Data::stringOrArrayReplace(["[", "]"], "", explode(",", $newRules[1]));
                            $data = [];
                            foreach ($array as $item) {
                                $data[] = $item;
                            }
                            $newRules[1] = $data;
                            break;
                        case 'any':
                            $array = Data::stringOrArrayReplace(["[", "]"], "", explode(",", $newRules[1]));
                            $data = [];
                            foreach ($array as $item) {
                                $data[] = $item;
                            }
                            $newRules[1] = $data;
                            break;
                        case 'min':
                            $newRules[1] = (int) $newRules[1];
                            break;
                        case 'max':
                            $newRules[1] = (int) $newRules[1];
                            break;
                        case 'required' || 'unique' || 'count':
                            switch ($newRules[1]) {
                                case 'true':
                                    $newRules[1] = true;
                                    break;
                                case 'false':
                                    $newRules[1] = false;
                                    break;
                            }
                            break;
                    }
                    $keys[] = $newRules[0];
                    $values[] = $newRules[1];
                }
            }
            array_push($rules, Data::combineArray($keys, $values));
        }
        $this->setFormattedRules($rules);
        return $this;
    }

    /**
     * #### Verify Rules Are Strings
     * - This method verifies if rule values have been defined as strings so that they can be formatted to array
     * - The method returns `true` if the rule values have been defined as strings otherwise the method returns `false`
     * @return bool|self
     */
    public function verifyRulesAreStrings(): bool|self
    {
        foreach (Data::arrayValues($this->getValues()) as $item) {
            if (Data::isString($item)) {
                return true;
            } else {
                return false;
            }
        }
        return $this;
    }


    /**
     * #### Generate Rules
     * - This method combines formatted rule values from formatted rules registrar to their keys and generates an array of rules formatted from string
     * @return self
     */
    private function generateRules(): self
    {
        $this->setRules(Data::combineArray(array_values($this->getKeys()), $this->getFormattedRules()));
        return $this;
    }

    /**
     * #### Generate Formatted Rules
     * - This method puts together all rule formatting methods and formats rules from an array to a string
     * @return bool|array
     */
    public function generateFormattedRules(array $rules): bool|array
    {
        $this->setRules($rules);
        $this->getRuleItems();
        if ($this->verifyRulesAreStrings()) {
            $this->formatRules();
            $this->generateRules();
            return $this->getRules();
        }
        return false;
    }


}