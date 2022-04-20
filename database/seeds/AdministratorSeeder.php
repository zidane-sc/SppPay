<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new User();
        $administrator->username = "administrator";
        $administrator->name = "Site Administrator";
        $administrator->email = "administrator@SppPay.com";
        $administrator->roles = "ADMIN";
        $administrator->password = Hash::make("SppPay");
        $administrator->phone = "082190239674";
        $administrator->address = "Kaliabang Tengah, Bekasi, Jawa Barat";
        $administrator->status = 'ACTIVE';
        $administrator->save();
        $administrator->assignRole('admin');
        
        $administrator2 = new User();
        $administrator2->username = "staff";
        $administrator2->name = "Site Staff";
        $administrator2->email = "staff@SppPay.com";
        $administrator2->roles = "STAFF";
        $administrator2->password = Hash::make("SppPay");
        $administrator2->phone = "082190239674";
        $administrator2->address = "Kaliabang Tengah, Bekasi, Jawa Barat";
        $administrator2->status = 'ACTIVE';
        $administrator2->save();
        $administrator2->assignRole('staff');

        $administrator3 = new User();
        $administrator3->username = "guru";
        $administrator3->name = "Site Guru";
        $administrator3->email = "guru@SppPay.com";
        $administrator3->roles = "GURU";
        $administrator3->password = Hash::make("SppPay");
        $administrator3->phone = "082190239674";
        $administrator3->address = "Kaliabang Tengah, Bekasi, Jawa Barat";
        $administrator3->status = 'ACTIVE';
        $administrator3->save();
        $administrator3->assignRole('guru');

        $this->command->info("Admin user inserted successfully");
    }
}
