<?php

use Vendor\Services\Security\Hashing;
use Vendor\Services\Database\Database as DB;
use Vendor\Services\File\File;

// Database::query("test")->create("users", [
//     "id int(11) NOT NULL AUTO_INCREMENT",
//     "user_id varchar(30) NOT NULL UNIQUE",
//     "firstname varchar(50) NOT NULL",
//     "lastname varchar(50) NOT NULL",
//     "gender varchar(50) NOT NULL",
//     "age int(30) NOT NULL",
//     "email varchar(100) NOT NULL UNIQUE",
//     "phone_number int(50) NOT NULL UNIQUE",
//     "password varchar(200) NOT NULL",
//     "CONSTRAINT pk_users PRIMARY KEY (id, user_id)"
// ]);

// Database::query("test")->create("activities", [
//     "id int(11) NOT NULL AUTO_INCREMENT",
//     "a_id varchar(30) NOT NULL UNIQUE",
//     "user_id varchar(30) NOT NULL",
//     "activity varchar(100) NOT NULL",
//     "date_assigned date NOT NULL DEFAULT CURRENT_TIMESTAMP",
//     "due_date varchar(50) NOT NULL",
//     "due_time varchar(30) NOT NULL",
//     "CONSTRAINT pk_activities PRIMARY KEY (id, a_id)"
// ]);

// Database::query("test")->run("ALTER TABLE activities ADD CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(user_id)", [], 2);


// $userId = strtoupper(uniqid());

// Database::query("test")->insert("users", [
//     "user_id" => $userId,
//     "firstname" => "Peter",
//     "lastname" => "Mwambi",
//     "gender" => "male",
//     "age" => "22",
//     "email" => "calebmwambi@gmail.com",
//     "phone_number" => "+254114958431",
//     "password" => password_hash("password", PASSWORD_ARGON2I)
// ]);


// Database::query("test")->insert("activities", [
//     "a_id" => strtoupper(uniqid()),
//     "user_id" => $userId,
//     "activity" => "Design home page",
//     "due_date" => "Friday, 4/7/2023",
//     "due_time" => "12:00pm",
// ]);


// Database::query("test")->update("users", ["password" => password_hash("password", PASSWORD_DEFAULT)], ["user_id" => "64C37E102B89C"]);

// echo "<pre>";
// print_r(Database::query("test")->select("users", ["*"], [], 1)->getResults());
// echo "</pre>";

// echo "<br/>";

// echo "<pre>";
// print_r(Database::query("test")->select("activities", ["*"], [], 1)->getResults());
// echo "</pre>";





// echo "<pre>";
// print_r(Database::query("team_bp")->run("SHOW TABLES", [], 1)->getResults());
// echo "</pre>";

//Table::runSetUp()->setColumns()->setRows();


// echo "<pre>";
// print_r(DB::query("team_bp")->run("SHOW DATABASES", [], 1)->getResults());
// echo "</pre>";



File::require("tests/randomlettergeneratortest.php");


DB::query("test")->create("users_account_info", [
    "id int(100) NOT NULL AUTO_INCREMENT",
    "user_id varchar(500) NOT NULL unique",
    "username varchar(500) NOT NULL unique",
    "password varchar(500) NOT NULL",
    "date_added DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP",
    "Constraint pk_user PRIMARY KEY(id,user_id)",
    "FOREIGN KEY(user_id) references users(user_id)"
]);



// DB::query("test")->run("DROP TABLE users_account_info", [], 2);


// DB::query("test")->delete("users_account_info", ["username", "=", "pmwambi"]);

$userid = strtoupper(uniqid());
$firstname = "Caleb";
$lastname = "Mwasagua";
$gender = "male";
$age = 23;
$phonenumber = +254114958431;
$email = "pmwambi@gmail.com";

// DB::query("test")->insert("users", [
//     "user_id" => $userid,
//     "firstname" => $firstname,
//     "lastname" => $lastname,
//     "gender" => $gender,
//     "age" => $age,
//     "phone_number" => $phonenumber,
//     "email" => $email
// ]);



