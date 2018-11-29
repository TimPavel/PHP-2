<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace core\base;

use core\Application;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Класс ActiveRecord (паттерн), представляющий возможность работы
 * с записями базы данных в объектном виде (на основе PDO и QueryBuilder)
 *
 * @package core\base
 */
abstract class ActiveRecord extends Model
{
    /**
     * @var string первичный ключ в таблице
     */
    protected static $primaryKey = 'id';

    /**
     * Метод для быстрого поиска по первичному ключу
     *
     * @param $id
     *
     * @return static
     */
    public static function findById($id)
    {
        $query = static::find()
            ->where(static::$primaryKey . " = :id")
            ->setParameter(':id', $id);

        // select * from user_role where id = $id

        return static::one($query);
    }

    /**
     * Построение запросов к БД при помощи QueryBuilder
     * @return QueryBuilder
     */
    public static function find()
    {
        return static::getConnection()
            ->createQueryBuilder()
            ->select('*')
            ->from(static::tableName());
    }

    /**
     * Соединение с базой данных
     * @return \Doctrine\DBAL\Connection
     */
    private static function getConnection()
    {
        return Application::getInstance()->connection;
    }

    /**
     * Преобразование названия класса в название таблицы в БД
     * @return null|string|string[]
     */
    protected static function tableName()
    {
        $className = parent::modelName();

        // UserRole -> user_role

        $snakeCaseName = preg_replace_callback("/[A-Z]/", function ($match) {
            return "_" . strtolower($match[0]);
        }, $className);

        $snakeCaseName = ltrim($snakeCaseName, '_');

        return $snakeCaseName;
    }

    /**
     * Получение одного объекта из базы данных
     *
     * @param QueryBuilder $query
     *
     * @return static
     */
    public static function one(QueryBuilder $query = null)
    {
        if (is_null($query)) {
            $query = static::find();
        }

        $query = static::prepareToFetch($query);

        return $query->fetch();
    }

    /**
     * Подготовка построителя запросов для получения объектов
     *
     * @param QueryBuilder $builder
     *
     * @return \Doctrine\DBAL\Driver\Statement|int
     */
    private static function prepareToFetch(QueryBuilder $builder)
    {
        $statement = $builder->execute();
        $statement->setFetchMode(FetchMode::CUSTOM_OBJECT, static::class);

        return $statement;
    }

    /**
     * Получение всех объектов из базы данных
     *
     * @param QueryBuilder $query
     *
     * @return static[]
     */
    public static function all(QueryBuilder $query = null)
    {
        if (is_null($query)) {
            $query = static::find();
        }

        $query = static::prepareToFetch($query);

        return $query->fetchAll();
    }

    /**
     * Сохранение или обновление записи в базе данных
     * @return bool
     *
     */
    public function save()
    {
        try {
            $connection = $this->getConnection();

            $attributes = [];

            foreach ($this->tableColumns() as $column) {
                if (isset($this->{$column})) {
                    $attributes[$column] = $this->{$column};
                }
            }

            unset($attributes[static::$primaryKey]);

            if ($this->isNewRecord()) {
                $result = (bool)$connection->insert(
					static::tableName(),
                    $attributes
                );

                if ($result) {
                    $this->{static::$primaryKey} = $connection->lastInsertId();
                }
            } else {
                $result = (bool)$connection->update(
					static::tableName(),
                    $attributes,
                    [static::$primaryKey => $this->getPrimaryKeyValue()]
                );
            }

            return $result;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            die();
        }
    }

    /**
     * Массив с названиями столбцов таблицы
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    private function tableColumns()
    {
        $connection = $this->getConnection();
        $connection->setFetchMode(FetchMode::ASSOCIATIVE);

        $query = $connection->prepare('describe ' . static::tableName());
        $query->execute();

        $columns = $query->fetchAll();

        $columns = array_map(function ($column) {
            return $column['Field'];
        }, $columns);

        return $columns;
    }

    /**
     * Новая или существующая запись в БД
     * @return bool
     */
    private function isNewRecord()
    {
        return !isset($this->{static::$primaryKey});
    }

    /**
     * Извлекаем свойство первичного ключа
     * @return mixed|null
     */
    private function getPrimaryKeyValue()
    {
        return ($this->isNewRecord()) ? null : $this->{static::$primaryKey};
    }

    /**
     * Удалить запись из базы данных
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     */
    public function delete()
    {
        if (!$this->isNewRecord()) {
            $connection = $this->getConnection();

            return (bool)$connection->delete(
				static::tableName(),
                [static::$primaryKey => $this->getPrimaryKeyValue()]
            );
        }

        return false;
    }
}