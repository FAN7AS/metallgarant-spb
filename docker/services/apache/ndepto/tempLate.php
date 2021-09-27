<?php

namespace ndepto;

class tempLate{

    protected $path ='';
    protected $parsedPath='';

    public $pathSep = "/";

    public function __construct(nRuner $nRuner, $path, $parsedPath = null)
    {

        $this->runner = $nRuner;
        $this->path = $path;
        $this->parsedPath=$parsedPath;
    }

    protected function getParsedPath($path=[])
    {
        if($this->parsedPath == null){
            if(is_dir($this->getTemplatePath())){
                $this->parsedPath = $this->path.$this->pathSep.".parsed";
            } elseif(is_file($this->getTemplatePath())){
                if(pathinfo($this->getTemplatePath())['extension'] == 'tplphp'){
                    $this->parsedPath = preg_replace('~\.tplphp$~i', '', $this->getParsedPath());
                } else {
                    $this->parsedPath =  $this->path.".parsed";
                }
            }

        }

        if(is_dir($this->getTemplatePath()) && is_file($this->parsedPath)){
            throw new \Exception('Parsed path is file!');
        }

        if(is_file($this->getTemplatePath()) && is_dir($this->parsedPath)){
            $this->parsedPath = $this->parsedPath.$this->pathSep.$this->toPath($this->getTemplatePath());
        }

        $path = implode($this->pathSep, (array)$path);
        return $this->parsedPath.($path ? $this->pathSep.$path : "");
    }

    public function toPath($path)
    {
        $path = basename($path, ".tplphp");

        return $path;
    }

    protected function getTemplatePath($path=[]){
        $path = implode($this->pathSep, (array)$path);
        return $this->path.($path ? $this->pathSep.$path : "");
    }

    public function run(){

        //echo $this->parsedPath();
        //echo $this->templatePath();

        if(is_dir($this->getTemplatePath())){
            $this->renewParsedDir();
            $this->parseDir();
        } elseif (is_file($this->getTemplatePath())){
            $this->parseFile($this->getTemplatePath(), $this->getParsedPath());
        }

    }

    public function loadEnv()
    {
        $env = [];

        foreach ($_ENV as $k=>$v) {
            $env["ENV_".$k] = $v;
        }

        return $env;
    }

    public function renewParsedDir()
    {
        if($this->getParsedPath() == "/") throw new Exception('Wrong parsed path');

        $this->rrmpath($this->getParsedPath());
        mkdir($this->getParsedPath(), 0777, true);
    }

    protected function parseDir($dir = [])
    {
        $l_dir = scandir($this->getTemplatePath($dir));

        foreach ($l_dir as $l){

            if( in_array($l, [".","..",".parsed"]) ) continue;

            $l_path = array_merge($dir, [$l]);

            if(is_dir($this->getTemplatePath($l_path))){
                $this->parseDir($l_path);
            } elseif (is_file($this->getTemplatePath($l_path)) && pathinfo($this->getTemplatePath($l_path))['extension'] == 'tplphp'){

                $from = $this->getTemplatePath($l_path);
                $to = preg_replace('~\.tplphp$~i', '', $this->getParsedPath($l_path));

                $this->parseFile($from, $to);

                echo "\n Parse FROM: ".$from;
                echo "\n Parse TO: ".$to;

            } elseif (is_file($this->getTemplatePath($l_path))) {

                echo "\n Copy FROM: ".$this->getTemplatePath($l_path);
                echo "\n Copy TO: ".$this->getParsedPath($l_path);

                $this->copyFile($this->getTemplatePath($l_path), $this->getParsedPath($l_path));
            }
        }

    }

    protected function copyFile($from, $to)
    {
        @mkdir(dirname($to), 0777, true);
        copy($from, $to);
    }

    protected function parseFile($from, $to)
    {
        $code = $this->_template(file_get_contents($from));
        file_exists(dirname($to)) && is_dir(dirname($to)) || @mkdir(dirname($to), 0777, true);
        file_put_contents($to, $code);
    }

    protected  function rrmpath($path) {
        if (is_dir($path)) {
            $objects = scandir($path);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($path. DIRECTORY_SEPARATOR .$object) && !is_link($path."/".$object))
                        $this->rrmpath($path. DIRECTORY_SEPARATOR .$object);
                    else
                        unlink($path. DIRECTORY_SEPARATOR .$object);
                }
            }
            rmdir($path);
        } elseif (is_file($path)){
            unlink($path);
        }
    }

    protected function _template($code){

        $randOpen = md5(rand(1000000, 9999999).microtime());
        $randClose = md5($randOpen.rand(1000000, 9999999));


        $code = str_replace('<?', "<<<$randOpen&&&",  $code);
        $code = str_replace('?>', "&&&$randClose>>>",  $code);

        $code = str_replace('<%', "<?", $code);
        $code = str_replace('%>', "?>", $code);

        extract($this->loadEnv());

        ob_start();
        eval("?>". $code );
        $code = ob_get_clean();

        $code = str_replace("<<<$randOpen&&&", '<?', $code);
        $code = str_replace("&&&$randClose>>>", '?>', $code);

        return $code;
    }


}