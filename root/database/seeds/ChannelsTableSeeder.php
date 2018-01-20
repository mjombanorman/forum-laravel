<?php

use Illuminate\Database\Seeder;
use App\Channel;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel1 = ['title'=>'We are the Millers'];
        $channel2 = ['title'=>'We are the Pias'];
        $channel3 = ['title'=>'We are the Trevors'];
        $channel4 = ['title'=>'We are the Rodgers'];

        Channel::create($channel1);
        Channel::create($channel2);
        Channel::create($channel3);
        Channel::create($channel4);
    }
}
