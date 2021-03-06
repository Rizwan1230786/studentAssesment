<?php

use App\SmHrPayrollGenerate;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class SmHrPayrollGenerateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        $increment=100;
        for ($i = 1; $i <= 10; $i++) {
            $store = new SmHrPayrollGenerate();

            $store->staff_id = $i;
            $store->basic_salary = 3000 +  $increment;
            $store->total_earning = 5000 + $increment;
            $store->total_deduction =300 + $increment;
            $store->gross_salary = 4000    +$increment;
            $store->tax = $increment++;
            $store->net_salary = $store->basic_salary + $store->gross_salary - $store->total_deduction + $store->total_earning + $store->tax;
            $store->payroll_month =$faker->monthName($max = 'now');
            $store->payroll_year =$faker->year($max = 'now');
            $store->payroll_status ='G';
            $store->payment_mode =1;
            $store->note =$faker->realText($maxNbChars = 100, $indexSize = 1);
            $store->created_by=$i;

            $store->save();
        }

    }
}
