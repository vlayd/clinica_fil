<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Translation\PotentiallyTranslatedString;

class CpfRule implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // dd($attribute);
        $cpf = preg_replace('/\D/', '', (string) $value);
        $message = 'O CPF é inválido.';

        if (strlen($cpf) !== 11) {
            $fail($message);
            return;
        }

        if (preg_match('/^(\d)\1{10}$/', $cpf)) {
            $fail($message);
            return;
        }

        $query = DB::table('users') // altere 'users' para o nome da sua tabela
            ->where('cpf', $value);

        // 3. Se for uma edição, ignora o registro atual
        // if ($this->ignoreId) {
        //     $query->where('id', '!=', $this->ignoreId);
        // }

        // 4. Se encontrar algum registro, dispara o erro, mas ignora se o atributo for 'data.cpf' (ou seja, se for o campo de CPF do formulário)
        if ($query->exists() && $attribute !== 'data.cpf') {
            $fail('Este CPF já está cadastrado em nosso sistema.');
        }

        for ($t = 9; $t < 11; $t++) {
            $sum = 0;

            for ($i = 0; $i < $t; $i++) {
                $sum += (int) $cpf[$i] * (($t + 1) - $i);
            }

            $digit = ((10 * $sum) % 11) % 10;

            if ((int) $cpf[$t] !== $digit) {
                $fail($message);
                return;
            }
        }
    }
}
