<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Translation\PotentiallyTranslatedString;

class CnpjRule implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // dd($attribute);
        $cnpj = preg_replace('/\D/', '', (string) $value);
        $message = 'O CNPJ é inválido.';

        if (strlen($cnpj) !== 14) {
            $fail($message);
            return;
        }

        if (preg_match('/^(\d)\1{13}$/', $cnpj)) {
            $fail($message);
            return;
        }

        // Valida o primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += (int)$cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;
        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)) {
            $fail($message);
            return;
        }

        // Valida o segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += (int)$cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;

        if($cnpj[13] != ($resto < 2 ? 0 : 11 - $resto)) {
            $fail($message);
            return;
        }

        $query = DB::table('enterprises') // altere para o nome da sua tabela
            ->where('cnpj', $value);

        // 3. Se for uma edição, ignora o registro atual
        // if ($this->ignoreId) {
        //     $query->where('id', '!=', $this->ignoreId);
        // }

        // 4. Se encontrar algum registro, dispara o erro, mas ignora se o atributo for 'data.cnpj' (ou seja, se for o campo de CNPJ do formulário)
        if ($query->exists() && $attribute !== 'data.cnpj') {
            $fail('Este CNPJ já está cadastrado em nosso sistema.');
        }
    }
}
