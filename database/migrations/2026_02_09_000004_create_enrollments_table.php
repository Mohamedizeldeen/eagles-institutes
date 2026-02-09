<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->decimal('amount_paid', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->enum('payment_status', ['مدفوع', 'جزئي', 'غير مدفوع'])->default('غير مدفوع');
            $table->enum('status', ['مسجل', 'مكتمل', 'منسحب', 'مؤجل'])->default('مسجل');
            $table->date('enrolled_at');
            $table->date('completed_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