//@todo: Refactor select statememts to accomodate flexible sub querying
//@todo: Craft next gen queries
// DB::query("test")->select("users", ["users_account_info.username",  ])
//                 ->innerJoin("users.user_id", "=", "users_account_info.user_id")
//                 ->where("users_account_info.username = ?")
//                 ->and("users.firstname = ?");



// echo '<pre>';
// print_r(DB::query("test")->run("SELECT users.user_id,
//                                 users.firstname, 
//                                 users.lastname, 
//                                 users_account_info.username, 
//                                 users_account_info.password,
//                                 users_account_info.date_added
//                                 FROM users
//                                 INNER JOIN users_account_info ON
//                                 users.user_id = users_account_info.user_id
//                                 WHERE users_account_info.username = ?", ["pmwambi"], 1)
//     ->getResults());
// echo '</pre>';


// DB::query("test")->insert("users_account_info", [
//     "user_id" => $userid,
//     "username" => "pmwambi",
//     "password" => password_hash("password", PASSWORD_DEFAULT),
// ]);


// DB::query("test")->delete("users_account_info", ["user_id", "=", "64E3B3F8D6147"]);
// DB::query("test")->delete("users", ["user_id", "=", "64E3B3F8D6147"]);


// echo '<pre>';
// print_r(DB::query("test")->select("users", ["*"], [], 1)->getResults());
// echo '</pre>';

// if (DB::query("test")->newDatabase("rmis_tenants")) {
//     echo "<pre>";
//     print_r(DB::query()->run("SHOW DATABASES", [], 1)->getResults());
//     echo "</pre>";
// }


/**
 * RMIS TENANT ACTIVITIES HAS NO TABLES
 */
// echo "<pre>";
// print_r(DB::query("rmis_tenant_activities")->run("SHOW TABLES", [], 1)->getResults());
// echo "</pre>";

// Configuration via OTP authentication
// Support for property management companies

/**
 * Create Database: rmis_actors
 * - Contains entries for less volatile data
 * - Tables
 *      1. tenant personal info: tn_personal_info
 *      2. tenant account info: tn_account_info
 *      3. property owner account info: pro_account_info
 *      4. property owner personal info: pro_personal_info
 *      5. property info: pr_info
 *      6. property address info: pr_address_info
 *      7. package info: pkg_info
 * - Columns
 *      1. tn_personal_info
 *              - id: id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
 *              - tenant id: tn_id varchar(500) NOT NULL UNIQUE PRIMARY KEY
 *              - firstname: tn_firstname varchar(500) NOT NULL
 *              - lastname: tn_lastname varchar(500) NOT NULL
 *              - gender: tn_gender varchar(500) NOT NULL
 *              - age: tn_age varchar(500) NOT NULL
 *              - nationality: tn_nationality varchar(500) NOT NULL
 *              - national Id number: tn_national_id varchar(500) NOT NULL UNIQUE
 *              - phone number: tn_phone_number varchar(500) NOT NULL UNIQUE
 *              - email address: tn_email varchar(500) NOT NULL UNIQUE
 *      2. tn_account_info
 *              - id: id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
 *              - tenant id: tn_id varchar(500) NOT NULL UNIQUE PRIMARY KEY 
 *              - username: tn_username varchar(500) NOT NULL UNIQUE
 *              - password: tn_password varchar(500) NOT NULL
 *              - date created: tn_date_added CURRENT_TIMESTAMP
 *              - last logged in: tn_last_logged_in
 *              - security question 1: tn_security_question_1
 *              - security question 2: tn_security_question_2
 *              - security question 3: tn_security_question_3
 *              - otp code: tn_otp_code
 *       3. pro_personal_info
 *              - property owner id: pro_id
 *              - firstname: pro_firstname
 *              - lastname: pro_lastname
 *              - gender: pro_gender
 *              - age: pro_age
 *              - nationality: pro_nationality
 *              - national Id number: pro_national_id
 *              - phone number: pro_phone_number
 *              - email address: pro_email
 *       4. pro_account_info
 *              - property owner id: pro_id
 *              - username: pro_username
 *              - password: pro_password
 *              - date created: pro_date_added
 *              - last logged in: pro_last_logged_in
 *              - security question 1: pro_security_question_1
 *              - security question 2: pro_security_question_2
 *              - security question 3: pro_security_question_3
 *              - otp code: pro_otp_code
 *        5. pr_address_info
 *              - property id: pr_id
 *              - county: pr_county
 *              - sub county: pr_sub_county
 *              - nearest town: pr_nearest_town
 *              - location: pr_location
 *              - street: pr_street
 *         6. pr_info
 *              - property id: pr_id
 *              - property owner: pro_id
 *              - name: pr_name
 *              - total no of rooms: pr_total_no_of_rooms
 *              - total no of floors: pr_total_no_of_floors
 *              - total no of occupied rooms: pr_total_no_of_occupied_rooms
 *              - total no of vaccant rooms: pr_total_no_of_vaccant_rooms
 *              - payment account no: pr_account_no
 *              - payment account type: pr_account_type
 *              - date added: pr_date_added
 *          7. pkg_info
 *              - package name: pkg_name
 *              - package amount payable: pkg_amount_payable
 *              - package date added: pkg_date_added
 *              - package added by: pkg_added_by
 */




