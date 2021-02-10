<?php

namespace Source\Model;

class Usuario extends Model
{
    protected static $safe = ["id", "created_at", "updated_at"];

    protected static $entity = "usuarios";

    public function bootstrap(string $nome, string $sobrenome, string $email, string $senha): ?Usuario
    {
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->email = $email;
        $this->senha = $senha;

        return $this;
    }

    public function load(int $id, string $columns = "*"): ?Usuario
    {
        return $this;
    }

    public function find($email, string $columns = "*"): ?Usuario
    {

        return $this;
    }

    public function all(int $limit = 30, int $offset = 0, string $columns = "*"): ?array
    {
        

        return [];
    }

    public function save(): ?Usuario
    {
      
        return $this;
    }

    public function destroy(): ?Usuario
    {
       
       return $this;
    }

    private function required(): ?bool
    {
        
        return true;
    }
}
