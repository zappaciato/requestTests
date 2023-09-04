<?php

class Request
{

    public string $url;
    public int $port;
    public string $httpMethod;
    public array $curlData;

    public function getCurrentPort($url)
    {
        $addressPort = substr($url, 0, 5);
        if ($addressPort == "https") {
            $port = 442;
        } else {
            $port = 80;
        }

        return $port;
    }


    private function validateData()
    {

        if (!isset($this->url)) {
            throw new Exception('No address given');
        }

        if (!isset($this->httpMethod)) {
            throw new Exception('No valid HTTPMethod given');
        } else {
            // echo $this->httpMethod;
            // ten switch robilem po to zeby zwalidowac poprawność wpisanej metody http. Mozna to inaczej ale pomyslalem, ze ten sposob bedzie ok w razie gdyby jeszcze zostaly inne rzeczy do walidacji specyficzne do kazdej z tych metod. 
            switch (strtoupper($this->httpMethod)) {

                case 'POST':
                    $this->httpMethod = 'POST';
                    break;

                case 'GET':
                    $this->httpMethod = 'GET';
                    break;
                    //tu jednak cos mi mowi, ze nie jest ok jak default zwraca incorrect method given.. ale nie mam pewnosci
                default:
                    throw new Exception('Incorrect httpMethod given!');
            }
        }
    }

    // poniższa metoda wyswietli nam status wraz ze znaczeniem. 
    public function statusCodeDisplay($e)
    {
        switch ($e) {
            case 404:
                $e = 404 . " Not found!!! ";
                echo $e;
                break;

            case 405:
                $e = 404 . " Method Not Allowed!!! ";
                echo $e;
                break;

            case 200:
                $e = 200 . " OK!!! ";
                echo $e;
                break;

            case 302:
                $e = 302 . " Found!!! ";
                echo $e;
                break;
        }
    }

    public function sendRqs()
    {
        $this->validateData();
        //tutaj wzialem pod uwage jedyne dwie metody, jesli wiecej to bym robil elseif. Po sprawdzeniu ktora to metoda odpala odpowiednia metode
        if ($this->httpMethod == "POST") {

            $this->curlPOSTRqs();
        } else {

            $this->curlGETRqs();
        }
    }

    public function curlPOSTRqs()
    {

        //dummy dane do POST
        $postRequest = array(
            'firstFieldData' => 'foo',
            'secondFieldData' => 'bar'
        );
        $curlData = $this->curlInit($postRequest);
        // $msg = "I am sending the POST request NOW! Port: " . $this->port . " HttpMethod: " . $this->httpMethod . ' //  ' . $this->statusCodeDisplay($curlData['status_code']);
        print_r($curlData);

        // Log::getLog($msg, $curlData);
    }


    public function curlGETRqs()
    {

        $curlData = $this->curlInit();

        // $msg = "I am sending the GET request NOW! Port: " . $this->port . " HttpMethod: " . $this->httpMethod . ' //  ' .
        //     $this->statusCodeDisplay($curlData['status_code']);

        //czy w takim wypadku to tak powinno sie robic, czy static function.. ? 
        // $log = new Log();
        // $log->getLog($curlData);
        // Log::getLog($msg);
        print_r($curlData);
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
            curl_setopt($ch, CURLOPT_POST, true); //z 1 nie chce zadziałać..

            curl_close($ch);
            // array_push();
            $curlData = ['ch' => $ch, 'server_output' => $server_output, 'status_code' => $statusCode];
            // Log::getLog("This is CurlData:: ", $curlData);
        } else {

            curl_close($ch);
            // array_push();
            $curlData = ['ch' => $ch, 'server_output' => $server_output, 'status_code' => $statusCode];
            // Log::getLog("This is CurlData:: ", $curlData);
        }

        // Log::getLog("This is CurlData:: ", $curlData);
        return $curlData;
    }
}
