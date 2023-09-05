<?php

namespace Kris\TestProject\Classes;

use Kris\TestProject\Classes\DefinedVaribles;
use Kris\TestProject\Classes\Database;
use Exception;

// include "../src/Classes/interfaces/DefinedVaribles.php";
// use Kris\TestProject\Classes\interfaces\DefinedVaribles;
// use TrainingApp\DefinedVaribles;
// use Exception;


class Request implements DefinedVaribles
{

    public string $url;
    public int $port = 80;
    public string $httpMethod;

    private array $allowedHttppMethods = DefinedVaribles::HTTP_METHODS;
    private array $httpStatusCodes = DefinedVaribles::HTTP_STATUS_CODES;

    // dopytac czy i kiedy lepiej dzialac w ten sposob; czyli dodaje wartosci default w momencie odpalenia instancji klasy; 
    // public function __construct()
    // {
    //     $this->url = "https://stackoverflow.com/questions/49948856/phpunit-testing-constructorless-class";
    //     $this->port = 80;
    //     $this->httpMethod = "GET";
    // }

    private function updatePort()
    {
        // echo "  I am updating port number.  ";
        $addressPort = substr($this->url, 0, 5);
        if (strtolower($addressPort) == "https") {
            $this->port = 442;
        } 
    }


    private function validateData()
    { 
        $this->updatePort();
        // echo "  I am validating data!  ";
        if (!isset($this->url)) {
            throw new Exception('No valid or no address given');
        }

        if (!in_array($this->httpMethod ?? null, $this->allowedHttppMethods)) {
            throw new Exception('No valid or incorrect HTTPMethod given');
        } 

    }

    private function statusCodeMessage($e)
    {
        echo " I am checking STATUS Code  ";
        // if (!array_key_exists($e ?? null, $this->httpStatusCodes))
        if(isset($httpStatusCodes[$e])) {
            echo "  No Status code in the Database! " . $e;
        } else {
            echo "  This is the STATUS CODE info: " . $this->httpStatusCodes[$e];
        }
        //tutaj zwracam, zeby wyswietlic info  w displycurrent data
        return $this->httpStatusCodes[$e];
    }

    public function sendRqs()
    {
        // echo "i am sending the request!  ";
        $this->validateData();

        if ($this->httpMethod == "POST") {

            $this->curlPOSTRqs();
        } else {

            $this->curlGETRqs();
        }
    }

    public function curlPOSTRqs()
    {
        // echo "  I am doin the POSTrqs  ";
        //dummy dane do POST
        $postRequest = array(
            'firstFieldData' => 'foo',
            'secondFieldData' => 'bar'
        );
        $this->curlInit($postRequest);

    }


    public function curlGETRqs()
    {
        $this->curlInit();

    }

    private function curlInit($postRequest = null)
    {

        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($this->httpMethod == "POST") {

            curl_setopt($ch, CURLOPT_POSTFIELDS, $postRequest);
            curl_setopt($ch, CURLOPT_POST, 1);
            $curlData = ['ch' => $ch, 'server_output' => $server_output, 'status_code' => $statusCode];
            $this->displayCurrentData($curlData);

        } 
            
        $curlData = ['ch' => $ch, 'server_output' => $server_output, 'status_code' => $statusCode];

        curl_close($ch);
        $this->displayCurrentData($curlData);
        

    }


    public function displayCurrentData(array $dataFeed){

        $port = $this->port;
        $method = $this->httpMethod;
        $statusCode = $dataFeed['status_code'];
        $statusCodeMsg = $this->statusCodeMessage($statusCode);
        $serverOutput = $dataFeed['server_output'];

        $data = [
            'port' => $port,
            'httpMethod' => $method,
            'statusCode' => $statusCode . " :: " . $statusCodeMsg,
            'server_output' => $serverOutput
        ];

        print_r($data);
    }

    //to nie powinno byc tutaj
    // public function connect_db() {
    //     $user = "root";
    //     $host = "localhost";
    //     $pwd = "";
    //     $db_name = "Kris_db";
    //     $db = new Database($host, $user, $pwd, $db_name);
    //     $link = $db->connect();
    //     print_r($link);
    //     return $link;
    //     // print_r($db);

    // }

}

    

//popularne klasy do wysylania requestow (port 80, 442 https) czy http czy https;

//metody magiczne, __set()
//jeśli ustawiamy adres zaczynający się od http, automatycznie ustawimy też $this->port 80, jeśli https 442
//możemy ręcznie zmienić $this->port

//w sendRqs wysłać realny request, sprawdzić kod odpowiedzi i zwrócić
//zobacz jak działają inne klasy do requestów, np. ta z laravel, przykładowo kod odpowiedzi pobiera się metodą getCode() więc taka publiczna metoda powinna być w Request class
//HTTP methods