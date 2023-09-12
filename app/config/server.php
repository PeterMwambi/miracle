<?php

/**
 * Contains all server configuration settings
 */
define(
    "SERVER_CONFIGURATION_SETTINGS",
    [
        "request" => [
            "method" => isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "",
            "uri" => isset($_SERVER["REQUEST_URI"]) ? filter_var($_SERVER["REQUEST_URI"], FILTER_SANITIZE_URL) : "",
            "handler" => isset($_SERVER["SCRIPT_NAME"]) ? $_SERVER["SCRIPT_NAME"] : "",
            "query-string" => isset($_SERVER["QUERY_STRING"]) ? $_SERVER["QUERY_STRING"] : "",
            "time" => isset($_SERVER["REQUEST_TIME"]) ? date('l, d/M/Y g:i:sA', $_SERVER["REQUEST_TIME"]) : "",
            "remote-ip" => isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : "",
            "server-ip" => isset($_SERVER["SERVER_ADDR"]) ? $_SERVER["SERVER_ADDR"] : "",
            "scheme" => isset($_SERVER["REQUEST_SCHEME"]) ? $_SERVER["REQUEST_SCHEME"] : "",
            "server-port" => isset($_SERVER["SERVER_PORT"]) ? $_SERVER["SERVER_PORT"] : "",
            "client-port" => isset($_SERVER["REMOTE_PORT"]) ? $_SERVER["REMOTE_PORT"] : "",
            "host" => isset($_SERVER["HTTP_HOST"]) ? $_SERVER["HTTP_HOST"] : "",
            "cookie" => isset($_SERVER["HTTP_COOKIE"]) ? $_SERVER["HTTP_HOST"] : "",
            "connection-type" => isset($_SERVER["HTTP_CONNECTION"]) ? $_SERVER["HTTP_CONNECTION"] : "",
            "browser-type" => isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : "",
            "status" => isset($_SERVER["REDIRECT_STATUS"]) ? $_SERVER["REDIRECT_STATUS"] : "",
            "redirect-url" => isset($_SERVER["REDIRECT_URL"]) ? $_SERVER["REDIRECT_URL"] : "",
            "file-formats" => isset($_SERVER["HTTP_ACCEPT"]) ? $_SERVER["HTTP_ACCEPT"] : "",
            "sessionid" => session_id(),
            "name" => isset($_SERVER["SERVER_NAME"]) ? $_SERVER["SERVER_NAME"] : ""
        ]
    ]
);