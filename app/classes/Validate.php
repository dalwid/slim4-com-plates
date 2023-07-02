<?php

namespace app\classes;

class Validate
{
    private array $erros = [];

    public function required(array $fields)
    {
        foreach ($fields as $field) {
            if(empty($_POST[$field])){
                Flash::set($field, "Esse campo é obrigatório", "danger");
                $this->erros[$field] = true;                
            }
            else{
                Flash::set('old_'.$field, $_POST[$field]);
            }
        }
        
        return $this;
    }

    public function exists($model, $table, $field, $value)
    {
        $data = $model->findBy($table, $field, $value);

        if($data)
        {
            Flash::set($field, "Esse email já está cadastrado no banco de dados", "danger");
            $this->erros[$field] = true;
        }
        else{
            Flash::set('old_'.$field, $_POST[$field]);
        }

        return $this;
    }

    public function email($email)
    {
        $validated = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(!$validated){
            Flash::set('email', "Email inválido", "danger");
            $this->erros['email'] = true;
        }
        else{
            Flash::set('old_email', $email);
        }
    }

    public function getErros()
    {
        return !! $this->erros;
    }

}