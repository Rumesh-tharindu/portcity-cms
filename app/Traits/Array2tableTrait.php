<?php

namespace App\Traits;

trait Array2tableTrait
{
    public function array2table($array, $recursive = false, $null = '&nbsp;')
    {

        // Sanity check
        if (empty($array) || ! is_array($array)) {
            return null;
        }
        if (! isset($array[1]) || ! is_array($array[1])) {
            $array = [$array];
        }
        // Start the table
        $table = '<table class="table table-responsive table-bordered table-striped">'."\n";
        // The header
        $table .= "\t<tr>";
        //Add an abitrary serial number S/N
        $table .= '<th>Id</th>';
        // Take the keys from the first row as the headings
        foreach (array_keys(reset($array)) as $heading) {
            $table .= '<th class="text-capitalize">'.str_replace('_', ' ', $heading).'</th>';
        }
        $table .= "</tr>\n";
        // The body
        $i = 1;
        foreach ($array as $key => $row) {
            $table .= "\t<tr>";
            $table .= '<td>'.$i++.'</td>';
            foreach ($row as $cell) {
                $table .= '<td>';
                // Cast objects
                if (is_object($cell)) {
                    $cell = (array) $cell;
                }
                if ($recursive === true && is_array($cell) && ! empty($cell)) {
                    // Recursive mode
                    $table .= "\n".$this->array2table($cell, true, true)."\n";
                } else {
                    //$tooltip = "gettype(): " . strtoupper(gettype($cell));
                    $table .= /* '<span title="' . $tooltip . '">' . */ (strlen($cell) > 0 ? htmlspecialchars((string) $cell) : $null) /* . '</span>' */;
                }
                $table .= '</td>';
            }
            $table .= "</tr>\n";
        }
        $table .= '</table>';

        return $table;
    }
}
