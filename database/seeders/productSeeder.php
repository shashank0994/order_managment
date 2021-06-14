<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $brands = ['RMF','NIKE','PUMA','ONE BAT','TWO BAT'];
        for($i=0;$i<=10;$i++){
            $productName = $faker->name;
            DB::table('products')->insert([
                'name'=>$productName,
                'price'=>$faker->numberBetween(1000,9000),
                'description'=>$faker->text(500),
                'brand'=>$brands[$faker->numberBetween(0,4)],
                'image'=>$this->storeImage($productName)
            ]);
        }
    }

    public function storeImage($name){
        $image=file_get_contents('https://ui-avatars.com/api/?name='.urlencode($name).'&color=ffffff&background=374151&size=250');
        $file_name='products/'.Carbon::now()->timestamp.'.png';
        $stored=Storage::disk('public')->put($file_name,$image);
        if($stored){
            return $file_name;
        }else{
            return '';
        }
    }
}
