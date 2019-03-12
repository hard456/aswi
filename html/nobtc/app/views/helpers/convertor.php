<?php
/*
 * Created on 20.7.2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class ConvertorHelper extends Helper
{

    /**
     * Funkce prevede datum ve formatu Y-m-d na format d.m.Y
     * */
    function convertDate($date)
    {
		$pattern = '/(\d+)-(\d+)-(\d+)/i';
		//+0 kvuli odstraneni pocatecnich nul (prevod na cislo)
		$day = preg_replace($pattern, '$3', $date) + 0;
		$month = preg_replace($pattern, '$2', $date) + 0;
		$year = preg_replace($pattern, '$1', $date) + 0;

		if ($day == 0 && $month == 0 && $year == 0) return '-';
		else return $day . '.' . $month . '.' . $year;
    }


	/**
	 *
	 * @param float $number cislo z zobrazeni
	 * @param integer $decimal pocet desetinych mist
	 *
	 * @return string cislo k vytisteni
	 */
    function convertNumber($number, $decimal = 2)
    {
		$number = round($number, $decimal);

		if (strpos($number, '.') == false) {
			if ($decimal > 0) {
				$number = $number . ',';
				for ($i = 0; $i < $decimal; $i++) $number = $number . '0';
			}
			return $number;
		}

		$pattern = '/(\d+).(\d+)/i';
		$convertedNumber = preg_replace($pattern, '$1' . ',' . '$2', $number);
		$decimalCount = strlen(preg_replace($pattern, '$2', $number));

		for ($i = 0; $i < $decimal - $decimalCount; $i++) $convertedNumber = $convertedNumber . '0';

		/*if ($decimal == -1) {
			$convertedNumber = preg_replace($pattern, '$1', $number);
		}*/

		return $convertedNumber;
    }

}

