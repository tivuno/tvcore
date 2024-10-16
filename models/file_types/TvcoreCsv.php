<?php

class TvcoreCsv
{
    public static function getRowData(
        $file_link,
        int $node_index,
        int $exclude_rows = 1,
        string $delimiter = ';'
    ) {
        $file_contents = file_get_contents($file_link);
        $lines = explode(PHP_EOL, $file_contents);
        if ($exclude_rows == 0) {

        } else {
            if (isset($lines[$node_index])) {
                $row = explode($delimiter, $lines[$node_index]);
                if (sizeof($row) == 1) {
                    if ($delimiter == ';') {
                        $delimiter = ',';
                    } else {
                        $delimiter = ';';
                    }
                }
                return explode($delimiter, $lines[$node_index]);
            }
        }
    }

    public static function getRowsCount(string $file_path, int $exclude_rows = 0): int
    {
        $file_contents = file_get_contents($file_path);
        $lines = explode(PHP_EOL, $file_contents);
        $last_index = sizeof($lines) - 1;
        if ($lines[$last_index] == '') {
            unset($lines[$last_index]);
        }

        return sizeof($lines) - $exclude_rows;
    }
}
