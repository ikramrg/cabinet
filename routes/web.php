<?php
use App\Http\Controllers\adminController;

use App\Http\Controllers\AppointmentCalendarController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\LoginController; 
use App\Http\Controllers\BloodBankController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CallLogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurrencySettingController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DiagnosisCategoryController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorDepartmentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\Employee;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FrontServiceController;
use App\Http\Controllers\FrontSettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HospitalScheduleController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Patient;

use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientDiagnosisTestController;
use App\Http\Controllers\PharmacistController;
use App\Http\Controllers\PostalController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccinatedPatientController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\Web;
use Illuminate\Support\Facades\Route;

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

Route::get('/users/creates', function () {
    return view('users.new_create');
});

// Routes for Landing Page starts
Route::middleware('setLanguage')->group(function () {
    Route::get('/', [Web\WebController::class, 'index'])->name('front');
    // Routes for Enquiry Form
    Route::post('send-enquiry', [EnquiryController::class, 'store'])->name('send.enquiry');
    Route::get('/contact-us', [EnquiryController::class, 'contactUs'])->name('contact');
    Route::get('/about-us', [Web\WebController::class, 'aboutUs'])->name('aboutUs');
    Route::post('/book-appointment', [Web\WebController::class, 'bookAppointment'])->name('book-appointment');
    Route::get('/appointment', [Web\WebController::class, 'appointment'])->name('appointment');
    Route::post('/appointment-form', [Web\WebController::class, 'appointmentFromOther'])->name('appointment.post');
    Route::get('/our-services', [Web\WebController::class, 'services'])->name('our-services');
    Route::get('/our-doctors', [Web\WebController::class, 'doctors'])->name('our-doctors');
    Route::get('/terms-of-service', [Web\WebController::class, 'termsOfService'])->name('terms-of-service');
    Route::get('/privacy-policy', [Web\WebController::class, 'privacyPolicy'])->name('privacy-policy');
    Route::get('/working-hours', [Web\WebController::class, 'workingHours'])->name('working-hours');
    Route::get('/testimonial', [Web\WebController::class, 'testimonials'])->name('testimonials');
});

