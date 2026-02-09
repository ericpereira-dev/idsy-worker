<?php // versão 01;   
namespace idsy\client\model\control;

class Login
{
    private string $login;
    private string $password;
    private string $team;
    private string $key;

    public function toClear(): void
    {
        $this->login                   = '';
        $this->password                = '';
        $this->team                    = '';
        $this->key                     = '';
    }

    public function __construct()
    {
        $this->toClear();
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $value): void
    {
        $this->login = substr($value, 0, 100);
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $value): void
    {
        $this->password = substr($value, 0, 100);
    }

    public function getTeam(): string
    {
        return $this->team;
    }

    public function setTeam(string $value): void
    {
        $this->team = substr($value, 0, 100);
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $value): void
    {
        $this->key = substr($value, 0, 100);
    }
}
