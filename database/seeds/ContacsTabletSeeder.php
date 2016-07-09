<?php

use App\Contact;
use App\Helpers\Utils;
use Illuminate\Database\Seeder;

class ContacsTabletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contacts = Utils::getContacts(storage_path(). "/out.txt");

        foreach ($contacts as $name => $rut)
        {
            Contact::create([
                'name' => $name,
                'rut'  => $rut
            ]);
        }
    }
}
