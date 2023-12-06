<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['frontend','backend', 'design', 'webapp', 'fullstack'];
        foreach ($data as $type) {
            $new_tecnology = new Type();
            $new_tecnology->name = $type;
            $new_tecnology->description = $type;
            $new_tecnology->save();
        }
    }
}
