<?php

namespace Kris\TestProject\Classes\MathClasses;

class Anagram {

    public string $wordOne;
    public string $wordTwo;
    private array $formattedWords = [];

    public function __construct($wordOne, $wordTwo) {

        $this->wordOne = $wordOne;
        $this->wordTwo = $wordTwo;

    }

    private function implodeStrings() : void {

        $this->wordOne = implode(' ', str_split($this->wordOne,1));
        $this->wordTwo = implode(' ', str_split($this->wordTwo,1));

    }

    private function explodeStrings(): void {

        $formattedWordOne = explode(' ', $this->wordOne);
        $formattedWordTwo = explode(' ', $this->wordTwo);

        $this->formattedWords = ['wordOne' => $formattedWordOne, 'wordTwo' => $formattedWordTwo];

    }

    private function sortArray() : void {

        sort($this->formattedWords['wordOne']);
        sort($this->formattedWords['wordTwo']);

    }

    private function prepareForComparison() : void {

        if (str_word_count($this->wordOne) == 1 && str_word_count($this->wordTwo) == 1) {

            $this->implodeStrings($this->wordOne, $this->wordTwo);
            $this->explodeStrings($this->wordOne, $this->wordTwo);
            $this->sortArray($this->formattedWords);

            print_r($this->formattedWords);

        } else {

            echo "There are either two words or there's space between";

        }

    }

    private function trimStrings() : void {

        $this->wordOne = trim($this->wordOne);
        $this->wordTwo = trim($this->wordTwo);
    }

    private function makeLowerCaseStrings () : void {

        $this->wordOne = strtolower($this->wordOne);
        $this->wordTwo = strtolower($this->wordTwo);

    }

    private function prepareText() : array {

        if ($this->wordOne !== '' && $this->wordTwo !== '') { //czy tu mozna uzyc tez isset?

            $this->makeLowerCaseStrings();
            $this->trimStrings();
            $this->prepareForComparison();

            return $this->formattedWords;
            
        } else {

            echo "One word is missing.";
            return $this->formattedWords;
        }
    }

    private function checkAnagram() : array {

        $arrayDiff = [];
        echo " i am PREPARING text";
        $this->prepareText();
        $arrayDiff = $this->getDifference();

        return $arrayDiff;

    }

    private function getDifference() : array {

        if ($this->formattedWords['wordOne'] && $this->formattedWords['wordTwo']) {
            $arrayDiff = array_merge(array_diff_assoc($this->formattedWords['wordOne'], $this->formattedWords['wordTwo']), array_diff_assoc($this->formattedWords['wordTwo'], $this->formattedWords['wordOne']));

            echo "differemncececcccccccccccccccccccccccccccccccc";
            print_r($arrayDiff);

        } else {
            $arrayDiff = [];
        }
        
        return $arrayDiff;
    }

    public function displayAnagramResults() : array {
        
        $arrayDiff = $this->checkAnagram();

        return $arrayDiff;

    }
}