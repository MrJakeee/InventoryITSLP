<?php

class MySQLConnect {

    private String $hostname;
    private String $user;
    private String $password;
    private String $database;
    
    function __construct($hostname, $user, $password, $database) {
        $this->hostname = $hostname;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
    }

    public function getHostname(): string
    {
        return $this->hostname;
    }

    public function setHostname(string $hostname): void
    {
        $this->hostname = $hostname;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function setUser(string $user): void
    {
        $this->user = $user;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getDatabase(): string
    {
        return $this->database;
    }

    public function setDatabase(string $database): void
    {
        $this->database = $database;
    }

    public function getConnection(){
        return mysqli_connect($this->getHostname(), $this->getUser(), $this->getPassword(), $this->getDatabase());
    }

    


}

?>