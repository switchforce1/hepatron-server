<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 19/08/2018
 * Time: 20:32
 */

namespace App\Helper\Middle;


class CsvHelper
{
    /**
     * @param string $filePath
     * @param string $delimiter
     * @param int $limit
     *
     * @throws \Exception
     *
     * @return array
     */
    public function readData(string $filePath, string $delimiter = ',', int $limit = 1000)
    {
        $data = [];
        $row = 1;
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            while (($lineData = fgetcsv($handle, $limit, $delimiter)) !== FALSE) {
                $data[] = $lineData;
                $row++;
            }
            fclose($handle);
        }else{
            throw new \Exception("Impossible de lire dans le fichier : ".$filePath);
        }
        return $data;
    }

    /**
     * @param string $filePath
     * @param array $rowData
     * @param int $position  La position ou inserer la ligne
     * @return bool
     */
    public function addRow(string $filePath, array $rowData, int $position = -1)
    {
        $success = false;

        return $success;
    }

    /**
     * @param string $filePath
     * @param array $rowsData
     * @param bool $replaceAll
     * @return bool
     */
    public function addRows(string $filePath, array $rowsData, $replaceAll = false)
    {
        $success = false;

        foreach ($rowsData as $key => $rowData){
            $this->addRow($filePath, $rowsData);
        }

        return $success;
    }
}