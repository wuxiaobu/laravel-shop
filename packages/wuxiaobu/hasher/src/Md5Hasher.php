<?php

namespace Wuxiaobu\Hasher;

class Md5Hasher
{
    /**
     * make
     *
     * @param  mixed $value
     * @param  mixed $options
     *
     * @return void
     */
    public function make($value, array $options = [])
    {   
        $a = 1;
        $a = 1;
        $salt = isset($options['salt']) ? $options['salt'] : '';
        return hash('md5', $value . $salt);
    }

    /**
     * check
     *
     * @param  mixed $value
     * @param  mixed $hashValue
     * @param  mixed $options
     *
     * @return void
     */
    public function check($value, $hashValue, array $options = [])
    {
        $salt = isset($options['salt']) ? $options['salt'] : '';
        return hash('md5', $value . $halt) === $hashValue;
    }
    
}