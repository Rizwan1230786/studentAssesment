<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SmRole::class);
        $this->call(Sm_users_seeder::class);
        $this->call(SmStudentsTableSeeder::class);
        $this->call(SmStaffsTableSeeder::class);
        $this->call(Sm_phone_call_logsSeeder::class);
        $this->call(Sm_general_setting_seeder::class);
        $this->call(Sm_section_seeder::class); 
        $this->call(Sm_Class_seeder::class);
        $this->call(Sm_base_group_seeder::class);
        $this->call(Sm_class_section_seeder::class);
        $this->call(SmModuleSeeder::class);
        $this->call(SmExamTypeSeeder::class);
        $this->call(SmSubjectsSeeder::class);
        $this->call(SmClassRoomsSeeder::class);
        $this->call(SmHumanDepartmentsTableSeeder::class);
        $this->call(SmDesignationsTableSeeder::class);
        $this->call(SmLeaveTypesTableSeeder::class);
        $this->call(SmBaseSetupsTableSeeder::class);
        $this->call(SmStudentCategoriesTableSeeder::class);
        $this->call(SmSessionsTableSeeder::class);
        $this->call(SmClassTimesTableSeeder::class);
        $this->call(SmAssignSubjectsTableSeeder::class);
        $this->call(SmAcademicYearsTableSeeder::class);
        $this->call(SmBookCategoriesTableSeeder::class);
        $this->call(SmLibraryMembersTableSeeder::class);
        $this->call(SmVisitorTableSeeder::class);
        $this->call(SmFeesTypeTableSeeder::class);
        $this->call(SmIncomeHeadTableSeeder::class);
        $this->call(SmStudentGroupTableSeeder::class);
        $this->call(SmInstructionTableSeeder::class);
        $this->call(SmquestionLevelTableSeeder::class);
        $this->call(SmquestionGroupTableSeeder::class);
        $this->call(SmQuestionBanksTableSeeder::class);
        $this->call(SmOnlineExamTableSeeder::class);
        $this->call(SmHourlyRateTableSeeder::class);
        $this->call(SmBankAccountTableSeeder::class);
        $this->call(SmExpenseHeadTableSeeder::class);
        $this->call(SmFeesMasterTableSeeder::class);
        $this->call(SmComplaintTableSeeder::class);
        $this->call(SmPostalReceiveTableSeeder::class);
        $this->call(SmPostalDispatchTableSeeder::class);
        $this->call(SmSchoolTableSeeder::class);
        $this->call(SmStudentHomeworkTableSeeder::class);
        $this->call(SmHrPayrollGenerateTableSeeder::class);

    }
}
