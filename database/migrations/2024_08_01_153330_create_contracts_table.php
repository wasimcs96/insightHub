<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('job_application_id');
            $table->unsignedBigInteger('job_id');
            
            $table->date('commencement_date');
            $table->date('contract_end_date')->nullable();

            $table->integer('probationary_period')->nullable();
            $table->string('employment_type');
            $table->string('place_of_work');

            $table->decimal('basic_salary', 15, 2);
            $table->string('pay_frequency');
            $table->text('overtime_rate');
            $table->integer('is_allowance')->nullable();
            $table->string('uniform_allowance')->nullable();
            $table->string('rice_subsidy')->nullable();
            $table->string('laundry_allowance')->nullable();
            $table->string('daily_meal_allowance')->nullable();
            $table->text('bonuses_incentive');
            // $table->text('deductions');
            $table->text('benefits');
            $table->text('statutary_deduction');
            $table->text('tardiness_policy');
            $table->text('working_hour');
            $table->text('holiday_entitlement');
            $table->text('leave_entitlement');
            $table->integer('notice_period')->nullable();
            $table->text('grounds_for_termination')->nullable();
            $table->text('separation_pay')->nullable();

            $table->text('confidentiality_agreement')->nullable();
            $table->text('non_compete_clause')->nullable();

            $table->text('non_disclosure_agreement')->nullable();

            $table->text('intellectual_property_rights')->nullable();

            $table->text('dispute_resolution')->nullable();

            $table->text('acknowledgement_of_company_policies')->nullable();

            $table->text('acknowledgement_of_receipt_of_handbook')->nullable();

            $table->text('acknowledgement_of_understanding_terms_and_conditions')->nullable();

            $table->string('employee_signature')->nullable();
            $table->date('date_signed_by_employee')->nullable();
            $table->string('employer_signature')->nullable();
            $table->date('date_signed_by_employer')->nullable();
            $table->timestamps();

            // $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            // $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
