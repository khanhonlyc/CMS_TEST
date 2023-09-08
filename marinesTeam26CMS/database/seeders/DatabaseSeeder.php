<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\User;
use App\Models\ViewedMessage;
use App\Models\FanTypeNameEn;
use App\Models\UniformRegistration;
use App\Models\RowsingLog;
use App\Models\Banner;
use App\Models\Movie;
use App\Models\Permission;
use App\Models\TagMovie;
use App\Models\BannerFanType;
use App\Models\PlayerUniform;
class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    Tag::factory(5)->create();
    User::factory(12)->create();
    ViewedMessage::factory(30)->create();
    FanTypeNameEn::factory(6)->create();
    UniformRegistration::factory(30)->create();
    RowsingLog::factory(30)->create();
    Banner::factory(30)->create();
    Movie::factory(30)->create();
    Permission::factory(3)->create();
    TagMovie::factory(30)->create();
    TagMovie::factory(30)->create();
    BannerFanType::factory(10)->create();
    PlayerUniform::factory(10)->create();
  }
}
