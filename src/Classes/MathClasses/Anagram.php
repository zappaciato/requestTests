<?php

namespace Kris\TestProject\Classes\MathClasses;

class Anagram {

    private string $wordOne;
    private string $wordTwo;
    private array $words;
    private bool $result = false;


    public function __construct($wordOne, $wordTwo)
    {
        $this->wordOne = $wordOne;
        $this->wordTwo = $wordTwo;
    }

    private function validateText() : array {
        echo " i am validating text";
        //string to lower so the letters are the same case
        strtolower($this->wordOne);
        strtolower($this->wordTwo);

        //remove spaces at the front and back
        trim($this->wordOne);
        trim($this->wordTwo);

        if (str_word_count($this->wordOne) == 1 && str_word_count($this->wordTwo) == 1) {
            echo "One word no spaces";
            //add spaces after each character to use explode and compare two arrays
            $formattedWordOne = implode(' ', str_split($this->wordOne));
            $formattedWordTwo = implode(' ', str_split($this->wordTwo));
            $formattedWordOne = explode(' ', $formattedWordOne);
            $formattedWordTwo = explode(' ', $formattedWordTwo);

            $this->words = ['wordOne' => $formattedWordOne, 'wordTwo' => $formattedWordTwo];


        } else {

            echo "There are either two words or there's space between";
            $this->words = null;
        }

        return $this->words;
    }

    private function checkAnagram() : bool {
        echo "  I am checking the anagram   ";

        $this->validateText();
        print_r($this->words);

            if(!empty($this->words)) {

                echo " =-=============I am IN IF IN check Anagram   ";

            // $arrayDiff = array_diff($this->words['wordOne'],$this->words['wordTwo']) ? array_diff($this->words['wordOne'], $this->words['wordTwo']) : " There is no difference between those words ";

            $arrayDiff = array_diff($this->words['wordOne'], $this->words['wordTwo']) ? $this->result = 0 : $this->result = 1;

            // $this->result = empty($arrayDiff) ? 1 : 0;

            }



        return $this->result;

    }

    public function displayAnagramResults() : string {
        
        //check anagram will return false (0), if the arrays are the same;
        
        if($this->checkAnagram()) {

            $message = " Word: " . "\"" . $this->wordOne .  "\"" . " and Word: " .   "\"" . $this->wordTwo .  "\"" . " are ANAGRAMS ";
            // echo "Word: " . $this->wordOne . " and Word: " . $this->wordTwo . " are ANAGRAMS";
        } else {
            $message = " Word: " . $this->wordOne . " and Word: " . $this->wordTwo . " are NOT (!!!) ANAGRAMS ";
        };

        return print_r($message);

    }
}