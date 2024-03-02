<?php

namespace Database\Seeders;

use App\Models\Tokens as ModelsTokens;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tokens extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsTokens::factory()->count(1)->create();
        DB::table('tokens')->create([
            'token' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJBbGZhdGljaDIiLCJpYXQiOjE3MDg5MzY2MjUsImV4cCI6MTc0MDQ3MjYyNSwiYXVkIjoiYWxmYXRpY2gyIiwic3ViIjoiYWxmYXRpY2gyIiwiR2l2ZW5OYW1lIjoiSm9obm55IiwiU3VybmFtZSI6IlJvY2tldCIsIkVtYWlsIjoianJvY2tldEBleGFtcGxlLmNvbSIsIlJvbGUiOlsiTWFuYWdlciIsIlByb2plY3QgQWRtaW5pc3RyYXRvciJdfQ.uHrcdxe-hRKXdbrojYD5fvO19Ge77Y9i1Mp1E03qKIQ'
        ]);
    }
}
