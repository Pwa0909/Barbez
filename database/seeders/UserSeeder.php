<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
 
class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'              => 'Admin Barbearia',
                'email'             => 'admin@barbearia.com',
                'email_verified_at' => Carbon::now(),
                'password'          => Hash::make('password'),
                'remember_token'    => null,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => 'João Silva',
                'email'             => 'joao@barbearia.com',
                'email_verified_at' => Carbon::now(),
                'password'          => Hash::make('password'),
                'remember_token'    => null,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => 'Pablo Martins',
                'email'             => 'pablo@barbearia.com',
                'email_verified_at' => Carbon::now(),
                'password'          => Hash::make('password'),
                'remember_token'    => null,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ];
 
        DB::table('users')->insert($users);
 
        $this->command->info('✅ Users criados: ' . count($users));
    }
}