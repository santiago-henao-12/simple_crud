<?php
declare(strict_types=1);

namespace App\View;

use App\View\SpreadsheetView;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

/**
 * Text view
 * 
 * Handles Text file generation
 */
class TextView extends SpreadsheetView
{
	/**
     * text layouts are located in the text subdirectory of `Layouts/`
     *
     * @var string
     */
    protected $layoutPath = 'txt';

    /**
     * text views are located in the 'text' subdirectory for controllers' views.
     *
     * @var string
     */
    protected $subDir = 'txt';

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
        return 'text/plain';
    }
}