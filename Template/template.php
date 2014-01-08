<?php
/**
 * Created by Ian den Hartog
 * Version 0.1
 * Copyright (c) 2013 Ian den Hartog
 */

namespace template;

class template {
    /**
     * @var string
     */
    private $content;

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }


    /**
     * @param $file
     * @throws Exception
     */
    public function __construct($file)
    {
        if(is_file($file))
        {
            $this->content = file_get_contents($file);
        }
        else
        {
            throw new Exception('$file is geen bestand');
        }
    }


    /**
     * @param $name
     * @param $change
     * @throws Exception
     */
    public function assign($name, $change)
    {
        if(!is_string($change) && !(is_object( $change ) && method_exists( $change, '__toString' ) ) )
        {
            throw new Exception('Variable $change is not String');
        }
        else
            $this->content = preg_replace("/{%$name%}/", "$change", $this->content);
    }

    /**
     * @param $name
     * @param $array
     */
    public function assignArray($name, $array)
    {
        $change = "";
        foreach($array as $value)
        {
            $change .= "$value, ";
        }
        $this->content = preg_replace("/{%$name%}/", "$change", $this->content);//verander {%name%} naar de content die daar hoord
    }
    public function ifVar($name)
    {
        if (strpos($this->content,'{%'.$name.'%}') !== false) {
            return true;
        }
        else
        {
            return false;
        }
    }
    /**
     *
     */
    public function printToScreen()
    {
        echo $this->content;
    }
}