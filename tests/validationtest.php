<?php



// Set a base class that extends service configrations.
// Extend base class to a controller class
// Let the main service class extend the controller class

use App\Controllers\ValidationController as Request;
use Vendor\Services\Configuration\Configuration as Config;
use Vendor\Services\Data\Data;
use Vendor\Services\Database\Database;


class ValidationTest
{

    /**
     * PROPERTIES
     */
    private array|string $data = [];

    private string $key = "";

    private array $rules = [];

    private string|int|array $value = "";

    private array $errors = [];

    private array $error = [];

    private bool $passed = false;

    private string $keyword = "";

    private array $filters = [];

    /**
     * Database Query Properties
     */

    private string $database = "";

    private string $table = "";

    private array|string $column = "";

    private string $reference = "";


    /**
     * GET AND SET METHODS
     */
    public function setData(array|string $data = [])
    {
        $this->data = $data;
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setKey(string $key)
    {
        $this->key = $key;
        return $this;
    }

    public function getKey()
    {
        return $this->key;
    }


    public function setRules(array $rules = [])
    {
        $this->rules = $rules;
        return $this;
    }

    public function setValue(string|array|int $value)
    {
        $this->value = $value;
        return $this;
    }


    public function getValue()
    {
        return $this->value;
    }

    public function setKeyword(string $keyword)
    {
        $this->keyword = $keyword;
        return $this;
    }

    public function getKeyword()
    {
        return $this->keyword;
    }

    public function getRules()
    {
        return $this->rules;
    }

    public function setErrors(array $errors = []): self
    {
        $this->errors = $errors;
        return $this;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setFilters(array $filters)
    {
        $this->filters = $filters;
    }

    public function getFilters()
    {
        return $this->filters;
    }

    public function passed()
    {
        if (count($this->error) <= 0) {
            $this->passed = true;
        }
        return $this->passed;
    }


    public function setError(string $error)
    {
        $this->error[] = $error;
        return;
    }

    public function getError()
    {
        foreach ($this->error as $error) {
            return $error;
        }
    }
    /**
     * Database Query Properties
     * @return string
     */
    public function getDatabase(): string
    {
        return $this->database;
    }

    /**
     * Database Query Properties
     * @param string $database Database Query Properties
     * @return self
     */
    public function setDatabase(string $database): self
    {
        $this->database = $database;
        return $this;
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * @param string $table 
     * @return self
     */
    public function setTable(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @return array|string
     */
    public function getColumn(): array|string
    {
        return $this->column;
    }

    /**
     * @param array|string $column 
     * @return self
     */
    public function setColumn(array|string $column): self
    {
        $this->column = $column;
        return $this;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string $reference 
     * @return self
     */
    public function setReference(string $reference): self
    {
        $this->reference = $reference;
        return $this;
    }


    /**
     * VALIDATION METHODS
     */


    private function writeError(string $type = "")
    {
        switch ($type) {
            case "count":
                return $this->setError($this->getErrors()[$this->getKey()][$this->getKey()]);
            default:
                return $this->setError($this->getErrors()[$this->getKey()][$this->getKeyword()]);
        }
    }

    private function validateMinLength()
    {
        if (
            isset($this->getData()[$this->getKey()]) &&
            (strlen($this->getData()[$this->getKey()]) < $this->getValue()) &&
            !isset($this->getRules()["count"])
        ) {
            $this->writeError();
            return false;
        }
        return;
    }

    private function validateMaxLength()
    {
        if (
            isset($this->getData()[$this->getKey()]) &&
            strlen($this->getData()[$this->getKey()]) > $this->getValue() &&
            !isset($this->getRules()["count"])
        ) {
            $this->writeError();
            return false;
        }
        return;
    }


    private function validateMinCount()
    {
        if (
            isset($this->getData()[$this->getKey()]) &&
            $this->getData()[$this->getKey()] < $this->getValue()
        ) {
            $this->writeError("count");
            return false;
        }
    }

    private function validateMaxCount()
    {
        if (
            isset($this->getData()[$this->getKey()]) &&
            $this->getData()[$this->getKey()] > $this->getValue()
        ) {
            $this->writeError("count");
            return false;
        }
    }

    private function validateCount()
    {
        foreach ($this->getRules() as $key => $value):
            $this->setKey($key);
            $this->setValue($value);
            switch ($key) {
                case "min":
                    return $this->validateMinCount();
                case "max":
                    return $this->validateMaxCount();
            }
        endforeach;
        return $this;
    }

    private function validateRequired()
    {
        switch ($this->getValue()) {
            case true:
                if (!isset($this->getData()[$this->getKey()])) {
                    $this->writeError();
                    return false;
                }
                break;
            default:
                return false;
        }
    }

    private function validateRequiredAny()
    {
        foreach ($this->getValue() as $key) {
            if (isset($this->getData()[$key])) {
                return true;
            } else {
                $this->writeError();
                return false;
            }
        }
    }


    private function validateWithFilter()
    {
        if (isset($this->getData()[$this->getKey()]) && $this->fetchFilter()) {
            if (!filter_var($this->getData()[$this->getKey()], $this->fetchFilter())) {
                $this->writeError();
                return false;
            }
        }
        return false;
    }

    private function validateWithPattern()
    {
        if (isset($this->getData()[$this->getKey()]) && $this->fetchPattern()) {
            if (!preg_match($this->fetchPattern(), $this->getData()[$this->getKey()])) {
                $this->writeError();
                return false;
            }
        }
        return false;
    }


    private function validateWithDatabase()
    {
        if (count($this->getRules())) {
            $this->setDatabase($this->getRules()["database"]);
            $this->setTable($this->getRules()["table"]);
            $this->setColumn($this->getRules()["column"]);
            return $this->validateDBData();
        }
        return false;
    }

    private function hasReferenceColumn()
    {
        if (isset($this->getRules()["reference"])) {
            return true;
        }
        return false;
    }

    private function validateUniqueData()
    {
        switch ($this->hasReferenceColumn()) {
            case true:
                if (!$this->getDBResultAndCompare()) {
                    $this->writeError();
                    return false;
                }
                break;
            case false:
                if ($this->validateExistentData()) {
                    $this->writeError();
                    return false;
                }
                break;
        }
    }

    private function validateNonUniqueData()
    {
        if (!$this->validateExistentData()) {
            $this->writeError();
            return false;
        }
    }

    private function getDBCount()
    {
        if (
            Database::query($this->getDatabase())->select(
                $this->getTable(),
                Data::isArray($this->getColumn()) ? $this->getColumn() : [$this->getColumn()],
                [$this->getColumn(), "=", $this->getData()[$this->getKey()]]
            )->getCount() > 0
        ) {
            return true;
        } else {
            return false;
        }
    }

    private function getDBResultAndCompare()
    {
        $this->setReference($this->getRules()["reference"]);
        $query = Database::query($this->getDatabase())->select($this->getTable(), [$this->getColumn()], [$this->getReference(), "=", $this->getData()[$this->getRules()["reference"]]]);
        if ($query->getCount() && password_verify($this->getData()[$this->getColumn()], $query->getResults()[$this->getColumn()])) {
            return true;
        } else {
            return false;
        }
    }



    private function validateDBData()
    {
        switch ($this->getValue()) {
            case true:
                return $this->validateUniqueData();
            case false:
                return $this->validateNonUniqueData();
        }
    }

    private function validateExistentData()
    {
        if ($this->getDBCount()) {
            return true;
        }
        return false;
    }



    private function fetchFilter()
    {
        if (Data::arrayKeyExists($this->getKey(), Config::app("filters"))) {
            return Config::app("filters")[$this->getKey()];
        }
        return false;
    }

    private function fetchPattern()
    {
        if (Data::arrayKeyExists($this->getValue(), Config::app("patterns"))) {
            return Config::app("patterns")[$this->getValue()];
        }
        return false;
    }



    /**
     * VALIDATION SERVICE PROVIDER
     */

    private function validateWithKeyword()
    {
        switch ($this->getKeyword()) {
            case "required":
                return $this->validateRequired();
            case "any":
                return $this->validateRequiredAny();
            case "count":
                return $this->validateCount();
            case "min":
                return $this->validateMinLength();
            case "max":
                return $this->validateMaxLength();
            case "filter":
                return $this->validateWithFilter();
            case "pattern":
                return $this->validateWithPattern();
            case "unique":
                return $this->validateWithDatabase();
        }
        return $this;
    }

    public function validate()
    {
        foreach ($this->getRules() as $key => $rules):
            foreach ($rules as $keyword => $value):
                $this->setKeyword($keyword);
                $this->setKey($key);
                $this->setValue($value);
                $this->setRules($rules);
                $this->validateWithKeyword();
            endforeach;
        endforeach;
        return $this;
    }


}






$data = [
    "username" => "pmwambi",
    "age" => 18,
    "password" => "password",
    "email" => "calebmwambi@gmail.com",
    "form" => "user-registration-form"
];

$errors = [
    "username" => [
        "required" => "Your username is required",
        "any" => "You must provide your username or email",
        "min" => "Username cannot be shorter than 5 characters",
        "max" => "Username cannot be longer than 30 characters",
        "pattern" => "Username contains invalid characters. Please use letters or letters with numbers",
        "unique" => "Username was not found"
    ],
    "email" => [
        "required" => "Your email address is required",
        "any" => "You must provide your username or email",
        "min" => "Your email address cannot be shorter than 5 characters",
        "filter" => "Your email address is invalid",
        "unique" => "Email address has already been registered"
    ],
    "age" => [
        "required" => "Your age is required",
        "min" => "Only 18 and above allowed",
        "max" => "Age cannot be greater than 80 years"
    ],
    "password" => [
        "required" => "Your password is required",
        "unique" => "Invalid password",
    ]

];


$rules = [
    "username" => "required:true|any:[username,email]|min:5|max:30|pattern:letters and numbers|unique:false|database:test|table:users_account_info|column:username",
    "email" => "required:true|any:[username,email]|min:5|filter:email|unique:true|database:test|table:users|column:email",
    "age" => "required:true|min:18|max:80|count:true",
    "password" => "required:true|unique:true|database:test|table:users_account_info|column:password|reference:username"
];

// $rules = [
//     "username" => [
//         "required" => true,
//         "any" => ["username", "email"],
//         "min" => 5,
//         "max" => 30,
//         "pattern" => "letters and numbers",
//         "unique" => false,
//         "database" => "test",
//         "table" => "users_account_info",
//         "column" => "username"
//     ],
//     "email" => [
//         "required" => false,
//         "any" => ["username", "email"],
//         "min" => 5,
//         "filter" => "email",
//         "unique" => true,
//         "database" => "test",
//         "table" => "users",
//         "column" => "email"
//     ],
//     "age" => [
//         "required" => true,
//         "min" => 18,
//         "max" => 80,
//         "count" => true
//     ],
//     "password" => [
//         "required" => true,
//         "unique" => true,
//         "database" => "test",
//         "table" => "users_account_info",
//         "column" => "password",
//         "reference" => "username"
//     ]
// ];


// print_r($rules);


// $rules = [
//     "username" => "required:true|min:5|max:30|unique:true|table:users_account_info|column:username|uses:true",
//     "firstname" => "required:true|min:10|max:20|assert:false|exists:true",
//     "lastname" => "required:true|min:15|max:30|unique:false|data:none",
// ];



// $rawRuleItems = [];
// $rawRuleKeys = [];
// $ruleItems = [];
// $processedRules = [];
// foreach ($rules as $key => $item) {
//     $items = (explode("|", $item));
//     array_push($rawRuleItems, $items);
//     array_push($rawRuleKeys, $key);
// }



// foreach ($rawRuleItems as $items) {
//     $rules = array_values($items);
//     $keys = [];
//     $newRules = [];
//     $processedRules = [];

//     for ($x = 0; $x < count($rules); $x++) {
//         $newRules = explode(":", $rules[$x]);
//         $newRules = [$newRules[0] => $newRules[1]];
//         $processedRules[] = $newRules;
//     }

//     array_push($ruleItems, $processedRules);

// }

// $processedRuleItems = [];
// for ($x = 0; $x < count($ruleItems); $x++) {

// }




// print_r($rawRules);












// echo "<pre>";
// print_r($ruleItems);
// echo "</pre>";


$validation = Request::validate($data, $rules, $errors);

if (!$validation->passed()) {
    echo $validation->displayError();
} else {
    die("true");
}

// Approach 2

// $validation = new Request();

// $validation->setData($data)->setRules($rules)->setErrors($errors);

// $validation->execute();

// if (!$validation->passed()) {
//     echo $validation->displayError();
// } else {
//     die("true");
// }