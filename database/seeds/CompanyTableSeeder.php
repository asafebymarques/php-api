<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        DB::table('companies')->insert([
            'cnpj' => '056994502000130',
            'name' => 'NOVARTIS BIOCIENCIAS SA',
            'logo' => 'logo-default.jpg',
            'contact_name' => 'Simonete',
            'phone' => '353535353535',
            'email' => 'simonete.bispo@novartis.com',
            'status' => "Aberto,Despachado,Pendente,Concluído,Frustrado,Cancelado"
        ]);

        DB::table('companies')->insert([
            'cnpj' => '082277955000155',
            'name' => 'NOVO NORDISK FARMACEUTICA DO BRASIL LTDA',
            'logo' => 'logo-default.jpg',
            'contact_name' => 'Teste',
            'phone' => '353535353535',
            'email' => 'email@email.com',
            'status' => "Aberto,Enviado ao Site,Entregue Paciente,Entregue amostra Drs"
        ]);
        */

        //Novos
        DB::table('companies')->insert([
            'cnpj' => '060318797000100',
            'name' => 'ASTRAZENECA DO BRASIL LTDA',
            'logo' => 'logo-default.jpg',
            'contact_name' => 'Teste',
            'phone' => '353535353535',
            'email' => 'email@astrazeneca.com',
            'status' => "Aberto,Enviado ao Site,Entregue Paciente,Entregue amostra Drs"
        ]);

        DB::table('companies')->insert([
            'cnpj' => '035800857000170',
            'name' => 'CLINERGY HEALTH RESEARCH',
            'logo' => 'logo-default.jpg',
            'contact_name' => 'Teste',
            'phone' => '353535353535',
            'email' => 'email@clinergy.com',
            'status' => "Aberto,Enviado ao Site,Entregue Paciente,Entregue amostra Drs"
        ]);

        DB::table('companies')->insert([
            'cnpj' => '061190096000192',
            'name' => 'EUROFARMA LABORATORIOS',
            'logo' => 'logo-default.jpg',
            'contact_name' => 'Teste',
            'phone' => '353535353535',
            'email' => 'email@eurofarma.com',
            'status' => "Aberto,Enviado ao Site,Entregue Paciente,Entregue amostra Drs"
        ]);

        DB::table('companies')->insert([
            'cnpj' => '003755215000100',
            'name' => 'FQM/DIVCOM',
            'logo' => 'logo-default.jpg',
            'contact_name' => 'Teste',
            'phone' => '353535353535',
            'email' => 'email@fqm.com',
            'status' => "Aberto,Enviado ao Site,Entregue Paciente,Entregue amostra Drs"
        ]);

        DB::table('companies')->insert([
            'cnpj' => '009011459000165',
            'name' => 'LABCORP BRASIL SERVIÇOS FARMACÊUTICO',
            'logo' => 'logo-default.jpg',
            'contact_name' => 'Teste',
            'phone' => '353535353535',
            'email' => 'email@labcorp.com',
            'status' => "Aberto,Enviado ao Site,Entregue Paciente,Entregue amostra Drs"
        ]);

        DB::table('companies')->insert([
            'cnpj' => '099000225999986',
            'name' => 'NUVISAN PHARMA SERVICES PERU SAC',
            'logo' => 'logo-default.jpg',
            'contact_name' => 'Teste',
            'phone' => '353535353535',
            'email' => 'email@nuvisan.com',
            'status' => "Aberto,Enviado ao Site,Entregue Paciente,Entregue amostra Drs"
        ]);

        DB::table('companies')->insert([
            'cnpj' => '033009945000123',
            'name' => 'PRODUTOS ROCHE QUIMICOS E FARMACEUTI',
            'logo' => 'logo-default.jpg',
            'contact_name' => 'Teste',
            'phone' => '353535353535',
            'email' => 'email@rochequimicos.com',
            'status' => "Aberto,Enviado ao Site,Entregue Paciente,Entregue amostra Drs"
        ]);

        DB::table('companies')->insert([
            'cnpj' => '099000347999972',
            'name' => 'TESTE LOGIX FILIAL',
            'logo' => 'logo-default.jpg',
            'contact_name' => 'Teste',
            'phone' => '353535353535',
            'email' => 'email@testelogix.com',
            'status' => "Aberto,Enviado ao Site,Entregue Paciente,Entregue amostra Drs"
        ]);
 
        DB::table('companies')->insert([
            'cnpj' => '055980684000127',
            'name' => 'ZODIAC PRODUTOS FARMACEUTICOS SA',
            'logo' => 'logo-default.jpg',
            'contact_name' => 'Teste',
            'phone' => '353535353535',
            'email' => 'email@zodiac.com',
            'status' => "Aberto,Enviado ao Site,Entregue Paciente,Entregue amostra Drs"
        ]);

        //Até aqui
    }
}
