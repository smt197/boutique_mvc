<?php

namespace App\Core\Validator;

class ConcreteValidator implements ValidatorInterface {
    protected array $errors = [];

    public function validate($data, $rules) {
        foreach ($rules as $field => $rule) {
            $value = $data[$field] ?? null;

            if (strpos($rule, 'required') !== false && empty($value)) {
                $this->addError($field, "Le champ $field est obligatoire");
                continue; 
            }

            if (!empty($value)) {
                if (strpos($rule, 'text') !== false && !preg_match("/^[a-zA-ZÀ-ÿ\s]+$/", $value)) {
                    $this->addError($field, "Le champ $field doit contenir uniquement des lettres");
                }

                if (strpos($rule, 'email') !== false) {
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $this->addError($field, "L'email n'est pas valide.");
                    } else if (!preg_match('/^[a-z][a-z0-9]*@gmail\.com$/', $value)) {
                        $this->addError($field, "L'email doit être valide et se terminer par @gmail.com sans caractères spéciaux, ni majuscules ou chiffres au début");
                    }
                }

                if (strpos($rule, 'telephone') !== false && !preg_match("/^(77|76|78|75)[0-9]{7}$/", $value)) {
                    $this->addError($field, "Le numéro de téléphone doit être valide et commencer par 77, 76, 78 ou 75 et contenir 9 chiffres");
                }

                if (strpos($rule, 'photo') !== false) {
                    if (!in_array(pathinfo($value, PATHINFO_EXTENSION), ['png', 'jpg', 'jpeg', 'webp'])) {
                        $this->addError($field, "Le champ $field doit être une image de type png, jpg, jpeg");
                    }
                }
            }
        }

        return empty($this->errors);
    }

    public function addError($field, $message) {
        $this->errors[$field] = $message;
    }

    public function getErrors() {
        return $this->errors;
    }
}
