<?php

namespace TCE\SAN;

require_once "Champion/Loader.php";
require_once "Champion/Configurator.php";
\Champion\Loader::registerAutoload();

class Configuration extends \Champion\Configurator {

    public $CRIAR_SCHEMA = FALSE;
    public $ATUALIZAR_SCHEMA = FALSE;
    public $CRIAR_CRUD = FALSE;
    public $ENGENHARIA_REVERSA = FALSE;
    public $VERSAO_DOCTRINE = "1.2";
    public $NOME_PROJETO = "Autenticar";
    public $ERROS_HTML = FALSE;
    public $DESCRICAO_PROJETO = "Sistema de Apoio ao Nutricionista";
    protected $connectionOptions = array(
        'dev' => array(
            'dbname' => 'Autenticar',
            'user' => 'champion',
            'password' => 'champion',
            'host' => '172.31.0.45',
            'driver' => 'pdo_sqlsrv',
        ),
        'prod' => array(
            'dbname' => 'Autenticar',
            'user' => 'autenticar',
            'password' => '4ut3nt1c4r',
            'host' => '172.31.0.33',
            'driver' => 'pdo_sqlsrv',
        )
    );

}

return __NAMESPACE__ . "\\Configuration";