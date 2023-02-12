<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\HomeWorkController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\EmployeeTypeController;
use App\Http\Controllers\OthersDownloadController;
use App\Http\Controllers\SyllabusController;
use App\Http\Controllers\ClassRoutineController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ExamScheduleController;
use App\Http\Controllers\ExamAttendanceController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\AddMarksController;
use App\Http\Controllers\FeeTypeController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\SubjectListController;
use App\Http\Controllers\AssignSubjectController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StudentImportController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\EmployeeLeaveController;
use App\Http\Controllers\StudentLeaveController;
use App\Http\Controllers\PendingLeaveController;
use App\Http\Controllers\ApprovedLeaveController;
use App\Http\Controllers\AddClassController;
use App\Http\Controllers\AddSectionController;
use App\Http\Controllers\AddExpenseController;
use App\Http\Controllers\ExpenseTypeController;
use App\Http\Controllers\AssignSectionController;
use App\Http\Controllers\IncomeTypeController;
use App\Http\Controllers\AddIncomeController;
use App\Http\Controllers\AssignClassTeacherController;
use App\Http\Controllers\StudentDiaryController;
use App\Http\Controllers\EmployeeAttendanceController;
use App\Http\Controllers\AccountReportController;
use App\Http\Controllers\EmployeeImportController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\UserStudentController;
use App\Http\Controllers\UserTeacherController;
use App\Http\Controllers\StdDetailsReportController;
use App\Http\Controllers\StdAttendanceReportController;
use App\Http\Controllers\ClassRoutineControler;
use App\Http\Controllers\ExamScheduleReportController;
use App\Http\Controllers\SettingsStudentController;
use App\Http\Controllers\SettingsPaymentsController;
use App\Http\Controllers\EmpDetailsReportControoler;
use App\Http\Controllers\ExamResultReportController;
use App\Http\Controllers\ComplainsController;
use App\Http\Controllers\HomeworkSubmitListController;
use App\Http\Controllers\FeesReportController;
use App\Http\Controllers\TeachersRemarkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/class-wise-section/{class_id}', [UtilityController::class, 'ClassWiseSection']);
Route::get('/class-and-section-wise-section/{class}/{section}', [UtilityController::class, 'ClassAndSectionWiseStudent']);
Route::get('/get-notifications', [UtilityController::class, 'GetNotifications']);
Route::get('/read-notifications', [UtilityController::class, 'ReadAllNotification']);



Route::get('/', [DashboardController::class,'Page'])->middleware('hasToken');
Route::get('/charts', [DashboardController::class,'Chart']);
Route::get('/login', [LoginController::class, 'Page']);
Route::post('/login', [LoginController::class, 'CheckLogin']);
Route::get('/logout', [LoginController::class, 'Logout']);

/** ADD STUDENT ROUTES */
Route::get('/student/add', [StudentController::class, 'Page'])->middleware('hasToken');
Route::post('/student/add', [StudentController::class, 'AddStudent']);

/**----- STUDENT ATTENDANCE ROUTES -----*/
Route::get('/student/attendance', [StudentAttendanceController::class, 'Page'])->middleware('hasToken');
Route::post('/student/attendance', [StudentAttendanceController::class, 'AddAttendance']);
Route::post('/student/attendance/update', [StudentAttendanceController::class, 'UpdateAttendance']);
Route::get('/student/attendance/get/{class}/{section}/{date}', [StudentAttendanceController::class, 'GetStudent']);

/**------ STUDENT IMPORT ROUTE ------------*/
Route::get('/student/import', [StudentImportController::class, 'Page'])->middleware('hasToken');
Route::post('/student/import/save', [StudentImportController::class, 'Save']);

/**------ EMPLOYEE  IMPORT ROUTE ------------*/
Route::get('/employee/import', [EmployeeImportController::class, 'Page'])->middleware('hasToken');
Route::post('/employee/import/save', [EmployeeImportController::class, 'Save']);

/**-----STUDENT EXPORT ROUTES -----*/
Route::get('/student/export', [ExportController::class, 'StudentExportPage'])->middleware('hasToken');
Route::get('/student/export/csv', [ExportController::class, 'StudentExportCSV']);
Route::get('/student/export/pdf', [ExportController::class, 'StudentExportPDF']);

