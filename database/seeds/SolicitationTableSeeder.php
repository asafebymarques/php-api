<?php

use ApiWebPsp\Models\SolicitationItem;
use ApiWebPsp\Models\Solicitation;
use Illuminate\Database\Seeder;

class SolicitationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Solicitation::class,50)->create()->each(function ($p) {
            for ($i=0; $i<3; $i++) {
                $p->solicitation_items()->save(factory(SolicitationItem::class)->make());
            }
        });
    }
}
