<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nookz
 * Date: 12/25/12
 * Time: 9:59 PM
 */
class BaseController
{

    public $baseUrl='http://localhost/projects/formBuilder';
    public $baseDir='C:\\xampp\\htdocs\\projects\\formbuilder';

    public function render($filename,array $vars = null)
    {
        if(isset($vars))
            extract($vars);
        ob_start();
        require_once $this->baseDir.'\\views\\'.$filename;
        $content = ob_get_contents();
        ob_end_clean();
        require_once $this->baseDir.'/templates/main.php';
    }
}
