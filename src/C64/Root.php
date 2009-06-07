<?php
class C64_Root extends k_Dispatcher
{
    public $debug = true;
    public $map = array('c64' => 'C64_Controller_Index',);

    function __construct()
    {
        parent::__construct();
        $this->document->template = dirname(__FILE__) . '/templates/main.tpl.php';
        $this->document->title = 'Commondore 64';
        $this->document->styles[] = $this->url('/style.css');
    }

    function execute()
    {
        throw new k_http_Redirect($this->url('c64'));
    }
}
