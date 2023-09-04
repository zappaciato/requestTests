<?php

class Request
{

    public string $url;
    public int $port = 80;
    public string $httpMethod;
    public array $curlData;
    private array $allowedHttppMethods = ['POST', 'GET'];

    private array $httpStatusCodes = [

        100 => 'Informational: Continue',
        101 => 'Informational: Switching Protocols',
        102 => 'Informational: Processing',
        200 => 'Successful: OK',
        201 => 'Successful: Created',
        202 => 'Successful: Accepted',
        203 => 'Successful: Non-Authoritative Information',
        204 => 'Successful: No Content',
        205 => 'Successful: Reset Content',
        206 => 'Successful: Partial Content',
        207 => 'Successful: Multi-Status',
        208 => 'Successful: Already Reported',
        226 => 'Successful: IM Used',
        300 => 'Redirection: Multiple Choices',
        301 => 'Redirection: Moved Permanently',
        302 => 'Redirection: Found',
        303 => 'Redirection: See Other',
        304 => 'Redirection: Not Modified',
        305 => 'Redirection: Use Proxy',
        306 => 'Redirection: Switch Proxy',
        307 => 'Redirection: Temporary Redirect',
        308 => 'Redirection: Permanent Redirect',
        400 => 'Client Error: Bad Request',
        401 => 'Client Error: Unauthorized',
        402 => 'Client Error: Payment Required',
        403 => 'Client Error: Forbidden',
        404 => 'Client Error: Not Found',
        405 => 'Client Error: Method Not Allowed',
        406 => 'Client Error: Not Acceptable',
        407 => 'Client Error: Proxy Authentication Required',
        408 => 'Client Error: Request Timeout',
        409 => 'Client Error: Conflict',
        410 => 'Client Error: Gone',
        411 => 'Client Error: Length Required',
        412 => 'Client Error: Precondition Failed',
        413 => 'Client Error: Request Entity Too Large',
        414 => 'Client Error: Request-URI Too Long',
        415 => 'Client Error: Unsupported Media Type',
        416 => 'Client Error: Requested Range Not Satisfiable',
        417 => 'Client Error: Expectation Failed',
        418 => 'Client Error: I\'m a teapot',
        419 => 'Client Error: Authentication Timeout',
        420 => 'Client Error: Enhance Your Calm',
        420 => 'Client Error: Method Failure',
        422 => 'Client Error: Unprocessable Entity',
        423 => 'Client Error: Locked',
        424 => 'Client Error: Failed Dependency',
        424 => 'Client Error: Method Failure',
        425 => 'Client Error: Unordered Collection',
        426 => 'Client Error: Upgrade Required',
        428 => 'Client Error: Precondition Required',
        429 => 'Client Error: Too Many Requests',
        431 => 'Client Error: Request Header Fields Too Large',
        444 => 'Client Error: No Response',
        449 => 'Client Error: Retry With',
        450 => 'Client Error: Blocked by Windows Parental Controls',
        451 => 'Client Error: Redirect',
        451 => 'Client Error: Unavailable For Legal Reasons',
        494 => 'Client Error: Request Header Too Large',
        495 => 'Client Error: Cert Error',
        496 => 'Client Error: No Cert',
        497 => 'Client Error: HTTP to HTTPS',
        499 => 'Client Error: Client Closed Request',
        500 => 'Server Error: Internal Server Error',
        501 => 'Server Error: Not Implemented',
        502 => 'Server Error: Bad Gateway',
        503 => 'Server Error: Service Unavailable',
        504 => 'Server Error: Gateway Timeout',
        505 => 'Server Error: HTTP Version Not Supported',
        506 => 'Server Error: Variant Also Negotiates',
        507 => 'Server Error: Insufficient Storage',
        508 => 'Server Error: Loop Detected',
        509 => 'Server Error: Bandwidth Limit Exceeded',
        510 => 'Server Error: Not Extended',
        511 => 'Server Error: Network Authentication Required',
        598 => 'Server Error: Network read timeout error',
        599 => 'Server Error: Network connect timeout error',

    ];


    private function updatePort()
    {
        $addressPort = substr($this->url, 0, 5);
        if (strtolower($addressPort) == "https") {
            $this->port = 442;
        }
    }


    private function validateData()
    {

        if (!isset($this->url)) {
            throw new Exception('No address given');
        }

        // echo $this->httpMethod ?? 'brak';

        // if (isset($this->httpMethod)) {
        //    echo $this->httpMethod;
        //} else {
        //    echo 'brak';
        //}

        //echo $this->httpMethod ? strtoupper($this->httpMethod) : "BRAK";
        // echo $this->httpMethod;
        // print_r($this->allowedHttppMethods);

        // if (in_array(null, ['GET', 'POST'])) {
        //     echo 'JEST!11';
        // }
        // $httpMethod = $this->httpMethod ?? '';

        if (!in_array($this->httpMethod ?? null, $this->allowedHttppMethods)) {
            throw new Exception('No valid HTTPMethod given');
        } 


        // if (!isset($this->httpMethod) || in_array($this->httpMethod, $this->allowedHttppMethods)) {
        //     throw new Exception('No valid HTTPMethod given');
        // } 

    }

    // poniższa metoda wyswietli nam status wraz ze znaczeniem.zrpbic tak samo jak wyzej; mapowanie wartosci;
    // (isset($this->allowedHttppMethods[$this->httpMethod]))
    // $statusCodes = [404 => ['message => 'Not found], 500 => ['message' => 'error']]

    // $statusCodes = [404 => ['message' => 'Not found'], 500 => ['message' => 'error']];

    // $statusCodes[500]['message'];

    public function statusCodeDisplay($e)
    {
        
// (!in_array($this->httpMethod ?? null, $this->http)) 
        if(!array_key_exists($e ?? null, $this->httpStatusCodes)) {
            echo "no status code given or wrong status code!";
        } else {
            echo $this->httpStatusCodes[$e];
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
        $msg = "I am sending the POST request NOW! Port: " . $this->port . " HttpMethod: " . $this->httpMethod . ' //  ' . $this->statusCodeDisplay($curlData['status_code']);

        // Log::getLog($msg, $curlData);
    }


    public function curlGETRqs()
    {

        $curlData = $this->curlInit();

        $msg = "I am sending the GET request NOW! Port: " . $this->port . " HttpMethod: " . $this->httpMethod . ' //  ';
            // $this->statusCodeDisplay($curlData['status_code']);

        //czy w takim wypadku to tak powinno sie robic, czy static function.. ? 
        // $log = new Log();
        // $log->getLog($curlData);
        // Log::getLog($msg);

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
            curl_setopt($ch, CURLOPT_POST, true);

            $curlData = ['ch' => $ch, 'server_output' => $server_output, 'status_code' => $statusCode];
        }

        curl_close($ch);
        $curlData = ['ch' => $ch, 'server_output' => $server_output, 'status_code' => $statusCode];

        // Log::getLog("This is CurlData:: ", $curlData);
        return $curlData;
    }
}


//popularne klasy do wysylania requestow (port 80, 442 https) czy http czy https;

//metody magiczne, __set()
//jeśli ustawiamy adres zaczynający się od http, automatycznie ustawimy też $this->port 80, jeśli https 442
//możemy ręcznie zmienić $this->port

//w sendRqs wysłać realny request, sprawdzić kod odpowiedzi i zwrócić
//zobacz jak działają inne klasy do requestów, np. ta z laravel, przykładowo kod odpowiedzi pobiera się metodą getCode() więc taka publiczna metoda powinna być w Request class
//HTTP methods