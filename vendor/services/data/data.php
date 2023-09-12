<?php


namespace Vendor\Services\Data;


/**
 * @author Peter Mwambi
 * @date Wed Aug 09 2023 16:04:41 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Data
 * @abstract Data Service Provider - Performs data manipulation
 */
class Data extends DataServiceProvider
{


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |BEGIN ARRAY METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

    /**
     * #### Array Key Exists
     * - This method checks if a  given key or index exists in an array
     * @param string $key - The search item
     * @param array $array - The array
     * @return bool true on success or false on failure
     */
    public static function arrayKeyExists(string $key, array $array)
    {
        if (array_key_exists($key, $array)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * #### Replace Array
     * - Replaces elements from passed arrays into the first array
     * @param array $array - The array in which elements are replaced
     * @param array $replacements - Arrays from which elements will be extracted. Values from later arrays overwrite the previous values.
     * @return array Returns an `array`.
     */
    public static function replaceArray(array $array, array ...$replacements)
    {
        return array_replace($array, $replacements);
    }


    /**
     * #### Combine Array
     * - Creates an array by using one array for keys and another for its values
     * - Creates an `array` by using the values from the `keys` array as keys and the values from the `values` array as the corresponding values.
     * @param array $keys Array of keys to be used. Illegal values for key will be converted to `string`.
     * @param array $values `Array` of values to be used
     * @return array Returns the combined `array`.
     */
    public static function combineArray(array $keys, array $values)
    {
        return array_combine($keys, $values);
    }

    /**
     * #### Is Array
     * - Finds whether the given variable is an array.
     * @param mixed $value The variable being evaluated.
     * @return bool Returns `true` if `value` is an `array`, `false` otherwise.
     */
    public static function isArray(mixed $data)
    {
        if (is_array($data)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * #### Array Keys
     * - Return all the keys or a subset of the keys of an array 
     * @param array $array An array containing keys to return. 
     * @return array Returns an array of all the keys in `array`.
     */
    public static function arrayKeys(array $array)
    {
        return array_keys($array);
    }

    /**
     * #### Array Values
     * Return all the values of an array
     * @param array $array The array.
     * @return array Returns an indexed array of values.
     */
    public static function arrayValues(array $array)
    {
        return array_values($array);
    }

    /**
     * #### Array First Key
     * - Gets the first key of an array 
     * @param array $array An array.
     * @return int|string|null Returns the first key of `array` if the array is not empty; `null` otherwise.
     */
    public static function arrayFirstKey(array $array)
    {
        return array_key_first($array);
    }

    /**
     * #### Array Last Key
     * - Gets the last key of an array
     * @param array $array An array.
     * @return int|string|null Returns the last key of `array` if the array is not empty; `null` otherwise.
     */
    public static function arrayLastKey(array $array)
    {
        return array_key_last($array);
    }

    /**
     * #### In Array
     * - Checks if a value exists in an array
     * @param mixed $item The searched value. Note : If `needle` is a string, the comparison is done in a case-sensitive manner.
     * @param array $array The array.
     * @param bool|null $strict If the third parameter `strict` is set to `true` then the in_array() function will also check the types of the `needle` in the `haystack`. Note : Prior to PHP 8.0.0, a `string` `needle` will match an array value of `0` in non-strict mode, and vice versa. That may lead to undesireable results. Similar edge cases exist for other types, as well. If not absolutely certain of the types of values involved, always use the `strict` flag to avoid unexpected behavior.
     * @return bool Returns `true` if `needle` is found in the array, `false` otherwise.
     */
    public static function inArray(string $item, array $array, bool|null $strict = false)
    {
        if (in_array($item, $array, $strict)) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * #### Count
     * Counts all elements in an array or in a Countable object
     * Counts all elements in an array when used with an array. When used with an object that implements the Countable interface, it returns the return value of the method Countable::count().
     * @param \Countable|array $value An array or Countable object.
     * @param int|null $mode If the optional `mode` parameter is set to `COUNT_RECURSIVE` (or 1), count() will recursively count the array. This is particularly useful for counting all the elements of a multidimensional array. Caution count() can detect recursion to avoid an infinite loop, but will emit an `E_WARNING` every time it does (in case the array contains itself more than once) and return a count higher than may be expected.
     * @return int Returns the number of elements in `value`. Prior to PHP 8.0.0, if the parameter was neither an `array` nor an `object` that implements the Countable interface, `1` would be returned, unless `value` was `null` , in which case `0` would be returned.
     */
    public static function count(\Countable|array $array)
    {
        return count($array);
    }




    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |END ARRAY METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    |BEGIN STRING METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */


    /**
     * #### Format to Array
     * - Formats data to an array
     * @param mixed $data - The data to format
     * @return array - The formatted data as an array
     */
    public static function formatToArray(mixed $data)
    {
        return (array) $data;
    }

    /**
     * #### Format to Object
     * - Formats an array to an object
     * @param array $data - The array to format
     * @return object - The formatted object as an array
     */
    public static function formatToObject(array $data)
    {
        return (object) $data;
    }

    /**
     * #### Format to String
     * - Formats data to a string
     * @param mixed $data - The data to format
     * @return string - The formatted data as a string
     */
    public static function formatToString(mixed $data)
    {
        return (string) $data;
    }

    /**
     * #### Format to Integer
     * - Formats data to an integer
     * @param mixed $data - The data to format
     * @return int - The formatted data as an integer
     */
    public static function formatToInt(mixed $data)
    {
        return (int) $data;
    }

    /**
     * #### String or Array Replace
     * Replace all occurrences of the search string with the replacement string
     * - This method returns a string or an array with all occurrences of `search` in `subject` replaced with the given `replace` value.
     * @param array|string $search The value being searched for, otherwise known as the needle . An array may be used to designate multiple needles.
     * @param array|string $replace The replacement value that replaces found `search` values. An array may be used to designate multiple replacements.
     * @param array|string $subject The string or array being searched and replaced on, otherwise known as the haystack . If `subject` is an array, then the search and replace is performed with every entry of `subject`, and the return value is an array as well.
     * @param int|null $count If passed, this will be set to the number of replacements performed.
     * @return array|string This function returns a string or an array with the replaced values.
     */
    public static function stringOrArrayReplace(array|string $search, array|string $replace, array|string $subject, int|null $count = null)
    {
        return str_replace($search, $replace, $subject, $count);
    }

    /**
     * #### String to Lower Case
     * -Make a string lowercase. Returns `string` with all ASCII alphabetic characters converted to lowercase.
     * @param string $string The input string.
     * @return string Returns the lowercased string.
     */
    public static function stringToLowerCase(string $string)
    {
        return strtolower($string);
    }

    /**
     * #### String length
     * Get string length
     * - Returns the length of the given `string`.
     * @param string $string The `string` being measured for length.
     * @return int The length of the `string` in bytes.
     */
    public static function stringLength(string $string)
    {
        return strlen($string);
    }

    /**
     * #### Is String
     * Find whether the type of a variable is string
     * - Finds whether the type of the given variable is string.
     * @param mixed $value The variable being evaluated.
     * @return bool Returns `true` if `value` is of type `string`, `false` otherwise.
     */
    public static function isString(mixed $data)
    {
        if (is_string($data)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * #### JSON Encode
     * Returns the JSON representation of a value
     * - Returns a string containing the JSON representation of the supplied `value`. If the parameter is an `array` or `object`, it will be serialized recursively.
     * @param mixed $data The `value` being encoded. Can be any type except a resource . All string data must be UTF-8 encoded. Note : PHP implements a superset of JSON as specified in the original » RFC 7159 .
     * @param int|null $flags Bitmask consisting of `JSON_FORCE_OBJECT` , `JSON_HEX_QUOT` , `JSON_HEX_TAG` , `JSON_HEX_AMP` , `JSON_HEX_APOS` , `JSON_INVALID_UTF8_IGNORE` , `JSON_INVALID_UTF8_SUBSTITUTE` , `JSON_NUMERIC_CHECK` , `JSON_PARTIAL_OUTPUT_ON_ERROR` , `JSON_PRESERVE_ZERO_FRACTION` , `JSON_PRETTY_PRINT` , `JSON_UNESCAPED_LINE_TERMINATORS` , `JSON_UNESCAPED_SLASHES` , `JSON_UNESCAPED_UNICODE` , `JSON_THROW_ON_ERROR` . The behaviour of these constants is described on the JSON constants page.
     * @param int|null $depth Set the maximum depth. Must be greater than zero.
     * @return bool|string Returns a JSON encoded `string` on success or `false` on failure.
     */
    public static function jsonEncode(mixed $data, int|null $flags = 0, int|null $depth = 512)
    {
        return json_encode($data, $flags, $depth);
    }

    /**
     * #### JSON decode
     * Decodes a JSON string
     * Takes a JSON encoded string and converts it into a PHP value.
     * @param string $json The `json` `string` being decoded. This function only works with UTF-8 encoded strings. Note : PHP implements a superset of JSON as specified in the original » RFC 7159 .
     * @param bool|null $associative When `true` , JSON objects will be returned as associative `array`s; when `false` , JSON objects will be returned as `object`s. When `null` , JSON objects will be returned as associative `array`s or `object`s depending on whether `JSON_OBJECT_AS_ARRAY` is set in the `flags`.
     * @param int|null $depth Maximum nesting depth of the structure being decoded. The value must be greater than `0`, and less than or equal to `2147483647`.
     * @param int|null $flags Bitmask of `JSON_BIGINT_AS_STRING` , `JSON_INVALID_UTF8_IGNORE` , `JSON_INVALID_UTF8_SUBSTITUTE` , `JSON_OBJECT_AS_ARRAY` , `JSON_THROW_ON_ERROR` . The behaviour of these constants is described on the JSON constants page.
     * @return mixed Returns the value encoded in `json` in appropriate PHP type. Values `true`, `false` and `null` are returned as `true` , `false` and `null` respectively. `null` is returned if the `json` cannot be decoded or if the encoded data is deeper than the nesting limit.
     */
    public static function jsonDecode(string $data)
    {
        return json_decode($data);
    }

    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END STRING METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */


    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | BEGIN CLASS METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */


    /**
     * #### Class Exists
     * - Checks if the class has been defined
     * - This method checks whether or not the given class has been defined.
     * @param string $class The class name. The name is matched in a case-insensitive manner.
     * @param bool|null $autoload Whether to autoload if not already loaded.
     * @return bool Returns `true` if `class` is a defined class, `false` otherwise.
     */
    public static function classExists(string $class)
    {
        if (class_exists($class)) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * #### Method Exists
     *  - Checks if the class method exists in the given `object_or_class`.
     * @param object|string|null $class An object instance or a class name
     * @param string $method The method name
     * @return bool Returns `true` if the method given by `method` has been defined for the given `object_or_class`, `false` otherwise.
     */
    public static function methodExists(object|string $class, string $method)
    {
        if (method_exists($class, $method)) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * #### Property Exists
     * Checks if the object or class has a property
     * This method checks if the given `property` exists in the specified class.
     * 
     *  @param object|string|null $object_or_class The class name or an object of the class to test for
     * @param string $property The name of the property
     * @return bool Returns `true` if the property exists, `false` if it doesn't exist or `null` in case of an error.
     */
    public static function propertyExists(object|string $class_or_object, string $property)
    {
        if (property_exists($class_or_object, $property)) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * #### Factory Service Provider
     * - Instantiate classes
     * - This method instantiates a class and provides access to properties an methods contained in the class
     * @param string $class - The class to instantiate
     * @return object - The instance of the instantiated class 
     */

    public static function factory(string $class)
    {
        return (new Data())->generateNewInstance($class);
    }




    /*
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    | END CLASS METHODS
    |`````````````````````````````````````````````````````````````````````````````````````````````````````
    */

}