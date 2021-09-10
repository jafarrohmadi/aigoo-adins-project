<?php

namespace App\Console\Commands;

use App\Models\Department;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class UpdateAllUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url   = config('app.api_adins_url');
        $key   = config('app.api_adins_key');
        $value = config('app.api_adins_value');

        $client = new Client(['headers' => [$key => $value]]);

        $res = $client->request(
            'GET',
            url($url.'/api/employee'),
            [
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]
        );

        $data = json_decode($res->getBody()->getContents());

        foreach ($data as $key => $value) {
            $department = Department::where('name', $value->Department)->first();

            if (!$department) {
                $department            = new Department();
                $department->is_active = 1;
                $department->name      = $value->Department;
                $department->team_name = $value->Department;
                $department->team_icon = 'default_team_avatar.png';
            }

            $department->department_code = $value->DepartmentCode;
            $department->save();

            $user = User::where('email', $value->Email)->first();

            if (!$user) {
                $user = new User();
                $user->avatar            = 'default_avatar.png';
                $user->email_verified_at = date('Y-m-d H:i:s');
                $user->password          = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
                $user->type              = 'user';
                $user->level             = 1;
                $user->active            = 1;
                $user->current_coin      = 0;
                $user->team_id           = $department->id;
                $user->department_id     = $department->id;
            }

            $user->name              = $value->EmployeeName;
            $user->email             = $value->Email;
            $user->department        = $value->Department;
            $user->username          = $value->Email;
            $user->company           = $value->Company;
            $user->bu                = $value->BU;
            $user->subbu             = $value->SubBU;
            $user->nik               = $value->NIK;
            $user->jobposition       = $value->JobPosition;
            $user->worklocationname  = $value->WorkLocationName;
            $user->statusincompany   = $value->Status ?? 'Ga ada';
            $user->gender            = $value->Gender == 'Male' ? 0 : 1;
            $user->bu_code           = $value->BUCode ?? '';
            $user->sub_bu_code       = $value->SubBUCode ?? '';
            $user->department_code   = $value->DepartmentCode ?? '';
            $user->job_level         = $value->JobLevel ?? '';

            if ($value->JobLevel == 'Staff' || $value->JobLevel == 'Operasional') {
                $user->roles = 'Staff';
                $user->employee_level_id = 1;
            } else if ($value->JobLevel == 'Senior Manager'
                || $value->JobLevel == 'Junior Manager'
                || $value->JobLevel == 'General Manager'
                || $value->JobLevel == 'Supervisor'
                || $value->JobLevel == 'Officer') {
                $user->roles = 'Managerial';
                $user->employee_level_id = 2;
            } else {
                $user->roles = 'BOD';
                $user->employee_level_id = 3;
            }
            $user->save();

            echo 'Sukses update user : ' .$user->id;
        }

    }
}
