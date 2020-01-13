<?php

use Illuminate\Database\Seeder;
use App\FinancialOrganization;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        FinancialOrganization::query()->delete();

        $users = [
            ['name' => 'Brac Bank', 'short_name' => 'BB', 'address' => 'Mirpur-11, Dhaka'],
            ['name' => 'Islami Bank Bangladesh Limited', 'short_name' => 'IBBL', 'address' => 'Mirpur-10, Dhaka'],
            ['name' => 'Dutch Bangla Bank Limited', 'short_name' => 'DBBL', 'address' => 'Kazipara, Dhaka'],
        ];

        foreach($users as $user){
            FinancialOrganization::create($user);
        }
    }
}
