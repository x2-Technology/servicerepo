<?php
/**
 * Created by PhpStorm.
 * User: suleymantopaloglu
 * Date: 2019-10-30
 * Time: 10:07
 */

final class Repository
{
        static public $REPO_SESSION     = 0;
        static public $REPO_COOKIE      = 1;
        private $repoType               = null;
        private $instance               = null;

        function __construct( $repoType = null ) {

                if( is_null($repoType) ){
                        $repoType = self::$REPO_SESSION;
                }

                $this->repoType = $repoType;
        }

        public function getInstance(){

                switch ( $this->repoType ){

                        case self::$REPO_COOKIE:
                                $this->instance =  CRepository::getInstance();
                                break;

                        case self::$REPO_SESSION:
                        default:
                                $this->instance =  SRepository::getInstance();

                                break;
                }

                #highlight_string(var_export(new ReflectionClass( $this->instance), true));
                
                return $this->instance;
        }

        public function __destruct()
        {
                unset($this);
        }


}