/**
 * Create Database: rmis_tenant_messages
 * - Table 
 *      1. tenants Id: tn_id
 * - Columns will be
 *      - message id: tn_message_id                 (TNMSG456GR7FDPZ)
 *      - message body: tn_message_body             (I will pay rent by 3 october)
 *      - sender id: tn_message_sender_id           (TNZ47U3R68BZ)
 *      - recipient id: tn_message_recipient_id     (PRO4RTS946VS) 
 *      - date sent: tn_message_date_sent           (current timestamp)
 *      - message indication: tn_message_indication (sent)
 *      - status: tn_message_delivery_status        (replied)
 *      - reply status: tn_message_status           (read, unread)
 *      - date replied: tn_message_date_replied     (date:27/9/2023, day: Wednesday, time:10:42pm)
 *      - reply id: tn_message_reply_id             (TNRPD475A3623F)
 *      - reply body: tn_message_reply_body         (Okay I will be waiting)
 *      - replied by: tn_message_reply_sender_id    (PRO4RTS946VS)
 */

/**
 * Create Database rmis_property_owner_messages
 *      1. property_owner id: pro_id
 * - Columns will be
 *      - message id: pro_message_id                 (PROMSG456GR7FDPZ)
 *      - message body: pro_message_body             (I will pay rent by 3 october)
 *      - sender id: pro_message_sender_id           (PROZ47U3R68BZ)
 *      - recipient id: pro_message_recipient_id     (PRO4RTS946VS) 
 *      - date sent: pro_message_date_sent           (current timestamp)
 *      - message indication: pro_message_indication (received)
 *      - status: pro_message_delivery_status        (replied)
 *      - reply status: pro_message_status           (read, unread)
 *      - date replied: pro_message_date_replied     (date:27/9/2023, day: Wednesday, time:10:42pm)
 *      - reply id: pro_message_reply_id             (PRORPD475A3623F)
 *      - reply body: pro_message_reply_body         (Okay I will be waiting)
 *      - replied by: pro_message_reply_sender_id    (PRO4RTS946VS)
 */




