<?php

use Models\Auth\Hashing;
use Models\Core\App\Database\Queries\Read\Admin;
use Models\Core\App\Helpers\Formatter;
use Models\Core\App\Utilities\Url;
use Views\Includes\Components\Forms\Form;
use Views\Includes\Components\Forms\FormDescription;
use Views\Includes\Components\Classes\Header as FormHeader;



/*
````````````````````````````````````````````````````````
DEFAULT PROPERTIES
```````````````````````````````````````````````````````
*/


/**
 * Form description setup defaults
 * @param FormDescription $formDescription
 * @return void
 */
function formDescriptionSetupDefaults(FormDescription $formDescription)
{
    $formDescription->setJustifyHeading("center");
    $formDescription->setHeadingColor("dark");
    $formDescription->setJustifyDescription("center");
    $formDescription->setDescriptionColor("dark");
    $formDescription->setDescriptionColumns("col-md-6 col-9");
    $formDescription->setJustifyDescriptionImage("center");
    $formDescription->setDescriptionSizing("my-3");
    $formDescription->setDescriptionTextJustify("center");
    $formDescription->setDescriptionImageUrlClasses("img-fluid");
    $formDescription->runSetup();
}


/**
 * form header set up default properties
 * @param FormHeader $formHeader
 * @return void
 */
function formHeaderSetupDefaults(FormHeader $formHeader)
{
    $formHeader->setHelpTextClasses("tutorspoint__help-text");
    $formHeader->setHeadingClasses("tutorspoint__form-heading");
    $formHeader->setHelpTextSizing("mb-3");
    $formHeader->setHeadingSizing("mt-3");
    $formHeader->setJustifyHeading("center");
    $formHeader->setJustifyHelpText("center");
    $formHeader->setType("form-header");
    $formHeader->runSetup();
}


/* 
```````````````````````````````````````````````````````
ATTENDANTS FORMS SET UP
``````````````````````````````````````````````````````
*/

/*
``````````````````````````````````````````````````````
ATTENDANT REGISTRATION FORM
`````````````````````````````````````````````````````
*/

/**
 * Attendant registration form description setup
 * @return void
 */
