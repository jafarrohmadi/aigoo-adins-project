<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class VwLeadeboardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('create view vw_leadeboard as
select `users`.`name`                 AS `name`,
       `users`.`display_name`         AS `display_name`,
       sum(`point_histories`.`score`) AS `total_score`,
       count(`point_histories`.`id`)  AS `count`,
       `point_histories`.`user_id`    AS `user_id`,
       `point_histories`.`game_id`    AS `game_id`,
       `users`.`division`             AS `division`
from (`point_histories` join `users` on ((`users`.`id` = `point_histories`.`user_id`)))
group by `point_histories`.`user_id`
order by `total_score` desc, count(`point_histories`.`id`);');


    }
}
