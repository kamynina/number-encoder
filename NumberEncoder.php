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
        while ($this->calcMultiplier($i + 1) <= $number) {
            $i++;
        }
        return $i;
    }

    /**
     * Calc multiplier depends of number position
     *
     * @param int $position
     * @return number
     */
    private function calcMultiplier($position) {
        return pow($this->foundation, $position);
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
     * Decode input string from sign system to decimals system
     *
     * @param $inputValue
     * @return int
     * @throws Exception
     */
    public function decode($inputValue) {
        $result = 0;
        foreach ( $inputValue as $position => $value ) {
            $result += $this->decodeFromChar ( $value ) * $this->calcMultiplier ( $position );
        }
        return $result;
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

    /**
     * Decode char
     *
     * @param $char
     * @return int
     * @throws Exception
     */
    private function decodeFromChar($char) {
        $number = array_search($char, $this->alphabet);
        if ($number === false) {
            throw new Exception("No supported chart " . $char);
        }
        return $number;
    }

}
?>
