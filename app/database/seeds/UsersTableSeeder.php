<?php


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Users();
        $user->username = "hr_admin";

        $user->fname = 'DOH HR';
        $user->lname = 'DOH_HR';
        $user->password = Hash::make('hr_admin');
        $user->usertype = 1;
        $user->unique_row = 'hr_admin';
        $user->save();

        $work_sched = new WorkScheds();
        $work_sched->description = "REGULAR TIME";
        $work_sched->am_in = "08:00:00";
        $work_sched->am_out = "12:00:00";
        $work_sched->pm_in = "13:00:00";
        $work_sched->pm_out = "17:00:00";
        $work_sched->save();

    }
}