DB::query("test")->create("tn_personal_info", [
    "id int(11) NOT NULL AUTO_INCREMENT",
    "tn_id varchar(500) NOT NULL UNIQUE",
    "tn_firstname varchar(500) NOT NULL",
    "tn_lastname varchar(500) NOT NULL",
    "tn_gender varchar(500) NOT NULL",
    "tn_age int(100) NOT NULL",
    "tn_nationality varchar(500) NOT NULL",
    "tn_national_id varchar(500) NOT NULL UNIQUE",
    "tn_phone_number varchar(500) NOT NULL UNIQUE",
    "tn_email varchar(500) NOT NULL UNIQUE",
    "PRIMARY KEY(id,tn_id)"
]);



DB::query("test")->create("tn_account_info", [
    "id int(11) NOT NULL AUTO_INCREMENT",
    "tn_id varchar(500) NOT NULL UNIQUE",
    "tn_username varchar(500) NOT NULL UNIQUE",
    "tn_password varchar(500) NOT NULL UNIQUE",
    "tn_date_added datetime NOT NULL DEFAULT CURRENT_TIMESTAMP",
    "tn_last_logged_in varchar(500) NOT NULL",
    "PRIMARY KEY(id,tn_id)"
]);


$tnid = generateString("TN");

// DB::query("test")->insert("tn_personal_info", [
//     "tn_id" => $tnid,
//     "tn_firstname" => Hashing::encrypt("Peter"),
//     "tn_lastname" => Hashing::encrypt("Mwambi"),
//     "tn_gender" => Hashing::encrypt("Male"),
//     "tn_age" => 22,
//     "tn_nationality" => Hashing::encrypt("Kenyan"),
//     "tn_national_id" => Hashing::encrypt("37999565"),
//     "tn_phone_number" => Hashing::encrypt("0700521998"),
//     "tn_email" => Hashing::encrypt("calebmwambi@gmail.com")
// ]);

// DB::query("test")->insert("tn_account_info", [
//     "tn_id" => $tnid,
//     "tn_username" => "pmwambi",
//     "tn_password" => Hashing::encrypt(password_hash("mwGGHJKl673V", PASSWORD_DEFAULT)),
//     "tn_last_logged_in" => Hashing::encrypt(date("l, d/m/Y g:iA"))
// ]);

// DB::query("test")->delete("tn_personal_info");
// DB::query("test")->delete("tn_account_info");



// echo "<pre>";

// print_r(DB::query("test")->run("SELECT 
//                                 tn_personal_info.tn_id,
//                                 tn_firstname,
//                                 tn_lastname,
//                                 tn_gender,
//                                 tn_age,
//                                 tn_nationality,
//                                 tn_national_id,
//                                 tn_phone_number,
//                                 tn_email,
//                                 tn_username,
//                                 tn_password,
//                                 tn_date_added,
//                                 tn_last_logged_in
//                         FROM tn_personal_info
//                         INNER JOIN tn_account_info
//                         ON
//                         tn_personal_info.tn_id = tn_account_info.tn_id",
//     [],
//     1
// )->getResults());

// echo "</pre>";

$tnid = generateString("TN");


$userData = [
    "tn_id" => $tnid,
    "tn_firstname" => Hashing::encrypt("Peter"),
    "tn_lastname" => Hashing::encrypt("Mwambi"),
    "tn_gender" => Hashing::encrypt("Male"),
    "tn_age" => Hashing::encrypt(22),
    "tn_nationality" => Hashing::encrypt("Kenyan"),
    "tn_national_id" => Hashing::encrypt("37999565"),
    "tn_phone_number" => Hashing::encrypt("0700521998"),
    "tn_email" => Hashing::encrypt("calebmwambi@gmail.com")
];


extract($userData);

// echo Hashing::decrypt($tn_firstname);
// echo Hashing::decrypt($tn_lastname);
// echo Hashing::decrypt($tn_gender);
// echo Hashing::decrypt($tn_age);

$tn_email = Hashing::decrypt($tn_email);
$tn_phone_number = Hashing::decrypt($tn_phone_number);

$keys = ["tn_email", "tn_phone_number", "tn_national_id"];


$tenantUniqueData = DB::query("test")->select("tn_personal_info", $keys, [], 1)->getResults();


extract($keys);