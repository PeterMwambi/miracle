<?php

use PSpell\Config;
use Vendor\Services\Configuration\Configuration;
use Vendor\Services\Data\Data;
use Vendor\Services\Modules\Rules as RuleFormatter;

class Rules
{


    private array $keys = [];

    private array $rules = [];

    private array $values = [];

    private array $formattedRules = [];



    /**
     * @return array
     */
    public function getKeys(): array
    {
        return $this->keys;
    }

    /**
     * @param array $keys 
     * @return self
     */
    public function setKeys(string $keys): self
    {
        $this->keys[] = $keys;
        return $this;
    }

    /**
     * @return array
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @param array $rules 
     * @return self
     */
    public function setRules(array $rules): self
    {
        $this->rules = $rules;
        return $this;
    }

    /**
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @param array $values 
     * @return self
     */
    public function setValues(array|string $values): self
    {
        $this->values[] = $values;
        return $this;
    }

    /**
     * @return array
     */
    public function getFormattedRules(): array
    {
        return $this->formattedRules;
    }

    /**
     * @param array $formattedRules 
     * @return self
     */
    public function setFormattedRules(array $formattedRules): self
    {
        $this->formattedRules = $formattedRules;
        return $this;
    }


    public function resetValues()
    {
        $this->values = [];
        return $this;
    }


    public function getRuleItems()
    {
        foreach ($this->getRules() as $key => $value) {
            $this->setKeys($key);
            $this->setValues($value);
        }
        return $this;
    }


    public function formatRules()
    {
        $rules = [];
        foreach (Data::arrayValues($this->getValues()) as $value) {
            $items = explode("|", $value);
            $keys = [];
            $values = [];
            for ($x = 0; $x < count($items); $x++) {
                $newRules = explode(":", $items[$x]);
                if (array_key_exists(0, $newRules) && array_key_exists(1, $newRules)) {
                    $keys[] = $newRules[0];
                    $values[] = $newRules[1];
                }
            }
            array_push($rules, Data::combineArray($keys, $values));
        }
        $this->setFormattedRules($rules);
        return $this;
    }

    public function verifyRulesAreStrings()
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


    public function generateRules()
    {
        $this->setRules(Data::combineArray(array_values($this->getKeys()), $this->getFormattedRules()));
        return $this;
    }

    public function generateFormattedRules(array $rules)
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


$ruleTest = new RuleFormatter();


$rules = [
    "username" => "required:true|min:5|max:30|unique:true|table:users_account_info|column:username",
    "firstname" => "required:true|min:10|max:20",
    "lastname" => "required:true|min:15|max:30|unique:false|",
    "dob" => "required:true|min-year:1960|max-year:2023",
    "gender" => "values:[male,female]"
];

// $rules = [
//     "username" => [
//         "required" => true,
//         "min" => 5,
//         "max" => 30,
//         "unique" => true,
//         "table" => "user_account_info"
//     ]
// ];

// $ruleTest->setRules($rules);

// $ruleTest->getRuleItems();

// $ruleTest->verifyRulesAreStrings();


$rules = $ruleTest->generateFormattedRules($rules);


// Type cast keys to their correct values
// Get Keyword

// Integer

// Keywords [min, max]
// $rules["username"]["max"] = (int) $rules["username"]["max"];


// Array

// Keywords [values]
// $array = Data::stringOrArrayReplace(["[", "]"], "", explode(",", $rules["gender"]["values"]));
// $data = [];
// foreach ($array as $item) {
//     $data[] = $item;
// }
// $rules["gender"]["values"] = $data;

// Booleans

// Keywords [required, unique]
// switch ($rules["username"]["required"]) {
//     case "true":
//         $rules["username"]["required"] = true;
//         break;
//     case "false":
//         $rules["username"]["required"] = false;
//         break;
// }


// foreach($keywords as $keyword){
//     foreach(Configuration::app("types") as $key => $value){

//     }
// }




// var_dump($rules["username"]["max"]);

echo "<pre>";
print_r(var_dump($rules));
echo "</pre>";