<?php

class ViewHelper
{
    /**
     * Подсветка нажатого типа сортировки
     * @param bool $isHighlight - тип сортировки
     * @return string - цвет подсветки текста
     */
    public static function highlightWithRed(bool $isHighlight = true)
    {
        return $isHighlight ?  'style="color: red"' : '';
    }

}