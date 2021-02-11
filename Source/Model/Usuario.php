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
        if(!$this->required()){
            return null;
        }

        // User update
        if (!empty($this->id)) {
            $userId = $this->id;

            $email = $this->read("SELECT id FROM usuarios WHERE email = :email AND id != :id", "email={$this->email}&id={$userId}");
            
            if($email->rowCount()){
                $this->message = "O e-mail já está cadastrado";
                return null;
            }

            $this->update(self::$entity, $this->safe(), "id= :id","id={$userId}");
            if ($this->fail()) {
                $this->message = "Erro ao atualizar verifique os dados";
            }

            $this->message = "Dados atualizados com sucesso!";
        }

        // User create
        if (empty($this->id)) {
            if ($this->find($this->email)) {
                $this->message = "O e-mail já está cadastrado";
                return null;
            }

            $userId = $this->create(self::$entity, $this->safe());

            if ($this->fail()) {
                $this->message = "Erro ao cadastrar verifique os dados";
            }
            $this->message = "Cadastro realizado com sucesso";
        }

        $this->data = $this->read("SELECT * FROM usuarios WHERE id = :id", "id={$userId}")->fetch();
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
