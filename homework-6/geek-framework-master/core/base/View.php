<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace core\base;

use Twig_Environment;

/**
 * Класс представления страницы (на основе Twig)
 *
 * @package core\base
 */
class View extends BaseObject
{
    /**
     * @var string Название страницы (можно использовать в шаблонах через {{ view.title }} )
     */
    public $title;

    private $_renderer;
    private $_data;

    /**
     * Создание нового представления для использования в контроллере
     *
     * @param Twig_Environment $renderer
     * @param array $data
     */
    public function __construct(Twig_Environment $renderer, array $data)
    {
        $this->_renderer = $renderer;
        $this->_data = $data;
    }

    /**
     * Генерация шаблона Twig
     *
     * @param string $view
     * @param array $data
     *
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function render(string $view, array $data = [])
    {
        $this->_data = [
            'app' => $this->_data,
            'view' => ['title' => $this->title],
        ];

        $this->_data = array_merge(
            $this->_data,
            $data
        );

        return $this->_renderer->render($view, $this->_data);
    }
}