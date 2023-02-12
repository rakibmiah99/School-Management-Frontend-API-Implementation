<!-- START SIDEBAR -->
<section class="section-dashboard--sidebar" style="overflow-y: auto">
    <div class="logo-box">
        <a href="/">
            <img class="logo" src="{{asset("assets/images/logo.png")}}" alt="logo" />
        </a>
    </div>
    <ul class="menu">
        <li>
            <a href="/" class="menu-item {{$activePage == "dashboard" ? "active" : ""}} mt-5">
                <i class="bi bi-speedometer2 pe-3"></i>
                Dashboard
            </a>
        </li>
        <li>
            <button
                    class="btn menu-item w-100 {{$activeMenu == "users" ? "active" : ""}}"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#usersCollapse"
                    aria-expanded="false"
                    aria-controls="usersCollapse"

            >
                <i class="bi bi-person-fill pe-3"></i>
                Users
            </button>
            <div class="collapse {{$activeMenu == "users" ? "show" : ""}}" id="usersCollapse">
                <a class="menu-sub-item {{$activePage == "users-admin" ? "active" : ""}}" href="/users/admin">Admin</a>
                <a class="menu-sub-item {{$activePage == "users-student" ? "active" : ""}}" href="/users/student">Student</a>
                <a class="menu-sub-item {{$activePage == "users-teacher" ? "active" : ""}}" href="/users/teacher">Teacher</a>
            </div>
        </li>
        <li>
            <button
                class="btn menu-item w-100 {{$activeMenu == "student" ? "active" : ""}}"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#studentInfoCollapse"
                aria-expanded="false"
                aria-controls="studentInfoCollapse"
            >
                <i class="bi bi-person-badge pe-3"></i>
                Student Info
            </button>
            <div class="collapse {{$activeMenu == "student" ? "show" : ""}}" id="studentInfoCollapse">
                <a class="menu-sub-item {{$activePage == "add-student" ? "active" : ""}}" href="/student/add"
                >Add Student</a
                >
                <a class="menu-sub-item {{$activePage == "student-attendance" ? "active" : ""}}" href="/student/attendance"
                >Student Attendance</a
                >
                <a class="menu-sub-item {{$activePage == "student-diary" ? "active" : ""}}" href="/study-material/student-diary"
                >Student Diary</a
                >
                <a class="menu-sub-item {{$activePage == "studentExport" ? "active" : ""}}" href="/student/export"
                >All Student Export</a
                >
            </div>
        </li>


        <li>
            <button
                class="btn menu-item w-100 {{$activeMenu == "employee" ? "active" : ""}}"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#employeeInfoCollapse"
                aria-expanded="false"
                aria-controls="employeeInfoCollapse"
            >
                <i class="bi bi-person-badge pe-3"></i>
                Employee Info
            </button>
            <div class="collapse {{$activeMenu == "employee" ? "show" : ""}}" id="employeeInfoCollapse">
                <a class="menu-sub-item {{$activePage == "employee-type" ? "active" : ""}}" href="/employee/type"
                >Employee Type</a
                >
                <a class="menu-sub-item {{$activePage == "add-employee" ? "active" : ""}}" href="/employee/add"
                >Add Employee</a
                >
                <a class="menu-sub-item {{$activePage == "employee-attendance" ? "active" : ""}}" href="/employee/attendance"
                >Employee Attendance</a
                >
                <a class="menu-sub-item {{$activePage == "employee-export" ? "active" : ""}}" href="/employee/export"
                >All Employee Export</a
                >
            </div>
        </li>


        <li>
            <button
                class="btn menu-item w-100 {{$activeMenu == "study-material" ? "active" : ""}}"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#studyMaterialCollapse"
                aria-expanded="false"
                aria-controls="studyMaterialCollapse"
            >
                <i class="bi bi-book pe-3"></i>
                Study Material
            </button>
            <div class="collapse {{$activeMenu == "study-material" ? "show" : ""}}" id="studyMaterialCollapse">
                <a class="menu-sub-item {{$activePage == "homework" ? "active" : ""}}" href="/study-material/homework"
                >Upload Homework</a
                >
                <a class="menu-sub-item {{$activePage == "syllabus" ? "active" : ""}}" href="/study-material/syllabus"
                >Upload Syllabus</a
                >
                <a class="menu-sub-item {{$activePage == "other" ? "active" : ""}}" href="/study-material/other"
                >Other Downloads</a
                >
                <a class="menu-sub-item {{$activePage == "all-homework" ? "active" : ""}}" href="/study-material/all-homework"
                >All Homework</a
                >
            </div>
        </li>
        <li>
            <button
                class="btn menu-item  w-100 {{$activeMenu == "leave" ? "active" : ""}}"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#leaveCollapse"
                aria-expanded="false"
                aria-controls="leaveCollapse"
            >
                <i class="bi bi-door-open pe-3"></i>
                Leave
            </button>
            <div class="collapse {{$activeMenu == "leave" ? "show" : ""}}" id="leaveCollapse">
                <a class="menu-sub-item {{$activePage == "leave-approved" ? "active" : ""}}" href="/leave/Approved"
                >Approved Leave Request</a
                >
                <a class="menu-sub-item {{$activePage == "leave-pending" ? "active" : ""}}" href="/leave/pending"
                >Pending Leave Request</a
                >
                <a class="menu-sub-item {{$activePage == "leave-employee" ? "active" : ""}}" href="/leave/employee"
                >Define Employee Leave</a
                >
                <a class="menu-sub-item {{$activePage == "leave-student" ? "active" : ""}}" href="/leave/student"
                >Define Student Leave</a
                >
                <a class="menu-sub-item {{$activePage == "leave-type" ? "active" : ""}}" href="/leave/leave-type"
                >Employee Leave Type</a
                >
            </div>
        </li>
        <li>
            <button
                class="btn menu-item w-100 {{$activeMenu == "examination" ? "active" : ""}}"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#examinationCollapse"
                aria-expanded="false"
                aria-controls="examinationCollapse"
            >
                <i class="bi bi-pencil-square pe-3"></i>
                Examination
            </button>
            <div class="collapse {{$activeMenu == "examination" ? "show" : ""}}" id="examinationCollapse">
                <a class="menu-sub-item {{$activePage == "exam-type" ? "active" : ""}}" href="/examination/exam-type"
                >Exam Type</a
                >
                <a class="menu-sub-item {{$activePage == "exam-schedule" ? "active" : ""}} " href="/examination/exam-schedule"
                >Exam Schedule</a
                >
                <a class="menu-sub-item {{$activePage == "exam-attendance" ? "active" : ""}} " href="/examination/attendance"
                >Exam Attendance</a
                >
                <a class="menu-sub-item {{$activePage == "add-marks" ? "active" : ""}}" href="/examination/add-mark"
                >Add Marks</a
                >
            </div>
        </li>
        <li>
            <button
                class="btn menu-item w-100 {{$activeMenu == "academics" ? "active" : ""}}"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#academicsCollapse"
                aria-expanded="false"
                aria-controls="academicsCollapse">
                <i class="bi bi-mortarboard pe-3"></i>
                Academics
            </button>
            <div class="collapse {{$activeMenu == "academics" ? "show" : ""}}" id="academicsCollapse">
                <a class="menu-sub-item {{$activePage == "add-class" ? "active" : ""}}" href="/academics/class">Add Class</a>
                <a class="menu-sub-item {{$activePage == "add-section" ? "active" : ""}}" href="/academics/section">Add Section</a>
                <a class="menu-sub-item {{$activePage == "assign-section" ? "active" : ""}}" href="/academics/assign-section">Assign Section</a>
                <a class="menu-sub-item {{$activePage == "create-routine" ? "active" : ""}}" href="/academics/routine">Create Class Routine</a>
                <a class="menu-sub-item {{$activePage == "assign-subject" ? "active" : ""}} " href="/academics/assign-subject">Assign Subject</a>
                <a class="menu-sub-item {{$activePage == "assign-teacher" ? "active" : ""}} " href="/academics/assign-teacher">Assign Class Teacher</a>
                <a class="menu-sub-item {{$activePage == "subject-list" ? "active" : ""}} " href="/academics/subject-list">Subject List</a>
            </div>
        </li>
        <li>
            <button
                class="btn menu-item w-100 {{$activeMenu == "accounts" ? "active" : ""}}"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#accountsCollapse"
                aria-expanded="false"
                aria-controls="accountsCollapse">
                <i class="bi bi-piggy-bank pe-3"></i>
                Accounts
            </button>
            <div class="collapse {{$activeMenu == "accounts" ? "show" : ""}}" id="accountsCollapse">
                <a class="menu-sub-item {{$activePage == "fee-type" ? "active" : ""}}" href="/accounts/fee-type">Fee Type</a>
                <a class="menu-sub-item {{$activePage == "fees" ? "active" : ""}}" href="/accounts/fees">Fees</a>
                <a class="menu-sub-item {{$activePage == "expense-type" ? "active" : ""}}" href="/accounts/expense-type">Expense Type</a>
                <a class="menu-sub-item {{$activePage == "add-expense" ? "active" : ""}}" href="/accounts/add-expense">Add Expense</a>
                <a class="menu-sub-item {{$activePage == "income-type" ? "active" : ""}}" href="/accounts/income-type">Income Type</a>
                <a class="menu-sub-item {{$activePage == "add-income" ? "active" : ""}}" href="/accounts/add-income">Add Income</a>
                <a class="menu-sub-item {{$activePage == "salary" ? "active" : ""}}" href="/accounts/salary">Salary</a>
            </div>
        </li>
        <li>
            <button
                    class="btn menu-item w-100 menu-item w-100 {{$activeMenu == "reports" ? "active" : ""}}"
                    type="button" data-bs-toggle="collapse"
                    data-bs-target="#reportsCollapse"
                    aria-expanded="false"
                    aria-controls="reportsCollapse"

            >
                <i class="bi bi-file-arrow-down pe-3"></i>
                Reports
            </button>
            <div class="collapse {{$activeMenu == "reports" ? "show" : ""}}" id="reportsCollapse">
                <a class="menu-sub-item {{$activePage == "account-report" ? "active" : ""}}" href="/reports/account">Accounts Report</a>
                <a class="menu-sub-item {{$activePage == "fees-report" ? "active" : ""}}" href="/reports/fees">Fees Report</a>
                <a class="menu-sub-item {{$activePage == "student-attendance-report" ? "active" : ""}}" href="/reports/student-attendance">Attendance Report</a>
                <a class="menu-sub-item {{$activePage == "student-details-report" ? "active" : ""}}" href="/reports/student-details">Student Details Report</a>
                <a class="menu-sub-item {{$activePage == "employee-details-report" ? "active" : ""}}" href="/reports/employee-details">Employee Details Report</a>
                <a class="menu-sub-item {{$activePage == "class-routine-report" ? "active" : ""}}" href="/reports/class-routine">Class Routine Report</a>
                <a class="menu-sub-item {{$activePage == "exam-schedule-report" ? "active" : ""}}" href="/reports/exam-schedule">Exam Schedule Report</a>
                <a class="menu-sub-item {{$activePage == "exam-result-report" ? "active" : ""}}" href="/reports/exam-result">Exam Result Report</a>
            </div>

        </li>
        <li>
            <a href="/teacher-remarks" class="menu-item {{$activeMenu == "teacher-remarks" ? "active" : ""}}">
                <i class="bi bi-graph-up pe-3"></i>
                Teacher's Remark
            </a>
        </li>
        <li>
            <a href="/notice" class="menu-item {{$activeMenu == "notice" ? "active" : ""}}">
                <i class="bi bi-pin-angle pe-3"></i>
                Notice Board
            </a>
        </li>
        <li>
            <a href="/complains" class="menu-item {{$activeMenu == "complains" ? "active" : ""}}">
                <i class="bi bi-exclamation-octagon pe-3"></i>
                Complains
            </a>
        </li>
        <li>
            <button class="btn menu-item w-100 {{$activeMenu == "settings" ? "active" : ""}}" type="button" data-bs-toggle="collapse" data-bs-target="#settingsCollapse" aria-expanded="false" aria-controls="settingsCollapse">
                <i class="bi bi-tools pe-3"></i>
                Settings
            </button>
            <div class="collapse {{$activeMenu == "settings" ? "show" : ""}}" id="settingsCollapse">
                <a class="menu-sub-item {{$activePage == "settings-school" ? "active" : ""}}" href="/settings/school">School Settings</a>
                <a class="menu-sub-item {{$activePage == "settings-payments" ? "active" : ""}}" href="/settings/payments">Payment Settings</a>
            </div>
        </li>
        <li>
            <hr />
        </li>

        <li>
            <a href="/logout" class="menu-item">
                <i class="bi bi-box-arrow-right pe-3"></i>
                Log Out
            </a>
        </li>
    </ul>
</section>
