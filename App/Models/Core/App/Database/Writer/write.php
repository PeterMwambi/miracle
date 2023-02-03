<?php

namespace Models\Core\App\Database\Writer;

use Exception;
use Models\Auth\Hashing;
use Models\Core\App\Cache\Storage;
use Models\Core\App\Database\Shell\Insert;
use Models\Core\App\Database\Shell\Query;
use Models\Core\App\Database\Shell\Select;
use Models\Core\App\Helpers\Formatter;
use Models\Core\App\Utilities\Session;

class Write
{

    private $_select;

    private $_insert;

    private $_test;

    private $_table;

    private $_where;

    private $_data;

    private $_fetch;

    private $_fields = array();

    private $_exists;

    private $_query;

    private $_handler;


    private $_formDataEntry = array();

    private $_userId;

    private $_specialKeys = array();

    private $_additionalParameters = array();

    private $_securityQuestions = array();

    private $_securityQuestionData = array();

    private $_securityQuestionFlag = false;

    private $_rawSecurityQuestions = array();

    private $_generateSecurityQuestions = array();

    private $_verifiedSecurityQuestion = array();


    public function WriteWhere(array |string $where)
    {
        $this->_where = $where;
    }
    public function WriteData(array |string $data)
    {
        $this->_data = $data;
    }

    public function WriteTable(string $table)
    {
        $this->_table = $table;
    }

    public function WriteFetch(int|null $fetch)
    {
        $this->_fetch = $fetch;
    }

    public function WriteFields(array $fields)
    {
        $this->_fields = $fields;
    }

    public function WriteExists(bool $exists)
    {
        $this->_exists = $exists;
    }

    private function _WriteHandler(string $handler)
    {
        $this->_handler = $handler;
    }

    private function _WriteFormDataEntry($formData = array())
    {
        if (count($formData)) {
            $this->WriteData($formData);
        }
        if (count($this->_GetData())) {
            foreach ($this->_GetData() as $data => $formData) {
                array_push($this->_formDataEntry, $formData);
            }
            return;
        } else {
            throw new Exception("Warning: Registration form data not found");
        }
    }

    private function _WriteSpecialKeys(array $keys)
    {
        $this->_specialKeys = $keys;
    }

    private function _WriteSecurityQuestions(string $questions)
    {
        array_push($this->_securityQuestions, $questions);
    }


    private function _WriteRawQuestion(array $question)
    {
        $this->_rawSecurityQuestions = $question;
    }

    private function _WriteVerifiedQuestion(object $question)
    {
        $this->_verifiedSecurityQuestion = $question;
    }

    private function _WriteSecurityQuestionData(array $data)
    {
        $this->_securityQuestionData = $data;
    }


    private function _WriteSecurityQuestionFlag(bool $flag)
    {
        $this->_securityQuestionFlag = $flag;
    }

    private function _GetRawQuestions()
    {
        if (count($this->_rawSecurityQuestions)) {
            return $this->_rawSecurityQuestions;
        } else {
            throw new Exception("Warning: No raw questions defined");
        }
    }



    private function _GetExists()
    {
        if (is_bool($this->_exists)) {
            return $this->_exists;
        } else {
            throw new Exception("Warning: Exists clause has not been initialised");
        }
    }


    private function _GetFields()
    {
        if (count($this->_fields)) {
            return $this->_fields;
        } else {
            throw new Exception("Warning: Fields have not been initialized");
        }
    }


    private function _GetFetch()
    {
        if (isset($this->_fetch)) {
            return $this->_fetch;
        } else {
            throw new Exception("Warning: Fetch has not been initialised");
        }
    }

    private function _GetTable()
    {
        if (!empty($this->_table)) {
            return $this->_table;
        } else {
            throw new Exception("Warning: Table has not been initialised");
        }
    }

