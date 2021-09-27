<?php

namespace ndepto;

class mOver {

    protected $path;
    /**
     * @var nRuner
     */
    protected $runner;

    protected $pathSep = DIRECTORY_SEPARATOR;

    public function __construct(nRuner $nRuner, $path)
    {
        $this->runner = $nRuner;
        $this->path = $path;
    }

    protected function getPath($path=[]){
        $path = implode($this->pathSep, (array)$path);
        return $this->path.($path ? $this->pathSep.$path : "");
    }

    public function run()
    {

        if(file_exists($this->getPath()) && is_dir($this->getPath())){
            $this->parseDirMover();
        } elseif (file_exists($this->getPath())){
            $this->parseFile($this->getPath());
        }
        
        
    }

    public function parseDir($dir = [], $exept = [])
    {

        $l_dir = scandir($this->getPath($dir));

        foreach ($l_dir as $l){

            if( in_array($l, [".","..", ".mOver"]) ) continue;

            //if (preg_match('~'..'~is'))

            $l_path = array_merge($dir, [$l]);

            if(is_dir($this->getPath($l_path))){
                $this->parseDirMover($l_path);
            } elseif (is_file($this->getPath($l_path))) {

                $file = $this->getPath($l_path);
                $this->parseFile($file);

                //$this->runner->out("Parse File: ".$file);
            }
        }
    }

    public function parseFile($file)
    {
        $content = file_get_contents($file);

        $m=[];
        preg_match_all('~#_#(.*?)$~is', $content, $m);

        //^#_#(.*?)$
        //var_dump($m);

        foreach($m[1] as $line => $str){
            $data = str_getcsv($str,  " ");
            $data = array_values(array_filter($data));
            try {
                $commander = new Commander($file, $this->runner);
                $commander->runCommand($data, $commands, $params, $file, $line);
            } catch (UnknownCommand $e){
                $this->runner->outError($e->getMessage()." in ".$file." on ".$line);
            }

        }

    }

    public function parseDirMover($dir=[])
    {

        $commands = [];
        $params = [
            'parseDir' => 1
        ];


        if(file_exists($moverFile = $this->getPath(array_merge($dir, ['.mOver'])))){
            ini_set('auto_detect_line_endings',TRUE);
            $handle = fopen($moverFile,'r');
            $line=1;
            while ( ($data = fgetcsv($handle, 10000, " ") ) !== FALSE ) {
                $data = array_values(array_filter($data));

                try {
                    $commander = new Commander($this->getPath($dir), $this->runner);
                    $commander->runCommand($data, $commands, $params);
                } catch (UnknownCommand $e){
                    $this->runner->outError($e->getMessage()." in ".$moverFile." on ".$line);
                }
                $line++;
            }
            ini_set('auto_detect_line_endings',FALSE);

            if($params['parseDir']){
                $this->parseDir($dir);
            }

        } else {
            $this->parseDir($dir);
        }
        return $commands;
    }





    

}

class Commander {

    public $context = "";

    protected $isDir = null;

    /**
     * @var nRuner
     */
    protected $runner;

    public function __construct($context, $runner)
    {

        $this->context=realpath($context);
        if(is_dir($this->context)){
            $this->isDir = 1;
        } elseif(is_file($this->context)){
            $this->isDir = 0;
        }

        $this->runner = $runner;
    }

    public function runCommand($data, &$commands, &$params)
    {
        $name = $data[0];
        if(substr($name, 0, 1) == "#"){
            return null;
        } elseif($name == "set"){
            isset($data[1]) and isset($data[2]) and $params[$data[1]] = $data[2];
        } else if(method_exists($this, $action = $name."_action")){
            $commands[array_shift($data)] = $data;
            return call_user_func_array([$this, $action], $data);
        } elseif($name) {
            throw new UnknownCommand("Unknown command \"$name\"");
        }
    }





    protected function checkFrom(&$from)
    {

        if($from){
            $fromArray = explode(DIRECTORY_SEPARATOR, $from);

            if($fromArray[0] !== ""){

                if(is_dir($this->context)){
                    $from = rtrim($this->context, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$from;
                } else {
                    $from = rtrim(dirname($this->context), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$from;
                }
            }

        } elseif (!$from){
            $from = $this->context;
        } elseif ($from == "__dir__"){
            if(is_dir($this->context)){
                $from = $this->context;
            } else {
                $from = dirname($this->context);
            }
        } elseif ($from == "__file__"){
            $from = $this->context;
        }

        return file_exists($from);

    }

    public function copy_raw_action($to="", $from="")
    {
        $this->checkFrom($from);
        $this->checkTo($to, $from);

        $this->runner->out("Copy raw $from to $to ");

        copy($from, $to) && $this->runner->outLine(" - OK");
    }


    public function copy_action($to, $from="")
    {
        $this->checkFrom($from);
        $this->checkTo($to, $from);



        $content = file_get_contents($from);
        $content = preg_replace('~#_#(.*?)$~is', "", $content);

        $this->runner->out("Copy clean $from to $to ");

        file_put_contents($to, $content) && $this->runner->outLine(" - OK");


    }

    protected function checkTo(&$to, $from)
    {

        if( ! file_exists($to) ) {
            if (substr($to, -1, 1) == DIRECTORY_SEPARATOR) {
                $dirName = $to;
            } else {
                $dirName = dirname($to);
            }
            @mkdir($dirName, 0777, true);
        }

        if(is_dir($to)){
            $to = rtrim($to, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.basename($from);
        }

        return true;


    }

    public function copy_dir_action($to, $from="", $rec = 1, $exclude='.mOver')
    {

        $this->checkFrom($from);

        $l_dir = scandir($from);

        foreach ($l_dir as $l) {

            if (in_array($l, [".", "..",".mOver"])) continue;

            $l_path = $from . DIRECTORY_SEPARATOR . $l;

            if (!is_array($exclude)){
                $glob = [];
                foreach (explode("|", $exclude) as $ex) {
                    //echo $this->context .DIRECTORY_SEPARATOR. $ex;
                    $glob = array_merge($glob, glob($this->context .DIRECTORY_SEPARATOR. $ex));
                }
                $exclude=$glob;
                //var_dump($exclude);
            }

            if(in_array($l_path, $exclude)) continue;

            //$l_n_path = preg_replace('~^'.str_replace(['-','.'],['\-','\.'],$this->context).'~i', DIRECTORY_SEPARATOR, $l_path);

            //echo $l_n_path;

            if(is_dir($l_path)){
                $this->copy_dir_action($l_path, $from, $rec, $exclude);
            } elseif (is_file($l_path)) {


                $this->copy_raw_action($to, $l_path);

                //$file = $this->getPath($l_path);
                //$this->parseFile($file);
                //$this->runner->out("Parse File: ".$file);
            }
        }
    }



}

class UnknownCommand extends \Exception{}