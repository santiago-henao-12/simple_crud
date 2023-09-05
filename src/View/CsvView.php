<?php
declare(strict_types=1);

namespace App\View;

use App\View\SpreadsheetView;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

/**
 * Csv view
 * 
 * Handles Csv file generation
 */
class CsvView extends SpreadsheetView
{
	/**
     * csv layouts are located in the csv subdirectory of `Layouts/`
     *
     * @var string
     */
    protected $layoutPath = 'csv';

    /**
     * csv views are located in the 'csv' subdirectory for controllers' views.
     *
     * @var string
     */
    protected $subDir = 'csv';

	/**
     * Returns the classname of the writer to be used
     * 
     * @return string The class name of the writer
     */
    protected function _getWriter(): string
	{
		return Csv::class;
	}

	/**
     * Mime-type this view class renders as.
     *
     * @return string The content type.
     */
    public static function contentType(): string
    {
        return 'text/csv';
    }
}