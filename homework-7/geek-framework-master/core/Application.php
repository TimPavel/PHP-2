<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace core;

use core\base\Controller;
use core\base\View;
use core\traits\Singleton;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * Класс приложения, который содержит всю логику
 * инициализации подключения компонентов, сервисов и базы данных
 *
 * @package core
 *
 * @property Request $request
 * @property Controller $controller
 * @property Connection $connection
 * @property string $action
 */
class Application
{
    use Singleton;

    public $request;
    public $connection;
    public $controller;

    private $_config;

    /**
     * Инициализиация приложения с указанными настройками
     *
     * @param array $configuration
     *
     * @throws \Exception
     */
    public function init(array $configuration)
    {
        // загружаем конфигурации
        $this->_config = $configuration;

        // инициализируем и регистрируем объекты компонентов приложения
        $this->request = $this->getRequest();
        $this->connection = $this->getConnection();

        $router = $this->getRouter();
        $renderer = $this->getRenderer();

        // если контроллер найден
        if ($router->controller) {
            // создаем новый экземпляр и вызываем action
            $controllerName = $router->controller;
            $this->controller = new $controllerName($this->request, $renderer);

            // сохраняем полученный результат от контроллера
            $response = $this->controller->runAction(
                $router->action,
                $router->params
            );

            // возвращаем на страницу
            echo $response;
        } else {
            throw new \Exception('Invalid controller');
        }
    }

    /**
     * Формирование объекта Request
     * @return Request
     */
    private function getRequest()
    {
        return new Request();
    }

    /**
     * Формирование объекта Doctrine
     * @return Connection
     * @throws \Doctrine\DBAL\DBALException
     */
    private function getConnection()
    {
        $doctrineConfig = new Configuration();

        $connection = DriverManager::getConnection($this->_config['database'], $doctrineConfig);

        return $connection;
    }

    /**
     * Формирование объекта Router
     * @return Router
     */
    private function getRouter()
    {
        return new Router(
            $this->request->path,
            $this->_config['routes']
        );
    }

    /**
     * Формирование объекта View
     * @return View
     */
    private function getRenderer()
    {
        $templatesDirectory = $this->_config['view']['templates'];

        $loader = new Twig_Loader_Filesystem($templatesDirectory);
        $twig = new Twig_Environment($loader, $this->_config['view']['params']);

        $view = new View($twig, $this->_config['app']);

        return $view;
    }

}