/** ADD EMPLOYEE ROUTES */
Route::get('/employee/add', [EmployeeController::class, 'Page'])->middleware('hasToken');
Route::post('/employee/save', [EmployeeController::class, 'Save']);
Route::get('/employee/export', [ExportController::class, 'EmployeeExportPage']);
Route::get('/employee/export/csv', [ExportController::class, 'EmployeeExportCSV']);
Route::get('/employee/export/pdf', [ExportController::class, 'EmployeeExportPDF']);

/**-------EMPLOYEE ATTENDANCE ROUTES------ */
Route::get('/employee/attendance', [EmployeeAttendanceController::class, 'Page'])->middleware('hasToken');
Route::post('/employee/attendance', [EmployeeAttendanceController::class, 'SetAttendance']);
Route::get('/employee/present-all/{attendance_date}', [EmployeeAttendanceController::class, 'PresentAll']);
Route::get('/employee/absent-all/{attendance_date}', [EmployeeAttendanceController::class, 'AbsentAll']);
Route::get('/employee/attendance/get/{date}', [EmployeeAttendanceController::class, 'Get']);


Route::get('/employee/type', [EmployeeTypeController::class, 'Page'])->middleware('hasToken');
Route::get('/employee/type/get-all', [EmployeeTypeController::class, 'GetAll']);
Route::get('/employee/type/get-single/{id}', [EmployeeTypeController::class, 'GetSingle']);
Route::post('/employee/type/add', [EmployeeTypeController::class, 'Add']);
Route::post('/employee/type/update/{id}', [EmployeeTypeController::class, 'Update']);
Route::get('/employee/type/delete/{id}', [EmployeeTypeController::class, 'Delete']);


/** HOME WORK ROUTE */
Route::get('/study-material/homework', [HomeWorkController::class, 'Page'])->middleware('hasToken');
Route::post('/study-material/homework/save', [HomeWorkController::class, 'Save']);
Route::post('/study-material/homework/update/{id}', [HomeWorkController::class, 'Update']);
Route::get('/study-material/homework/delete/{id}', [HomeWorkController::class, 'Delete']);
Route::get('/study-material/homework/get/{id}', [HomeWorkController::class, 'GetSingleHomeWork']);
Route::get('/study-material/homework/get-all/{class}/{section}/{subject}', [HomeWorkController::class, 'GetAll']);

/** HOME WORK  Submitted List ROUTE */
Route::get('/study-material/all-homework', [HomeworkSubmitListController::class, 'Page'])->middleware('hasToken');
Route::get('/study-material/all-homework/delete/{id}', [HomeworkSubmitListController::class, 'Delete']);
//Route::get('/study-material/homework/get/{id}', [HomeworkSubmitListController::class, 'GetSingleHomeWork']);
Route::get('/study-material/all-homework/{id}', [HomeworkSubmitListController::class, 'GetAll']);


/** STUDENT DIARY ROUTE */
Route::get('/study-material/student-diary', [StudentDiaryController::class, 'Page'])->middleware('hasToken');
Route::post('/study-material/student-diary/save', [StudentDiaryController::class, 'Save']);
Route::post('/study-material/student-diary/update/{id}', [StudentDiaryController::class, 'Update']);
Route::get('/study-material/student-diary/delete/{id}', [StudentDiaryController::class, 'Delete']);
Route::get('/study-material/student-diary/get/{id}', [StudentDiaryController::class, 'GetSingle']);
Route::get('/study-material/student-diary/get-students/{class_id}/{section_id}', [StudentDiaryController::class, 'GetStudents']);
Route::get('/study-material/student-diary/get/{class_id}/{section_id}/{student_id}', [StudentDiaryController::class, 'GetAll']);

Route::get('/study-material/other', [OthersDownloadController::class, 'Page'])->middleware('hasToken');
Route::post('/study-material/other/save', [OthersDownloadController::class, 'Save']);
Route::post('/study-material/other/update/{id}', [OthersDownloadController::class, 'Update']);
Route::get('/study-material/get-contents', [OthersDownloadController::class, 'GetContents']);
Route::get('/study-material/other/delete/{id}', [OthersDownloadController::class, 'Delete']);

Route::get('/study-material/syllabus', [SyllabusController::class, 'Page'])->middleware('hasToken');
Route::get('/study-material/syllabus/get/{class_id}/{exam_id}', [SyllabusController::class, 'GetSyllabus']);
Route::post('/study-material/syllabus/save', [SyllabusController::class, 'Save']);
Route::post('/study-material/syllabus/edit/{id}', [SyllabusController::class, 'Edit']);
Route::get('/study-material/syllabus/delete/{id}', [SyllabusController::class, 'Delete']);
Route::get('/study-material/syllabus/get-single/{id}', [SyllabusController::class, 'GetSingle']);


