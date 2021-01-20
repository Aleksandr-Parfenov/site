<?php

class Db
{
    private static $connection;

    public const LAST_INSERT_ID='lastInsertId';
    public const FETCH_COLUMN='fetchColumn';
    public const FETCH_ALL = 'fetchAll';
    public const FETCH = 'fetch';
    public const IN_STRING = 'in_string';


    public static function getConnection()
    {
        if (!empty(self::$connection)) {
            return self::$connection;
        }
        $paramsPath = ROOT . DB_PARAMS;
        $params = include($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']};"
            . "port={$params['port']};charset={$params['charset']};";
        self::$connection = new PDO($dsn, $params['user'], $params['password']);

        return self::$connection;
    }

    public static function executeQuerySelect(string $query, string $PdoInstructionForReturn = self::FETCH_ALL )
    {
        return self::executeQuery($query, [], $PdoInstructionForReturn);
    }


    //TODO: Добавить больше фильтров функции, проверок, больше логировать
    /** Использование подготовленного запроса с IN (т.к. есть большая особенность его использования с PDO)
     * @param string $query sql | запрос insert into set name=:name
     * @param array $paramsIn параметры подстановки в sql запрос IN |
     * @return array в sql запрос IN |
     */
    public static function executeQueryIn(string $query, array $paramsIn = [])
    {
        $executeStart=microtime(true);
        $error = array();
        $str = "";
        //Подключаемся к БД
        $db=self::getConnection();
        $in_string  = str_repeat('?,', count($paramsIn) - 1) . '?';
        $str_replace = ' IN (' . $in_string . ')';
        $query = str_replace(' IN', $str_replace, $query);
        $result = $db->prepare($query);
        if ($result->execute($paramsIn)) {
            $return = $result->fetchAll();
        } else {
            $error = $result->errorInfo();
            if (!empty($paramsIn)) {
                $str .= '\n          Ошибка: в запросе с IN не передан параметр c аргументом(ами) $params["IN"]';
            }
            $return = false;
        }
        Log::writeSqlLog($query, $paramsIn, $str, $executeStart, $error);
        return $return;
    }
    public static function executeQuery(string $query, array $params = [], string $PdoInstructionForReturn = '')
    {
        $executeStart=microtime(true);
        $error = array();
        $str = "";
        //Log::start();
        //Подключаемся к БД
        $db=self::getConnection();
        //Используем подготовленный запрос, для внесения записи в таблице БД
        $result = $db->prepare($query);
        //если переданы параметры - подставляем
        if (!empty($params)) {
            //Проверяем исключение (в случае если в запросе подставновка для LIMIT)
            //необходимо явно указывать тип INT иначе подставляет в кавычках и передает в БД
            if (substr_count($query, 'LIMIT')) {
                foreach ($params as $key => $value) {
                    $key = ':' . $key;
                    if (is_int($value) or ctype_digit($value)) {
                        $result->bindValue($key, $value, PDO::PARAM_INT);
                    } else {
                        $result->bindValue($key, $value);
                    }
                }
            } else {
                foreach ($params as $key => $value) {
                    $key = ':' . $key;
                    $result->bindValue($key, $value);
                }
            }
        }
        if ($result->execute()) {
            // Проверяем передавалась ли инструкция по формированию, если да - выполняем
            if (!empty($PdoInstructionForReturn)) {
                $str .= "\n     Инструкция '" . $PdoInstructionForReturn . "'";
                switch ($PdoInstructionForReturn) {
                    case self::LAST_INSERT_ID:
                        $return = $db->lastInsertId();
                        $str .= ' инициировала выполнение "$db->lastInsertId()"';
                        break;
                    case self::FETCH_COLUMN:
                        $return = $result->fetchColumn();
                        $str .= ' инициировала выполнение "PDOStatement::fetchColumn()"';
                        break;
                    case self::FETCH:
                        $return = $result->fetch();
                        $str .= ' инициировала выполнение "PDOStatement::fetch()"';
                        break;
                    case self::FETCH_ALL:
                        $return = $result->fetchAll();
                        $str .= ' инициировала выполнение "PDOStatement::fetchAll()"';
                        break;
                    default:
                        $return = 'Ошибка PDO инструкции.';
                }
            } else {
                $return = true;
            }
        }else{
            //Записываем, что об этом думает PDO
            $error = $result->errorInfo();
            //Надеятся на PDO неприходится, обрабатываем сами, пишем
            //1) нужное ли количество переданных параметров?;
            if (count($params) != substr_count($query, ":")) {
                $str .= "\n     Не соответствует количество параметров в запросе.";
            }
            //2) соответствует ли именование переданных параметров?;
            foreach ($params as $key => $value) {
                $key = $key . ' = :' . $key;
                $cond = substr_count($query, $key);
                if (!$cond) {
                    $str .= "\n     Не найдено параметра в запросе: " . $key;
                }
            }
            $return = false;
        }
        Log::writeSqlLog($query, $params, $str, $executeStart, $error);
        return $return;
    }
}
