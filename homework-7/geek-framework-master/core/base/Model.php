<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */
namespace core\base;
/**
 * Класс модели для валидации и упрощения загрузки данных
 *
 * @package core\base
 */
abstract class Model extends BaseObject
{
	/**
	 * @var array ошибки в полях модели
	 */
	public $errors = [];
	/**
	 * Правила валидации
	 * ['user_name' => StringValidator::class]
	 * ['user_name' => 'string'] ===> StringValidator ...
	 * @return array
	 */
	protected function validationRules()
	{
		return [];
	}
	/**
	 * Инициализация модели и атрибутов по умолчанию
	 *
	 * @param array|null $attributes
	 */
	public function __construct(array $attributes = null)
	{
		if (!is_null($attributes)) {
			foreach ($attributes as $attr => $value) {
				$this->{$attr} = $value;
			}
		}
	}
	/**
	 * Загружает автоматически все атрибуты модели из $request по названию ключа
	 *
	 * @param array $request
	 *
	 * @return bool
	 */
	public function load(array $request)
	{
		if (isset($request[static::modelName()])) {
			$data = $request[static::modelName()];
			foreach ($data as $attr => $value) {
				$this->{$attr} = $value;
			}
			return true;
		}
		return false;
	}
	/**
	 * Возвращает имя класса модели (для использования в методах)
	 * @return mixed
	 */
	protected static function modelName()
	{
		$namespaces = explode('\\', static::class);
		$className = array_pop($namespaces);
		return $className;
	}

	/**
	 * Добавление ошибки на указанный атрибут
	 *
	 * @param string $attribute
	 * @param string $message
	 */
	public function addError(string $attribute, string $message)
	{
		$this->errors[$attribute] = $message;
	}

	public function validate()
	{
		$status = true;
		// user_name => string
		// StringValidator::check(user_name)
		foreach ($this->validationRules() as $attribute => $validator) {
			$value = $this->{$attribute};
			if (!$validator::check($value)) {
				$this->addError($attribute, 'Invalid value!');
				$status = false;
			}
		}
		return $status;
	}
}