Route::get('/notice', [NoticeController::class, 'Page'])->middleware('hasToken');
Route::post('/notice/save', [NoticeController::class, 'Save']);
Route::post('/notice/edit/{id}', [NoticeController::class, 'Edit']);
Route::get('/notice/delete/{id}', [NoticeController::class, 'Delete']);
Route::get('/notice/get-single/{id}', [NoticeController::class, 'GetSingle']);
Route::get('/get-notice', [NoticeController::class, 'GetNotice']);

Route::get('/academics/routine', [ClassRoutineController::class, 'Page'])->middleware('hasToken');
Route::post('/academics/routine', [ClassRoutineController::class, 'AddRoutine']);
Route::post('/academics/routine/update', [ClassRoutineController::class, 'Update']);
Route::get('/academics/routine/{class}/{section}', [ClassRoutineController::class, 'GetRoutine']);

//Route::get('/salary', [SalaryController::class, 'Page']);
Route::post('/salary/assign', [SalaryController::class, 'AssignSalary']);
Route::get('/salary/list', [SalaryController::class, 'SalaryList']);
Route::get('/salary/delete/{id}', [SalaryController::class, 'Delete']);
Route::get('/salary/get/{id}', [SalaryController::class, 'GetSingle']);
Route::post('/salary/update/{id}', [SalaryController::class, 'UpdateSalary']);

Route::get('/examination/exam-type', [ExamTypeController::class, 'Page'])->middleware('hasToken');
Route::get('/examination/get-all', [ExamTypeController::class, 'GetAll']);
Route::get('/examination/get-single/{id}', [ExamTypeController::class, 'GetSingle']);
Route::post('/examination/add', [ExamTypeController::class, 'AddExamType']);
Route::post('/examination/update/{id}', [ExamTypeController::class, 'UpdateExamType']);
Route::get('/examination/delete/{id}', [ExamTypeController::class, 'DeleteExamType']);


Route::get('/leave/leave-type', [LeaveTypeController::class, 'Page'])->middleware('hasToken');
Route::get('/leave/get-all', [LeaveTypeController::class, 'GetAll']);
Route::get('/leave/get-single/{id}', [LeaveTypeController::class, 'GetSingle']);
Route::post('/leave/add', [LeaveTypeController::class, 'Add']);
Route::post('/leave/update/{id}', [LeaveTypeController::class, 'Update']);
Route::get('/leave/delete/{id}', [LeaveTypeController::class, 'Delete']);

/** Employee Leave */
Route::get('/leave/employee', [EmployeeLeaveController::class, 'Page'])->middleware('hasToken');
Route::get('/leave/employee/get', [EmployeeLeaveController::class, 'GetAll']);
Route::post('/leave/employee/save', [EmployeeLeaveController::class, 'Save']);
Route::post('/leave/employee/update/{id}', [EmployeeLeaveController::class, 'Update']);
Route::get('/leave/employee/delete/{id}', [EmployeeLeaveController::class, 'Delete']);
Route::get('/leave/employee/get-single/{id}', [EmployeeLeaveController::class, 'GetSingle']);

/** Student Leave */
Route::get('/leave/student', [StudentLeaveController::class, 'Page'])->middleware('hasToken');
Route::get('/leave/student/get', [StudentLeaveController::class, 'GetAll']);
Route::post('/leave/student/save', [StudentLeaveController::class, 'Save']);
Route::post('/leave/student/update/{id}', [StudentLeaveController::class, 'Update']);
Route::get('/leave/student/delete/{id}', [StudentLeaveController::class, 'Delete']);
Route::get('/leave/student/get-single/{id}', [StudentLeaveController::class, 'GetSingle']);

/** Pending Leave */
Route::get('/leave/pending', [PendingLeaveController::class, 'Page'])->middleware('hasToken');
Route::get('/leave/get/{criteria}', [PendingLeaveController::class, 'Get']);
Route::get('/leave/approve/{criteria}/{id}', [PendingLeaveController::class, 'Aprove']);

