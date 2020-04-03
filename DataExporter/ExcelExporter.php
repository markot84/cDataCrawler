<?php

require_once 'DataExporter/DataExporter.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Class ExcelExporter
 */
class ExcelExporter implements DataExporter
{
    /**
     * @var resource $spreadsheet
     */
    private $spreadsheet;
    /**
     * @var resource $sheet
     */
    private $sheet;

    /**
     * ExcelExporter constructor.
     * @return ExcelExporter | false
     */
    public function __construct()
    {
        $this->spreadsheet = new Spreadsheet();

        try {
            $this->sheet = $this->spreadsheet->getActiveSheet();
            return $this;
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /**
     * Writes the data to spreadsheet
     *
     * @var $data
     */
    public function writeData($data)
    {
        $letters = range('A', 'Z');
        $i = 2;

        $this->sheet->setCellValue('A1', 'Country');
        $this->sheet->setCellValue('B1', 'Total Cases');
        $this->sheet->setCellValue('C1', 'New Cases');
        $this->sheet->setCellValue('D1', 'Total Deaths');
        $this->sheet->setCellValue('E1', 'New Deaths');
        $this->sheet->setCellValue('F1', 'Total Recovered');
        $this->sheet->setCellValue('G1', 'Active Cases');
        $this->sheet->setCellValue('H1', 'Serious Cases');
        $this->sheet->setCellValue('I1', 'Total Cases / 1M pop');
        $this->sheet->setCellValue('J1', 'Total Deaths / 1M pop');

        foreach ($data as $countryData) {
            foreach ($countryData as $key=>$value) {
                $this->sheet->setCellValue($letters[$key].$i, $value);
            }
            $i++;
        }
    }

    /**
     * Exports the xlsx file
     */
    public function exportData()
    {
        $writer = new Xlsx($this->spreadsheet);
        try {
            $writer->save('COVID-REPORT.xlsx');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}