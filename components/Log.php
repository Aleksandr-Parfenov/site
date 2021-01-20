<?php


class Log
{
    public static function writeSqlLog(string $query, array $params, string $str, $executeStart, array $error)
    {
        $str .= "\n     Запрос = '" . $query . "'";
        if (!empty($params)) {
            $str .= "\n     Параметры = " . json_encode($params);
        }
        if (empty($error)) {
            $str .= "\n     Запрос выполнен успешно.";
            $str.="\n     Время выполнения: ".round(microtime(true) - $executeStart, 2);
        } else {
            //Записываем также ошибки самой БД
            $str .= "\n     Запрос не выполнен";
            $str .= "\n          Сообщение об ошибке: "
                . $error[2] . "\n          Код ошибки SQLSTATE: " . $error[0]
                . "\n          Код ошибки, заданный драйвером: " . $error[1];
        }
        $log = fopen("sql.log", 'a') or die("не удалось создать файл");
        fwrite($log, "\n\n[".date('Y-m-d H:i:s')."]".$str);
        fclose($log);
    }
}