    private function _GetWhere()
    {
        if (!empty($this->_where) || count($this->_where)) {
            return $this->_where;
        } else {
            throw new Exception("Warning: Where clause has not been initialised");
        }
    }

    private function _GetData()
    {
        if (!empty($this->_data) || count($this->_data)) {
            return $this->_data;
        } else {
            throw new Exception("Warning: Data has not been initialized");
        }
    }
    public function __construct()
    {
        $this->_select = new Select;
        $this->_query = new Query;
        $this->_insert = new Insert;
    }





    private function _GetFormDataEntry()
    {
        if (count($this->_formDataEntry)) {
            return $this->_formDataEntry;
        } else {
            throw new Exception("Warning: Registration data not set");
        }
    }


    private function _GetDataByForm(string $form)
    {
        for ($x = 0; $x < count($this->_GetFormDataEntry()); $x++) {
            if (array_key_exists($form, $this->_GetFormDataEntry()[$x])) {
                $formData = $this->_GetFormDataEntry()[$x][$form];
            }
        }
        return $formData;
    }


    private function _GetSpecialKeys()
    {
        if (count($this->_specialKeys)) {
            return $this->_specialKeys;
        } else {
            throw new Exception("Warning: No special keys found");
        }
    }

    private function _GetSecurityQuestions()
    {
        if (count($this->_securityQuestions)) {
            return $this->_securityQuestions;
        } else {
            throw new Exception("Warning: No security questions found");
        }
    }


    private function _GetHandler()
    {
        if (!empty($this->_handler)) {
            return $this->_handler;
        } else {
            throw new Exception("Warning: Handler has not been defined");
        }
    }


    /**
     * Summary of _GetSecurityQuestionData
     * @throws Exception
     * @return array
     */
    private function _GetSecurityQuestionData()
    {
        if (count($this->_securityQuestionData)) {
            return $this->_securityQuestionData;
        } else {
            throw new Exception("Warning: Security Question data has not been set");
        }
    }



    /**
     * Summary of _GetVerifiedQuestion
     * @throws Exception
     * @return array|object
     */
    private function _GetVerifiedQuestion()
    {
        if (is_object($this->_verifiedSecurityQuestion)) {
            return $this->_verifiedSecurityQuestion;
        } else {
            throw new Exception("Warning: No verified question found");
        }
    }


    private function _GetSecurityQuestionFlag()
    {
        if (is_bool($this->_securityQuestionFlag)) {
            return $this->_securityQuestionFlag;
        } else {
            throw new Exception("Warning: Invalid security question flag detected");
        }
    }



    public function ValidateSecurityQuestion1()
    {
        $this->_WriteSecurityQuestionData($this->_GetData());
        return $this->_RunSecurityQuestionValidation(
            $this->_ValidateSecurityQuestion("security-question-1")
        );
    }

    public function ValidateSecurityQuestion2()
    {
        $this->_WriteSecurityQuestionData($this->_GetData());
        return $this->_RunSecurityQuestionValidation(
            $this->_ValidateSecurityQuestion("security-question-2")
        );
    }

    public function ValidateSecurityAnswer1()
    {
        return $this->_RunSecurityAnswerValidation(
            $this->ValidateSecurityQuestion1(),
            $this->_GetSecurityQuestionData()["security-answer-1"]
        );
    }

    public function ValidateSecurityAnswer2()
    {
        return $this->_RunSecurityAnswerValidation(
            $this->ValidateSecurityQuestion2(),
            $this->_GetSecurityQuestionData()["security-answer-2"]
        );
    }



    private function _RunSecurityAnswerValidation(bool $question, string $data)
    {
        if ($question) {
            return match ($data) {
                Hashing::Decrypt($this->_GetVerifiedQuestion()->answer) => true,
                default => false,
            };
        } else {
            return false;
        }
    }

    private function _RunSecurityQuestionValidation(bool $question)
    {
        if ($question) {
            return true;
        } else {
            return false;
        }
    }

