<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

date_default_timezone_set('Europe/London');

/** Include PHPExcel_IOFactory */
require_once dirname(__FILE__) . '/../Classes/PHPExcel/IOFactory.php';


if (!file_exists("05featuredemo.xlsx")) {
	exit("Please run 05featuredemo.php first." . EOL);
}

$inputFileName = "05featuredemo.xlsx";
$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
// Load the workbook and extract sheet list and basic info. This is robust and avoids
// relying on reader-specific helper methods that may not be present in all builds.
try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
	$sheetList = [];
	$sheetInfo = [];
	foreach ($objPHPExcel->getAllSheets() as $sheet) {
		$title = $sheet->getTitle();
		$sheetList[] = $title;
		$highestCol = $sheet->getHighestColumn();
		$highestRow = $sheet->getHighestRow();
		$totalColumns = PHPExcel_Cell::columnIndexFromString($highestCol);
		$sheetInfo[] = [
			'worksheetName' => $title,
			'lastColumnIndex' => $totalColumns - 1,
			'totalRows' => $highestRow,
			'totalColumns' => $totalColumns,
		];
	}
} catch (Exception $e) {
	$sheetList = [];
	$sheetInfo = [];
}

echo 'File Type:', PHP_EOL;
var_dump($inputFileType);

echo 'Worksheet Names:', PHP_EOL;
var_dump($sheetList);

echo 'Worksheet Names:', PHP_EOL;
var_dump($sheetInfo);

