<?php

namespace Models\Components;

class FormComponent
{
    private static $options;

    public static function getClassNames(array $classNames = [])
    {
        if (count($classNames)) {
            $className = "";
            $x = 1;
            foreach ($classNames as $class) {
                $className .= $class;
                if ($x < count($classNames)) {
                    $className .= " ";
                }
                $x++;
            }
            return $className;
        }
    }
    public static function Input(string $type = "", string $name = "", array $classNames = [], $value = null)
    {
        if (count($classNames)) {
            $className = self::getClassNames($classNames);
            return '<input type="' . $type . '" name="' . $name . '" class="' . $className . '" value="' . $value . '">';
        } else
            return '<input type="' . $type . '" name="' . $name . 'value="' . $value . '">';
    }

    public static function Label(string $for = "", string $value = "", array $classNames = [])
    {
        if (count($classNames)) {
            $className = self::getClassNames($classNames);
            return '<label for="' . $for . '" class="' . $className . '">' . $value . '</label>';
        } else {
            return '<label for="' . $for . '">' . $value . '</label>';
        }
    }

    public static function Textarea(string $name = "", array $classNames = [], string $value = "")
    {
        if (count($classNames)) {
            $className = self::getClassNames($classNames);
            return '<textarea name="' . $name . '" class="' . $className . '">' . $value . '</textarea>';
        } else {
            return '<textarea name="' . $name . '">' . $value . '</textarea>';
        }
    }

    private static function selectOptions(array $options, $selectedOption = null)
    {
        foreach ($options as $option) {
            if (!empty($selectedOption) && $selectedOption === $option) {
                self::$options .= '<option selected="selected">' . $option . '</option>';
                continue;
            }
            self::$options .= '<option>' . $option . '</option>';
        }
        return self::$options;
    }
    public static function initializeOptions()
    {
        return self::$options = "";
    }
    public static function Select(string $name, array $options = array(), array $classNames = [], $selectedOption = null)
    {
        if (!empty($name)) {
            if (count($classNames)) {
                $className = self::getClassNames($classNames);
                return '<select name="' . $name . '" class="' . $className . '">' . self::selectOptions($options, $selectedOption) . '</select>';
            } else {
                return '<select name="' . $name . '">' . self::selectOptions($options, $selectedOption) . '</select>';
            }
        }
    }
}