<?php
/**
 * @var \App\View\AppView $this
 * @var array<array> $contacts
 */

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

// Gets field names
$fields = [array_keys($contacts[0])];

// Builds spreadsheet from array
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->fromArray($fields, null, 'A1');
$sheet->fromArray($contacts, null, 'A2');
$writer = new Xlsx($spreadsheet);
$writer->save('php://output'); // Saves file to stream