/** Approved Leave */
Route::get('/leave/Approved', [ApprovedLeaveController::class, 'Page'])->middleware('hasToken');
Route::get('/leave/Approved/get/{criteria}', [ApprovedLeaveController::class, 'Get']);
Route::get('/leave/deny/{criteria}/{id}', [ApprovedLeaveController::class, 'Deny']);


Route::get('/examination/exam-schedule', [ExamScheduleController::class, 'Page'])->middleware('hasToken');
Route::get('/examination/exam-schedule/get/{exam_type}/{class}/{section}', [ExamScheduleController::class, 'Get']);
Route::get('/examination/exam-schedule/check/{exam_type}/{class}/{section}/{subject}/{exam_date}', [ExamScheduleController::class, 'CheckSchedule']);
Route::post('/examination/exam-schedule/save', [ExamScheduleController::class, 'Save']);
Route::post('/examination/exam-schedule/update', [ExamScheduleController::class, 'Update']);

Route::get('/examination/attendance', [ExamAttendanceController::class, 'Page'])->middleware('hasToken');
Route::post('/examination/attendance/save', [ExamAttendanceController::class, 'Save']);
Route::post('/examination/attendance/delete', [ExamAttendanceController::class, 'Delete']);
Route::post('/examination/attendance/update', [ExamAttendanceController::class, 'Update']);
Route::get('/examination/attendance/get-student/{class}/{section}/{subject}/{exam_type}', [ExamAttendanceController::class, 'GetStudent']);

Route::get('/examination/add-mark', [AddMarksController::class, 'Page'])->middleware('hasToken');
Route::post('/examination/add-mark/save', [AddMarksController::class, 'Save']);
Route::post('/examination/add-mark/update', [AddMarksController::class, 'Update']);
Route::get('/examination/mark/get/{class}/{section}/{subject}/{exam_type}', [AddMarksController::class, 'Get']);


Route::get('/accounts/fee-type', [FeeTypeController::class, 'Page'])->middleware('hasToken');
Route::get('/accounts/fee-type/get-all', [FeeTypeController::class, 'GetAll']);
Route::get('/accounts/fee-type/get-single/{id}', [FeeTypeController::class, 'GetSingle']);
Route::post('/accounts/fee-type/add', [FeeTypeController::class, 'AddExamType']);
Route::post('/accounts/fee-type/update/{id}', [FeeTypeController::class, 'UpdateExamType']);
Route::get('/accounts/fee-type/delete/{id}', [FeeTypeController::class, 'DeleteExamType']);

Route::get('/accounts/fees', [FeesController::class, 'Page'])->middleware('hasToken');
Route::get('/accounts/fees/get-all', [FeesController::class, 'GetAll']);
Route::get('/accounts/fees/get-single/{id}', [FeesController::class, 'GetSingle']);
Route::post('/accounts/fees/add', [FeesController::class, 'Add']);
Route::post('/accounts/fees/update/{id}', [FeesController::class, 'Update']);
Route::get('/accounts/fees/delete/{id}', [FeesController::class, 'Delete']);

/** Expense Type Route */
Route::get('/accounts/expense-type', [ExpenseTypeController::class, 'Page'])->middleware('hasToken');
Route::get('/accounts/expense-type/get-all', [ExpenseTypeController::class, 'GetAll']);
Route::get('/accounts/expense-type/get-single/{id}', [ExpenseTypeController::class, 'GetSingle']);
Route::post('/accounts/expense-type/add', [ExpenseTypeController::class, 'Add']);
Route::post('/accounts/expense-type/update/{id}', [ExpenseTypeController::class, 'Update']);
Route::get('/accounts/expense-type/delete/{id}', [ExpenseTypeController::class, 'Delete']);

/** Add Expense Route */
Route::get('/accounts/add-expense', [AddExpenseController::class, 'Page'])->middleware('hasToken');
Route::get('/accounts/add-expense/get-all', [AddExpenseController::class, 'GetAll']);
Route::get('/accounts/add-expense/get-single/{id}', [AddExpenseController::class, 'GetSingle']);
Route::post('/accounts/add-expense/add', [AddExpenseController::class, 'Add']);
Route::post('/accounts/add-expense/update/{id}', [AddExpenseController::class, 'Update']);
Route::get('/accounts/add-expense/delete/{id}', [AddExpenseController::class, 'Delete']);

