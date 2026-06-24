<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dados = [
                ["name" => "Vlaydisson Valóis de Melo", "email" => "vlaydisson@gmail.com", "password" =>  bcrypt("123")],
                ["name" => "Vladymir Gomes Valóis", "email" => "vladymir@gmail.com", "password" =>  bcrypt("123")],
                ["name" => "Fernanda Valóis de Melo", "email" => "fernanda@gmail.com", "password" =>  bcrypt("123")],
                ["name" => "Joana Gomes Valóis", "email" => "joana@gmail.com", "password" =>  bcrypt("123")],
                ["name" => "Eduarda Lima", "email" => "eduarda.lima@example.com", "password" =>  bcrypt("123")],
                ["name" => "Felipe Alves", "email" => "felipe.alves@example.com", "password" =>  bcrypt("123")],
                ["name" => "Gabriela Rocha", "email" => "gabriela.rocha@example.com", "password" =>  bcrypt("123")],
                ["name" => "Henrique Martins", "email" => "henrique.martins@example.com", "password" =>  bcrypt("123")],
                ["name" => "Isabela Ribeiro", "email" => "isabela.ribeiro@example.com", "password" =>  bcrypt("123")],
                ["name" => "João Pedro", "email" => "joao.pedro@example.com", "password" =>  bcrypt("123")],
                ["name" => "Karina Mendes", "email" => "karina.mendes@example.com", "password" =>  bcrypt("123")],
                ["name" => "Lucas Carvalho", "email" => "lucas.carvalho@example.com", "password" =>  bcrypt("123")],
                ["name" => "Mariana Santos", "email" => "mariana.santos@example.com", "password" =>  bcrypt("123")],
                ["name" => "Nicolas Rocha", "email" => "nicolas.rocha@example.com", "password" =>  bcrypt("123")],
                ["name" => "Olivia Goncalves", "email" => "olivia.goncalves@example.com", "password" =>  bcrypt("123")],
                ["name" => "Paulo Roberto", "email" => "paulo.roberto@example.com", "password" =>  bcrypt("123")],
                ["name" => "Quiteria Azevedo", "email" => "quiteria.azevedo@example.com", "password" =>  bcrypt("123")],
                ["name" => "Rafael Araujo", "email" => "rafael.araujo@example.com", "password" =>  bcrypt("123")],
                ["name" => "Sofia Ferreira", "email" => "sofia.ferreira@example.com", "password" =>  bcrypt("123")],
                ["name" => "Thiago Barbosa", "email" => "thiago.barbosa@example.com", "password" =>  bcrypt("123")],
                ["name" => "Ursula Moreira", "email" => "ursula.moreira@example.com", "password" =>  bcrypt("123")],
                ["name" => "Vinicius Xavier", "email" => "vinicius.xavier@example.com", "password" =>  bcrypt("123")],
                ["name" => "Wanessa Castro", "email" => "wanessa.castro@example.com", "password" =>  bcrypt("123")],
                ["name" => "Xavier Lima", "email" => "xavier.lima@example.com", "password" =>  bcrypt("123")],
                ["name" => "Yasmin Duarte", "email" => "yasmin.duarte@example.com", "password" =>  bcrypt("123")],
                ["name" => "Zacarias Nogueira", "email" => "zacarias.nogueira@example.com", "password" =>  bcrypt("123")],
                ["name" => "Aline Farias", "email" => "aline.farias@example.com", "password" =>  bcrypt("123")],
                ["name" => "Breno Gonçalves", "email" => "breno.goncalves@example.com", "password" =>  bcrypt("123")],
                ["name" => "Clara Moura", "email" => "clara.moura@example.com", "password" =>  bcrypt("123")],
                ["name" => "Daniel Ramos", "email" => "daniel.ramos@example.com", "password" =>  bcrypt("123")],
                ["name" => "Elaine Cristina", "email" => "elaine.cristina@example.com", "password" =>  bcrypt("123")],
                ["name" => "Fernando Borges", "email" => "fernando.borges@example.com", "password" =>  bcrypt("123")],
                ["name" => "Gisele Vieira", "email" => "gisele.vieira@example.com", "password" =>  bcrypt("123")],
                ["name" => "Hugo Leonardo", "email" => "hugo.leonardo@example.com", "password" =>  bcrypt("123")],
                ["name" => "Ingrid Pacheco", "email" => "ingrid.pacheco@example.com", "password" =>  bcrypt("123")],
                ["name" => "Jeferson Dias", "email" => "jeferson.dias@example.com", "password" =>  bcrypt("123")],
                ["name" => "Kelly Cristina", "email" => "kelly.cristina@example.com", "password" =>  bcrypt("123")],
                ["name" => "Leandro Lopes", "email" => "leandro.lopes@example.com", "password" =>  bcrypt("123")],
                ["name" => "Michelle Andrade", "email" => "michelle.andrade@example.com", "password" =>  bcrypt("123")],
                ["name" => "Nathan Azevedo", "email" => "nathan.azevedo@example.com", "password" =>  bcrypt("123")],
                ["name" => "Patricia Lima", "email" => "patricia.lima@example.com", "password" =>  bcrypt("123")],
                ["name" => "Quintino Melo", "email" => "quintino.melo@example.com", "password" =>  bcrypt("123")],
                ["name" => "Roberta Nunes", "email" => "roberta.nunes@example.com", "password" =>  bcrypt("123")],
                ["name" => "Sergio Ramos", "email" => "sergio.ramos@example.com", "password" =>  bcrypt("123")],
                ["name" => "Tatiane Silva", "email" => "tatiane.silva@example.com", "password" =>  bcrypt("123")],
                ["name" => "Ueliton Batista", "email" => "ueliton.batista@example.com", "password" =>  bcrypt("123")],
                ["name" => "Vanessa Rocha", "email" => "vanessa.rocha@example.com", "password" =>  bcrypt("123")],
                ["name" => "Wagner Freitas", "email" => "wagner.freitas@example.com", "password" =>  bcrypt("123")],
                ["name" => "Xênia Souza", "email" => "xenia.souza@example.com", "password" =>  bcrypt("123")],
                ["name" => "Yuri Martins", "email" => "yuri.martins@example.com", "password" =>  bcrypt("123")]
        ];
        DB::table('users')->insert($dados);

    }
}