    private function _ValidateSecurityQuestion(string $primitive)
    {
        if ($this->_VerifyCachedLoginData()) {
            $this->_RunSecurityQuestionSetup();
            if ($this->_VerifyPrimitive($primitive)) {
                $this->_ValidateAndWriteVerifiedSecurityQuestion($primitive);
                return match ($this->_GetSecurityQuestionFlag()) {
                    true => true,
                    false => false,
                };
            }
        } else {
            return false;
        }
    }


    private function _ValidateAndWriteVerifiedSecurityQuestion(string $primitive)
    {
        foreach ($this->_GetSecurityQuestionsFromHandlers() as $securityQuestion) {
            switch ($this->_GetSecurityQuestionData()[$primitive]) {
                case Hashing::Decrypt($securityQuestion->question):
                    $this->_WriteVerifiedQuestion($securityQuestion);
                    $this->_WriteSecurityQuestionFlag(true);
                    break;
            }
        }
    }


    private function _VerifyCachedLoginData()
    {

        if (!isset($_SESSION)) {
            Session::Start();
        }
        if (!empty(Storage::GetCachedData())) {
            return true;
        } else {
            return false;
        }
    }

    private function _VerifyPrimitive(string $primitive)
    {
        if (array_key_exists($primitive, $this->_GetSecurityQuestionData())) {
            return true;
        } else {
            return false;
        }
    }


    private function _RunSecurityQuestionSetup()
    {
        $this->_WriteFormDataEntry(Storage::GetCachedData());
        $this->_WriteSpecialKeys(["username", "email"]);
        $this->_BindDataToSecurityQuestionHandler($this->_GetDataByForm("login-form-step-1"));
        $this->_WriteSecurityQuestionsFromHandlers();
    }



    private function _WriteSecurityQuestionsFromHandlers()
    {
        $this->_WriteRawSecurityQuestions();
        $this->_generateSecurityQuestions = array(
            $this->_GetSecurityQuestion1(),
            $this->_GetSecurityQuestion2(),
            $this->_GetSecurityQuestion3()
        );
    }


    private function _GetSecurityQuestionsFromHandlers()
    {
        if (count($this->_generateSecurityQuestions)) {
            return $this->_generateSecurityQuestions;
        } else {
            throw new Exception("Warning: No methods and no questions found");
        }
    }



    private function _GetSecurityQuestion1()
    {
        return $this->_GetRawSecurityQuestions()["question1"]->SecurityQuestion1;
    }

    private function _GetSecurityQuestion2()
    {
        return $this->_GetRawSecurityQuestions()["question2"]->SecurityQuestion2;
    }
    private function _GetSecurityQuestion3()
    {
        return $this->_GetRawSecurityQuestions()["question3"]->SecurityQuestion3;
    }

    private function _GetRawSecurityQuestions()
    {
        return $this->_GetRawQuestions();
    }



    private function _WriteRawSecurityQuestions()
    {
        $questions = array_values($this->_GetSecurityQuestionsFromJSON());
        $this->_WriteRawQuestion(Formatter::Run()->FormatArray($questions, ["question1", "question2", "question3"]));
        return;
    }




    private function _GetSecurityQuestionsFromJSON()
    {
        foreach ($this->_GetSecurityQuestions() as $SecurityQuestions) {
            $this->_securityQuestions = json_decode($SecurityQuestions);
        }
        return $this->_securityQuestions;
    }



    private function _BindDataToSecurityQuestionHandler(array $data)
    {
        foreach (array_keys($data) as $key) {
            $this->_ResolveSecurityQuestionData($data, $key);
        }
        return;
    }



    private function _ResolveSecurityQuestionData($data, $key)
    {
        if (!empty($data[$key]) && in_array($key, $this->_GetSpecialKeys())) {
            $this->_ResolveSecurityQuestionToHandler($key, $data[$key]);
        }
    }


