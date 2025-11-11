@extends('plantilla.layouts.panel')

@section('panel_blanco')


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">PERFIL</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                                <li class="breadcrumb-item active">Nuevo Rol</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="input-mask-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="display: flex; align-items: center;">
                                <h4 class="card-title" style="flex: 1; text-align: center; margin: 0;">Perfil</h4>
                                <a class="btn btn-primary waves-effect waves-float waves-light" href="{{ route('roles.index') }}">Regresar</a>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <script>
                                        Swal.fire({
                                            title: 'Errores en el formulario',
                                            html: '<ul>' +
                                                @foreach ($errors->all() as $error)
                                                    '<li>{{ $error }}</li>' +
                                                @endforeach
                                                '</ul>',
                                            icon: 'error'
                                        });
                                    </script>
                                @endif

                                <div class="card-body py-2 my-25">
                                    <!-- header section -->
                                    <div class="d-flex">
                                      <a href="#" class="me-25">
                                        <img src="{{asset('images/imagenes/user.jpg')}}" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100">
                                      </a>
                                      <!-- upload and reset button -->
                                      <div class="d-flex align-items-end mt-75 ms-1">
                                        <div>
                                          <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75 waves-effect waves-float waves-light">Upload</label>
                                          <input type="file" id="account-upload" hidden="" accept="image/*">
                                          <button type="button" id="account-reset" class="btn btn-sm btn-outline-secondary mb-75 waves-effect">Reset</button>
                                          <p class="mb-0">Allowed file types: png, jpg, jpeg.</p>
                                        </div>
                                      </div>
                                      <!--/ upload and reset button -->
                                    </div>
                                    <!--/ header section -->
                            
                                    <!-- form -->
                                    <form class="validate-form mt-2 pt-50" novalidate="novalidate">
                                      <div class="row">
                                        <div class="col-12 col-sm-6 mb-1">
                                          <label class="form-label" for="accountFirstName">First Name</label>
                                          <input type="text" class="form-control" id="accountFirstName" name="firstName" placeholder="John" value="John" data-msg="Please enter first name">
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                          <label class="form-label" for="accountLastName">Last Name</label>
                                          <input type="text" class="form-control" id="accountLastName" name="lastName" placeholder="Doe" value="Doe" data-msg="Please enter last name">
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                          <label class="form-label" for="accountEmail">Email</label>
                                          <input type="email" class="form-control" id="accountEmail" name="email" placeholder="Email" value="johndoe@gmail.com">
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                          <label class="form-label" for="accountOrganization">Organization</label>
                                          <input type="text" class="form-control" id="accountOrganization" name="organization" placeholder="Organization name" value="PIXINVENT">
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                          <label class="form-label" for="accountPhoneNumber">Phone Number</label>
                                          <input type="text" class="form-control account-number-mask" id="accountPhoneNumber" name="phoneNumber" placeholder="Phone Number" value="457 657 1237">
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                          <label class="form-label" for="accountAddress">Address</label>
                                          <input type="text" class="form-control" id="accountAddress" name="address" placeholder="Your Address">
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                          <label class="form-label" for="accountState">State</label>
                                          <input type="text" class="form-control" id="accountState" name="state" placeholder="State">
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                          <label class="form-label" for="accountZipCode">Zip Code</label>
                                          <input type="text" class="form-control account-zip-code" id="accountZipCode" name="zipCode" placeholder="Code" maxlength="6">
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                          <label class="form-label" for="country">Country</label>
                                          <div class="position-relative"><select id="country" class="select2 form-select select2-hidden-accessible" data-select2-id="country" tabindex="-1" aria-hidden="true">
                                            <option value="" data-select2-id="2">Select Country</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Canada">Canada</option>
                                            <option value="China">China</option>
                                            <option value="France">France</option>
                                            <option value="Germany">Germany</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Korea">Korea, Republic of</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Russia">Russian Federation</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                          </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="1" style="width: 566.6px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-country-container"><span class="select2-selection__rendered" id="select2-country-container" role="textbox" aria-readonly="true" title="Select Country">Select Country</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                          <label for="language" class="form-label">Language</label>
                                          <div class="position-relative"><select id="language" class="select2 form-select select2-hidden-accessible" data-select2-id="language" tabindex="-1" aria-hidden="true">
                                            <option value="" data-select2-id="4">Select Language</option>
                                            <option value="en">English</option>
                                            <option value="fr">French</option>
                                            <option value="de">German</option>
                                            <option value="pt">Portuguese</option>
                                          </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="3" style="width: 566.6px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-language-container"><span class="select2-selection__rendered" id="select2-language-container" role="textbox" aria-readonly="true" title="Select Language">Select Language</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                          <label for="timeZones" class="form-label">Timezone</label>
                                          <div class="position-relative"><select id="timeZones" class="select2 form-select select2-hidden-accessible" data-select2-id="timeZones" tabindex="-1" aria-hidden="true">
                                            <option value="" data-select2-id="6">Select Time Zone</option>
                                            <option value="-12">(GMT-12:00) International Date Line West</option>
                                            <option value="-11">(GMT-11:00) Midway Island, Samoa</option>
                                            <option value="-10">(GMT-10:00) Hawaii</option>
                                            <option value="-9">(GMT-09:00) Alaska</option>
                                            <option value="-8">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                                            <option value="-8">(GMT-08:00) Tijuana, Baja California</option>
                                            <option value="-7">(GMT-07:00) Arizona</option>
                                            <option value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                            <option value="-7">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                                            <option value="-6">(GMT-06:00) Central America</option>
                                            <option value="-6">(GMT-06:00) Central Time (US &amp; Canada)</option>
                                            <option value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                            <option value="-6">(GMT-06:00) Saskatchewan</option>
                                            <option value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                            <option value="-5">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                                            <option value="-5">(GMT-05:00) Indiana (East)</option>
                                            <option value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                                            <option value="-4">(GMT-04:00) Caracas, La Paz</option>
                                            <option value="-4">(GMT-04:00) Manaus</option>
                                            <option value="-4">(GMT-04:00) Santiago</option>
                                            <option value="-3.5">(GMT-03:30) Newfoundland</option>
                                          </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="5" style="width: 566.6px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-timeZones-container"><span class="select2-selection__rendered" id="select2-timeZones-container" role="textbox" aria-readonly="true" title="Select Time Zone">Select Time Zone</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                          <label for="currency" class="form-label">Currency</label>
                                          <div class="position-relative"><select id="currency" class="select2 form-select select2-hidden-accessible" data-select2-id="currency" tabindex="-1" aria-hidden="true">
                                            <option value="" data-select2-id="8">Select Currency</option>
                                            <option value="usd">USD</option>
                                            <option value="euro">Euro</option>
                                            <option value="pound">Pound</option>
                                            <option value="bitcoin">Bitcoin</option>
                                          </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="7" style="width: 566.6px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-currency-container"><span class="select2-selection__rendered" id="select2-currency-container" role="textbox" aria-readonly="true" title="Select Currency">Select Currency</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                                        </div>
                                        <div class="col-12">
                                          <button type="submit" class="btn btn-primary mt-1 me-1 waves-effect waves-float waves-light">Save changes</button>
                                          <button type="reset" class="btn btn-outline-secondary mt-1 waves-effect">Discard</button>
                                        </div>
                                      </div>
                                    </form>
                                    <!--/ form -->
                                  </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>


@endsection




{{-- <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('put')

    <div>
        <x-input-label for="current_password" :value="__('Current Password')" />
        <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="password" :value="__('New Password')" />
        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Save') }}</x-primary-button>

        @if (session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400"
            >{{ __('Saved.') }}</p>
        @endif
    </div>
</form>





 --}}






















{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
