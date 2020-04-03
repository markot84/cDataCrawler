<?php

/**
 * Interface DataExporter
 */
interface DataExporter
{
    public function writeData($data);
    public function exportData();
}