    private function _ResolveSecurityQuestionToHandler(string $primitive, string $data)
    {
        return match ($primitive) {
            "username" => $this->_GetSecurityQuestionsByUsername($data),
            "email" => $this->_GetSecurityQuestionsByEmail($data)
        };
    }


    private function _GetSecurityQuestionsByUsername(string $username)
    {
        $this->_query->RunSQL("SELECT mb_securityinfo.SecurityQuestions 
        FROM mb_securityinfo 
        INNER JOIN mb_accountinfo ON 
        mb_securityinfo.UserId = mb_accountinfo.UserId 
        WHERE mb_accountinfo.Username =  ?",
            0,
            array($username)
        );
        if ($this->_query->GetCount()) {
            $this->_WriteSecurityQuestions($this->_query->GetResultsAsObject()->SecurityQuestions);
            return true;
        } else {
            return false;
        }
    }


    private function _GetSecurityQuestionsByEmail(string $email)
    {
        $this->_query->RunSQL("SELECT mb_securityinfo.SecurityQuestions 
        FROM mb_securityinfo 
        INNER JOIN mb_contactinfo ON 
        mb_securityinfo.UserId = mb_contactinfo.UserId 
        WHERE mb_contactinfo.Email = ?",
            0,
            array($email)
        );
        if ($this->_query->GetCount()) {
            $this->_WriteSecurityQuestions($this->_query->GetResultsAsObject()->SecurityQuestions);
            return true;
        } else {
            return false;
        }
    }

    public function ProcessMemberLogin()
    {
        echo "<pre>";
        print_r(Storage::GetCachedData());
        echo "</pre>";
        die;
    }

    private function _ValidateData()
    {
        $this->_select->Fields($this->_GetFields());
        $this->_select->Table($this->_GetTable());
        $this->WriteFetch(0);
        $this->_select->Fetch($this->_GetFetch());
        $this->_select->Where($this->_GetWhere());
        $this->_select->Execute();
        if ($this->_select->GetCount() > 0) {
            return true;
        } else {
            return false;
        }
    }


    private function _ResolveTestFromExistsClause()
    {
        if (isset($this->_test)) {
            return match ($this->_GetExists()) {
                true => match ($this->_test) {
                        true => true,
                        false => false,
                    },
                false => match ($this->_test) {
                        true => false,
                        false => true,
                    },
            };
        }
    }

    private function _ValidateAccountByUsername()
    {
        $data = is_array($this->_GetData()) ? $this->_GetData()["username"] : $this->_GetData();
        $this->WriteFields(array("username", "password"));
        $this->WriteTable("mb_accountinfo");
        $this->WriteWhere(array("username", "=", $data));
        $this->_test = $this->_ValidateData();
        return $this->_ResolveTestFromExistsClause();
    }


    private function _ValidateAccountByEmail()
    {
        $data = is_array($this->_GetData()) ? $this->_GetData()["email"] : $this->_GetData();
        $this->WriteFetch(0);
        $this->_query->RunSQL(
            "SELECT mb_contactinfo.email,
            mb_accountinfo.password 
            FROM mb_contactinfo
            INNER JOIN  mb_accountinfo ON 
            mb_accountinfo.UserId = mb_contactinfo.UserId 
            WHERE mb_contactinfo.Email = ?",
            $this->_GetFetch(),
            array($data)
        );
        if ($this->_query->GetCount() > 0) {
            $this->_test = true;
        } else {
            $this->_test = false;
        }
        return $this->_ResolveTestFromExistsClause();
    }




    private function _VerifyAuthSession()
    {
        if (Session::Exists("USER_AUTH")) {
            return true;
        } else {
            return false;
        }
    }

    private function _GenerateAuthSession()
    {
        return match ($this->_GetHandler()) {
            "email" => Session::Set("USER_AUTH", $this->_query->GetResultsAsArray()),
            "username" => Session::Set("USER_AUTH", $this->_select->GetResultsAsArray()),
        };
    }


