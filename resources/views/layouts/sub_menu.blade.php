@php($modules = App\Models\Module::cacheFor(now()->addDays())->toBase()->get())
@role('Admin')
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('dashboard*')) ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('dashboard*') ? 'active' : ''  }}"
           href="{{ route('dashboard') }}">
            {{ __('messages.dashboard.dashboard') }}
        </a>
    </li>
@endrole
@role('Admin')
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('users*')) ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('users*') ? 'active' : ''  }}"
           href="{{ route('users.index') }}">
            {{ __('messages.users') }}
        </a>
    </li>
@endrole

@role('Admin')
@module('Vaccinated Patients',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('vaccinated-patients*','vaccinations*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('vaccinated-patients*') ? 'active' : ''  }}"
       href="{{ route('vaccinated-patients.index') }}">
        {{ __('messages.vaccinated_patients') }}
    </a>
</li>
@endmodule
@endrole
@role('Admin')
@module('Vaccinations',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('vaccinated-patients*','vaccinations*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('vaccinations*') ? 'active' : '' }}"
       href="{{ route('vaccinations.index') }}">
        {{ __('messages.vaccinations') }}
    </a>
</li>
@endmodule
@endrole




@role('Pharmacist')
@module('Doctors',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('employee/doctor*') ? 'd-none' : ''  }}">
    <a class="nav-link p-0 {{ Request::is('employee/doctor*') ? 'active' : '' }}" href="{{ url('employee/doctor') }}">
        {{ __('messages.doctors') }}
    </a>
</li>
@endmodule
@endrole
@role('Pharmacist')
@module('Prescriptions',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('employee/prescriptions*') ? 'd-none' : ''  }}">
    <a class="nav-link p-0 {{ Request::is('employee/prescriptions*') ? 'active' : '' }}"
       href="{{ url('employee/prescriptions') }}">
        {{ __('messages.prescriptions') }}
    </a>
</li>
@endmodule
@endrole
@role('Admin|Doctor|Patient')
@module('Documents',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('documents*','document-types*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('documents*') ? 'active' : '' }}"
       href="{{ route('documents.index') }}">
        {{ __('messages.documents') }}
    </a>
</li>
@endmodule
@endrole
@role('Admin')
@module('Document Types',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('documents*','document-types*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('document-types*') ? 'active' : '' }}"
       href="{{ route('document-types.index') }}">
        {{ __('messages.document_types') }}
    </a>
</li>
@endmodule
@endrole



@role('Admin|Receptionist')
{{--<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0">--}}
    @role('Admin|Receptionist')
    @module('Doctors',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('doctors*','doctor-departments*','schedules*','prescriptions*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('doctors*') ? 'active' : '' }}"
       href="{{ route('doctors.index') }}">
        {{ __('messages.doctors') }}
    </a>
</li>
@endmodule
@endrole
@role('Admin')
@module('Doctor Departments',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('doctors*','doctor-departments*','schedules*','prescriptions*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('doctor-departments*') ? 'active' : '' }}"
       href="{{ route('doctor-departments.index') }}">
        <span class="menu-title" style="white-space: nowrap">{{ __('messages.doctor_departments') }}
    </a>
</li>
@endmodule
@endrole
@role('Admin')
@module('Schedules',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('doctors*','doctor-departments*','schedules*','prescriptions*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('schedules*') ? 'active' : '' }}"
       href="{{ route('schedules.index') }}">
        {{ __('messages.schedules') }}
    </a>
</li>
@endmodule
@endrole
@role('Admin')
@module('Prescriptions',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('doctors*','doctor-departments*','schedules*','prescriptions*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('prescriptions*') ? 'active' : '' }}"
       href="{{ route('prescriptions.index') }}">
        {{ __('messages.prescriptions') }}
    </a>
</li>
@endmodule
@endrole
@endrole


{{--<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('receptionists*')) ? 'd-none' : '' }}"--}}
{{-->--}}
@role('Admin')
@module('Receptionists',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('receptionists*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('receptionists*') ? 'active' : '' }}"
       href="{{ route('receptionists.index') }}">
        {{ __('messages.receptionists') }}
    </a>
</li>
@endmodule
@endrole

@role('Admin')
@module('Pharmacists',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('pharmacists*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('pharmacists*') ? 'active' : '' }}"
       href="{{ route('pharmacists.index') }}">
        {{ __('messages.pharmacists') }}
    </a>
</li>
@endmodule
@endrole
@module('Appointments',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('appointments*','appointment-calendars')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('appointments*') ? 'active' : '' }}"
       href="{{ route('appointments.index') }}">
        {{ __('messages.appointments') }}
    </a>
</li>
@endmodule


@role('Admin|Pharmacist')
@module('Medicine Categories',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('categories*','brands*','medicines*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('categories*') ? 'active' : '' }}"
       href="{{ route('categories.index') }}">
        {{ __('messages.medicine_categories') }}
    </a>
</li>
@endmodule
@endrole
@role('Admin|Pharmacist')
@module('Medicine Brands',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('categories*','brands*','medicines*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('brands*') ? 'active' : '' }}"
       href="{{ route('brands.index') }}">
        {{ __('messages.medicine_brands') }}
    </a>
</li>
@endmodule
@endrole
@role('Admin|Pharmacist')
@module('Medicines',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('categories*','brands*','medicines*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('medicines*') ? 'active' : '' }}"
       href="{{ route('medicines.index') }}">
        {{ __('messages.medicines') }}
    </a>
</li>
@endmodule
@endrole


@role('Admin|Doctor|Receptionist')
@module('Diagnosis Categories',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('diagnosis-categories*','patient-diagnosis-test*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('diagnosis-categories*') ? 'active' : '' }}"
       href="{{ route('diagnosis.category.index') }}">
        {{__('messages.diagnosis_category.diagnosis_categories')}}
    </a>
</li>
@endmodule
@endrole
@role('Admin|Doctor|Receptionist')
@module('Diagnosis Tests',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('diagnosis-categories*','patient-diagnosis-test*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('patient-diagnosis-test*') ? 'active' : '' }}"
       href="{{ route('patient.diagnosis.test.index') }}">
        {{ __('messages.patient_diagnosis_test.diagnosis_test') }}
    </a>
</li>
@endmodule


@role('Admin|Doctor|Receptionist|Pharmacist')
@module('SMS',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('sms*','mail*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('sms*') ? 'active' : '' }}"
       href="{{ route('sms.index') }}">
        {{ __('messages.sms.sms') }}
    </a>
</li>
@endmodule
@endrole
@role('Admin|Receptionist')
@module('Mail',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('sms*','mail*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('mail*') ? 'active' : '' }}"
       href="{{ route('mail') }}">
        {{ __('messages.mail') }}
    </a>
</li>
@endmodule
@endrole




@role('Admin|Receptionist')
@module('Call Logs',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('call-logs*','visitor*','receives*','dispatches*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('call-logs*') ? 'active' : '' }}"
       href="{{ route('call_logs.index') }}">
        {{ __('messages.call_logs') }}
    </a>
</li>
@endmodule
@endrole
@role('Admin|Receptionist')
@module('Visitors',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('call-logs*','visitor*','receives*','dispatches*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('visitors*') ? 'active' : '' }}"
       href="{{ route('visitors.index') }}">
        {{ __('messages.visitors') }}
    </a>
</li>
@endmodule
@endrole
@role('Admin|Receptionist')
@module('Postal Receive',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('call-logs*','visitor*','receives*','dispatches*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('receives*') ? 'active' : '' }}"
       href="{{ route('receives.index') }}">
        {{ __('messages.postal_receive') }}
    </a>
</li>
@endmodule
@endrole
@role('Admin|Receptionist')
@module('Postal Dispatch',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('call-logs*','visitor*','receives*','dispatches*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('dispatches*') ? 'active' : '' }}"
       href="{{ route('dispatches.index') }}">
        {{ __('messages.postal_dispatch') }}
    </a>
</li>
@endmodule
@endrole

@php($sectionName = (Request::get('section') === null && !Request::is('hospital-schedules') && !Request::is('currency-settings')) ? 'general' : Request::get('section'))
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0  {{ (Request::is('settings*', 'currency-settings*', 'hospital-schedules')) ? '' : 'd-none' }}">
    <a class="nav-link p-0  {{ (isset($sectionName) && $sectionName == 'general') ? 'active' : '' }}"
       href="{{ route('settings.edit', ['section' => 'general']) }}">
        {{ __('messages.general') }}
    </a>
</li>
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (Request::is('settings*', 'currency-settings*', 'hospital-schedules')) ? '' : 'd-none' }}">
    <a class="nav-link p-0 {{ Request::is('hospital-schedules*') ? 'active' : ''  }}"
       href="{{ route('hospital-schedules.index') }}">
        {{ __('messages.hospital_schedule') }}
    </a>
</li>
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0  {{ (Request::is('settings*', 'currency-settings*', 'hospital-schedules')) ? '' : 'd-none' }} ">
    <a class="nav-link p-0 {{ (isset($sectionName) && $sectionName == 'sidebar-setting') ? 'active' : '' }}"
       href="{{ route('settings.edit', ['section' => 'sidebar-setting']) }}">
        {{ __('messages.sidebar_setting') }}
    </a>
</li>
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0  {{ (Request::is('settings*', 'currency-settings*','hospital-schedules')) ? '' : 'd-none' }} ">
    <a class="nav-link p-0 {{ Request::is('currency-settings*') ? 'active' : '' }}"
       href="{{ route('currency-settings.index') }}">
        {{ __('messages.currency_setting') }}
    </a>
</li>
@role('Admin')
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('front-settings*','notice-boards*','testimonials*', 'front-cms-services*','terms-and-conditions*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0  {{ Request::is('front-settings*') ? 'active' : ''  }}"
       href="{{ route('front.settings.index') }}">
        {{ __('messages.cms') }}
    </a>
</li>
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('front-settings*','notice-boards*','testimonials*', 'front-cms-services*','terms-and-conditions*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0  {{ Request::is('front-cms-services*') ? 'active' : ''  }}"
       href="{{ route('front.cms.services.index') }}">
        {{ __('messages.front_cms_services') }}
    </a>
</li>
@endrole
@role('Admin')
@module('Notice Boards',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('front-settings*','notice-boards*','testimonials*', 'front-cms-services*','terms-and-conditions*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('notice-boards*') ? 'active' : '' }}"
       href="{{ url('notice-boards') }}">
        {{ __('messages.notice_boards') }}
    </a>
</li>
@endmodule
@endrole
@role('Admin|Receptionist')
@module('Testimonial',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('front-settings*','notice-boards*','testimonials*', 'front-cms-services*','terms-and-conditions*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('testimonials*') ? 'active' : '' }}"
       href="{{ route('testimonials.index') }}">
        {{ __('messages.testimonials') }}
    </a>
</li>
@endmodule
@endrole
{{--<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('enquiries*','enquiry*')) ? 'd-none' : '' }}"--}}
{{-->--}}
    @role('Admin|Receptionist')
    @module('Enquires',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ Request::is('enquiries*', 'enquiry*') ? '' : 'd-none'  }}">
    <a class="nav-link p-0  {{ Request::is('enquiries*') || Request::is('enquiry*') ? 'active' : ''  }}"
       href="{{ route('enquiries') }}">
        {{ __('messages.enquiries') }}
    </a>
</li>
@endmodule
@endrole
@role('Doctor')
@module('Doctors',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('employee/doctor*','prescriptions*','schedules*','doctors*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('employee/doctor*') ? 'active' : '' }}" href="{{ url('employee/doctor') }}">
        {{ __('messages.doctors') }}
    </a>
</li>
@endmodule
@module('Schedules',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('employee/doctor*','prescriptions*','schedules*','doctors*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('schedules*') ? 'active' : '' }}"
       href="{{ route('schedules.index') }}">
        {{ __('messages.schedules') }}
    </a>
</li>
@endmodule

@endrole
@module('Prescriptions',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('employee/doctor*','prescriptions*','schedules*','doctors*')) ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('prescriptions*') ? 'active' : '' }}"
       href="{{ route('prescriptions.index') }}">
        {{ __('messages.prescriptions') }}
    </a>
</li>
@endmodule
@endrole
@role('Doctor|Receptionist|Pharmacist|Patient')
@module('Notice Boards',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('employee/notice-board*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('employee/notice-board*') ? 'active' : '' }}"
       href="{{ url('employee/notice-board') }}">
        {{ __('messages.notice_boards') }}
    </a>
</li>
@endmodule
@endrole

@role('Patient')
@module('Prescriptions',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{!Request::is('patient/my-prescriptions*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('patient/my-prescriptions*') ? 'active' : '' }}"
       href="{{ route('prescriptions.list') }}">
        {{ __('messages.prescriptions') }}
    </a>
</li>
@endmodule
@endrole
@role('Patient')
@module('Vaccinated Patients',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patient/my-vaccinated*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('patient/my-vaccinated*') ? 'active' : '' }}"
       href="{{ route('patient.vaccinated') }}">
        {{ __('messages.vaccinated_patients') }}
    </a>
</li>
@endmodule
@endrole

@role('Patient')
@module('Diagnosis Tests',$modules)
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('employee/patient-diagnosis-test*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('employee/patient-diagnosis-test*') ? 'active' : '' }}"
       href="{{ url('employee/patient-diagnosis-test') }}">
        {{ __('messages.patient_diagnosis_test.diagnosis_test') }}
    </a>
</li>
@endmodule
@endrole