//Change language
Route::post('/change-language', [Web\WebController::class, 'changeLanguage']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout.user');
Route::get('/demo', [Web\WebController::class, 'demo'])->name('demo');
Route::get('/modules-of-hms', [Web\WebController::class, 'modulesOfHms'])->name('modules-of-hms');
// Routes for Landing Page ends

// Routes for Appointment
Route::get('appointments/{email}/patient-detail',
    [Web\AppointmentController::class, 'getPatientDetails'])->name('appointment.patient.details');
Route::get('appointment-doctors-list', [Web\AppointmentController::class, 'getDoctors'])->name('appointment.doctor.list');
Route::get('appointment-doctor-list', [Web\AppointmentController::class, 'getDoctorList'])->name('appointment.doctors.list');
Route::get('appointment-booking-slot',
    [Web\AppointmentController::class, 'getBookingSlot'])->name('appointment.get.booking.slot');
Route::get('appointment-doctor-schedule-list', [ScheduleController::class, 'doctorScheduleList'])->name('doctor-schedule-list');
Route::post('appointment-store', [Web\AppointmentController::class, 'store'])->name('web.appointments.store');

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->middleware('verified');

Route::get('theme-mode', [UserController::class, 'changeThemeMode'])->name('user.mode');

Route::middleware('auth', 'verified', 'xss', 'checkUserStatus')->group(function () {
    Route::get('profile', [UserController::class, 'editProfile']);
    Route::post('change-password', [UserController::class, 'changePassword']);
    Route::post('profile-update', [UserController::class, 'profileUpdate']);
    Route::post('update-language', [UserController::class, 'updateLanguage']);

    

    Route::middleware('role:Admin|Patient|Doctor|Receptionist||Pharmacist')->group(function () {
        Route::prefix('employee')->group(function () {
            Route::get('notice-board', [Employee\NoticeBoardController::class, 'index'])->name('employee.noticeboard')->middleware('modules');
            Route::get('notice-board/{id}', [Employee\NoticeBoardController::class, 'show'])->name('noticeboard.show');
           
        });
    });


    Route::middleware('role:Admin|Patient|Doctor')->group(function () {
        Route::resource('documents', DocumentController::class);
        Route::get('documents', [DocumentController::class, 'index'])->name('documents.index')->middleware('modules');
        Route::post('documents/{document}/update', [DocumentController::class, 'update']);
    });

    Route::middleware('role:Admin|Patient|Doctor|Receptionist')->group(function () {
       
        Route::prefix('patient')->group(function () {
            

            // Routes for Prescription Listing
            Route::get('my-prescriptions', [Patient\PrescriptionController::class, 'index'])->name('prescriptions.list');
            Route::get('my-prescriptions/{id}', [Patient\PrescriptionController::class, 'show'])->name('prescription.show');
        });
    });

    

    // excel export routes.
    Route::middleware('role:Patient')->group(function () {
        Route::prefix('patient')->group(function () {
            Route::get('export-prescription',
                [Patient\PrescriptionController::class, 'prescriptionExport'])->name('prescription.excel');

           

            Route::get('my-vaccinated', [Patient\VaccinatedController::class, 'index'])->name('patient.vaccinated');
        });
    });

    // excel export routes.
    Route::middleware('role:Patient|Doctor|Receptionist')->group(function () {
        Route::get('export-appointments', [AppointmentController::class, 'appointmentExport'])->name('appointments.excel');
    });

    // excel export routes.
    Route::middleware('role:Doctor')->group(function () {
        Route::prefix('doctor')->group(function () {
            Route::get('export-schedules', [ScheduleController::class, 'schedulesExport'])->name('schedules.excel');
        });
    });

    


   



    // excel export routes.
    Route::middleware('role:Receptionist')->group(function () {
        Route::get('export-patient-diagnosis-test',
            [PatientDiagnosisTestController::class, 'patientDiagnosisTestExport'])->name('patient.diagnosis.test.excel');
    });

  

    // excel export routes.
    Route::middleware('role:Pharmacist')->group(function () {
        Route::prefix('pharmacist')->group(function () {
            Route::get('export-brands', [BrandController::class, 'brandExport'])->name('brands.excel');
            Route::get('export-medicines', [MedicineController::class, 'medicineExport'])->name('medicines.excel');
        });
    });

    

    

    

    Route::middleware('role:Admin|Patient|Doctor|Receptionist')->group(function () {
        Route::get('patients/{patient}', [PatientController::class, 'show'])->where('patient',
                '[0-9]+')->name('patients.show');
        Route::get('patient/{patient?}', [PatientController::class, 'getBirthDate'])->name('patients.birthDate');
    });

    Route::middleware('role:Admin|Doctor|Receptionist')->group(function () {
        Route::get('doctors/{doctor}', [DoctorController::class, 'show'])->where('doctor', '[0-9]+')->name('doctors_show');
    });

    Route::middleware('role:Admin|Patient|Doctor|Receptionist')->group(function () {
        Route::resource('appointments', AppointmentController::class);
        Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments.index')->middleware('modules');
        Route::post('appointments/{appointment}', [AppointmentController::class, 'update']);
        Route::get('doctors-list', [AppointmentController::class, 'getDoctors']);
        Route::get('appointment-calendars', [AppointmentCalendarController::class, 'index'])->name('appointment-calendars.index');
        Route::get('calendar-list', [AppointmentCalendarController::class, 'calendarList']);
        Route::get('appointment-detail/{appointment}',
            [AppointmentCalendarController::class, 'getAppointmentDetails'])->name('appointment.details');
        Route::post('appointments/{appointment}/status', [AppointmentController::class, 'status'])
            ->name('appointment.status');
        Route::post('appointments/{appointment}/cancel', [AppointmentController::class, 'cancelAppointment'])
            ->name('appointment.cancel');
    });

    Route::middleware('role:Admin|Receptionist|Patient')->group(function () {
        Route::get('booking-slot', [AppointmentController::class, 'getBookingSlot'])->name('get.booking.slot');
        Route::get('doctor-schedule-list', [ScheduleController::class, 'doctorScheduleList'])->name('admin-doctor-schedule-list');
    });

    

   

    Route::middleware('role:Admin|Doctor|Receptionist|Patient')->group(function () {
        Route::get('doctor-departments/{doctorDepartment}', [DoctorDepartmentController::class, 'show'])
            ->where('doctorDepartment', '[0-9]+');
    });

    
    Route::middleware('role:Admin|Receptionist|Doctor')->group(function () {
        Route::get('doctors', [DoctorController::class, 'index'])->name('doctors.index')->middleware('modules');
        Route::post('doctors', [DoctorController::class, 'store'])->name('doctors.store');
        Route::get('doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
        Route::delete('doctors/{doctor}', [DoctorController::class, 'destroy'])
            ->name('doctors.destroy');
        Route::patch('doctors/{doctor}', [DoctorController::class, 'update'])
            ->name('doctors.update');
        Route::get('doctors/{doctor}/edit', [DoctorController::class, 'edit'])
            ->name('doctors.edit');
        Route::post('doctors/{doctor}/active-deactive', [DoctorController::class, 'activeDeactiveStatus']);
        Route::get('export-doctors', [DoctorController::class, 'doctorExport'])->name('doctors.excel');

        // Listing route for the Enquiry Form details
        Route::get('enquiries', [EnquiryController::class, 'index'])->name('enquiries')->middleware('modules');
        Route::post('enquiries/{id}/active-deactive', [EnquiryController::class, 'activeDeactiveStatus']);
        Route::get('enquiry/{enquiry}', [EnquiryController::class, 'show'])->name('enquiry.show');
        Route::get('patients', [PatientController::class, 'index'])->name('patients.index')->middleware('modules');
        Route::post('patients', [PatientController::class, 'store'])->name('patients.store');
        Route::get('patients/create', [PatientController::class, 'create'])->name('patients.create');
        Route::delete('patients/{patient}', [PatientController::class, 'destroy'])
            ->name('patients.destroy');
        Route::patch('patients/{patient}', [PatientController::class, 'update'])
            ->name('patients.update');
        Route::get('patients/{patient}/edit', [PatientController::class, 'edit'])
            ->name('patients.edit');
        Route::post('patients/{patient}/active-deactive', [PatientController::class, 'activeDeactiveStatus']);
        Route::get('export-patients', [PatientController::class, 'patientExport'])->name('patient.excel');

       
    });

    Route::middleware('role:Admin|Doctor|Pharmacist|Receptionist')->group(function () {
        Route::prefix('employee')->group(function () {
            Route::get('doctor', [Employee\DoctorController::class, 'index'])->name('doctor');
            Route::get('doctor/{id}', [Employee\DoctorController::class, 'show'])->name('doctor.show');
        });
    });

    Route::middleware('role:Pharmacist')->group(function () {
        Route::prefix('employee')->group(function () {
            Route::get('prescriptions', [Employee\PrescriptionController::class, 'index'])->name('employee.prescriptions');
            Route::get('prescriptions/{id}', [Employee\PrescriptionController::class, 'show'])->name('employee.prescriptions.show');
            Route::get('export-prescription',
                    [Employee\PrescriptionController::class, 'prescriptionExport'])->name('employee.prescriptions.excel');
        });
    });

    Route::middleware('role:Admin|Pharmacist')->group(function () {
        Route::resource('medicines', MedicineController::class)->parameters(['medicines' => 'medicine']);
        Route::get('medicines', [MedicineController::class, 'index'])->name('medicines.index')->middleware('modules');
        Route::get('medicines-show-modal/{medicine}', [MedicineController::class, 'showModal'])->name('medicines.show.modal');

        Route::resource('categories', CategoryController::class)->parameters(['categories' => 'category']);
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index')->middleware('modules');
        Route::post('categories/{category_id}/active-deactive',
            [CategoryController::class, 'activeDeActiveCategory'])->name('active.deactive');

        Route::get('brands', [BrandController::class, 'index'])->name('brands.index')->middleware('modules');
        Route::post('brands', [BrandController::class, 'store'])->name('brands.store');
        Route::get('brands/create', [BrandController::class, 'create'])->name('brands.create');
        Route::delete('brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');
        Route::patch('brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
        Route::get('brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
        Route::get('brands/{brand}', [BrandController::class, 'show'])->name('brands.show');
    });

    
    

    

    

    Route::middleware('role:Admin|Doctor')->group(function () {
        Route::resource('document-types', DocumentTypeController::class)->parameters(['document-types' => 'documentType']);
        Route::get('document-types',
            [DocumentTypeController::class, 'index'])->name('document-types.index')->middleware('modules');

        Route::resource('schedules', ScheduleController::class)->parameters(['schedules' => 'schedule']);
        Route::get('schedules', [ScheduleController::class, 'index'])->name('schedules.index')->middleware('modules');

       

        // Route for Prescription
        Route::resource('prescriptions', PrescriptionController::class);
        Route::get('prescriptions/{id}/view', [PrescriptionController::class, 'prescriptionsView']);
        Route::get('prescription-pdf/{id}', [PrescriptionController::class, 'convertToPDF'])->name('prescriptions.pdf');
        Route::post('prescription-medicine', [PrescriptionController::class, 'prescreptionMedicineStore'])->name('prescription.medicine.store');
        Route::get('prescriptions-show-modal/{id}',
            [PrescriptionController::class, 'showModal'])->name('prescriptions.show.modal');
        Route::get('prescriptions', [PrescriptionController::class, 'index'])->name('prescriptions.index')->middleware('modules');
        Route::post('prescriptions/{prescription}/active-deactive', [PrescriptionController::class, 'activeDeactiveStatus']);

        //Route for Vaccinations
        Route::resource('vaccinations', VaccinationController::class)->middleware('modules');

        //Route for Vaccinated Patients
        Route::get('vaccinations', [VaccinationController::class, 'index'])->name('vaccinations.index')->middleware('modules');
        Route::post('vaccinations', [VaccinationController::class, 'store'])->name('vaccinations.store');
        Route::get('vaccinations/create', [VaccinationController::class, 'create'])->name('vaccinations.create');
        Route::get('vaccinations/{vaccination}', [VaccinationController::class, 'show'])->name('vaccinations.show');
        Route::delete('vaccinations/{vaccination}', [VaccinationController::class, 'destroy'])->name('vaccinations.destroy');
        Route::post('vaccinations/{vaccination}/update', [VaccinationController::class, 'update'])->name('vaccination.update');
        Route::get('vaccinations/{vaccination}/edit', [VaccinationController::class, 'edit'])->name('vaccinations.edit');
        Route::get('export-vaccinations', [VaccinationController::class, 'vaccinationsExport'])->name('vaccinations.excel');

        //Route for Vaccinated Patients
        Route::get('vaccinated-patients',
            [VaccinatedPatientController::class, 'index'])->name('vaccinated-patients.index')->middleware('modules');
        Route::post('vaccinated-patients', [VaccinatedPatientController::class, 'store'])->name('vaccinated-patients.store');
        Route::get('vaccinated-patients/create',
            [VaccinatedPatientController::class, 'create'])->name('vaccinated-patients.create');
        Route::get('vaccinated-patients/{vaccinatedPatient}',
            [VaccinatedPatientController::class, 'show'])->name('vaccinated-patients.show');
        Route::delete('vaccinated-patients/{vaccinatedPatient}',
            [VaccinatedPatientController::class, 'destroy'])->name('vaccinated-patients.destroy');
        Route::post('vaccinated-patients/{vaccinatedPatient}/update',
            [VaccinatedPatientController::class, 'update'])->name('vaccinated-patients.update');
        Route::get('vaccinated-patients/{vaccinatedPatient}/edit',
            [VaccinatedPatientController::class, 'edit'])->name('vaccinated-patients.edit');
        Route::get('export-vaccinated-patients', [VaccinatedPatientController::class, 'vaccinatedPatientExport'])
            ->name('vaccinated-patients.excel');
    });

   

    Route::middleware('role:Admin|Receptionist')->group(function () {

        //services routes
        Route::resource('services', ServiceController::class)->parameters(['services' => 'service']);
        Route::get('services', [ServiceController::class, 'index'])->name('services.index')->middleware('modules');
        Route::post('services/{service_id}/active-deactive', [ServiceController::class, 'activeDeActiveService']);
    });

    Route::middleware('role:Admin')->group(function () {
        //Expense Rout
        Route::get('expenses', [ExpenseController::class, 'index'])->name('expenses.index')->middleware('modules');
        Route::post('expenses', [ExpenseController::class, 'store'])->name('expenses.store');
        Route::get('expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
        Route::get('expenses/{expense}', [ExpenseController::class, 'show'])->name('expenses.show');
        Route::delete('expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
        Route::post('expenses/{expense}/update', [ExpenseController::class, 'update'])->name('expenses.update');
        Route::get('expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');

        
    });

    

    

    Route::middleware('role:Admin|Receptionist')->group(function () {
        Route::resource('notice-boards', NoticeBoardController::class)->parameters(['notice-boards' => 'noticeBoard']);
        Route::get('notice-boards', [NoticeBoardController::class, 'index'])->name('noticeboard')->middleware('modules');
    });

    Route::middleware('role:Admin|Receptionist')->group(function () {
       
        // Routes for Mail
        Route::get('mail', [MailController::class, 'index'])->name('mail')->middleware('modules');
        Route::post('send-mail', [MailController::class, 'store'])->name('mail.send');

        
    });

    Route::middleware('role:Admin|Receptionist|Doctor|Pharmacist')->group(function () {
        //Sms Rout
        Route::get('sms', [SmsController::class, 'index'])->name('sms.index')->middleware('modules');
        Route::post('sms', [SmsController::class, 'store'])->name('sms.store');
        Route::get('sms/{sms}', [SmsController::class, 'show'])->name('sms.show');
        Route::get('sms-show-modal/{sms}', [SmsController::class, 'showModal'])->name('sms.show.modal');
        Route::delete('sms/{sms}', [SmsController::class, 'destroy'])->name('sms.destroy');
        Route::get('sms-users-lists', [SmsController::class, 'getUsersList'])->name('sms.users.lists');
    });

    

   

    Route::middleware('role:Admin')->group(function () {

        //blood-bank routes
        Route::resource('blood-banks', BloodBankController::class)->parameters(['blood-banks' => 'bloodBank']);
        Route::get('blood-banks', [BloodBankController::class, 'index'])->name('blood-banks.index')->middleware('modules');

        
    });

    

    Route::middleware('role:Admin')->group(function () {
//        Route::resource('departments', 'DepartmentController');
//        Route::post('departments/{department}/active-deactive', 'DepartmentController@activeDeactiveDepartment');
        Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users-details/{user?}', [UserController::class, 'show'])->name('users.show');
        Route::get('users-details-modal/{user?}', [UserController::class, 'showModal'])->name('users.show.modal');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::patch('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('users/{user}/active-deactive', [UserController::class, 'activeDeactiveStatus'])->name('users.status');
        Route::post('users/{user}/is-verified', [UserController::class, 'isVerified'])->name('users.verified');
        Route::resource('admins', adminController::class);
        Route::get('admins', [adminController::class, 'index'])->name('admins.index');
       

       

        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::resource('currency-settings', CurrencySettingController::class);
        Route::resource('hospital-schedules', HospitalScheduleController::class);
        Route::post('checkRecord', [HospitalScheduleController::class, 'checkRecord'])->name('checkRecord');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
        Route::get('modules', [SettingController::class, 'getModule'])->name('module.index');
        Route::post('modules/{module}/active-deactive', [SettingController::class, 'activeDeactiveStatus'])
            ->name('module.activeDeactiveStatus');

        Route::get('front-settings', [FrontSettingController::class, 'index'])->name('front.settings.index');
        Route::post('front-settings', [FrontSettingController::class, 'update'])->name('front.settings.update');

        Route::get('front-cms-services', [FrontServiceController::class, 'index'])->name('front.cms.services.index');
        Route::get('front-cms-services/create', [FrontServiceController::class, 'create'])->name('front.cms.services.create');
        Route::post('front-cms-services', [FrontServiceController::class, 'store'])->name('front.cms.services.store');
        Route::get('front-cms-services/{id}/edit', [FrontServiceController::class, 'edit'])->name('front.cms.services.edit');
        Route::post('front-cms-services/{id}', [FrontServiceController::class, 'update'])->name('front.cms.services.update');
        Route::delete('front-cms-services/{id}', [FrontServiceController::class, 'destroy'])->name('front.cms.services.destroy');

        Route::get('doctor-departments',
            [DoctorDepartmentController::class, 'index'])->name('doctor-departments.index')->middleware('modules');
        Route::post('doctor-departments', [DoctorDepartmentController::class, 'store'])->name('doctor-departments.store');
        Route::get('doctor-departments/create', [DoctorDepartmentController::class, 'create'])->name('doctor-departments.create');
        Route::delete('doctor-departments/{doctorDepartment}', [DoctorDepartmentController::class, 'destroy'])
            ->name('doctor-departments.destroy');
        Route::patch('doctor-departments/{doctorDepartment}', [DoctorDepartmentController::class, 'update'])
            ->name('doctor-departments.update');
        Route::get('doctor-departments/{doctorDepartment}/edit', [DoctorDepartmentController::class, 'edit'])
            ->name('doctor-departments.edit');
        Route::resource('pharmacists', PharmacistController::class);
        Route::get('pharmacists', [PharmacistController::class, 'index'])->name('pharmacists.index')->middleware('modules');
        Route::post('pharmacists/{pharmacist}/active-deactive', [PharmacistController::class, 'activeDeactiveStatus']);
        Route::get('export-pharmacists', [PharmacistController::class, 'pharmacistExport'])->name('pharmacists.excel');
        Route::resource('receptionists', ReceptionistController::class);
        Route::get('receptionists', [ReceptionistController::class, 'index'])->name('receptionists.index')->middleware('modules');
        Route::post('receptionists/{receptionist}/active-deactive', [ReceptionistController::class, 'activeDeactiveStatus']);
        Route::get('export-receptionists', [ReceptionistController::class, 'receptionistExport'])->name('receptionists.excel');

        Route::get('export-expenses', [ExpenseController::class, 'expenseExport'])->name('expenses.excel');  
    });

    Route::middleware('role:Admin|Patient')->group(function () {
        Route::prefix('employee')->group(function () {
            Route::get('patient-diagnosis-test',
                [Employee\PatientDiagnosisTestController::class, 'index'])->name('patient-diagnosis-test');
            Route::get('patient-diagnosis-test/{patientDiagnosisTest}',
                [Employee\PatientDiagnosisTestController::class, 'show'])->name('patient-diagnosis-test.show');
            Route::get('patient-diagnosis-test/{patientDiagnosisTest}/pdf',
                [Employee\PatientDiagnosisTestController::class, 'convertToPdf'])->name('employee.patient.diagnosis.test.pdf');
        });
    });

    Route::middleware('role:Admin|Doctor|Receptionist')->group(function () {
        //Patient Diagnosis Test
        Route::get('patient-diagnosis-test',
            [PatientDiagnosisTestController::class, 'index'])->name('patient.diagnosis.test.index')->middleware('modules');
        Route::post('patient-diagnosis-test',
            [PatientDiagnosisTestController::class, 'store'])->name('patient.diagnosis.test.store');
        Route::get('patient-diagnosis-test/create',
            [PatientDiagnosisTestController::class, 'create'])->name('patient.diagnosis.test.create');
        Route::get('patient-diagnosis-test/{patientDiagnosisTest}',
            [PatientDiagnosisTestController::class, 'show'])->name('patient.diagnosis.test.show');
        Route::delete('patient-diagnosis-test/{patientDiagnosisTest}',
            [PatientDiagnosisTestController::class, 'destroy'])->name('patient.diagnosis.test.destroy');
        Route::post('patient-diagnosis-test/{patientDiagnosisTest}/update',
            [PatientDiagnosisTestController::class, 'update'])->name('patient.diagnosis.test.update');
        Route::get('patient-diagnosis-test/{patientDiagnosisTest}/edit',
            [PatientDiagnosisTestController::class, 'edit'])->name('patient.diagnosis.test.edit');
        Route::get('patient-diagnosis-test/{patientDiagnosisTest}/pdf',
            [PatientDiagnosisTestController::class, 'convertToPdf'])->name('patient.diagnosis.test.pdf');

        //Diagnosis test Category
        Route::get('diagnosis-categories',
            [DiagnosisCategoryController::class, 'index'])->name('diagnosis.category.index')->middleware('modules');
        Route::post('diagnosis-categories',
            [DiagnosisCategoryController::class, 'store'])->name('diagnosis.category.store');
        Route::get('diagnosis-categories/{diagnosisCategory}',
            [DiagnosisCategoryController::class, 'show'])->name('diagnosis.category.show');
        Route::delete('diagnosis-categories/{diagnosisCategory}',
            [DiagnosisCategoryController::class, 'destroy'])->name('diagnosis.category.destroy');
        Route::patch('diagnosis-categories/{diagnosisCategory}',
            [DiagnosisCategoryController::class, 'update'])->name('diagnosis.category.update');
        Route::get('diagnosis-categories/{diagnosisCategory}/edit',
            [DiagnosisCategoryController::class, 'edit'])->name('diagnosis.category.edit');
    });

    

    Route::middleware('role:Admin')->group(function () {
        Route::get('expense-download/{expense}', [ExpenseController::class, 'downloadMedia']);
        Route::get('export-expenses', [ExpenseController::class, 'expenseExport'])->name('expenses.excel');
    });

    

    
        

    Route::middleware('role:Admin|Receptionist')->group(function () {
        //Call-log routes
        Route::get('call-logs', [CallLogController::class, 'index'])->name('call_logs.index')->middleware('modules');
        Route::get('call-logs/create', [CallLogController::class, 'create'])->name('call_logs.create');
        Route::post('call-logs', [CallLogController::class, 'store'])->name('call_logs.store');
        Route::get('call-logs/{call_log}/edit', [CallLogController::class, 'edit'])->name('call_logs.edit');
        Route::patch('call-logs/{call_log}', [CallLogController::class, 'update'])->name('call_logs.update');
        Route::delete('call-logs/{call_log}', [CallLogController::class, 'destroy'])->name('call_logs.destroy');
        Route::get('export-call-logs', [CallLogController::class, 'export'])->name('call_logs.excel');

       

        //Visitors routes
        Route::get('visitors', [VisitorController::class, 'index'])->name('visitors.index')->middleware('modules');
        Route::get('visitors/create', [VisitorController::class, 'create'])->name('visitors.create');
        Route::post('visitors', [VisitorController::class, 'store'])->name('visitors.store');
        Route::get('visitors/{visitor}/edit', [VisitorController::class, 'edit'])->name('visitors.edit');
        Route::patch('visitors/{visitor}', [VisitorController::class, 'update'])->name('visitors.update');
        Route::delete('visitors/{visitor}', [VisitorController::class, 'destroy'])->name('visitors.destroy');
        Route::get('visitors-download/{visitor}', [VisitorController::class, 'downloadMedia']);
        Route::get('export-visitor', [VisitorController::class, 'export'])->name('visitors.excel');

        //Postal receive routes
        Route::get('receives', [PostalController::class, 'index'])->name('receives.index')->middleware('modules');
        Route::post('receives', [PostalController::class, 'store'])->name('receives.store');
        Route::get('receives/{postal}/edit', [PostalController::class, 'edit'])->name('receives.edit');
        Route::post('receives/{postal}', [PostalController::class, 'update'])->name('receives.update');
        Route::delete('receives/{postal}', [PostalController::class, 'destroy'])->name('receives.destroy');
        Route::get('receives/{postal}', [PostalController::class, 'downloadMedia'])->name('receives.download');
        Route::get('receives-download/{postal}', [PostalController::class, 'downloadMedia']);
        Route::get('export-receive', [PostalController::class, 'export'])->name('receives.excel');

        //Postal dispatch routes
        Route::get('dispatches', [PostalController::class, 'index'])->name('dispatches.index')->middleware('modules');
        Route::post('dispatches', [PostalController::class, 'store'])->name('dispatches.store');
        Route::get('dispatches/{postal}/edit', [PostalController::class, 'edit'])->name('dispatches.edit');
        Route::post('dispatches/{postal}', [PostalController::class, 'update'])->name('dispatches.update');
        Route::delete('dispatches/{postal}', [PostalController::class, 'destroy'])->name('dispatches.destroy');
//        Route::get('dispatches/{postal}', 'PostalController@downloadMedia')->name('dispatches.download');
        Route::get('dispatches-download/{postal}', [PostalController::class, 'downloadMedia'])->name('dispatches.download');
        Route::get('export-dispatch', [PostalController::class, 'export'])->name('dispatches.excel');

        //Testimonial routes
        Route::get('testimonials', [TestimonialController::class, 'index'])->name('testimonials.index')->middleware('modules');
        Route::post('testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
        Route::get('testimonials/{testimonial}', [TestimonialController::class, 'show'])->name('testimonials.show');
        Route::get('testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
        Route::post('testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update');
        Route::delete('testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');
    });

    Route::middleware('role:Admin|Patient|Doctor|Receptionist|Pharmacist')->group(function () {

            //Notification routes
        Route::get('/notification/{notification}/read',
                [NotificationController::class, 'readNotification'])->name('read.notification');
        Route::post('/read-all-notification',
                [NotificationController::class, 'readAllNotification'])->name('read.all.notification');
       
    });

   
});

Route::get('hms-logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::get('qr-scan', function () {
    return view('qr');
});

Route::get('/set-language', [Web\WebController::class, 'setLanguage'])->name('set-language');

require __DIR__.'/upgrade.php';
