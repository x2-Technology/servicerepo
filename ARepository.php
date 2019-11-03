<?php
/**
 * Created by PhpStorm.
 * User: suleymantopaloglu
 * Date: 2019-10-30
 * Time: 13:54
 */

abstract class ARepository
{

        const FETCH_TYPE_ARRAY = 0;
        const FETCH_TYPE_OBJECT = 1;

        private $fetchMethod = self::FETCH_TYPE_OBJECT;

        protected static $instance = null;
        protected $tempRepo     = null;
        protected $repoKey      = "";
        protected $repoVal      = null;

        protected function __construct()
        {


        }

        function switchArray($arrayData, $toObject = true)
        {

                $n = array();
                foreach ($arrayData as $index => $item) {


                        if (gettype($item) == ($toObject ? "array" : "object")) {

                                if ($this->isAssoc($item)) {
                                        $n[$index] = $this->switchArray($item, $toObject);
                                } else {

                                        $n[$index] = $item;
                                }
                        } else {
                                $n[$index] = $item;
                        }
                }

                if ($toObject) {
                        return (object)$n;
                }

                return (array)$n;


        }

        function isAssoc($arrayData)
        {

                if (!count($arrayData)) {
                        return false;
                }

                return array_keys($arrayData) !== range(0, count($arrayData) - 1);

        }


        final function setFetchMethod($fetchType = self::FETCH_TYPE_ARRAY)
        {
                $this->fetchMethod = $fetchType;
        }

        final function getFetchMethod()
        {
                return $this->fetchMethod;
        }


}