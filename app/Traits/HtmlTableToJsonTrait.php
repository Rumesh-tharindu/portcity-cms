<?php

namespace App\Traits;

use DOMDocument;

trait HtmlTableToJsonTrait
{
    public static function tdrows($elements)
    {
    $str = [];
    foreach ($elements as $element) {
            $str[] = $element->nodeValue;
    }

    return $str;
    }

    public static function htmlTableToJson($contents = null)
    {
    $DOM = new DOMDocument();
    $DOM->loadHTML($contents);

    $items = $DOM->getElementsByTagName('tr');

    $tableRowArr = [];
    foreach ($items as $node) {
            $tableRowArr[] = self::tdrows($node->childNodes);
    }

    return $tableRowArr;
    }

}
