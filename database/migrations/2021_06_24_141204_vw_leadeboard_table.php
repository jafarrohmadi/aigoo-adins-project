<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class VwLeadeboardTable extends
    Migration
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
       sum(`point_histories`.`coins`) AS `total_coins`,
       sum(`point_histories`.`point`) AS `total_points`,
       count(`point_histories`.`id`)  AS `count`,
       `point_histories`.`user_id`    AS `user_id`,
       `point_histories`.`quiz_ID`    AS `quiz_ID`,
       `point_histories`.`team_id`    AS `team_id`,
       `users`.`department_id`    AS `department_id`,
       `point_histories`.`date_year_month`    AS `date`
from (`point_histories` join `users` on ((`users`.`id` = `point_histories`.`user_id`)))
group by `point_histories`.`user_id`, `date`
order by `total_points` desc, count(`point_histories`.`id`);');

    }
}
