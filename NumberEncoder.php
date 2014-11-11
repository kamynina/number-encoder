<?php
/**
 * @author: gabby
 * @date: 11.11.14 23:10
 */
class NumberEncoder {

    /** @var array */
    private $alphabet = array();

    /** @var int might of alphabet (count of symbols in alphabet) */
    private $foundation;

    public function __construct(array $alphabet) {
        $this->alphabet = $alphabet;
        $this->foundation = count($alphabet);
    }


    /**
     * Exponent of foundation nearest and less of the number
     *
     * @param int $number
     * @return int
     */
    private function getNearestExponent($number) {
        $i = 0;
        while (pow($this->foundation, $i + 1) <= $number) {
            $i++;
        }
        return $i;
    }

    public function encode($inputValue) {
        $series = array();
        $number = $inputValue;
        $exponent = $this->getNearestExponent($number);
        while ($exponent >= 0) {
            $weight = pow($this->foundation, $exponent);
            if ($number >= $weight) {
                $multiplier = floor($number/$weight);
                $member = $multiplier * $weight;
                $number -= $member;
            } else {
                $multiplier = 0;
            }
            array_push($series, $this->encodeToChar($multiplier));
            $exponent--;
        }
        return implode("", $series);
    }

    /**
     * Encode to char from alphabet (get by index)
     *
     * @param $number
     * @return mixed
     * @throws Exception
     */
    private function encodeToChar($number) {
        if (!isset($this->alphabet[$number])) {
            throw new Exception("Wrong alphabet given");
        }
        return $this->alphabet[$number];
    }
}
?>
