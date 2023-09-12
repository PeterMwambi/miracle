<?php


use Vendor\Services\Database\Database as DB;

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
// DB::query("test")->select("users", ["users_account_info.username",  ])
//                 ->withJoin("users.user_id", "=", "users_account_info.user_id")
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