function runAttendantRegistrationFormDescriptionSetup()
{
    $formDescription = new FormDescription;
    $formDescription->setHeading("Attendant registration form");
    $formDescription->setDescription("Please ensure that you fill all the required
        fields to
        register a new attendant");
    $formDescription->setDescriptionImageUrl(Url::getReference("resources/assets/images/png/team.png"));
    formDescriptionSetupDefaults($formDescription);
}

/**
 * Attendant registration form header set up
 * @return void
 */
function runAttendantRegistrationFormHeaderSetUp()
{
    $formHeader = new FormHeader;
    $formHeader->setHeading("Step 1: Personal Information");
    $formHeader->setHelpText("Required fields are marked by *");
    formHeaderSetupDefaults($formHeader);
}
/**
 * Attendant registration form set up step 1
 * @return void
 */
function runAttendantRegistrationFormSetupStep1()
{
    $form = new Form;
    $form->setFields([
        "firstname",
        "lastname",
        "gender",
        "date-of-birth",
        "age",
        "nationality",
        "national-id",
        "phone-number",
        "email",
        "form-identifier",
        "submit",
        "additional-buttons"
    ]);
    $form->setRows(1);
    $form->setCols([
        "firstname" => "col-12 col-md-6 my-2",
        "lastname" => "col-12 col-md-6 my-2",
        "gender" => "col-12 col-md-6 my-2",
        "date-of-birth" => "col-12 col-md-6 my-2",
        "age" => "col-12 col-md-6 my-2",
        "nationality" => "col-12 col-md-6 my-2",
        "national-id" => "col-12 col-md-6 my-2",
        "phone-number" => "col-12 col-md-6 my-2",
        "email" => "col-12 col-md-12 my-2",
        "form-identifier" => "col-12",
        "submit" => "col-12 col-md-12",
        "additional-buttons" => "col-12 col-md-12"
    ]);
    $form->setContent([
        "firstname" => array(
            "label" => [
                "for" => "firstname",
                "value" => "<h6><strong>Firstname: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "text",
                "name" => "firstname",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "lastname" => array(
            "label" => [
                "for" => "lastname",
                "value" => "<h6><strong>Lastname: * </strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "text",
                "name" => "lastname",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "gender" => array(
            "label" => [
                "for" => "gender",
                "value" => "<h6><strong>Gender: *</strong></h6>",
                "class" => "my-2"
            ],
            "select" => [
                "name" => "gender",
                "options" => ["Male", "Female"],
                "class" => "form-select"
            ]
        ),
        "date-of-birth" => array(
            "label" => [
                "for" => "date-of-birth",
                "value" => "<h6><strong>Date of birth* </strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "date",
                "name" => "date-of-birth",
                "class" => "form-control",
                "value" => "",
            ]
        ),
        "age" => array(
            "label" => [
                "for" => "age",
                "value" => "<h6><strong>Age: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "number",
                "name" => "age",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "nationality" => array(
            "label" => [
                "for" => "nationality",
                "value" => "<h6><strong>Nationality: *</strong></h6>",
                "class" => "my-2"
            ],
            "select" => [
                "name" => "nationality",
                "options" => ["Kenyan"],
                "class" => "form-select"
            ]
        ),
        "national-id" => array(
            "label" => [
                "for" => "national-id",
                "value" => "<h6><strong>National id: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "number",
                "name" => "national-id",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "phone-number" => array(
            "label" => [
                "for" => "phone-number",
                "value" => "<h6><strong>Phone Number: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "number",
                "name" => "phone-number",
                "class" => "form-control",
                "value" => "",
                "has-group" => true,
                "group-details" => array("prefix" => "+254")
            ]
        ),
        "email" => array(
            "label" => [
                "for" => "email",
                "value" => "<h6><strong>Email: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "email",
                "name" => "email",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "form-identifier" => array(
            "input" => [
                "type" => "hidden",
                "name" => "form-identifier",
                "class" => "",
                "value" => Hashing::encrypt("ATTENDANT_REGISTRATION_FORM_STEP_1")
            ]
        ),
        "submit" => array(
            "button" => [
                "color" => "dark",
                "type" => "submit",
                "has-spinner" => true,
                "value" => "Go to step 2"
            ]
        ),
        "additional-buttons" => array(
            "additional-buttons" => [
                "color" => "secondary",
                "purpose" => "action-btn",
                "size" => "w-100 mt-3",
                "link" => "tutor-login",
                "innerHtml" => "I already have an account"
            ]
        ),

    ]);
    $form->runSetup([
        "method" => "POST",
        "action" => "",
        "id" => "attendant-registration-form-step-1",
        "class" => ""
    ]);
}
/**
 * Attendant registration form setup step 2
 * @return void
 */
function runAttendantRegistrationFormSetupStep2()
{
    $form = new Form;
    $form->setFields([
        "username",
        "password",
        "confirm-password",
        "show-password",
        "form-identifier",
        "submit"
    ]);
    $form->setRows(1);
    $form->setCols([
        "username" => "col-12 my-2",
        "password" => "col-12 my-2",
        "confirm-password" => "col-12 my-2",
        "show-password" => "col-12 my-2",
        "form-identifier" => "col-12",
        "submit" => "col-12 col-md-12 my-2"
    ]);
    $form->setContent([
        "username" => array(
            "label" => [
                "for" => "username",
                "value" => "<h6><strong>Username: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "text",
                "name" => "username",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "password" => array(
            "label" => [
                "for" => "password",
                "value" => "<h6><strong>Password: * </strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "password",
                "name" => "password",
                "class" => "form-control password-visibility-toggle",
                "value" => ""
            ]
        ),
        "confirm-password" => array(
            "label" => [
                "for" => "password",
                "value" => "<h6><strong>Confirm Password: * </strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "password",
                "name" => "confirm-password",
                "class" => "form-control password-visibility-toggle",
                "value" => ""
            ]
        ),

        "show-password" => array(
            "input" => [
                "type" => "checkbox",
                "name" => "show-password",
                "class" => "form-check-input password-switch",
                "value" => ""
            ],
            "label" => [
                "for" => "show password",
                "value" => "<h6>Show Password</h6>",
                "class" => "form-check-label mx-2"
            ],
        ),
        "form-identifier" => array(
            "input" => [
                "type" => "hidden",
                "name" => "form-identifier",
                "class" => "",
                "value" => Hashing::encrypt("ATTENDANT_REGISTRATION_FORM_STEP_2")
            ]
        ),
        "submit" => array(
            "button" => [
                "color" => "dark",
                "type" => "submit",
                "has-spinner" => true,
                "value" => "Complete Registration &raquo;"
            ]
        )
    ]);
    $form->runSetup([
        "method" => "POST",
        "action" => "",
        "id" => "attendant-registration-form-step-2",
        "class" => "d-none"
    ]);
}

/*
``````````````````````````````````````````````````````````````
ATTENDANT LOGIN FORM
`````````````````````````````````````````````````````````````
*/
/**
 * Attendant login form description set up
 * @return void
 */
function runAttendantLoginFormDescriptionSetup()
{
    $formDescription = new FormDescription;
    $formDescription->setHeading("Attendant login form");
    $formDescription->setDescription("Please ensure that you enter the correct username and password for you to access your account");
    $formDescription->setDescriptionImageUrl(Url::getReference("resources/assets/images/png/team.png"));
    formDescriptionSetupDefaults($formDescription);
}
/**
 * Attendant login form header set up
 * @return void
 */
function runAttendantLoginFormHeaderSetUp()
{
    $formHeader = new FormHeader;
    $formHeader->setHeading("Account Information");
    $formHeader->setHelpText("Required fields are marked by *");
    formHeaderSetupDefaults($formHeader);
}

/**
 * Attendant login form setup
 * @return void
 */
function runAttendantLoginFormSetup()
{
    $form = new Form;
    $form->setFields([
        "username",
        "password",
        "show-password",
        "form-identifier",
        "submit"
    ]);

    $form->setRows(1);
    $form->setCols([
        "username" => "col-md-12 my-2",
        "password" => "col-md-12 my-2",
        "show-password" => "col-md-12 my-2",
        "form-identifier" => "col-md-12",
        "submit" => "col-md-12 my-2"
    ]);
    $form->setContent([
        "username" => array(
            "label" => [
                "for" => "username",
                "value" => "<h6><strong>Username: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "text",
                "name" => "username",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "password" => array(
            "label" => [
                "for" => "password",
                "value" => "<h6><strong>Password: * </strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "password",
                "name" => "password",
                "class" => "form-control password-visibility-toggle",
                "value" => ""
            ]
        ),
        "show-password" => array(
            "input" => [
                "type" => "checkbox",
                "name" => "show-password",
                "class" => "form-check-input password-switch",
                "value" => ""
            ],
            "label" => [
                "for" => "show password",
                "value" => "<h6>Show Password</h6>",
                "class" => "form-check-label mx-2"
            ],
        ),
        "form-identifier" => array(
            "input" => [
                "type" => "hidden",
                "name" => "form-identifier",
                "class" => "",
                "value" => Hashing::encrypt("ATTENDANT_LOGIN_FORM")
            ]
        ),
        "submit" => array(
            "button" => [
                "color" => "dark",
                "type" => "submit",
                "has-spinner" => true,
                "value" => "Go to my account &raquo;"
            ]
        )
    ]);
    $form->runSetup([
        "method" => "POST",
        "action" => "",
        "id" => "attendant-login-form",
        "class" => ""
    ]);
}




/*
```````````````````````````````````````````````````````````````
CLIENTS FORM SETUP
`````````````````````````````````````````````````````````````````
*/
/*
``````````````````````````````````````````````````````````````````
CLIENT REGISTRATION FORMS
``````````````````````````````````````````````````````````````````
*/
/**
 * Client registration form description setup
 * @return void
 */
function runClientRegistrationFormDescriptionSetup()
{
    $formDescription = new FormDescription;
    $formDescription->setHeading("Client registration form");
    $formDescription->setDescription("Please ensure that you fill all the required
        fields to
        create an account");
    $formDescription->setDescriptionImageUrl(Url::getReference("resources/assets/images/png/beauty-treatment.png"));
    formDescriptionSetupDefaults($formDescription);
}
/**
 * Client description form header setup
 * @return void
 */
function runClientRegistrationFormHeaderSetup()
{
    $formHeader = new FormHeader;
    $formHeader->setHeading("Step 1: Personal Information");
    $formHeader->setHelpText("Required fields are marked by *");
    formHeaderSetupDefaults($formHeader);
}

/**
 * Client registration form set up step 1
 * @return void
 */
function runClientRegistrationFormSetupStep1()
{
    $form = new Form;
    $form->setFields([
        "firstname",
        "lastname",
        "gender",
        "date-of-birth",
        "age",
        "nationality",
        "national-id",
        "phone-number",
        "email",
        "form-identifier",
        "submit",
        "additional-buttons"
    ]);
    $form->setRows(1);
    $form->setCols([
        "firstname" => "col-12 col-md-6 my-2",
        "lastname" => "col-12 col-md-6 my-2",
        "gender" => "col-12 col-md-6 my-2",
        "date-of-birth" => "col-12 col-md-6 my-2",
        "age" => "col-12 col-md-6 my-2",
        "nationality" => "col-12 col-md-6 my-2",
        "national-id" => "col-12 col-md-6 my-2",
        "phone-number" => "col-12 col-md-6 my-2",
        "email" => "col-12 col-md-12 my-2",
        "form-identifier" => "col-12",
        "submit" => "col-12 col-md-12",
        "additional-buttons" => "col-12 col-md-12"
    ]);
    $form->setContent([
        "firstname" => array(
            "label" => [
                "for" => "firstname",
                "value" => "<h6><strong>Firstname: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "text",
                "name" => "firstname",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "lastname" => array(
            "label" => [
                "for" => "lastname",
                "value" => "<h6><strong>Lastname: * </strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "text",
                "name" => "lastname",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "gender" => array(
            "label" => [
                "for" => "gender",
                "value" => "<h6><strong>Gender: *</strong></h6>",
                "class" => "my-2"
            ],
            "select" => [
                "name" => "gender",
                "options" => ["Male", "Female"],
                "class" => "form-select"
            ]
        ),
        "date-of-birth" => array(
            "label" => [
                "for" => "date-of-birth",
                "value" => "<h6><strong>Date of birth* </strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "date",
                "name" => "date-of-birth",
                "class" => "form-control",
                "value" => "",
            ]
        ),
        "age" => array(
            "label" => [
                "for" => "age",
                "value" => "<h6><strong>Age: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "number",
                "name" => "age",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "nationality" => array(
            "label" => [
                "for" => "nationality",
                "value" => "<h6><strong>Nationality: *</strong></h6>",
                "class" => "my-2"
            ],
            "select" => [
                "name" => "nationality",
                "options" => ["Kenyan"],
                "class" => "form-select"
            ]
        ),
        "national-id" => array(
            "label" => [
                "for" => "national-id",
                "value" => "<h6><strong>National id: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "number",
                "name" => "national-id",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "phone-number" => array(
            "label" => [
                "for" => "phone-number",
                "value" => "<h6><strong>Phone Number: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "number",
                "name" => "phone-number",
                "class" => "form-control",
                "value" => "",
                "has-group" => true,
                "group-details" => array("prefix" => "+254")
            ]
        ),
        "email" => array(
            "label" => [
                "for" => "email",
                "value" => "<h6><strong>Email: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "email",
                "name" => "email",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "form-identifier" => array(
            "input" => [
                "type" => "hidden",
                "name" => "form-identifier",
                "class" => "",
                "value" => Hashing::encrypt("CLIENT_REGISTRATION_FORM_STEP_1")
            ]
        ),
        "submit" => array(
            "button" => [
                "color" => "dark",
                "type" => "submit",
                "has-spinner" => true,
                "value" => "Go to step 2"
            ]
        ),
        "additional-buttons" => array(
            "additional-buttons" => [
                "color" => "secondary",
                "purpose" => "action-btn",
                "size" => "w-100 mt-3",
                "link" => "student-login",
                "innerHtml" => "I already have an account"
            ]
        ),

    ]);
    $form->runSetup([
        "method" => "POST",
        "action" => "",
        "id" => "client-registration-form-step-1",
        "class" => ""
    ]);
}

/**
 * Client registration form setup step 2
 * @return void
 */
function runClientRegistrationFormSetupStep2()
{
    $form = new Form;
    $form->setFields([
        "username",
        "password",
        "confirm-password",
        "show-password",
        "form-identifier",
        "submit"
    ]);
    $form->setRows(1);
    $form->setCols([
        "username" => "col-12 my-2",
        "password" => "col-12 my-2",
        "confirm-password" => "col-12 my-2",
        "show-password" => "col-12 my-2",
        "form-identifier" => "col-12",
        "submit" => "col-12 col-md-12 my-2"
    ]);
    $form->setContent([
        "username" => array(
            "label" => [
                "for" => "username",
                "value" => "<h6><strong>Username: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "text",
                "name" => "username",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "password" => array(
            "label" => [
                "for" => "password",
                "value" => "<h6><strong>Password: * </strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "password",
                "name" => "password",
                "class" => "form-control password-visibility-toggle",
                "value" => ""
            ]
        ),
        "confirm-password" => array(
            "label" => [
                "for" => "password",
                "value" => "<h6><strong>Confirm Password: * </strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "password",
                "name" => "confirm-password",
                "class" => "form-control password-visibility-toggle",
                "value" => ""
            ]
        ),

        "show-password" => array(
            "input" => [
                "type" => "checkbox",
                "name" => "show-password",
                "class" => "form-check-input password-switch",
                "value" => ""
            ],
            "label" => [
                "for" => "show password",
                "value" => "<h6>Show Password</h6>",
                "class" => "form-check-label mx-2"
            ],
        ),
        "form-identifier" => array(
            "input" => [
                "type" => "hidden",
                "name" => "form-identifier",
                "class" => "",
                "value" => Hashing::encrypt("CLIENT_REGISTRATION_FORM_STEP_2")
            ]
        ),
        "submit" => array(
            "button" => [
                "color" => "dark",
                "type" => "submit",
                "has-spinner" => true,
                "value" => "Complete Registration &raquo;"
            ]
        )
    ]);
    $form->runSetup([
        "method" => "POST",
        "action" => "",
        "id" => "client-registration-form-step-2",
        "class" => "d-none"
    ]);
}
/*
``````````````````````````````````````````````````````````````````
CLIENT LOGIN FORMS
``````````````````````````````````````````````````````````````````
*/
/**
 * Client login form description setup
 * @return void
 */
function runClientLoginFormDescriptionSetup()
{
    $formDescription = new FormDescription;
    $formDescription->setHeading("Client login form");
    $formDescription->setDescription("Please ensure that you enter the correct username and password for you to access your account");
    $formDescription->setDescriptionImageUrl(Url::getReference("resources/assets/images/png/beauty-treatment.png"));
    formDescriptionSetupDefaults($formDescription);
}

/**
 * Client login form header setup
 * @return void
 */
function runClientLoginFormHeaderSetup()
{
    $formHeader = new FormHeader;
    $formHeader->setHeading("Account Information");
    $formHeader->setHelpText("Required fields are marked by *");
    formHeaderSetupDefaults($formHeader);
}

/**
 * Client login form setup
 * @return void
 */
function runClientLoginFormSetup()
{
    $form = new Form;
    $form->setFields([
        "username",
        "password",
        "show-password",
        "form-identifier",
        "submit"
    ]);

    $form->setRows(1);
    $form->setCols([
        "username" => "col-md-12 my-2",
        "password" => "col-md-12 my-2",
        "show-password" => "col-md-12 my-2",
        "form-identifier" => "col-md-12",
        "submit" => "col-md-12 my-2"
    ]);
    $form->setContent([
        "username" => array(
            "label" => [
                "for" => "username",
                "value" => "<h6><strong>Username: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "text",
                "name" => "username",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "password" => array(
            "label" => [
                "for" => "password",
                "value" => "<h6><strong>Password: * </strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "password",
                "name" => "password",
                "class" => "form-control password-visibility-toggle",
                "value" => ""
            ]
        ),
        "show-password" => array(
            "input" => [
                "type" => "checkbox",
                "name" => "show-password",
                "class" => "form-check-input password-switch",
                "value" => ""
            ],
            "label" => [
                "for" => "show password",
                "value" => "<h6>Show Password</h6>",
                "class" => "form-check-label mx-2"
            ],
        ),
        "form-identifier" => array(
            "input" => [
                "type" => "hidden",
                "name" => "form-identifier",
                "class" => "",
                "value" => Hashing::encrypt("CLIENT_LOGIN_FORM")
            ]
        ),
        "submit" => array(
            "button" => [
                "color" => "dark",
                "type" => "submit",
                "has-spinner" => true,
                "value" => "Go to my account &raquo;"
            ]
        )
    ]);
    $form->runSetup([
        "method" => "POST",
        "action" => "",
        "id" => "client-login-form",
        "class" => ""
    ]);
}


/*
````````````````````````````````````````````````````````````````````
CLIENT BOOKING FORM
```````````````````````````````````````````````````````````````````
*/

/**
 * Client booking form description setup
 * @return void
 */
function runClientBookingFormDescriptionSetup()
{
    $formDescription = new FormDescription;
    $formDescription->setHeading("Client booking");
    $formDescription->setDescription("Please choose your preffered day of service");
    $formDescription->setDescriptionImageUrl(Url::getReference("resources/assets/images/png/phone.png"));
    formDescriptionSetupDefaults($formDescription);
}


/**
 * Client booking form header setup
 * @return void
 */
function runClientBookingFormHeaderSetup()
{

    $formHeader = new FormHeader;
    $formHeader->setHeading("Booking Information");
    $formHeader->setHelpText("Required fields are marked by *");
    formHeaderSetupDefaults($formHeader);
}


function runClientBookingFormSetup()
{
    $form = new Form;
    $form->setRows(1);
    $form->setFields([
        "expected-checkin-date",
        "expected-checkin-time",
        "form-identifier",
        "submit"
    ]);
    $form->setCols([
        "expected-checkin-date" => "col-12 my-2",
        "expected-checkin-time" => "col-12 my-2",
        "form-identifier" => "col-12 my-2",
        "submit" => "col-12 my-2"
    ]);

    $form->setContent([
        "expected-checkin-date" => [
            "label" => [
                "for" => "checkin-date",
                "class" => "my-3",
                "value" => "<h6><strong>Expected date of check in: *</strong></h6>"
            ],
            "input" => [
                "type" => "date",
                "name" => "expected-checkin-date",
                "class" => "form-control"
            ]
        ],
        "expected-checkin-time" => [
            "label" => [
                "for" => "checkin-time",
                "class" => "my-3",
                "value" => "<h6><strong>Expected time of check in: *</strong> (24 hour format)</h6>"
            ],
            "input" => [
                "type" => "time",
                "name" => "expected-checkin-time",
                "class" => "form-control"
            ]
        ],
        "form-identifier" => [
            "input" => [
                "type" => "hidden",
                "name" => "form-identifier",
                "value" => Hashing::encrypt("CLIENT_BOOKING_FORM")
            ]
        ],
        "submit" => [
            "button" => [
                "type" => "submit",
                "color" => "dark",
                "has-spinner" => true,
                "value" => "Book now"
            ]
        ]
    ]);
    $form->runSetup([
        "method" => "POST",
        "action" => "",
        "id" => "client-booking-form",
        "class" => ""
    ]);
}



/*
``````````````````````````````````````````````````````````````````
CLIENT PAYMENT FORM SETUP
``````````````````````````````````````````````````````````````````
*/
/**
 * Client payment form description setup
 * @return void
 */
function runClientPaymentFormDescriptionSetup()
{
    $formDescription = new FormDescription;
    $formDescription->setHeading("Client payment");
    $formDescription->setDescription("Please ensure that you fill the required fields to process your payment");
    $formDescription->setDescriptionImageUrl(Url::getReference("resources/assets/images/png/beauty-treatment.png"));
    formDescriptionSetupDefaults($formDescription);
}


/**
 * Client payment form header setup
 * @return void
 */
function runClientPaymentFormHeaderSetup()
{

    $formHeader = new FormHeader;
    $formHeader->setHeading("Payment Information");
    $formHeader->setHelpText("Required fields are marked by *");
    formHeaderSetupDefaults($formHeader);
}

/**
 * client payment form setup
 * @return void
 */
function runClientPaymentFormSetup()
{
    $form = new Form;
    $form->setFields([
        "amount",
        "mode",
        "transaction-code",
        "form-identifier",
        "submit"
    ]);

    $form->setRows(1);
    $form->setCols([
        "amount" => "col-md-12 my-2",
        "mode" => "col-md-12 my-2",
        "transaction-code" => "col-md-12 my-2",
        "form-identifier" => "col-md-12",
        "submit" => "col-md-12 my-2"
    ]);
    $form->setContent([
        "amount" => array(
            "label" => [
                "for" => "payment-amount",
                "value" => "<h6><strong>Payment amount: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "number",
                "name" => "amount",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "mode" => array(
            "label" => [
                "for" => "payment-mode",
                "value" => "<h6><strong>Payment mode: * </strong></h6>",
                "class" => "my-2"
            ],
            "select" => [
                "name" => "mode",
                "options" => ["Mpesa"],
                "class" => "form-select"
            ]
        ),
        "transaction-code" => array(
            "label" => [
                "for" => "transaction-code",
                "value" => "<h6><strong>Transaction code: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "text",
                "name" => "transaction-code",
                "class" => "form-control",
                "value" => ""
            ],
        ),
        "form-identifier" => array(
            "input" => [
                "type" => "hidden",
                "name" => "form-identifier",
                "class" => "",
                "value" => Hashing::encrypt("CLIENT_PAYMENT_FORM")
            ]
        ),
        "submit" => array(
            "button" => [
                "color" => "dark",
                "type" => "submit",
                "has-spinner" => true,
                "value" => "Complete payment"
            ]
        )
    ]);
    $form->runSetup([
        "method" => "POST",
        "action" => "",
        "id" => "client-payment-form",
        "class" => ""
    ]);

}




/*
```````````````````````````````````````````````````````````````
ADMINISTRATORS FORM SETUP
`````````````````````````````````````````````````````````````````
*/
/*
``````````````````````````````````````````````````````````````````
ADMIN REGISTRATION FORMS
``````````````````````````````````````````````````````````````````
*/
/**
 * Admin registration form description setup
 * @return void
 */
function runAdminRegistrationFormDescriptionSetup()
{
    $formDescription = new FormDescription;
    $formDescription->setHeading("Admin registration form");
    $formDescription->setDescription("Please ensure that you fill all the required
        fields to
        sign up a new administrator");
    $formDescription->setDescriptionImageUrl(Url::getReference("resources/assets/images/png/meeting.png"));
    formDescriptionSetupDefaults($formDescription);
}
/**
 * Admin description form header setup
 * @return void
 */
function runAdminRegistrationFormHeaderSetup()
{
    $formHeader = new FormHeader;
    $formHeader->setHeading("Step 1: Personal Information");
    $formHeader->setHelpText("Required fields are marked by *");
    formHeaderSetupDefaults($formHeader);
}

/**
 * Admin registration form set up step 1
 * @return void
 */
function runAdminRegistrationFormSetupStep1()
{
    $form = new Form;
    $form->setFields([
        "firstname",
        "lastname",
        "gender",
        "date-of-birth",
        "age",
        "nationality",
        "national-id",
        "phone-number",
        "email",
        "form-identifier",
        "submit",
    ]);
    $form->setRows(1);
    $form->setCols([
        "firstname" => "col-12 col-md-6 my-2",
        "lastname" => "col-12 col-md-6 my-2",
        "gender" => "col-12 col-md-6 my-2",
        "date-of-birth" => "col-12 col-md-6 my-2",
        "age" => "col-12 col-md-6 my-2",
        "nationality" => "col-12 col-md-6 my-2",
        "national-id" => "col-12 col-md-6 my-2",
        "phone-number" => "col-12 col-md-6 my-2",
        "email" => "col-12 col-md-12 my-2",
        "form-identifier" => "col-12",
        "submit" => "col-12 col-md-12",
    ]);
    $form->setContent([
        "firstname" => array(
            "label" => [
                "for" => "firstname",
                "value" => "<h6><strong>Firstname: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "text",
                "name" => "firstname",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "lastname" => array(
            "label" => [
                "for" => "lastname",
                "value" => "<h6><strong>Lastname: * </strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "text",
                "name" => "lastname",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "gender" => array(
            "label" => [
                "for" => "gender",
                "value" => "<h6><strong>Gender: *</strong></h6>",
                "class" => "my-2"
            ],
            "select" => [
                "name" => "gender",
                "options" => ["Male", "Female"],
                "class" => "form-select"
            ]
        ),
        "date-of-birth" => array(
            "label" => [
                "for" => "date-of-birth",
                "value" => "<h6><strong>Date of birth* </strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "date",
                "name" => "date-of-birth",
                "class" => "form-control",
                "value" => "",
            ]
        ),
        "age" => array(
            "label" => [
                "for" => "age",
                "value" => "<h6><strong>Age: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "number",
                "name" => "age",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "nationality" => array(
            "label" => [
                "for" => "nationality",
                "value" => "<h6><strong>Nationality: *</strong></h6>",
                "class" => "my-2"
            ],
            "select" => [
                "name" => "nationality",
                "options" => ["Kenyan"],
                "class" => "form-select"
            ]
        ),
        "national-id" => array(
            "label" => [
                "for" => "national-id",
                "value" => "<h6><strong>National id: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "number",
                "name" => "national-id",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "phone-number" => array(
            "label" => [
                "for" => "phone-number",
                "value" => "<h6><strong>Phone Number: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "number",
                "name" => "phone-number",
                "class" => "form-control",
                "value" => "",
                "has-group" => true,
                "group-details" => array("prefix" => "+254")
            ]
        ),
        "email" => array(
            "label" => [
                "for" => "email",
                "value" => "<h6><strong>Email: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "email",
                "name" => "email",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "form-identifier" => array(
            "input" => [
                "type" => "hidden",
                "name" => "form-identifier",
                "class" => "",
                "value" => Hashing::encrypt("ADMIN_REGISTRATION_FORM_STEP_1")
            ]
        ),
        "submit" => array(
            "button" => [
                "color" => "dark",
                "type" => "submit",
                "has-spinner" => true,
                "value" => "Go to step 2"
            ]
        ),
    ]);
    $form->runSetup([
        "method" => "POST",
        "action" => "",
        "id" => "admin-registration-form-step-1",
        "class" => ""
    ]);
}

/**
 * Admin registration form setup step 2
 * @return void
 */
function runAdminRegistrationFormSetupStep2()
{
    $form = new Form;
    $form->setFields([
        "username",
        "password",
        "confirm-password",
        "show-password",
        "form-identifier",
        "submit"
    ]);
    $form->setRows(1);
    $form->setCols([
        "username" => "col-12 my-2",
        "password" => "col-12 my-2",
        "confirm-password" => "col-12 my-2",
        "show-password" => "col-12 my-2",
        "form-identifier" => "col-12",
        "submit" => "col-12 col-md-12 my-2"
    ]);
    $form->setContent([
        "username" => array(
            "label" => [
                "for" => "username",
                "value" => "<h6><strong>Username: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "text",
                "name" => "username",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "password" => array(
            "label" => [
                "for" => "password",
                "value" => "<h6><strong>Password: * </strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "password",
                "name" => "password",
                "class" => "form-control password-visibility-toggle",
                "value" => ""
            ]
        ),
        "confirm-password" => array(
            "label" => [
                "for" => "password",
                "value" => "<h6><strong>Confirm Password: * </strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "password",
                "name" => "confirm-password",
                "class" => "form-control password-visibility-toggle",
                "value" => ""
            ]
        ),

        "show-password" => array(
            "input" => [
                "type" => "checkbox",
                "name" => "show-password",
                "class" => "form-check-input password-switch",
                "value" => ""
            ],
            "label" => [
                "for" => "show password",
                "value" => "<h6>Show Password</h6>",
                "class" => "form-check-label mx-2"
            ],
        ),
        "form-identifier" => array(
            "input" => [
                "type" => "hidden",
                "name" => "form-identifier",
                "class" => "",
                "value" => Hashing::encrypt("ADMIN_REGISTRATION_FORM_STEP_2")
            ]
        ),
        "submit" => array(
            "button" => [
                "color" => "dark",
                "type" => "submit",
                "has-spinner" => true,
                "value" => "Complete Registration &raquo;"
            ]
        )
    ]);
    $form->runSetup([
        "method" => "POST",
        "action" => "",
        "id" => "admin-registration-form-step-2",
        "class" => "d-none"
    ]);
}
/*
``````````````````````````````````````````````````````````````````
ADMIN LOGIN FORMS
``````````````````````````````````````````````````````````````````
*/
/**
 * Admin login form description setup
 * @return void
 */
function runAdminLoginFormDescriptionSetup()
{
    $formDescription = new FormDescription;
    $formDescription->setHeading("Admin login form");
    $formDescription->setDescription("Please ensure that you enter the correct username and password for you to access your account");
    $formDescription->setDescriptionImageUrl(Url::getReference("resources/assets/images/png/meeting.png"));
    formDescriptionSetupDefaults($formDescription);
}

/**
 * Admin login form header setup
 * @return void
 */
function runAdminLoginFormHeaderSetup()
{
    $formHeader = new FormHeader;
    $formHeader->setHeading("Account Information");
    $formHeader->setHelpText("Required fields are marked by *");
    formHeaderSetupDefaults($formHeader);
}

/**
 * Admin login form setup
 * @return void
 */
function runAdminLoginFormSetup()
{
    $form = new Form;
    $form->setFields([
        "username",
        "password",
        "show-password",
        "form-identifier",
        "submit"
    ]);

    $form->setRows(1);
    $form->setCols([
        "username" => "col-md-12 my-2",
        "password" => "col-md-12 my-2",
        "show-password" => "col-md-12 my-2",
        "form-identifier" => "col-md-12",
        "submit" => "col-md-12 my-2"
    ]);
    $form->setContent([
        "username" => array(
            "label" => [
                "for" => "username",
                "value" => "<h6><strong>Username: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "text",
                "name" => "username",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "password" => array(
            "label" => [
                "for" => "password",
                "value" => "<h6><strong>Password: * </strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "password",
                "name" => "password",
                "class" => "form-control password-visibility-toggle",
                "value" => ""
            ]
        ),
        "show-password" => array(
            "input" => [
                "type" => "checkbox",
                "name" => "show-password",
                "class" => "form-check-input password-switch",
                "value" => ""
            ],
            "label" => [
                "for" => "show password",
                "value" => "<h6>Show Password</h6>",
                "class" => "form-check-label mx-2"
            ],
        ),
        "form-identifier" => array(
            "input" => [
                "type" => "hidden",
                "name" => "form-identifier",
                "class" => "",
                "value" => Hashing::encrypt("ADMIN_LOGIN_FORM")
            ]
        ),
        "submit" => array(
            "button" => [
                "color" => "dark",
                "type" => "submit",
                "has-spinner" => true,
                "value" => "Go to my account"
            ]
        )
    ]);
    $form->runSetup([
        "method" => "POST",
        "action" => "",
        "id" => "admin-login-form",
        "class" => ""
    ]);
}

/*
```````````````````````````````````````````````````````````````
ADMIN ADD SERVICE
```````````````````````````````````````````````````````````````
*/

/**
 * Service category form description setup 
 * @return void
 */
function runAdminServiceRegistrationFormDescriptionSetup()
{
    $formDescription = new FormDescription;
    $formDescription->setHeading("Service registration form");
    $formDescription->setDescription("Please ensure that you fill the required fields to register a new service");
    $formDescription->setDescriptionImageUrl(Url::getReference("resources/assets/images/png/plant.png"));
    formDescriptionSetupDefaults($formDescription);
}

/**
 * Admin run service registration form header setup
 * @return void
 */
function runAdminServiceRegistrationFormHeaderSetup()
{
    $formHeader = new FormHeader;
    $formHeader->setHeading("Service Information");
    $formHeader->setHelpText("Required fields are marked by *");
    formHeaderSetupDefaults($formHeader);
}

/**
 * Admin Service registration form step 1 setup
 * @return void
 */
function runAdminServiceRegistrationFormSetupStep1()
{
    $form = new Form;

    $attendants = readAdmin()->getAttendants();

    $attendantsArray = [];

    foreach ($attendants as $attendant) {
        array_push($attendantsArray, $attendant["at_firstname"] . " " . $attendant["at_lastname"] . ", " . str_replace("+254", "0", $attendant["at_phone_number"]));
    }


    $form->setFields([
        "service-name",
        "attendants",
        "service-price",
        "service-description",
        "form-identifier",
        "submit"
    ]);

    $form->setRows(1);
    $form->setCols([
        "service-name" => "col-md-12 my-2",
        "attendants" => "col-md-12 my-2",
        "service-price" => "col-md-12 my-2",
        "service-description" => "col-md-12 my-2",
        "form-identifier" => "col-md-12",
        "submit" => "col-md-12 my-2"
    ]);
    $form->setContent([
        "service-name" => array(
            "label" => [
                "for" => "service-name",
                "value" => "<h6><strong>Service name: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "text",
                "name" => "name",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "attendants" => array(
            "label" => [
                "for" => "attendants",
                "value" => "<h6><strong>Attendant: *</strong></h6>",
                "class" => "my-2"
            ],
            "select" => [
                "name" => "attendant",
                "options" => $attendantsArray,
                "class" => "form-select"
            ]
        ),
        "service-price" => array(
            "label" => [
                "for" => "service-price",
                "value" => "<h6><strong>Price: *</strong></h6>",
                "class" => "my-2"
            ],
            "input" => [
                "type" => "number",
                "name" => "price",
                "class" => "form-control",
                "value" => ""
            ]
        ),
        "service-description" => array(
            "label" => [
                "for" => "service-description",
                "value" => "<h6><strong>Service description: * </strong></h6>",
                "class" => "my-2"
            ],
            "textarea" => [
                "name" => "description",
                "class" => "form-control",
                "value" => "",
                "style" => "height:120px;",
            ]
        ),
        "form-identifier" => array(
            "input" => [
                "type" => "hidden",
                "name" => "form-identifier",
                "class" => "",
                "value" => Hashing::encrypt("SERVICE_REGISTRATION_FORM_STEP_1")
            ]
        ),
        "submit" => array(
            "button" => [
                "color" => "dark",
                "type" => "submit",
                "has-spinner" => true,
                "value" => "Go to step 2"
            ]
        )
    ]);
    $form->runSetup([
        "method" => "POST",
        "action" => "",
        "id" => "service-registration-form-step-1",
        "class" => ""
    ]);

}

/**
 * Admin service registration form step 2 setup
 * @return void
 */
function runAdminServiceRegistrationFormSetupStep2()
{
    $form = new Form;
    $form->setRows(1);
    $form->setFields([
        "service-picture",
        "form-identifier",
        "submit"
    ]);
    $form->setCols([
        "service-picture" => "col-md-12 col-12 my-2",
        "form-identifier" => "col-12 col-md-12",
        "submit" => "col-12 col-md-12"
    ]);
    $form->setContent([
        "service-picture" => [
            "label" => [
                "for" => "service-image",
                "value" => "
                <div class='my-2'>
                    <img src='" . Url::getReference("resources/assets/images/png/add.png") . "' class='img-fluid x-large pointer upload-icon'>
                </div>
                ",
                "class" => "my-2 d-flex justify-content-center",
            ],
            "input" => [
                "type" => "file",
                "name" => "pictures",
                "class" => "d-none",
                "id" => "service-image",
                "onchange" => "readFile(this)"
            ]
        ],
        "form-identifier" => [
            "input" => [
                "type" => "hidden",
                "name" => "form-identifier",
                "value" => Hashing::encrypt("SERVICE_REGISTRATION_FORM_STEP_2")
            ]
        ],
        "submit" => [
            "button" => [
                "color" => "dark btn-lg",
                "type" => "submit",
                "has-spinner" => true,
                "value" => "Complete setup"
            ]
        ]
    ]);
    $form->runSetup([
        "method" => "post",
        "action" => "",
        "enctype" => "multipart/form-data",
        "class" => "d-none",
        "id" => "service-registration-form-step-2"
    ]);
}