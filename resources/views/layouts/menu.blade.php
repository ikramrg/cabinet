@php($modules = App\Models\Module::cacheFor(now()->addDays())->toBase()->get())
{{--<div class="position-relative mb-5 mx-3 mt-2 sidebar-search-box">--}}
{{--    <span class="svg-icon svg-icon-1 svg-icon-primary position-absolute top-50 translate-middle ms-9">--}}
{{--                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"--}}
{{--                                                                 height="24" viewBox="0 0 24 24" fill="none">--}}
{{--                                                                <rect opacity="0.5" x="17.0365" y="15.1223"--}}
{{--                                                                      width="8.15546" height="2" rx="1"--}}
{{--                                                                      transform="rotate(45 17.0365 15.1223)"--}}
{{--                                                                      fill="black"></rect>--}}
{{--                                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"--}}
{{--                                                                      fill="black"></path>--}}
{{--                                                            </svg>--}}
{{--                                                        </span>--}}
{{--    <input type="text" class="form-control form-control-lg  ps-15" id="menuSearch" name="search"--}}
{{--           value="" placeholder="Search" style="background-color: #2A2B3A;border: none;color: #FFFFFF"--}}
{{--           autocomplete="off">--}}
{{--</li>--}}
{{--<div class="no-record text-white text-center d-none">No matching records found</li>--}}
@role('Admin')
{{--Dashboard--}}
<li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
    <a class="nav-link  d-flex align-items-center py-3" href="{{ route('dashboard') }}">
        <span class="aside-menu-icon pe-3 pe-3">
            <i class="fas fa-chart-pie"></i>
		</span>
        <span class="aside-menu-title">{{ __('messages.dashboard.dashboard') }}</span>
    </a>
</li>

{{--Admin--}}
@module('Admin',$modules)
<li class="nav-item  {{ Request::is('admins*') ? 'active' : '' }}">
    <a class="nav-link  d-flex align-items-center py-3"
       href="{{ route('admins.index') }}">
        <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-user"></i></span>
        <span class="aside-menu-title">{{ __('messages.admin') }}</span>
    </a>
</li>
@endmodule



{{--Appointments--}}
@module('Appointments',$modules)
<li class="nav-item {{ Request::is('appointment*') ? 'active' : '' }}">
    <a class="nav-link  d-flex align-items-center py-3"
       href="{{ route('appointments.index') }}">
        <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-calendar-check"></i></span>
        <span class="aside-menu-title">{{ __('messages.appointments') }}</span>
    </a>
</li>
@endmodule





{{-- Blood Bank dropdown --}}
<?php
$bloodbankMGT = getMenuLinks(\App\Models\User::MAIN_BLOOD_BANK_MGT)
?>
@if ($bloodbankMGT)
    <li class="nav-item  {{ Request::is('blood-banks*','blood-donors*','blood-donations*','blood-issues*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ $bloodbankMGT }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-tint"></i></span>
            <span class="aside-menu-title">{{ __('messages.blood_bank') }}</span>
            <span class="d-none">{{__('messages.blood_donors')}}</span>
            <span class="d-none">{{__('messages.blood_donations')}}</span>
            <span class="d-none">{{__('messages.blood_issues')}}</span>
        </a>
    </li>
@endif

{{--Documents Mgt--}}
<?php
$documentMGT = getMenuLinks(\App\Models\User::MAIN_DOCUMENT)
?>
@if ($documentMGT)
    <li class="nav-item {{ Request::is('documents*','document-types*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ $documentMGT }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-file"></i></span>
            <span class="aside-menu-title">{{ __('messages.documents') }}</span>
            <span class="d-none">{{__('messages.document_types')}}</span>
        </a>
    </li>
@endif

{{-- Doctors dropdown --}}
<?php
$doctorMGT = getMenuLinks(\App\Models\User::MAIN_DOCTOR)
?>
@if ($doctorMGT)
    <li class="nav-item  {{ Request::is('doctors*','doctor-departments*','schedules*','prescriptions*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ $doctorMGT }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fa fa-user-md"></i></span>
            <span class="aside-menu-title">{{ __('messages.doctors') }}</span>
            <span class="d-none">{{__('messages.doctor_departments')}}</span>
            <span class="d-none">{{__('messages.schedules')}}</span>
            <span class="d-none">{{__('messages.prescriptions')}}</span>
        </a>
    </li>
@endif

{{--Diagnosis Test--}}
<?php
$diagnosisMGT = getMenuLinks(\App\Models\User::MAIN_DIAGNOSIS)
?>
@if ($diagnosisMGT)
    <li class="nav-item  {{ Request::is('diagnosis-categories*','patient-diagnosis-test*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ $diagnosisMGT }}">
                                                    <span class="aside-menu-icon pe-3 pe-3"><i
                                                                class="fas fa-diagnoses"></i></span>
            <span class="aside-menu-title">{{ __('messages.patient_diagnosis_test.diagnosis') }}</span>
            <span class="d-none">{{ __('messages.patient_diagnosis_test.diagnosis_category') }}</span>
            <span class="d-none">{{ __('messages.patient_diagnosis_test.diagnosis_test') }}</span>
        </a>
    </li>
@endif

{{-- Enquiries --}}
@module('Enquires',$modules)
<li class="nav-item  {{ Request::is('enquiries*') || Request::is('enquiry*') ? 'active' : '' }}">
    <a class="nav-link  d-flex align-items-center py-3"
       href="{{ route('enquiries') }}">
                                                        <span class="aside-menu-icon pe-3 pe-3"><i
                                                                    class="fas fa-question-circle"></i></span>
        <span class="aside-menu-title">{{ __('messages.enquiries') }}</span>
    </a>
</li>
@endmodule



{{-- Front office --}}
<?php
$frontOfficeMGT = getMenuLinks(\App\Models\User::MAIN_FRONT_OFFICE)
?>
@if ($frontOfficeMGT)
    <li class="nav-item  {{ Request::is('call-logs*','visitor*','receives*','dispatches*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ $frontOfficeMGT }}">
                                                                    <span class="aside-menu-icon pe-3 pe-3"><i
                                                                                class="fa fa-dungeon"></i></span>
            <span class="aside-menu-title">{{ __('messages.front_office') }}</span>
            <span class="d-none">{{ __('messages.call_logs') }}</span>
            <span class="d-none">{{ __('messages.visitors') }}</span>
            <span class="d-none">{{ __('messages.postal_receive') }}</span>
            <span class="d-none">{{ __('messages.postal_dispatch') }}</span>
        </a>
    </li>
@endif

{{-- Front settings --}}
<li class="nav-item {{ Request::is('front-settings*','notice-boards*','testimonials*', 'front-cms-services*') ? 'active' : '' }}">
    <a class="nav-link  d-flex align-items-center py-3"
       href="{{ route('front.settings.index') }}">
                                                                        <span class="aside-menu-icon pe-3 pe-3"><i
                                                                                    class="fas fa fa-cog"></i></span>
        <span class="aside-menu-title">{{ __('messages.front_cms') }}</span>
        <span class="d-none">{{ __('messages.notice_boards') }}</span>
        <span class="d-none">{{ __('messages.testimonials') }}</span>
        <span class="d-none">{{ __('messages.cms') }}</span>
        <span class="d-none">{{ __('messages.front_cms_services') }}</span>
    </a>
</li>










{{-- Medicines dropdown --}}
<?php
$medicineMgt = getMenuLinks(\App\Models\User::MAIN_MEDICINES)
?>
@if ($medicineMgt)
    <li class="nav-item  {{ Request::is('categories*','brands*','medicines*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ $medicineMgt }}">
                                                                                                    <span class="aside-menu-icon pe-3 pe-3"><i
                                                                                                                class="fas fa-capsules"></i></span>
            <span class="aside-menu-title">{{ __('messages.medicines') }}</span>
            <span class="d-none">{{__('messages.medicine_categories')}}</span>
            <span class="d-none">{{__('messages.medicine_brands')}}</span>
            <span class="d-none">{{__('messages.medicines')}}</span>
        </a>
    </li>
@endif





{{--Pharmacsist--}}
@module('Pharmacists',$modules)
<li class="nav-item {{ Request::is('pharmacists*') ? 'active' : '' }}">
    <a class="nav-link  d-flex align-items-center py-3"
       href="{{ route('pharmacists.index') }}">
                                                                                                                <span class="aside-menu-icon pe-3 pe-3"><i
                                                                                                                            class="fas fa-file-prescription"></i></span>
        <span class="aside-menu-title">{{ __('messages.pharmacists') }}</span>
    </a>
</li>
@endmodule




{{--Receptinist--}}
@module('Receptionists',$modules)
<li class="nav-item  {{ Request::is('receptionists*') ? 'active' : '' }}">
    <a class="nav-link  d-flex align-items-center py-3"
       href="{{ route('receptionists.index') }}">
                                                                                                                        <span class="aside-menu-icon pe-3 pe-3"><i
                                                                                                                                    class="fa fa-user-tie"></i></span>
        <span class="aside-menu-title">{{ __('messages.receptionists') }}</span>
    </a>
</li>
@endmodule







{{-- sms/mail--}}
<?php
$smsMailMgt = getMenuLinks(\App\Models\User::MAIN_SMS_MAIL)
?>
@if ($smsMailMgt)
    <li class="nav-item  {{ Request::is('sms*','mail*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ $smsMailMgt }}"
           title="{{ __('SMS/Mail') }}">
        <span class="aside-menu-icon pe-3 pe-3">
            <i class="fas fa-bell"></i>
		</span>
            <span class="aside-menu-title">{{ __('messages.sms.sms') }}/{{ __('messages.mail') }}</span>
            <span class="d-none">{{ __('messages.sms.sms') }}</span>
            <span class="d-none">{{ __('messages.mail') }}</span>
        </a>
    </li>
@endif

{{-- Settings --}}
<li class="nav-item  {{ Request::is('settings*','hospital-schedules*','currency-settings*') ? 'active' : '' }}">
    <a class="nav-link  d-flex align-items-center py-3"
       href="{{ route('settings.edit') }}">
        <span class="aside-menu-icon pe-3 pe-3"><i class="fa fa-cogs"></i></span>
        <span class="aside-menu-title">{{ __('messages.settings') }}</span>
        <span class="d-none">{{ __('messages.general') }}</span>
        <span class="d-none">{{ __('messages.sidebar_setting') }}</span>
    </a>
</li>


{{--Users--}}
<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link  d-flex align-items-center py-3"
       href="{{ route('users.index') }}">
        <span class="aside-menu-icon pe-3 pe-3">
            <i class="fas fa-user-friends"></i>
		</span>
        <span class="aside-menu-title">{{ __('messages.users') }}</span>
    </a>
</li>

{{-- Vaccination --}}
<?php
$vaccinationsPatient = getMenuLinks(\App\Models\User::MAIN_VACCINATION_MGT)
?>
@if ($vaccinationsPatient)
    <li class="nav-item  {{ Request::is('vaccinated-patients*','vaccinations*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ $vaccinationsPatient }}">
                <span class="aside-menu-icon pe-3 pe-3">
                     <i class="fas fa-syringe"></i>
                </span>
            <span class="aside-menu-title">{{ __('messages.vaccinations') }}</span>
            <span class="d-none">{{__('messages.vaccinated_patients')}}</span>
        </a>
    </li>
@endif
@endrole
@if(Auth::user()->email_verified_at != null)
    @role('Doctor')
    @module('Appointments',$modules)
    <li class="nav-item  {{ Request::is('appointments*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('appointments.index') }}">
                                                                                                                                                                <span class="aside-menu-icon pe-3 pe-3"><i
                                                                                                                                                                            class="nav-icon fas fa-calendar-check"></i></span>
            <span class="aside-menu-title">{{ __('messages.appointments') }}</span>
        </a>
    </li>
    @endmodule



    @module('Doctors',$modules)
    <li class="nav-item  {{ Request::is('employee/doctor*','prescriptions*','schedules*','doctors*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/doctor') }}">
                                                                                                                                                                <span class="aside-menu-icon pe-3 pe-3"><i
                                                                                                                                                                            class="fa fa-user-md"></i></span>
            <span class="aside-menu-title">{{ __('messages.doctors') }}</span>
            <span class="d-none">{{__('messages.schedules')}}</span>
            <span class="d-none">{{__('messages.prescriptions')}}</span>
        </a>
    </li>
    @endmodule

    @module('Documents',$modules)
    <li class="nav-item  {{ Request::is('documents*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('documents.index') }}">
                                                                                                                                                                <span class="aside-menu-icon pe-3 pe-3"><i
                                                                                                                                                                            class="fas fa-file"></i></span>
            <span class="aside-menu-title">{{ __('messages.documents') }}</span>
        </a>
    </li>
    @endmodule

    {{--Diagnosis Test--}}
    <?php
    $diagnosisDoctorMGT = getMenuLinks(\App\Models\User::MAIN_DIAGNOSIS)
    ?>
    @if ($diagnosisDoctorMGT)
        <li class="nav-item  {{ Request::is('diagnosis-categories*','patient-diagnosis-test*') ? 'active' : '' }}">
            <a class="nav-link  d-flex align-items-center py-3"
               href="{{ $diagnosisDoctorMGT }}">
                <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-diagnoses"></i></span>
                <span class="aside-menu-title">{{ __('messages.patient_diagnosis_test.diagnosis') }}</span>
                <span class="d-none">{{ __('messages.patient_diagnosis_test.diagnosis_category') }}</span>
                <span class="d-none">{{ __('messages.patient_diagnosis_test.diagnosis_test') }}</span>
            </a>
        </li>
    @endif

    {{-- Front settings --}}
    @module('Notice Boards',$modules)
    <li class="nav-item {{ Request::is('employee/notice-board*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/notice-board') }}">
                                                                                                                                                                        <span class="aside-menu-icon pe-3 pe-3"><i
                                                                                                                                                                                    class="fas fa fa-cog"></i></span>
            <span class="aside-menu-title">{{ __('messages.notice_boards') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>
        </a>
    </li>
    @endmodule

    

   

    


    

    {{-- SMS --}}
    @module('SMS',$modules)
    <li class="nav-item {{ Request::is('sms*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('sms.index') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa fa-sms"></i></span>
            <span class="aside-menu-title">{{ __('messages.sms.sms') }}</span>
        </a>
    </li>
    @endmodule
    
    @endrole


    @role('Receptionist')
    {{--Appointments--}}
    @module('Appointments',$modules)
    <li class="nav-item  {{ Request::is('appointments*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('appointments.index') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-calendar-check"></i></span>
            <span class="aside-menu-title">{{ __('messages.appointments') }}</span>
        </a>
    </li>
    @endmodule

    {{--Doctors--}}
    @module('Doctors',$modules)
    <li class="nav-item  {{ Request::is('doctors*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('doctors.index') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fa fa-user-md"></i></span>
            <span class="aside-menu-title">{{ __('messages.doctors') }}</span>
        </a>
    </li>
    @endmodule

    {{--Diagnosis Test--}}
    <?php
    $diagnosisReceptionistMGT = getMenuLinks(\App\Models\User::MAIN_DIAGNOSIS)
    ?>
    @if ($diagnosisReceptionistMGT)
        <li class="nav-item  {{ Request::is('diagnosis-categories*','patient-diagnosis-test*') ? 'active' : '' }}">
            <a class="nav-link  d-flex align-items-center py-3" href="{{ $diagnosisReceptionistMGT }}">
                <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-diagnoses"></i></span>
                <span class="aside-menu-title">{{ __('messages.patient_diagnosis_test.diagnosis') }}</span>
                <span class="d-none">{{ __('messages.patient_diagnosis_test.diagnosis_category') }}</span>
                <span class="d-none">{{ __('messages.patient_diagnosis_test.diagnosis_test') }}</span>
            </a>
        </li>
    @endif

    {{--Enquires--}}
    @module('Enquires',$modules)
    <li class="nav-item  {{ Request::is('enquiries*') || Request::is('enquiry*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('enquiries') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-question-circle"></i></span>
            <span class="aside-menu-title">{{ __('messages.enquiries') }}</span>
        </a>
    </li>
    @endmodule

    {{-- Front office --}}
    <?php
    $frontReceptionistOfficeMGT = getMenuLinks(\App\Models\User::MAIN_FRONT_OFFICE)
    ?>
    @if ($frontReceptionistOfficeMGT)
        <li class="nav-item {{ Request::is('call-logs*','visitor*','receives*','dispatches*') ? 'active' : '' }}">
            <a href="{{ $frontReceptionistOfficeMGT }}" class="nav-link  d-flex align-items-center py-3">
                <span class="aside-menu-icon pe-3 pe-3"><i class="fa fa-dungeon"></i></span>
                <span class="aside-menu-title">{{ __('messages.front_office') }}</span>
                <span class="d-none">{{ __('messages.call_logs') }}</span>
                <span class="d-none">{{ __('messages.visitors') }}</span>
                <span class="d-none">{{ __('messages.postal_receive') }}</span>
                <span class="d-none">{{ __('messages.postal_dispatch') }}</span>
            </a>
        </li>
    @endif

    @module('Notice Boards',$modules)
    <li class="nav-item {{ Request::is('employee/notice-board','testimonials*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/notice-board') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa fa-cog"></i></span>
            <span class="aside-menu-title">{{ __('messages.notice_boards') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>
        </a>
    </li>
    @endmodule






  

    {{-- Mail and SMS --}}
    <?php
    $receptionistSmsMailMgt = getMenuLinks(\App\Models\User::MAIN_SMS_MAIL)
    ?>
    @if ($receptionistSmsMailMgt)
        <li class="nav-item  {{ Request::is('sms*','mail*') ? 'active' : '' }}">
            <a class="nav-link  d-flex align-items-center py-3"
               href="{{ $receptionistSmsMailMgt }}"
               title="{{ __('SMS/Mail') }}">
                <span class="aside-menu-icon pe-3 pe-3">
                    <i class="fas fa-bell"></i>
                </span>
                <span class="aside-menu-title">{{ __('messages.sms.sms') }}/{{ __('messages.mail') }}</span>
                <span class="d-none">{{ __('messages.sms.sms') }}</span>
                <span class="d-none">{{ __('messages.mail') }}</span>
            </a>
        </li>
    @endif

    {{--@module('Testimonial',$modules)--}}
    {{--<li class="nav-item">--}}
    {{--    <a class="nav-link  d-flex align-items-center py-3 ps-0 {{ Request::is('testimonials*') ? 'active' : '' }}"--}}
    {{--       href="{{ route('testimonials.index') }}">--}}
    {{--        <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa fa-cog"></i></span>--}}
    {{--               <span class="aside-menu-title">{{ __('messages.front_settings') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>--}}
    {{--    </a>--}}
    {{--</li>--}}
    {{--@endmodule--}}
    @endrole

    @role('Pharmacist')
    @module('Doctors',$modules)
    <li class="nav-item  {{ Request::is('employee/doctor*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/doctor') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fa fa-user-md"></i></span>
            <span class="aside-menu-title">{{ __('messages.doctors') }}</span>
        </a>
    </li>
    @endmodule

    @module('Prescriptions',$modules)
    <li class="nav-item  {{ Request::is('employee/prescriptions*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/prescriptions') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-prescription"></i></span>
            <span class="aside-menu-title">{{ __('messages.prescriptions') }}</span>
        </a>
    </li>
    @endmodule

    @module('Notice Boards',$modules)
    <li class="nav-item  {{ Request::is('employee/notice-board*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/notice-board') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa fa-cog"></i></span>
            <span class="aside-menu-title">{{ __('messages.notice_boards') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>
        </a>
    </li>
    @endmodule


    {{-- Medicines--}}
    <?php
    $medicinePharmacistMgt = getMenuLinks(\App\Models\User::MAIN_MEDICINES)
    ?>
    @if ($medicinePharmacistMgt)
        <li class="nav-item {{ Request::is('categories*','brands*','medicines*') ? 'active' : '' }}">
            <a class="nav-link  d-flex align-items-center py-3"
               href="{{ $medicinePharmacistMgt }}">
                <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-capsules"></i></span>
                <span class="aside-menu-title">{{ __('messages.medicines') }}</span>
                <span class="d-none">{{__('messages.medicine_categories')}}</span>
                <span class="d-none">{{__('messages.medicine_brands')}}</span>
                <span class="d-none">{{__('messages.medicines')}}</span>
            </a>
        </li>
    @endif

  

   

    {{-- SMS --}}
    @module('SMS',$modules)
    <li class="nav-item {{ Request::is('sms*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('sms.index') }}">
                                                                                                                                                                                                                                                        <span class="aside-menu-icon pe-3 pe-3"><i
                                                                                                                                                                                                                                                                    class="fas fa fa-sms"></i></span>
            <span class="aside-menu-title">{{ __('messages.sms.sms') }}</span>
        </a>
    </li>
    @endmodule
    @endrole

   

    @role('Patient')

    @module('Appointments',$modules)
    <li class="nav-item  {{ Request::is('appointments*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('appointments.index') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-calendar-check"></i></span>
            <span class="aside-menu-title">{{ __('messages.appointments') }}</span>
        </a>
    </li>
    @endmodule

   

    {{--Diagnosis test Report--}}
    @module('Diagnosis Tests',$modules)
    <li class="nav-item  {{ Request::is('employee/patient-diagnosis-test*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/patient-diagnosis-test') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-file-medical"></i></span>
            <span class="aside-menu-title">{{ __('messages.patient_diagnosis_test.diagnosis_test') }}</span>
        </a>
    </li>
    @endmodule

    {{-- Documents--}}
    @module('Documents',$modules)
    <li class="nav-item  {{ Request::is('documents*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('documents.index') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-file"></i></span>
            <span class="aside-menu-title">{{ __('messages.documents') }}</span>
        </a>
    </li>
    @endmodule

    @module('Notice Boards',$modules)
    <li class="nav-item  {{ Request::is('employee/notice-board*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ url('employee/notice-board') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa fa-cog"></i></span>
            <span class="aside-menu-title">{{ __('messages.notice_boards') }}</span>
            <span class="d-none">{{ __('messages.notice_boards') }}</span>
        </a>
    </li>
    @endmodule

    

 

    

    @module('Prescriptions',$modules)
    <li class="nav-item {{ Request::is('patient/my-prescriptions*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('prescriptions.list') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-prescription"></i></span>
            <span class="aside-menu-title">{{ __('messages.prescriptions') }}</span>
        </a>
    </li>
    @endmodule

    @module('Vaccinated Patients',$modules)
    <li class="nav-item  {{ Request::is('patient/my-vaccinated*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-items-center py-3"
           href="{{ route('patient.vaccinated') }}">
            <span class="aside-menu-icon pe-3 pe-3"><i class="fas fa-head-side-mask"></i></span>
            <span class="aside-menu-title">{{ __('messages.vaccinated_patients') }}</span>
        </a>
    </li>
    @endmodule
    @endrole
@endif
