<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ConfigSeeder
 * @package Database\Seeders
 */
class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = date('Y-m-d H:i:s');

        DB::table('configs')->insert([
            [
                'group' => 'basic',
                'type' => 'text',
                'key' => 'title',
                'value' => '',
                'help' => 'title',
                'rules' => '[null]',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'group' => 'basic',
                'type' => 'image',
                'key' => 'logo',
                'value' => '',
                'help' => 'logo',
                'rules' => '[null]',
                'created_at' => $time,
                'updated_at' => $time
            ]
        ]);
    }
}
