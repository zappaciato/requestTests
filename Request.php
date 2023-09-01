<?php

class Request {

    public string $address;
    public int $port; 
    public string $httpMethod; 

    private function currentPort($address) {
        // tutaj rozbijamy address zeby uzyskac info czy jest http czy https
        $addressPort = substr($address, 0, 5);
        if ($addressPort == "http") {
            $port = 80;
        } else {
            $port = 442;
        }

        return $port;
    }

    private function httpMethod() {
        
    }

    private function validateData() {

        if (!isset($this->address)) {
            throw new Exception('No address given');
        } else {
            
        }
    }

    public function sendRqs ()
    {
        $this->validateData();
        echo "I am sending the request NOW!";
    }
}


//popularne klasy do wysylania requestow (port 80, 442 https) czy http czy https;

//metody magiczne, __set()
//jeśli ustawiamy adres zaczynający się od http, automatycznie ustawimy też $this->port 80, jeśli https 442
//możemy ręcznie zmienić $this->port

//w sendRqs wysłać realny request, sprawdzić kod odpowiedzi i zwrócić
//zobacz jak działają inne klasy do requestów, np. ta z laravel, przykładowo kod odpowiedzi pobiera się metodą getCode() więc taka publiczna metoda powinna być w Request class
//HTTP methods