/** Income Type Route */
Route::get('/accounts/income-type', [IncomeTypeController::class, 'Page'])->middleware('hasToken');
Route::get('/accounts/income-type/get-all', [IncomeTypeController::class, 'GetAll']);
Route::get('/accounts/income-type/get-single/{id}', [IncomeTypeController::class, 'GetSingle']);
Route::post('/accounts/income-type/add', [IncomeTypeController::class, 'Add']);
Route::post('/accounts/income-type/update/{id}', [IncomeTypeController::class, 'Update']);
Route::get('/accounts/income-type/delete/{id}', [IncomeTypeController::class, 'Delete']);

/** Add Income Route */
Route::get('/accounts/add-income', [AddIncomeController::class, 'Page'])->middleware('hasToken');
Route::get('/accounts/add-income/get-all', [AddIncomeController::class, 'GetAll']);
Route::get('/accounts/add-income/get-single/{id}', [AddIncomeController::class, 'GetSingle']);
Route::post('/accounts/add-income/add', [AddIncomeController::class, 'Add']);
Route::post('/accounts/add-income/update/{id}', [AddIncomeController::class, 'Update']);
Route::get('/accounts/add-income/delete/{id}', [AddIncomeController::class, 'Delete']);
Route::get('/accounts/salary', [SalaryController::class, 'Page']);

/** Subject List Route */
Route::get('/academics/subject-list', [SubjectListController::class, 'Page'])->middleware('hasToken');
Route::get('/academics/get-all', [SubjectListController::class, 'GetAll']);
Route::get('/academics/get-single/{id}', [SubjectListController::class, 'GetSingle']);
Route::post('/academics/add', [SubjectListController::class, 'Add']);
Route::post('/academics/update/{id}', [SubjectListController::class, 'Update']);
Route::get('/academics/delete/{id}', [SubjectListController::class, 'Delete']);

/** Add Class Route */
Route::get('/academics/class', [AddClassController::class, 'Page'])->middleware('hasToken');
Route::get('/academics/class/get-all', [AddClassController::class, 'GetAll']);
Route::get('/academics/class/get-single/{id}', [AddClassController::class, 'GetSingle']);
Route::post('/academics/class/add', [AddClassController::class, 'Add']);
Route::post('/academics/class/update/{id}', [AddClassController::class, 'Update']);
Route::get('/academics/class/delete/{id}', [AddClassController::class, 'Delete']);

/** Add Section Route */
Route::get('/academics/section', [AddSectionController::class, 'Page'])->middleware('hasToken');
Route::get('/academics/section/get-all', [AddSectionController::class, 'GetAll']);
Route::get('/academics/section/get-single/{id}', [AddSectionController::class, 'GetSingle']);
Route::post('/academics/section/add', [AddSectionController::class, 'Add']);
Route::post('/academics/section/update/{id}', [AddSectionController::class, 'Update']);
Route::get('/academics/section/delete/{id}', [AddSectionController::class, 'Delete']);

/** Assign Section Route */
Route::get('/academics/assign-section', [AssignSectionController::class, 'Page'])->middleware('hasToken');
Route::get('/academics/assign-section/get-all', [AssignSectionController::class, 'GetAll']);
Route::get('/academics/assign-section/get-single/{id}', [AssignSectionController::class, 'GetSingle']);
Route::post('/academics/assign-section/add', [AssignSectionController::class, 'Add']);
Route::post('/academics/assign-section/update/{id}', [AssignSectionController::class, 'Update']);
Route::get('/academics/assign-section/delete/{id}', [AssignSectionController::class, 'Delete']);

/** Assign Class Teacher Route */
Route::get('/academics/assign-teacher', [AssignClassTeacherController::class, 'Page'])->middleware('hasToken');
Route::get('/academics/assign-teacher/get-all', [AssignClassTeacherController::class, 'GetAll']);
Route::get('/academics/assign-teacher/get-single/{id}', [AssignClassTeacherController::class, 'GetSingle']);
Route::post('/academics/assign-teacher/add', [AssignClassTeacherController::class, 'Add']);
Route::post('/academics/assign-teacher/update/{id}', [AssignClassTeacherController::class, 'Update']);
Route::get('/academics/assign-teacher/delete/{id}', [AssignClassTeacherController::class, 'Delete']);

