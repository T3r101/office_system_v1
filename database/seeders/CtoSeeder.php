<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Record;
use App\Models\SystemLog;

class CtoSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        $admin = User::create([
            'name' => 'CTO Admin',
            'email' => 'admin@cto.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // User
        $user = User::create([
            'name' => 'User',
            'email' => 'user@cto.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'is_active' => true,
        ]);

        // Sample records
        Record::create([
            'user_id' => $user->id,
            'date' => '2024-01-15',
            'description' => 'Salary',
            'category' => 'Income',
            'debit' => 0,
            'credit' => 5000.00,
            'balance' => 5000.00,
        ]);

        Record::create([
            'user_id' => $user->id,
            'date' => '2024-01-20',
            'description' => 'Groceries',
            'category' => 'Expense',
            'debit' => 250.50,
            'credit' => 0,
            'balance' => 4749.50,
        ]);

        // Sample logs
        SystemLog::create([
            'user_id' => $admin->id,
            'action' => 'login',
            'description' => 'Admin login',
        ]);
    }
}

