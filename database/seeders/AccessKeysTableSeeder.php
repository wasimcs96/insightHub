<?php

namespace Database\Seeders;

use App\Models\AccessKey;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccessKeysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      AccessKey::create([
          'key' => hash('sha256','lmcBgFcmS2lwZcCIjpJClcs4NdvoC9R9i4TWgSsg'),
          'ips' => null,
          'https' => false
      ]);
    }
}