Route::get('/academics/assign-subject', [AssignSubjectController::class, 'Page'])->middleware('hasToken');
Route::get('/academics/assign-subject/get', [AssignSubjectController::class, 'Get']);
Route::post('/academics/assign-subject/save', [AssignSubjectController::class, 'Save']);
Route::post('/academics/assign-subject/update/{id}', [AssignSubjectController::class, 'Update']);
Route::get('/academics/assign-subject/delete/{id}', [AssignSubjectController::class, 'Delete']);
Route::get('/academics/assign-subject/get-single/{id}', [AssignSubjectController::class, 'GetSingle']);

/**@Report Section [Account]*/
Route::get('/reports/account', [AccountReportController::class, 'Page'])->middleware('hasToken');
Route::get('/reports/account/get/{startDate}/{endDate}', [AccountReportController::class, 'Get']);
Route::get('/reports/account/export-csv/{startDate}/{endDate}', [AccountReportController::class, 'ExportCSV']);
Route::get('/reports/account/export-pdf/{startDate}/{endDate}', [AccountReportController::class, 'ExportPDF']);

/**@Report Section [Employee Details]*/
Route::get('/reports/employee-details', [EmpDetailsReportControoler::class, 'Page'])->middleware('hasToken');
Route::get('/reports/employee-details/get/{type}/{startDate}/{endDate}', [EmpDetailsReportControoler::class, 'Get']);
Route::get('/reports/employee-details/export-csv/{type}/{startDate}/{endDate}', [EmpDetailsReportControoler::class, 'ExportCSV']);
Route::get('/reports/employee-details/export-pdf/{type}/{startDate}/{endDate}', [EmpDetailsReportControoler::class, 'ExportPDF']);

/** @Report Section [Student Attendance]*/
Route::get('/reports/student-attendance', [StdAttendanceReportController::class, 'Page'])->middleware('hasToken');
//Route::get('/reports/student-attendance/get/{startDate}/{endDate}/{student_id}', [StdAttendanceReportController::class, 'Get']);
Route::get('/reports/student-attendance/get/{startDate}/{endDate}/{class}/{section}', [StdAttendanceReportController::class, 'Get']);
//Route::get('/reports/student-attendance/export-csv/{startDate}/{endDate}/{student_id}', [StdAttendanceReportController::class, 'ExportCSV']);
Route::get('/reports/student-attendance/export-csv/{startDate}/{endDate}/{class}/{section}', [StdAttendanceReportController::class, 'ExportCSV']);
//Route::get('/reports/student-attendance/export-pdf/{startDate}/{endDate}/{student_id}', [StdAttendanceReportController::class, 'ExportPDF']);
Route::get('/reports/student-attendance/export-pdf/{startDate}/{endDate}/{class}/{section}', [StdAttendanceReportController::class, 'ExportPDF']);

/** @Report Section [Student Details]*/
Route::get('/reports/student-details', [StdDetailsReportController::class, 'Page'])->middleware('hasToken');
Route::get('/reports/student-details/get/{startDate}/{endDate}/{class}/{section}', [StdDetailsReportController::class, 'Get']);
Route::get('/reports/student-details/export-csv/{startDate}/{endDate}/{class}/{section}', [StdDetailsReportController::class, 'ExportCSV']);
Route::get('/reports/student-details/export-pdf/{startDate}/{endDate}/{class}/{section}', [StdDetailsReportController::class, 'ExportPDF']);

/** @Report Section [Class Routine]*/
Route::get('/reports/class-routine', [ClassRoutineControler::class, 'Page'])->middleware('hasToken');
Route::get('/reports/class-routine/get/{startDate}/{endDate}/{class}/{section}', [ClassRoutineControler::class, 'Get']);
Route::get('/reports/class-routine/export-csv/{startDate}/{endDate}/{class}/{section}', [ClassRoutineControler::class, 'ExportCSV']);
Route::get('/reports/class-routine/export-pdf/{startDate}/{endDate}/{class}/{section}', [ClassRoutineControler::class, 'ExportPDF']);

/** @Report Section [Exam Schedule]*/
Route::get('/reports/exam-schedule', [ExamScheduleReportController::class, 'Page'])->middleware('hasToken');
Route::get('/reports/exam-schedule/get/{examType?}/{startDate?}/{endDate?}/{class?}/{section?}', [ExamScheduleReportController::class, 'Get']);
Route::get('/reports/exam-schedule/export-csv/{examType?}/{startDate?}/{endDate?}/{class?}/{section?}', [ExamScheduleReportController::class, 'ExportCSV']);
Route::get('/reports/exam-schedule/export-pdf/{examType?}/{startDate?}/{endDate?}/{class?}/{section?}', [ExamScheduleReportController::class, 'ExportPDF']);

