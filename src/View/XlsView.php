<?php
declare(strict_types=1);

namespace App\View;

use App\View\SpreadsheetView;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

/**
 * Xls view
 * 
 * Handles Xls file generation
 */
class XlsView extends SpreadsheetView
{
	/**
     * xls layouts are located in the xls subdirectory of `Layouts/`
     *
     * @var string
     */
    protected $layoutPath = 'xls';

    /**
     * xls views are located in the 'xls' subdirectory for controllers' views.
     *
     * @var string
     */
    protected $subDir = 'xls';

	/**
     * Returns the classname of the writer to be used
     * 
     * @return string The class name of the writer
     */
    protected function _getWriter(): string
	{
		return Xls::class;
	}

	/**
     * Mime-type this view class renders as.
     *
     * @return string The content type.
     */
    public static function contentType(): string
    {
        return 'application/vnd.ms-excel';
    }
}