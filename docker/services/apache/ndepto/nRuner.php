<?php

namespace ndepto;

/**
 * Class nRuner
 * @package ndepto
 */

class nRuner {

    protected $args = [];

    protected $keys = [];

    protected $keyAliases= [];

    protected $argAliases= [];

    protected $argv = [];

    protected $unknownKey = true;

    protected $wrongArgCount = true;

    protected $actions = [];

    protected $middlewares = [];

    protected $_middlewares = [];

    const STATUS_SUCCESS = 0;

    const STATUS_FAIL = 0;

    const OUT_ERROR = -10;

    const OUT_WARNING = -1;

    const OUT_MESSAGE = 0;

    const OUT_HEADER = 20;

    public function __construct($argv)
    {
        $this->argv = $argv;
        //$this->parseArgv($argv);
    }

    /**
     * @param $next Closure
     */
    public function parseArgv($next){

        foreach ($this->argv as $k => $v) {
            if ($k == 0) continue;


            $m = [];
            if (preg_match('~^(--([A-z0-9]+)|-([A-z0-9]))(=?(.*?))?$~is', $v, $m)) {
                $value=$m[4];
                $key=$m[2];
                $alias = $m[3];

                if(isset($this->keys[$key])){
                    $this->keys[$key]['value'] = isset($value) ? $value : true;
                } else if(isset($this->keyAliases[$alias])){
                    $this->keyAliases[$alias]['value'] = isset($value) ? $value : true;
                } else {
                    return $this->error_unknownKey($alias ?: $key);
                }


            } else {

                isset($this->argAliases[$k-1]) && ($this->argAliases[$k-1]['value'] = $v);
            }
        }

        foreach($this->args as $arg){
            if($arg['required'] && !isset($arg['value'])){
                return $this->error_wrongArgsCount($arg['name']);
            }
        }

        return call_user_func($next);
    }

    protected function error_unknownKey($key){

        $this->out("Unknown key $key ", self::OUT_ERROR);

        return self::STATUS_FAIL;
    }

    protected function error_wrongArgsCount($arg){

        $this->out("Wrong args count. $arg - not provided", self::OUT_ERROR);

        return self::STATUS_FAIL;
    }

    public function key($name, $default=null, $alias=null, $type=null, $description=null){
        $this->keys[$name] = [
            'default' => $default,
            'type' => $type,
            'description' => $description,
            'alias' => $alias,
            'name' => $name
        ];

        $alias && ($this->keyAliases[$alias] = &$this->keys[$name]);

        return $this;
    }

    public function arg($name, $default = null, $required=false, $description=null){
        $this->args[$name] = [
            'default' => $default,
            'required' => $required,
            'description' => $description,
            'index' => count($this->args),
            'name' => $name
        ];
        $this->argAliases[$this->args[$name]['index']] = &$this->args[$name];
        return $this;
    }

    public function  unknownKey($val){
        $this->unknownKey=$val;
        return $this;
    }


    public function  unknownArg($val){
        $this->wrongArgCount=$val;
        return $this;
    }

    public function getKey($name, $default)
    {
        return isset($this->keys[$name]['value']) ? $this->keys[$name]['value'] : (isset($this->keys[$name]['default']) ? $this->keys[$name]['default']: null);
    }

    public function getArg($name)
    {
        if(is_numeric($name)){
            if(count($this->args) <= (int)$name)
            $name = array_keys($this->args)[$name];
        }

        return isset($this->args[$name]['value']) ? $this->args[$name]['value'] : (isset($this->args[$name]['default']) ? $this->args[$name]['default']: null);
    }


    public function defaultAction()
    {
        $this->action();

        return $this;
    }

    public function run()
    {;
        $this->middleware([$this, 'afterBrake']);
        $this->middleware([$this, 'parseArgv']);
        $this->middleware([$this, 'runAction']);

        $this->_middlewares = $this->middlewares;
        return $this->runNextMiddleWare();

    }

    /**
     * @param $next Closure
     */
    public function afterBrake($next)
    {
        $result = call_user_func($next);
        $this->out("");
        return $result;
    }

    public function runAction($next, $runner)
    {
        $results = [];
        foreach ($this->actions as &$action){
            try {
                $this->outHeader($action['title']);
                $results[] = $action['result'] = call_user_func($action['call'], $this);
            } catch(Exception $e){
                $this->out($e->getMessage());
            }
        }

        return in_array(false, $results) ? self::STATUS_FAIL : self::STATUS_SUCCESS;
    }

    public function runNextMiddleWare(){

        $mw = array_shift($this->_middlewares);

        if(is_callable($mw['condition'])){
            if (!call_user_func($mw['condition'], $this)){
                return $this->runNextMiddleWare();
            }
        }

        $runner = $this;

        if($mw) {
            return call_user_func_array($mw['call'], array_merge([function ($in = null) use ($runner) {
                return $runner->runNextMiddleWare();
            }, $this], $mw['arguments']));
        }
    }

    public function action($call, $title="", $cond = null)
    {
        $this->actions[] = [
            'call' => $call,
            'title' => $title ? $title: "Action #".(count($this->actions)+1),
            'result'
        ];

        return $this;
    }

    public function middleware($call, $before = false, $condition = null, $arguments = []){
        $mv = [
            'call' => $call,
            'condition' => $condition,
            'arguments' => $arguments,
        ];

        if ($before){
            array_unshift($this->middlewares,$mv);
        } else {
            $this->middlewares[] = $mv;
        }

        return $this;

    }

    public function out($text, $type = self::OUT_MESSAGE)
    {
        $prefix="";
        $postfix = "";
        switch ($type){
            case self::OUT_ERROR:
                $prefix = "Error: ";
            break;
            case self::OUT_WARNING:
                $prefix = "Warning: ";
            break;
            case self::OUT_MESSAGE:
                $prefix = "";
            break;
            case self::OUT_HEADER:
                $prefix = "\n ==";
                $postfix = " \n";
            break;
        }

        echo "\n".$prefix.$text.$postfix;
    }

    public function outHeader($text)
    {
        $this->out($text, self::OUT_HEADER);
    }

    public function outError($text)
    {
        $this->out($text, self::OUT_ERROR);
    }

    public function outLine($text)
    {
        echo $text;
    }
}