/** @Report Section [Exam Result]*/
Route::get('/reports/exam-result', [ExamResultReportController::class, 'Page'])->middleware('hasToken');
Route::get('/reports/exam-result/get/{examType?}/{startDate?}/{endDate?}/{class?}/{section?}', [ExamResultReportController::class, 'Get']);
Route::get('/reports/exam-result/export-csv/{examType?}/{startDate?}/{endDate?}/{class?}/{section?}', [ExamResultReportController::class, 'ExportCSV']);
Route::get('/reports/exam-result/export-pdf/{examType?}/{startDate?}/{endDate?}/{class?}/{section?}', [ExamResultReportController::class, 'ExportPDF']);

/**@Report Section [Fees]*/
Route::get('/reports/fees', [FeesReportController::class, 'Page'])->middleware('hasToken');
Route::get('/reports/fees/get/{startDate}/{endDate}', [FeesReportController::class, 'Get']);
Route::get('/reports/fees/export-csv/{startDate}/{endDate}', [FeesReportController::class, 'ExportCSV']);
Route::get('/reports/fees/export-pdf/{startDate}/{endDate}', [FeesReportController::class, 'ExportPDF']);

/** @Report Section [Teacher Remarks]*/
Route::get('/teacher-remarks', [TeachersRemarkController::class, 'Page'])->middleware('hasToken');
Route::get('/reports/teacher-remarks/get/{month}/{class}/{section}', [TeachersRemarkController::class, 'Get']);
Route::get('/reports/teacher-remarks/export-csv/{month}/{class}/{section}', [TeachersRemarkController::class, 'ExportCSV']);
Route::get('/reports/teacher-remarks/export-pdf/{month}/{class}/{section}', [TeachersRemarkController::class, 'ExportPDF']);




/**@Users Section */
//admin
Route::get('/users/admin', [UserAdminController::class, 'Page'])->middleware('hasToken');
Route::get('/users/admin/list', [UserAdminController::class, 'Get']);
Route::post('/users/admin/create', [UserAdminController::class, 'Create']);
Route::post('/users/admin/update', [UserAdminController::class, 'Update']);
Route::get('/users/admin/list/{id}', [UserAdminController::class, 'GetSingle']);

//student
Route::get('/users/student', [UserStudentController::class, 'Page'])->middleware('hasToken');
Route::get('/users/student/list', [UserStudentController::class, 'Get']);
Route::get('/users/student/create', [UserStudentController::class, 'Create']);
Route::get('/users/student/list/{id}', [UserStudentController::class, 'GetSingle']);
Route::post('/users/student/update/{id}', [UserStudentController::class, 'Update']);
Route::get('/users/student/delete/{id}', [UserStudentController::class, 'Delete']);

//teacher
Route::get('/users/teacher', [UserTeacherController::class, 'Page'])->middleware('hasToken');
Route::get('/users/teacher/list', [UserTeacherController::class, 'Get']);
Route::get('/users/teacher/create', [UserTeacherController::class, 'Create']);
Route::get('/users/teacher/list/{id}', [UserTeacherController::class, 'GetSingle']);
Route::post('/users/teacher/update', [UserTeacherController::class, 'Update']);
Route::get('/users/teacher/delete/{id}', [UserTeacherController::class, 'Delete']);


/**Settings [School]*/
Route::get('/settings/school', [SettingsStudentController::class, 'Page'])->middleware('hasToken');
Route::post('/settings/create', [SettingsStudentController::class, 'Create']);

/**Settings [Payments]*/
Route::get('/settings/payments', [SettingsPaymentsController::class, 'Page'])->middleware('hasToken');

/**Complains Controller */
Route::get('/complains', [ComplainsController::class, 'Page'])->middleware('hasToken');
Route::get('/reports/complains/get/{startDate}/{endDate}', [ComplainsController::class, 'Get']);
Route::get('/reports/complains/export-csv/{startDate}/{endDate}', [ComplainsController::class, 'ExportCSV']);
Route::get('/reports/complains/export-pdf/{startDate}/{endDate}', [ComplainsController::class, 'ExportPDF']);


Route::get('/privacy-policy', function(){
    return view('pages.PrivacyPolicy');
});