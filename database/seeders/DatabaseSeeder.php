<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Setting;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'مدير النظام',
            'name_en' => 'System Admin',
            'email' => 'admin@eagles.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'role' => 'admin',
            'phone' => '0912345678',
        ]);

        // Create receptionist user
        $receptionist = User::create([
            'name' => 'موظف الاستقبال',
            'name_en' => 'Receptionist',
            'email' => 'reception@eagles.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'role' => 'receptionist',
            'phone' => '0912345679',
        ]);

        // Create courses (bilingual)
        $courses = [
            [
                'name' => 'دورة المبتدئين في اللغة الإنجليزية',
                'name_en' => 'English for Beginners',
                'description' => 'دورة شاملة للمبتدئين تغطي أساسيات اللغة الإنجليزية من الصفر. تشمل الحروف الأبجدية، الأرقام، المفردات الأساسية اليومية، القواعد الأساسية وتركيب الجمل البسيطة، والمحادثات اليومية.',
                'description_en' => 'A comprehensive course for beginners covering English fundamentals from scratch. Includes the alphabet, numbers, basic daily vocabulary, fundamental grammar and sentence structure, and everyday conversations.',
                'level' => 'مبتدئ',
                'price' => 5000,
                'duration_hours' => 60,
                'max_students' => 25,
                'start_date' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'end_date' => Carbon::now()->addMonths(2)->format('Y-m-d'),
                'is_active' => true,
                'show_on_website' => true,
            ],
            [
                'name' => 'دورة تأسيس اللغة الإنجليزية للأطفال',
                'name_en' => 'English Foundation for Kids',
                'description' => 'دورة مخصصة للأطفال من سن 8 إلى 14 سنة لتعلم اللغة الإنجليزية بطريقة ممتعة وتفاعلية. تشمل الألعاب التعليمية والأنشطة الجماعية.',
                'description_en' => 'A specialized course for children aged 8 to 14 to learn English in a fun and interactive way. Includes educational games and group activities.',
                'level' => 'مبتدئ',
                'price' => 4000,
                'duration_hours' => 40,
                'max_students' => 20,
                'start_date' => Carbon::now()->addDays(14)->format('Y-m-d'),
                'end_date' => Carbon::now()->addMonths(2)->format('Y-m-d'),
                'is_active' => true,
                'show_on_website' => true,
            ],
            [
                'name' => 'دورة المحادثة والاستماع - متوسط',
                'name_en' => 'Conversation & Listening - Intermediate',
                'description' => 'دورة متخصصة في تطوير مهارات المحادثة والاستماع للمستوى المتوسط. تركز على بناء الثقة في التحدث باللغة الإنجليزية.',
                'description_en' => 'A specialized course in developing conversation and listening skills for intermediate level. Focuses on building confidence in speaking English.',
                'level' => 'متوسط',
                'price' => 7000,
                'duration_hours' => 80,
                'max_students' => 20,
                'start_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'end_date' => Carbon::now()->addMonths(3)->format('Y-m-d'),
                'is_active' => true,
                'show_on_website' => true,
            ],
            [
                'name' => 'دورة القواعد المتقدمة والكتابة',
                'name_en' => 'Advanced Grammar & Writing',
                'description' => 'دورة شاملة في القواعد المتقدمة ومهارات الكتابة الاحترافية. تشمل الأزمنة المتقدمة، الجمل الشرطية، المبني للمجهول.',
                'description_en' => 'A comprehensive course in advanced grammar and professional writing skills. Covers advanced tenses, conditional sentences, and passive voice.',
                'level' => 'متوسط',
                'price' => 7500,
                'duration_hours' => 70,
                'max_students' => 20,
                'start_date' => Carbon::now()->subDays(30)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(30)->format('Y-m-d'),
                'is_active' => true,
                'show_on_website' => true,
            ],
            [
                'name' => 'دورة إنجليزية الأعمال',
                'name_en' => 'Business English',
                'description' => 'دورة متقدمة مصممة للمهنيين ورجال الأعمال. تغطي مهارات التفاوض، كتابة التقارير، العروض التقديمية، والمراسلات التجارية.',
                'description_en' => 'An advanced course designed for professionals and business people. Covers negotiation skills, report writing, presentations, and business correspondence.',
                'level' => 'متقدم',
                'price' => 10000,
                'duration_hours' => 100,
                'max_students' => 15,
                'start_date' => Carbon::now()->addDays(21)->format('Y-m-d'),
                'end_date' => Carbon::now()->addMonths(4)->format('Y-m-d'),
                'is_active' => true,
                'show_on_website' => true,
            ],
            [
                'name' => 'دورة التحضير لاختبار IELTS',
                'name_en' => 'IELTS Preparation Course',
                'description' => 'دورة تحضيرية مكثفة لاختبار IELTS تغطي الأقسام الأربعة: الاستماع، القراءة، الكتابة، والتحدث.',
                'description_en' => 'An intensive IELTS preparatory course covering all four sections: Listening, Reading, Writing, and Speaking.',
                'level' => 'متقدم',
                'price' => 12000,
                'duration_hours' => 120,
                'max_students' => 15,
                'start_date' => Carbon::now()->subDays(60)->format('Y-m-d'),
                'end_date' => Carbon::now()->subDays(5)->format('Y-m-d'),
                'is_active' => false,
                'show_on_website' => true,
            ],
        ];

        $createdCourses = [];
        foreach ($courses as $courseData) {
            $createdCourses[] = Course::create($courseData);
        }

        // Create students
        $students = [
            ['name' => 'أحمد محمد علي', 'name_en' => 'Ahmed Mohammed Ali', 'email' => 'ahmed@example.com', 'phone' => '0911111111', 'id_number' => 'SD-2024-001', 'gender' => 'ذكر', 'date_of_birth' => '2000-05-15', 'address' => 'الخرطوم - الرياض', 'address_en' => 'Khartoum - Al Riyadh', 'is_active' => true],
            ['name' => 'فاطمة عبدالله حسن', 'name_en' => 'Fatima Abdullah Hassan', 'email' => 'fatima@example.com', 'phone' => '0922222222', 'id_number' => 'SD-2024-002', 'gender' => 'أنثى', 'date_of_birth' => '1998-08-20', 'address' => 'الخرطوم - المعمورة', 'address_en' => 'Khartoum - Al Mamoura', 'is_active' => true],
            ['name' => 'محمد إبراهيم أحمد', 'name_en' => 'Mohammed Ibrahim Ahmed', 'email' => 'mohamed@example.com', 'phone' => '0933333333', 'id_number' => 'SD-2024-003', 'gender' => 'ذكر', 'date_of_birth' => '2001-03-10', 'address' => 'أم درمان - الثورة', 'address_en' => 'Omdurman - Al Thawra', 'is_active' => true],
            ['name' => 'مريم حسين يوسف', 'name_en' => 'Mariam Hussein Yousif', 'email' => 'mariam@example.com', 'phone' => '0944444444', 'id_number' => 'SD-2024-004', 'gender' => 'أنثى', 'date_of_birth' => '1999-11-25', 'address' => 'بحري - الحلفايا', 'address_en' => 'Bahri - Al Halfaya', 'is_active' => true],
            ['name' => 'عمر صالح خالد', 'name_en' => 'Omar Salih Khalid', 'email' => 'omar@example.com', 'phone' => '0955555555', 'id_number' => 'SD-2024-005', 'gender' => 'ذكر', 'date_of_birth' => '2002-01-08', 'address' => 'الخرطوم - الصحافة', 'address_en' => 'Khartoum - Al Sahafa', 'is_active' => true],
            ['name' => 'هبة عثمان محمود', 'name_en' => 'Hiba Othman Mahmoud', 'email' => 'hiba@example.com', 'phone' => '0966666666', 'id_number' => 'SD-2024-006', 'gender' => 'أنثى', 'date_of_birth' => '2000-07-12', 'address' => 'الخرطوم - جبرة', 'address_en' => 'Khartoum - Jabra', 'is_active' => true],
            ['name' => 'يوسف عبدالرحمن نور', 'name_en' => 'Yousif Abdulrahman Noor', 'email' => 'yousif@example.com', 'phone' => '0977777777', 'id_number' => 'SD-2024-007', 'gender' => 'ذكر', 'date_of_birth' => '1997-09-30', 'address' => 'أم درمان - أبو سعد', 'address_en' => 'Omdurman - Abu Saad', 'is_active' => true],
            ['name' => 'آمنة بكري إسماعيل', 'name_en' => 'Amna Bakri Ismail', 'email' => 'amna@example.com', 'phone' => '0988888888', 'id_number' => 'SD-2024-008', 'gender' => 'أنثى', 'date_of_birth' => '2003-04-18', 'address' => 'بحري - الخوجلاب', 'address_en' => 'Bahri - Al Khojlab', 'is_active' => true],
            ['name' => 'خالد مصطفى عمر', 'name_en' => 'Khalid Mustafa Omar', 'email' => 'khaled@example.com', 'phone' => '0999999999', 'id_number' => 'SD-2024-009', 'gender' => 'ذكر', 'date_of_birth' => '2001-12-05', 'address' => 'الخرطوم - المقرن', 'address_en' => 'Khartoum - Al Mogran', 'is_active' => true],
            ['name' => 'سارة محمد عبدالله', 'name_en' => 'Sara Mohammed Abdullah', 'email' => 'sara@example.com', 'phone' => '0910101010', 'id_number' => 'SD-2024-010', 'gender' => 'أنثى', 'date_of_birth' => '2000-02-28', 'address' => 'الخرطوم - بري', 'address_en' => 'Khartoum - Burri', 'is_active' => true],
        ];

        $createdStudents = [];
        foreach ($students as $studentData) {
            $createdStudents[] = Student::create($studentData);
        }

        // Create enrollments
        $enrollments = [
            ['student_id' => $createdStudents[0]->id, 'course_id' => $createdCourses[0]->id, 'amount_paid' => 5000, 'discount' => 0, 'payment_status' => 'مدفوع', 'status' => 'مسجل', 'enrolled_at' => Carbon::now()->subDays(5)],
            ['student_id' => $createdStudents[1]->id, 'course_id' => $createdCourses[0]->id, 'amount_paid' => 4500, 'discount' => 500, 'payment_status' => 'مدفوع', 'status' => 'مسجل', 'enrolled_at' => Carbon::now()->subDays(4)],
            ['student_id' => $createdStudents[7]->id, 'course_id' => $createdCourses[0]->id, 'amount_paid' => 2500, 'discount' => 0, 'payment_status' => 'جزئي', 'status' => 'مسجل', 'enrolled_at' => Carbon::now()->subDays(3)],
            ['student_id' => $createdStudents[2]->id, 'course_id' => $createdCourses[2]->id, 'amount_paid' => 7000, 'discount' => 0, 'payment_status' => 'مدفوع', 'status' => 'مكتمل', 'enrolled_at' => Carbon::now()->subDays(60), 'completed_at' => Carbon::now()->subDays(2)],
            ['student_id' => $createdStudents[3]->id, 'course_id' => $createdCourses[2]->id, 'amount_paid' => 7000, 'discount' => 0, 'payment_status' => 'مدفوع', 'status' => 'مكتمل', 'enrolled_at' => Carbon::now()->subDays(60), 'completed_at' => Carbon::now()->subDays(2)],
            ['student_id' => $createdStudents[4]->id, 'course_id' => $createdCourses[2]->id, 'amount_paid' => 0, 'discount' => 0, 'payment_status' => 'غير مدفوع', 'status' => 'مسجل', 'enrolled_at' => Carbon::now()->subDays(2)],
            ['student_id' => $createdStudents[5]->id, 'course_id' => $createdCourses[3]->id, 'amount_paid' => 7500, 'discount' => 0, 'payment_status' => 'مدفوع', 'status' => 'مكتمل', 'enrolled_at' => Carbon::now()->subDays(60), 'completed_at' => Carbon::now()->subDays(5)],
            ['student_id' => $createdStudents[6]->id, 'course_id' => $createdCourses[3]->id, 'amount_paid' => 7500, 'discount' => 0, 'payment_status' => 'مدفوع', 'status' => 'مكتمل', 'enrolled_at' => Carbon::now()->subDays(60), 'completed_at' => Carbon::now()->subDays(5)],
            ['student_id' => $createdStudents[8]->id, 'course_id' => $createdCourses[3]->id, 'amount_paid' => 7500, 'discount' => 0, 'payment_status' => 'مدفوع', 'status' => 'مكتمل', 'enrolled_at' => Carbon::now()->subDays(60), 'completed_at' => Carbon::now()->subDays(3)],
            ['student_id' => $createdStudents[0]->id, 'course_id' => $createdCourses[5]->id, 'amount_paid' => 12000, 'discount' => 0, 'payment_status' => 'مدفوع', 'status' => 'مكتمل', 'enrolled_at' => Carbon::now()->subDays(90), 'completed_at' => Carbon::now()->subDays(10)],
            ['student_id' => $createdStudents[2]->id, 'course_id' => $createdCourses[5]->id, 'amount_paid' => 10000, 'discount' => 2000, 'payment_status' => 'مدفوع', 'status' => 'مكتمل', 'enrolled_at' => Carbon::now()->subDays(90), 'completed_at' => Carbon::now()->subDays(10)],
            ['student_id' => $createdStudents[9]->id, 'course_id' => $createdCourses[5]->id, 'amount_paid' => 12000, 'discount' => 0, 'payment_status' => 'مدفوع', 'status' => 'منسحب', 'enrolled_at' => Carbon::now()->subDays(80)],
            ['student_id' => $createdStudents[4]->id, 'course_id' => $createdCourses[4]->id, 'amount_paid' => 10000, 'discount' => 0, 'payment_status' => 'مدفوع', 'status' => 'مسجل', 'enrolled_at' => Carbon::now()->subDays(2)],
            ['student_id' => $createdStudents[9]->id, 'course_id' => $createdCourses[4]->id, 'amount_paid' => 5000, 'discount' => 0, 'payment_status' => 'جزئي', 'status' => 'مسجل', 'enrolled_at' => Carbon::now()->subDays(1)],
        ];

        $createdEnrollments = [];
        foreach ($enrollments as $enrollmentData) {
            $createdEnrollments[] = Enrollment::create($enrollmentData);
        }

        // Create certificates for completed students
        Certificate::create([
            'student_id' => $createdStudents[5]->id,
            'course_id' => $createdCourses[3]->id,
            'enrollment_id' => $createdEnrollments[6]->id,
            'certificate_number' => Certificate::generateNumber(),
            'issued_at' => Carbon::now()->subDays(4),
            'grade' => 'excellent',
        ]);

        Certificate::create([
            'student_id' => $createdStudents[6]->id,
            'course_id' => $createdCourses[3]->id,
            'enrollment_id' => $createdEnrollments[7]->id,
            'certificate_number' => Certificate::generateNumber(),
            'issued_at' => Carbon::now()->subDays(4),
            'grade' => 'very_good',
        ]);

        Certificate::create([
            'student_id' => $createdStudents[0]->id,
            'course_id' => $createdCourses[5]->id,
            'enrollment_id' => $createdEnrollments[9]->id,
            'certificate_number' => Certificate::generateNumber(),
            'issued_at' => Carbon::now()->subDays(8),
            'grade' => 'excellent',
        ]);

        Certificate::create([
            'student_id' => $createdStudents[2]->id,
            'course_id' => $createdCourses[5]->id,
            'enrollment_id' => $createdEnrollments[10]->id,
            'certificate_number' => Certificate::generateNumber(),
            'issued_at' => Carbon::now()->subDays(8),
            'grade' => 'good',
        ]);

        // Create articles (bilingual)
        $articles = [
            [
                'title' => 'كيف تتعلم اللغة الإنجليزية بفعالية: 10 نصائح ذهبية',
                'title_en' => 'How to Learn English Effectively: 10 Golden Tips',
                'slug' => 'how-to-learn-english-effectively',
                'excerpt' => 'تعلم اللغة الإنجليزية ليس بالأمر الصعب إذا اتبعت الطريقة الصحيحة. نقدم لك 10 نصائح ذهبية لتسريع تعلمك.',
                'excerpt_en' => 'Learning English is not difficult if you follow the right approach. Here are 10 golden tips to accelerate your learning journey.',
                'content' => "تعلم اللغة الإنجليزية يتطلب الصبر والمثابرة، ولكن مع الطريقة الصحيحة يمكنك تحقيق تقدم سريع.\n\n1. مارس الاستماع يومياً\n2. اقرأ بانتظام\n3. تحدث بلا خوف\n4. احفظ مفردات جديدة يومياً\n5. استخدم التطبيقات التعليمية\n6. شاهد الأفلام بالترجمة الإنجليزية\n7. انضم لمجموعات محادثة\n8. اكتب يومياً\n9. تعلم القواعد بالسياق\n10. كن صبوراً ومنتظماً",
                'content_en' => "Learning English requires patience and perseverance, but with the right approach you can achieve rapid progress.\n\n1. Practice listening daily\n2. Read regularly\n3. Speak without fear\n4. Memorize new vocabulary every day\n5. Use educational apps\n6. Watch movies with English subtitles\n7. Join conversation groups\n8. Write daily\n9. Learn grammar in context\n10. Be patient and consistent",
                'created_by' => $admin->id,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(30),
            ],
            [
                'title' => 'أهم الأخطاء الشائعة عند تعلم اللغة الإنجليزية',
                'title_en' => 'Common Mistakes When Learning English',
                'slug' => 'common-english-mistakes',
                'excerpt' => 'يقع كثير من متعلمي اللغة الإنجليزية في أخطاء شائعة يمكن تجنبها بسهولة.',
                'excerpt_en' => 'Many English learners make common mistakes that can be easily avoided.',
                'content' => "هناك العديد من الأخطاء الشائعة التي يرتكبها متعلمو اللغة الإنجليزية.\n\nالخلط بين الأزمنة: من أكثر الأخطاء شيوعاً.\nالترجمة الحرفية: حاول التفكير بالإنجليزية مباشرة.\nإهمال النطق: النطق الصحيح مهم جداً.\nعدم الممارسة: الدراسة النظرية وحدها لا تكفي.",
                'content_en' => "There are many common mistakes that English learners make.\n\nMixing tenses: One of the most common errors.\nLiteral translation: Try to think in English directly.\nNeglecting pronunciation: Correct pronunciation is very important.\nLack of practice: Theoretical study alone is not enough.",
                'created_by' => $admin->id,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(20),
            ],
            [
                'title' => 'أفضل 5 تطبيقات لتعلم اللغة الإنجليزية في 2025',
                'title_en' => 'Top 5 Apps for Learning English in 2025',
                'slug' => 'best-english-learning-apps-2025',
                'excerpt' => 'التكنولوجيا أصبحت أداة أساسية في تعلم اللغات. نستعرض لكم أفضل 5 تطبيقات.',
                'excerpt_en' => 'Technology has become an essential tool for language learning. Here are the top 5 apps we recommend.',
                'content' => "في عصر التكنولوجيا، أصبح تعلم اللغة الإنجليزية أسهل من أي وقت مضى.\n\n1. Duolingo\n2. Babbel\n3. Busuu\n4. Memrise\n5. HelloTalk\n\nتذكر أن التطبيقات وسيلة مساعدة وليست بديلاً عن الدراسة المنظمة.",
                'content_en' => "In the age of technology, learning English has become easier than ever.\n\n1. Duolingo\n2. Babbel\n3. Busuu\n4. Memrise\n5. HelloTalk\n\nRemember that apps are a helpful tool, not a substitute for structured study.",
                'created_by' => $admin->id,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(10),
            ],
            [
                'title' => 'كيف تستعد لاختبار IELTS: دليل شامل',
                'title_en' => 'How to Prepare for IELTS: A Complete Guide',
                'slug' => 'ielts-preparation-guide',
                'excerpt' => 'اختبار IELTS من أهم الاختبارات الدولية للغة الإنجليزية.',
                'excerpt_en' => 'IELTS is one of the most important international English proficiency tests.',
                'content' => "اختبار IELTS أحد أهم اختبارات اللغة الإنجليزية المعترف بها دولياً.\n\nقسم الاستماع: مارس الاستماع لمختلف اللهجات.\nقسم القراءة: اقرأ نصوصاً متنوعة.\nقسم الكتابة: تدرب على كتابة المقالات والتقارير.\nقسم التحدث: مارس التحدث بانتظام.\n\nابدأ الاستعداد قبل الاختبار بـ 3 أشهر على الأقل.",
                'content_en' => "IELTS is one of the most internationally recognized English language tests.\n\nListening section: Practice listening to different accents.\nReading section: Read diverse texts.\nWriting section: Practice writing essays and reports.\nSpeaking section: Practice speaking regularly.\n\nStart preparing at least 3 months before the test.",
                'created_by' => $admin->id,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(5),
            ],
        ];

        foreach ($articles as $articleData) {
            Article::create($articleData);
        }

        // Site settings
        Setting::set('site_name', 'معهد النسور للغة الإنجليزية');
        Setting::set('site_description', 'أفضل معهد لتعليم اللغة الإنجليزية');
        Setting::set('site_phone', '+249 XX XXX XXXX');
        Setting::set('site_email', 'info@eagles-institute.com');
        Setting::set('site_address', 'الخرطوم، السودان');

        $this->command->info('تم إنشاء البيانات التجريبية بنجاح!');
        $this->command->info('بيانات الدخول: admin@eagles.com / password');
        $this->command->info('موظف استقبال: reception@eagles.com / password');
    }
}
