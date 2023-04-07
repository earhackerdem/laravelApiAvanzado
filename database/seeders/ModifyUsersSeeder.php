<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModifyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = User::select('created_at')->first()->created_at;

        User::whereCreatedAt($date)
            ->update([
                'created_at' => Carbon::now()->subDays(7)->format('Y-m-d'),
                'email_verified_at' => null
            ]);

    }
}
