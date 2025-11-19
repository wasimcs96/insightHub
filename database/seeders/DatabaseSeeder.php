<?php

namespace Database\Seeders;

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
        $this->call([
          // QuizzesTableSeeder::class,
          // QuizDomainsTableSeeder::class,
          // QuizDomainValuesTableSeeder::class,
          // QuizDomainValueQuestionsTableSeeder::class,
          // QuizDomainValueAnswerValuationTableSeeder::class,
          // AccessKeysTableSeeder::class
          DefaultTenantSeeder::class
        ]);
    }
}
