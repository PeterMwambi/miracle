<?php



define("ARRAY_CONSTANT", [
    "name" => "username",
    "address" => [
        "main" => "15251",
        "secondary" => "4576273"
    ],
    "users" => [
        "username" => [
            "nickname" => "anonymous001",
            "name" => "champion",
            "cody" => [
                "name" => "cody"
            ]
        ]
    ]
]);
function getConfigurationV1_0_0(array $array, string $path)
{
    $path = explode("/", $path);
    foreach ($array as $item) {
        if (is_array($item)) {
            if (count($path) === 1 && array_key_exists($path[0], $array)) {
                return $item;
            } else {
                for ($i = 0; $i < count($path); $i++) {
                    if (array_key_exists($path[$i], $item)) {
                        if (is_array($item[$path[$i]])) {
                            foreach ($item[$path[$i]] as $key => $value) {
                                if (array_key_exists($path[array_key_last($path)], $item[$path[$i]])) {
                                    if (is_array($item[$path[$i]][$path[array_key_last($path)]])) {
                                        return $item[$path[$i]][$path[array_key_last($path)]];
                                    } else {
                                        return $item[$path[$i]][$path[array_key_last($path)]];
                                    }
                                } else {
                                    //Throw an exception here
                                    die("false");
                                }
                            }
                        } else {
                            return $item[$path[$i]];
                        }
                    }
                }
            }
        }
    }
}

// print_r(getConfigurationV1_0_0(ARRAY_CONSTANT, "name"));


function getConfigurationV_1_2_0(array $array, string $path)
{
    $path = explode("/", $path);
    foreach ($path as $item) {
        if (array_key_exists($item, $array)) {
            $configItem = $array[$item];
            if (is_array($configItem) && count($path) > 1) {
                foreach ($configItem as $key => $value) {
                    if (in_array($key, $path)) {
                        $configItem = $configItem[$key];
                        if (is_array($configItem) && count($path) > 2) {
                            foreach ($configItem as $key => $value) {
                                if (in_array($key, $path)) {
                                    return $configItem[$key];
                                }
                            }
                        } else {
                            return $configItem;
                        }
                    }
                }
            } else {
                return $configItem;
            }
        }
        return false;
    }
}


// Configuration::get("server")->item("request/uri");

//Configuration::get("app")->item("default-landing-page");

print_r(getConfigurationV_1_2_0(ARRAY_CONSTANT, "users/username"));