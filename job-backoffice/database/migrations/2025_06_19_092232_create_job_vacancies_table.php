<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->enum('type',['Full-Time','Part-Time','Contract','Remote','Hybrid'])->default('Full-time');
            $table->decimal('salary',8,2);
            $table->text('required_skills');
            $table->integer('view_count');
            $table->timestamps();
            $table->softDeletes();

            //Relationships
            $table->uuid('companyId');
            $table->foreign('companyId')->references('id')->on('companies')->onDelete('restrict');

            $table->uuid('jobCategoryId');
            $table->foreign('jobCategoryId')->references('id')->on('job_categories')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};
