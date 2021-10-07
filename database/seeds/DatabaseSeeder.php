<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(ClientOauthTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(ReceiverTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(SolicitationTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(CapabilityTableSeeder::class);

    }
}
