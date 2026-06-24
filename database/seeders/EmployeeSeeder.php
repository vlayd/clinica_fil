<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dados = '[
                        {
                            "name": "Ana Silva",
                            "birth": "1988-04-12",
                            "cpf": "123.456.789-00",
                            "address_number": "100",
                            "address_complement": "Apto 202"
                        },
                        {
                            "name": "Bruno Costa",
                            "birth": "1992-08-25",
                            "cpf": "987.654.321-11",
                            "address_number": "145",
                            "address_complement": "Casa A"
                        },
                        {
                            "name": "Camila Oliveira",
                            "birth": "1995-11-02",
                            "cpf": "456.789.123-22",
                            "address_number": "1280",
                            "address_complement": "Bloco B, Apto 504"
                        },
                        {
                            "name": "Daniel Santos",
                            "birth": "1980-01-15",
                            "cpf": "789.123.456-33",
                            "address_number": "55",
                            "address_complement": "Casa"
                        },
                        {
                            "name": "Eduardo Pereira",
                            "birth": "1986-06-30",
                            "cpf": "321.654.987-44",
                            "address_number": "205",
                            "address_complement": "Fundos"
                        },
                        {
                            "name": "Fernanda Lima",
                            "birth": "1999-03-18",
                            "cpf": "654.987.321-55",
                            "address_number": "77",
                            "address_complement": "Apto 11"
                        },
                        {
                            "name": "Gabriel Rocha",
                            "birth": "1991-09-05",
                            "cpf": "159.753.486-66",
                            "address_number": "1020",
                            "address_complement": "Conjunto 3"
                        },
                        {
                            "name": "Helena Almeida",
                            "birth": "2001-12-12",
                            "cpf": "753.486.159-77",
                            "address_number": "89",
                            "address_complement": "Casa dos fundos"
                        },
                        {
                            "name": "Igor Souza",
                            "birth": "1994-02-22",
                            "cpf": "486.159.753-88",
                            "address_number": "400",
                            "address_complement": "Apto 1201"
                        },
                        {
                            "name": "Juliana Costa",
                            "birth": "1985-07-08",
                            "cpf": "258.369.147-99",
                            "address_number": "310",
                            "address_complement": "Loja 2"
                        },
                        {
                            "name": "Kleber Martins",
                            "birth": "1982-10-10",
                            "cpf": "369.147.258-01",
                            "address_number": "15",
                            "address_complement": "Bloco A, Apto 101"
                        },
                        {
                            "name": "Larissa Moura",
                            "birth": "1990-05-14",
                            "cpf": "147.258.369-02",
                            "address_number": "111",
                            "address_complement": "Apto 301"
                        },
                        {
                            "name": "Matheus Carvalho",
                            "birth": "1997-01-27",
                            "cpf": "963.852.741-03",
                            "address_number": "78",
                            "address_complement": "Casa B"
                        },
                        {
                            "name": "Natália Rocha",
                            "birth": "1993-04-09",
                            "cpf": "852.741.963-04",
                            "address_number": "12",
                            "address_complement": "Casa"
                        },
                        {
                            "name": "Otávio Mendes",
                            "birth": "1989-11-23",
                            "cpf": "741.963.852-05",
                            "address_number": "999",
                            "address_complement": "Apto 1003"
                        },
                        {
                            "name": "Patrícia Duarte",
                            "birth": "1984-06-17",
                            "cpf": "357.159.486-06",
                            "address_number": "22",
                            "address_complement": "Cobertura"
                        },
                        {
                            "name": "Rafael Teixeira",
                            "birth": "1996-08-30",
                            "cpf": "159.486.357-07",
                            "address_number": "66",
                            "address_complement": "Apto 802"
                        },
                        {
                            "name": "Sabrina Gonçalves",
                            "birth": "1998-02-15",
                            "cpf": "486.357.159-08",
                            "address_number": "345",
                            "address_complement": "Sala 4"
                        },
                        {
                            "name": "Thiago Lopes",
                            "birth": "1987-12-05",
                            "cpf": "753.951.468-09",
                            "address_number": "175",
                            "address_complement": "Casa 2"
                        },
                        {
                            "name": "Vanessa Carvalho",
                            "birth": "1992-09-21",
                            "cpf": "951.468.753-10",
                            "address_number": "1500",
                            "address_complement": "Apto 1502"
                        },
                        {
                            "name": "Anderson Cunha",
                            "birth": "1981-03-04",
                            "cpf": "468.753.951-12",
                            "address_number": "21",
                            "address_complement": "Casa"
                        },
                        {
                            "name": "Beatriz Barbosa",
                            "birth": "2000-05-28",
                            "cpf": "753.159.852-13",
                            "address_number": "85",
                            "address_complement": "Apto 402"
                        },
                        {
                            "name": "Caio Dias",
                            "birth": "1991-11-13",
                            "cpf": "159.852.753-14",
                            "address_number": "96",
                            "address_complement": "Bloco C, Apto 31"
                        },
                        {
                            "name": "Daniela Moura",
                            "birth": "1994-07-22",
                            "cpf": "852.753.159-15",
                            "address_number": "32",
                            "address_complement": "Casa fundos"
                        },
                        {
                            "name": "Enzo Gabriel",
                            "birth": "2003-01-09",
                            "cpf": "369.258.147-16",
                            "address_number": "74",
                            "address_complement": "Apto 12"
                        },
                        {
                            "name": "Fabiana Costa",
                            "birth": "1986-04-15",
                            "cpf": "258.147.369-17",
                            "address_number": "45",
                            "address_complement": "Apto 601"
                        },
                        {
                            "name": "Guilherme Silva",
                            "birth": "1995-10-06",
                            "cpf": "147.369.258-18",
                            "address_number": "88",
                            "address_complement": "Sala 302"
                        },
                        {
                            "name": "Heloísa Carvalho",
                            "birth": "1999-01-29",
                            "cpf": "741.852.963-19",
                            "address_number": "222",
                            "address_complement": "Casa A"
                        },
                        {
                            "name": "Isabella Farias",
                            "birth": "1997-05-17",
                            "cpf": "852.963.741-20",
                            "address_number": "104",
                            "address_complement": "Apto 901"
                        },
                        {
                            "name": "João Pedro",
                            "birth": "1993-08-11",
                            "cpf": "963.741.852-21",
                            "address_number": "550",
                            "address_complement": "Casa"
                        },
                        {
                            "name": "Karina Duarte",
                            "birth": "1988-12-03",
                            "cpf": "123.789.456-22",
                            "address_number": "30",
                            "address_complement": "Apto 23"
                        },
                        {
                            "name": "Leandro Azevedo",
                            "birth": "1983-02-25",
                            "cpf": "789.456.123-23",
                            "address_number": "412",
                            "address_complement": "Bloco B, Apto 104"
                        },
                        {
                            "name": "Mariana Rocha",
                            "birth": "1990-09-07",
                            "cpf": "456.123.789-24",
                            "address_number": "71",
                            "address_complement": "Casa 3"
                        },
                        {
                            "name": "Nicolas Nogueira",
                            "birth": "2002-04-20",
                            "cpf": "321.789.654-25",
                            "address_number": "258",
                            "address_complement": "Apto 1402"
                        },
                        {
                            "name": "Olivia Moraes",
                            "birth": "1992-06-14",
                            "cpf": "789.654.321-26",
                            "address_number": "369",
                            "address_complement": "Apto 703"
                        },
                        {
                            "name": "Paulo Roberto",
                            "birth": "1979-01-30",
                            "cpf": "654.321.789-27",
                            "address_number": "852",
                            "address_complement": "Casa"
                        },
                        {
                            "name": "Queila Santos",
                            "birth": "1985-03-22",
                            "cpf": "987.321.654-28",
                            "address_number": "14",
                            "address_complement": "Apto 33"
                        },
                        {
                            "name": "Rodrigo Mendes",
                            "birth": "1986-11-18",
                            "cpf": "321.987.654-29",
                            "address_number": "99",
                            "address_complement": "Sala 12"
                        },
                        {
                            "name": "Sofia Ferreira",
                            "birth": "2001-07-05",
                            "cpf": "654.123.987-30",
                            "address_number": "110",
                            "address_complement": "Casa 1"
                        },
                        {
                            "name": "Thomas Henrique",
                            "birth": "1998-10-09",
                            "cpf": "123.987.654-31",
                            "address_number": "220",
                            "address_complement": "Apto 204"
                        },
                        {
                            "name": "Uéliton Alves",
                            "birth": "1991-04-02",
                            "cpf": "987.123.654-32",
                            "address_number": "1001",
                            "address_complement": "Bloco D, Apto 502"
                        },
                        {
                            "name": "Valentina Gomes",
                            "birth": "2004-12-25",
                            "cpf": "654.987.123-33",
                            "address_number": "60",
                            "address_complement": "Casa"
                        },
                        {
                            "name": "Wagner Teixeira",
                            "birth": "1984-06-12",
                            "cpf": "321.654.987-34",
                            "address_number": "16",
                            "address_complement": "Apto 14"
                        },
                        {
                            "name": "Xênia Bastos",
                            "birth": "1989-09-15",
                            "cpf": "987.654.321-35",
                            "address_number": "87",
                            "address_complement": "Fundos 2"
                        },
                        {
                            "name": "Yuri Vinícius",
                            "birth": "1996-01-28",
                            "cpf": "159.357.753-36",
                            "address_number": "41",
                            "address_complement": "Apto 1501"
                        },
                        {
                            "name": "Zilda Padilha",
                            "birth": "1975-08-08",
                            "cpf": "753.753.159-37",
                            "address_number": "72",
                            "address_complement": "Apto 5"
                        },
                        {
                            "name": "Arthur Farias",
                            "birth": "1993-02-14",
                            "cpf": "159.159.753-38",
                            "address_number": "510",
                            "address_complement": "Casa B"
                        },
                        {
                            "name": "Bianca Castro",
                            "birth": "1994-07-19",
                            "cpf": "357.357.159-39",
                            "address_number": "39",
                            "address_complement": "Apto 34"
                        },
                        {
                            "name": "César Augusto",
                            "birth": "1982-05-24",
                            "cpf": "753.357.357-40",
                            "address_number": "90",
                            "address_complement": "Loja Térrea"
                        },
                        {
                            "name": "Débora Albuquerque",
                            "birth": "1987-10-12",
                            "cpf": "159.357.357-41",
                            "address_number": "54",
                            "address_complement": "Cobertura B"
                        }
                        ]
                        ';
                        try {
                            //code...
                            DB::table('employees')->insert(json_decode($dados));
                        } catch (\Throwable $th) {
                            echo $th->getMessage();exit;
                        }
    }
}