    private function _GetLiveAuthSession()
    {
        if ($this->_VerifyAuthSession()) {
            return Session::Get("USER_AUTH");
        } else {
            throw new Exception("Warning: Auth session has not been initialised");
        }
    }




    public function ValidateUsername()
    {
        if ($this->_ValidateAccountByUsername()) {
            if ($this->_GetExists()) {
                $this->_WriteHandler("username");
                $this->_GenerateAuthSession();
            }
            return true;
        } else {
            return false;
        }
    }


    public function ValidateEmail()
    {
        if ($this->_GetExists()) {
            if ($this->_ValidateAccountByEmail()) {
                $this->_WriteHandler("email");
                $this->_GenerateAuthSession();
                return true;
            }
        } else {
            $data = is_array($this->_GetData()) ? $this->_GetData()["email"] : $this->_GetData();
            $this->WriteFields(array("Email"));
            $this->WriteWhere(array("Email", "=", $data));
            return $this->_ValidateContactInfo();
        }
    }

    public function ValidatePassword()
    {
        if ($this->_ResolveMethodFromDataEntry()) {
            if (password_verify($this->_GetData()["password"], $this->_GetLiveAuthSession()["password"])) {
                Session::Destroy("USER_AUTH");
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function _ResolveMethodFromDataEntry()
    {
        if (isset($this->_GetData()["username"])) {
            $method = $this->ValidateUsername();
        } else {
            if (isset($this->_GetData()["email"])) {
                $method = $this->ValidateEmail();
            }
        }
        return $method;
    }


    private function _ValidateContactInfo()
    {
        $this->WriteFetch(0);
        $this->WriteTable("mb_contactinfo");
        $this->_test = $this->_ValidateData();
        return $this->_ResolveTestFromExistsClause();
    }

    public function ValidatePhoneNumber()
    {
        $this->WriteFields(array("PhoneNumber"));
        $phoneNumber = "+254" . $this->_GetData();
        $this->WriteWhere(array("PhoneNumber", "=", $phoneNumber));
        return $this->_ValidateContactInfo();
    }

    public function ValidateNationalId()
    {
        $this->WriteFields(array("NationalId"));
        $this->WriteWhere(array("NationalId", "=", $this->_GetData()));
        return $this->_ValidateContactInfo();
    }





    private function _GenerateUserId()
    {
        $this->_userId = strtoupper(uniqid());
    }

    private function _GetUserId()
    {
        if (!empty($this->_userId)) {
            return $this->_userId;
        } else {
            throw new Exception("Warning: User id has not been defined");
        }
    }


    public function RegisterMemberToDB()
    {
        $this->_WriteFormDataEntry();
        $this->_GenerateUserId();
        $this->_RegisterDataFromStep1();
        $this->_RegisterDataFromStep2();
        $this->_RegisterDataFromStep3();
        $this->_RegisterDataFromStep4();
        $this->_RegisterDataFromStep5();
        return true;
    }


    private function _RegisterAdditionalParameters(array $params)
    {
        $this->_additionalParameters = $params;
    }

    private function _GetAdditionalParameters()
    {
        if (count($this->_additionalParameters)) {
            return $this->_additionalParameters;
        } else {
            throw new Exception("Warning: Additional parameters have not been defined");
        }
    }


    private function _ResolveParameterToValue(string $param)
    {
        return $this->_GetAdditionalParameters()[$param];
    }



    private function _RegisterDataFromStep1()
    {
        $this->_RegisterAdditionalParameters(
            array(
                "UserId" => $this->_GetUserId()
            )
        );
        $this->WriteTable("mb_personalinfo");
        $this->_RegisterData(
            $this->_GetDataByForm("registration-form-step-1"),
            "UserId"
        );
    }

    private function _RegisterDataFromStep2()
    {
        $data = $this->_GetDataByForm("registration-form-step-2");
        $data["phone-number"] = "+254" . $data["phone-number"];
        $this->_RegisterAdditionalParameters(
            array(
                "UserId" => $this->_GetUserId()
            )
        );
        $this->WriteTable("mb_contactinfo");
        $this->_RegisterData($data, "UserId");
    }

    private function _RegisterDataFromStep3()
    {
        $this->_RegisterAdditionalParameters(
            array(
                "UserId" => $this->_GetUserId(),
                "EducationBackground" => json_encode(array()),
                "EmploymentHistory" => json_encode(array()),
                "Projects" => json_encode(array())
            )
        );
        $this->WriteTable("mb_competencyinfo");
        $this->_RegisterData(
            $this->_GetDataByForm("registration-form-step-3"),
            "UserId",
            "EducationBackground",
            "EmploymentHistory",
            "Projects"
        );
    }

    private function _RegisterDataFromStep4()
    {
        $data = $this->_GetDataByForm("registration-form-step-4");
        $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
        $data = array(
            "Username" => $data["username"],
            "Password" => $data["password"],
            "TermsAndConditions" => $data["terms-and-conditions"]
        );
        $this->_RegisterAdditionalParameters(
            array(
                "UserId" => $this->_GetUserId(),
                "DateCreated" => $this->_GenerateDateAsJSON(),
                "LastSignedIn" => $this->_GenerateDateAsJSON()
            )
        );
        $this->WriteTable("mb_accountinfo");
        $this->_RegisterData($data, "UserId", "DateCreated", "LastSignedIn");
    }


    private function _RegisterDataFromStep5()
    {

        $data = $this->_GetDataByForm("registration-form-step-5");
        $question1 = array(
            "SecurityQuestion1" => array(
                "question" => Hashing::Encrypt($data["security-question-1"]),
                "answer" => Hashing::Encrypt($data["security-answer-1"])
            )
        );
        $question2 = array(
            "SecurityQuestion2" => array(
                "question" => Hashing::Encrypt($data["security-question-2"]),
                "answer" => Hashing::Encrypt($data["security-answer-2"])
            )
        );
        $question3 = array(
            "SecurityQuestion3" => array(
                "question" => Hashing::Encrypt($data["security-question-3"]),
                "answer" => Hashing::Encrypt($data["security-answer-3"])
            )
        );
        $SecurityQuestions = [];
        array_push($SecurityQuestions, $question1, $question2, $question3);
        $SecurityQuestions = array("SecurityQuestions" => json_encode($SecurityQuestions));
        $this->_RegisterAdditionalParameters(array("UserId" => $this->_GetUserId()));
        $this->WriteTable("mb_securityinfo");
        $this->_RegisterData($SecurityQuestions, "UserId");
    }


    private function _RegisterData(array $data, mixed...$vars)
    {
        $dataKeys = [];
        foreach (array_keys($data) as $key) {
            array_push($dataKeys, $this->_FormatKeys($key));
        }
        $values = array_values($data);
        if (count($vars)) {
            foreach ($vars as $var) {
                array_push($dataKeys, $var);
                array_push($values, $this->_ResolveParameterToValue($var));
            }
        }
        $CleanData = Formatter::Run()->FormatArray($values, $dataKeys);
        $this->_RunInsertQuery($CleanData);
        return;
    }


    private function _RunInsertQuery(array $data)
    {
        $this->_insert->Table($this->_GetTable());
        $this->_insert->Fields($data);
        $this->_insert->Execute();
        return;
    }


    private function _FormatKeys($key)
    {
        return str_replace(" ", "", ucwords(str_replace("-", " ", $key)));
    }

    private function _GenerateDateAsJSON()
    {
        $date = json_encode(
            array(
                "day" => date("l"),
                "date" => date("d/M/Y"),
                "time" => date("g:iA")
            )
        );
        return $date;
    }

}