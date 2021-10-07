<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // 1
        DB::table('permissions')->insert([
            'name' => 'createUser',
            'label' => 'Criar usuario',
            'entity' => '/users',
        ]);

        // 2
        DB::table('permissions')->insert([
            'name' => 'updateUser',
            'label' => 'Atualizar usuario',
            'entity' => '/users',
        ]);

        // 3
        DB::table('permissions')->insert([
            'name' => 'viewUser',
            'label' => 'Visualizar usuario',
            'entity' => '/users',
        ]);

        // 4
        DB::table('permissions')->insert([
            'name' => 'getUsers',
            'label' => 'Listar usuarios',
            'entity' => '/users',
        ]);

        // 5
        DB::table('permissions')->insert([
            'name' => 'dashboard',
            'label' => 'Visualizar Dashboard',
            'entity' => '/',
        ]);

        // 6
        DB::table('permissions')->insert([
            'name' => 'getSolicitations',
            'label' => 'Listar Solicitações',
            'entity' => '/solicitations',
        ]);

        // 7
        DB::table('permissions')->insert([
            'name' => 'getReceivers',
            'label' => 'Listar Destinatário/Pacientes',
            'entity' => '/receivers',
        ]);

        // 8
        DB::table('permissions')->insert([
            'name' => 'getCompanies',
            'label' => 'Listar Clientes',
            'entity' => '/companies',
        ]);

        // 9
        DB::table('permissions')->insert([
            'name' => 'getAudits',
            'label' => 'Listar Auditorias',
            'entity' => '/audits',
        ]);

        // 10
        DB::table('permissions')->insert([
            'name' => 'viewAudit',
            'label' => 'Visualizar Auditorias',
            'entity' => '/audits',
        ]);

        // 11
        DB::table('permissions')->insert([
            'name' => 'createCompany',
            'label' => 'Criar Cliente',
            'entity' => '/companies',
        ]);

        // 12
        DB::table('permissions')->insert([
            'name' => 'updateCompany',
            'label' => 'Editar Cliente',
            'entity' => '/companies',
        ]);

        // 13
        DB::table('permissions')->insert([
            'name' => 'createSolicitation',
            'label' => 'Criar Solicitação',
            'entity' => '/solicitations',
        ]);

        // 14
        DB::table('permissions')->insert([
            'name' => 'updateSolicitation',
            'label' => 'Editar Solicitação',
            'entity' => '/solicitations',
        ]);

        // 15
        DB::table('permissions')->insert([
            'name' => 'assignSolicitation',
            'label' => 'Atribuir Atendente na Solicitação',
            'entity' => '/solicitations',
        ]);

        // 16
        DB::table('permissions')->insert([
            'name' => 'viewSolicitation',
            'label' => 'Visualizar Solicitação',
            'entity' => '/solicitations',
        ]);

        // 17
        DB::table('permissions')->insert([
            'name' => 'updateSolicitationLater',
            'label' => 'Atualizar Solicitação Após Agendamento',
            'entity' => '/solicitations',
        ]);

        // 18
        DB::table('permissions')->insert([
            'name' => 'schedulingSolicitation',
            'label' => 'Confirmação/Agendamento da Solicitação',
            'entity' => '/solicitations',
        ]);

        // 19
        DB::table('permissions')->insert([
            'name' => 'statusSolicitation',
            'label' => 'Alterar Status da Solicitação',
            'entity' => '/solicitations',
        ]);

        // 20
        DB::table('permissions')->insert([
            'name' => 'attendSolicitation',
            'label' => 'Atender Solicitação',
            'entity' => '/solicitations',
        ]);

        // 21
        DB::table('permissions')->insert([
            'name' => 'pullSolicitation',
            'label' => 'Puxar Solicitalção',
            'entity' => '/solicitations',
        ]);

        // 22
        DB::table('permissions')->insert([
            'name' => 'createReceiver',
            'label' => 'Criar Destinatário/Paciente',
            'entity' => '/receivers',
        ]);

        // 23
        DB::table('permissions')->insert([
            'name' => 'updateReceiver',
            'label' => 'Editar Destinatário/Paciente',
            'entity' => '/receivers',
        ]);

        // 24
        DB::table('permissions')->insert([
            'name' => 'viewReceiver',
            'label' => 'Visualizar Destinatário/Paciente',
            'entity' => '/receiver',
        ]);

        // 25
        DB::table('permissions')->insert([
            'name' => 'statusCompany',
            'label' => 'Inativar Cliente',
            'entity' => '/companies',
        ]);

        // 26
        DB::table('permissions')->insert([
            'name' => 'statusUser',
            'label' => 'Inativar Usuário',
            'entity' => '/users',
        ]);

        // 27
        DB::table('permissions')->insert([
            'name' => 'reopenSolicitation',
            'label' => 'Reabrir Solicitação',
            'entity' => '/solicitations',
        ]);

    }
}
