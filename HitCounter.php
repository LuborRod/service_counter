<?php


class HitCounter
{
    //filename containing the total number of ips
    private string $totIpsFile;

    //filename containing the data for visits
    private string $logfile;

    //ip for current user
    private string $ip;

    // array of ips
    private  array $arrayOfIps;

    /**
     * HitCounter constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->totIpsFile = $this->createFileIfNotExists('totalIps.json');
        $this->logfile = $this->createFileIfNotExists('visits.txt');
        $this->arrayOfIps = $this->getArrayOfIpsFromFile();
    }


    public function getNumbersOfUsers()
    {
        if (!$this->checkIfIpExists() || empty($this->arrayOfIps)) {
            $this->addNewIpToFileAndSave();
        }
        $this->logData();

        $countUsers = count($this->getArrayOfIpsFromFile());

        echo "Number of users which opened current page of website - $countUsers";
    }


    /**
     * @return array|false
     */
    public function getLogRecords()
    {
        var_dump(file($this->logfile));
    }


    /**
     * @param $fileName
     * @return string
     * @throws Exception
     */
    private function createFileIfNotExists($fileName)
    {
        if (!file_exists(__DIR__ . "/$fileName")) {
            if (touch("$fileName")) {
                return __DIR__ . "/$fileName";
            } else {
                throw new Exception("You can`t create file. You have to check your access modes");
            }
        }

        return __DIR__ . "/$fileName";
    }


    private function logData(): void
    {
        //update the counter logfile
        //get the referer to my home page(if necessary)
        $serverName = $_SERVER['SERVER_ADDR'] ?? $_SERVER['SERVER_NAME'];

        if (isset($_SESSION['visitorUrl'])) {
            $referer = $_SESSION['visitorUrl'];
        } else {
            $referer = '';
        }

        $str = "\\r\
                   " . "Remote addr\	" . $this->ip . "\\r\ " .
            " Server addr\	    " . $serverName . "\\r\ " .
            " User agent\	" . $_SERVER['HTTP_USER_AGENT'] . "\\r\ " .
            " Referer:\	    " . $referer . "\\r\ " .
            date('j M Y g:i a') . "\\r\ ";

        //open the logfile
        $fw = fopen($this->logfile, 'a+');
        //write the log data for this visit to file
        fwrite($fw, $str);
        fclose($fw);
    }

    /**
     * @return mixed
     */
    private function getArrayOfIpsFromFile()
    {
        $data = file_get_contents($this->totIpsFile);

        return json_decode($data, true) ?? [];
    }


    private function addNewIpToFileAndSave(): void
    {
        $this->arrayOfIps[] = $this->ip;

        file_put_contents($this->totIpsFile, json_encode($this->arrayOfIps));
    }

    /**
     * @return bool
     */
    private function checkIfIpExists()
    {
        if (in_array($this->ip, $this->arrayOfIps)) {
            return true;
        }

        return false;
    }

}