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
        News::create([
            'head' => 'الخبر الاول',
            'body' => 'تفاصيل الخر الاول',
            'img' => 'test.png',
            'video' => 'video.mp4',
            'news_category_id' => 1
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
        NewsCategory::create([
            'name' => 'مهرجانات وترفيه'
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
        NewsCategory::create([
            'name' => 'برنامج 1',
            'category' => 2,
            'img' => 'test.png'
        ]);
        NewsCategory::create([
            'name' => 'برنامج 2',
            'category' => 2,
            'img' => 'test.png'
        ]);
        NewsCategory::create([
            'name' => 'سناب 1',
            'category' => 3,
            'img' => 'test.png'
        ]);

        //
        News::create([
            'head' => 'خبر مثلا عن محمد علي',
            'img' => 'test.png',
            'news_category_id' => 10
        ]);
        News::create([
            'head' => 'هذا خبر منوع',
            'img' => 'test.png',
            'news_category_id' => 1
        ]);
        News::create([
            'head' => 'حلقة واحد من برنامج واحد',
            'img' => 'test.png',
            'video' => 'video.mp4',
            'news_category_id' => 12
        ]);
        News::create([
            'head' => 'سناب واحد داخل سناب 1',
            'img' => 'test.png',
            'video' => 'video.mp4',
            'news_category_id' => 14
        ]);
        //
    }
}
