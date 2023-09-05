<?php
declare(strict_types=1);

namespace App\View;

use Cake\ORM\Entity;
use Cake\View\SerializedView;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

abstract class SpreadsheetView extends SerializedView
{
	/**
     * Default config options.
     *
     *
     * - `serialize`: Option to convert a set of view variables into a serialized response.
     *   Its value can be a string for single variable name or array for multiple
     *   names. If true all view variables will be serialized. If null or false
     *   normal view template will be rendered.
     * - `header`: A flat array of header column names.
     *
     * @var array<string, mixed>
     */
	protected $_defaultConfig = [
        'serialize' => null,
		'header' => null
    ];

    /**
     * Returns the classname of the writer to be used
     * 
     * @return string The class name of the writer
     */
    abstract protected function _getWriter(): string;

	/**
     * Serialize view vars.
     *
     * @param array|string $serialize The name(s) of the view variable(s) that
     *   need(s) to be serialized
     * @return string The serialized data.
     */
    protected function _serialize($serialize): string
    {
        $spreadsheet = new Spreadsheet();
        $activeSheet = $spreadsheet->getActiveSheet();

        $currentRow = 1;

		// Checks existence of headers for the file
        if (is_array($this->getConfig('header'))) {
            $activeSheet->fromArray($this->getConfig('header'), null, 'A' . $currentRow++);
        }

		// Serializes the data passed
        
        foreach ($this->viewVars[$serialize] as $data) {
            if ($data instanceof Entity) {
                $data = $data->toArray();
			}

            $activeSheet->fromArray($data, null, 'A' . $currentRow++);
        }

        // Writes data to a stream and retrieves it
        $tempStreamName = sprintf('php://temp_%s', microtime(true) * 10000);
		$tmpStream = fopen($tempStreamName, 'r+');
        $writerClass = $this->_getWriter();
        $writer = new $writerClass($spreadsheet);
        $writer->save($tmpStream);
        rewind($tmpStream);
        $content = stream_get_contents($tmpStream);
		fclose($tmpStream);
        $spreadsheet->disconnectWorksheets();

        return $content;
    }
}