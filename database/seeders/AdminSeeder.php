<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12332100')
        ]);
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12332100')
        ]);
        NewsCategory::create([
            'name' => 'اخبار منوعة'
        ]);
        NewsCategory::create([
            'name' => 'من برامجنا'
        ]);
        NewsCategory::create([
            'name' => 'سناب الوسام'
        ]);
        NewsCategory::create([
            'name' => 'شخصيات مؤثرة'
        ]);
        NewsCategory::create([
            'name' => 'مواقع سياحية وتراثية'
        ]);
        NewsCategory::create([
            'name' => 'مسابقات'
        ]);
        NewsCategory::create([
            'name' => 'من ارشيفنا'
        ]);
        NewsCategory::create([
            'name' => 'احتفالات ومناسبات'
        ]);
        NewsCategory::create([
            'name' => 'تغطيات'
        ]);
        Setting::create([
            'live' => '',
            'live_status' => 1
        ]);
        //
        NewsCategory::create([
            'name' => 'محمد علي',
            'category' => 4
        ]);
        News::create([
            'head' => 'خبر مثلا عن محمد علي',
            'img' => 'test.png',
            'news_category_id' => 10
        ]);
    }
}
