<?php

namespace App\Controllers;

abstract class BaseController {
    protected $templateDir = __DIR__.'/../../views/';
    
    public function render(string $path, array $params = [])
{
    extract($params);
    require($this->templateDir . $path . '.php');
    require($this->templateDir . '/template.php');
}
}