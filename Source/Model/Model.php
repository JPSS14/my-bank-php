<?php

namespace Source\Model;

use Source\Database\Connection;

abstract class Model{
    protected $data;
    protected $fail;
    protected $message;

    public function data(): ?object{
        return $this->data;
    }

    public function fail(): ?\PDOException{
        return $this->fail();
    }

    public function message(): ?string{
        return $this->message;
    }

    public function __set($name, $value){
        if(empty($this->data)){
            $this->data = new \stdClass();
        }
        $this->data->$name = $value;
    }

    public function __isset($name){
        return isset($this->data->$name);
    }

    public function __get($name){
        return ($this->data->$name ?? null);
    }

    protected function create(string $entity, array $data): ?int{
        return 1;
    }

    protected function read($select, string $params = null): ?\PDOStatement{
        return null;
    }

    protected function update(string $entity, array $data, string $terms, string $params): ?int{
        return 1;
    }

    protected function delete(string $entity, string $terms, string $params): ?int{
        return 1;
    }

    protected function safe(): ?array{
        $safe = (array)$this->data;
        foreach(static::$safe as $unset){
            unset($safe[$unset]);
        }
        return $safe;
    }

    protected function filter(array $data): ?array{
        $filter = [];
        foreach($data as $key => $value){
            $filter[$key] = (is_null($value) ? null : filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS));
        }
        return $filter;
    }
}