@extends('theme-views.layouts.app')

@section('title', translate('My_Address').' | '.$web_config['name']->value.' '.translate(' Ecommerce'))
@push('css_or_js')
    <link rel="stylesheet" href="{{ theme_asset('assets/plugins/select2/css/select2.min.css') }}">
    <style>
        .select2{
            max-width: 100%;
            border-radius: 0.375rem;
            border: 1px solid #ced4da;
        }
    </style>
@endpush

@section('content')
    <!-- Main Content -->
    <main class="main-content d-flex flex-column gap-3 py-3 mb-5">
        <div class="container">
            <div class="row g-3">

                <!-- Sidebar-->
                @include('theme-views.partials._profile-aside')

                <div class="col-lg-9">
                    <div class="card h-100">
                        <div class="card-body p-lg-4">
                            <div class="mt-4">
                                <form action="{{route('address-update')}}" method="post">
                                    @csrf
                                    <div class="row gy-4">
                                        <div class="col-md-6">
                                            <input type="hidden" name="id" value="{{$shippingAddress->id}}">
                                            <div class="">
                                                <h6 class="fw-semibold text-muted mb-3">{{translate('Choose_Label')}}</h6>
                                                <ul class="option-select-btn flex-wrap style--two gap-4 mb-4">
                                                    <li>
                                                        <label>
                                                            <input type="radio" name="addressAs" hidden value="home" {{$shippingAddress->address_type == 'home' ? 'checked':''}}>
                                                            <span><i class="bi bi-house"></i></span>
                                                        </label>
                                                        {{translate('Home')}}
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="radio" name="addressAs" hidden value="permanent" {{$shippingAddress->address_type == 'permanent' ? 'checked':''}}>
                                                            <span><i class="bi bi-paperclip"></i></span>
                                                        </label>
                                                        {{translate('Permanent')}}
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="radio" name="addressAs" hidden="" value="office" {{$shippingAddress->address_type == 'office' ? 'checked':''}}>
                                                            <span><i class="bi bi-briefcase"></i></span>
                                                        </label>
                                                        {{translate('Office')}}
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="name">{{translate('Contact_Person')}}</label>
                                                <input type="text" id="name" name="name" class="form-control" value="{{$shippingAddress['contact_person_name']}}" placeholder="{{translate('Ex:_Jhon_Doe')}}">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="phone2">{{translate('Phone')}}</label>
                                                <div class="select-wrap focus-border form-control rounded d-flex align-items-center px-0">
                                                    <input type="tel" id="phone" class="form-control bg-transparent px-3 border-0 focus-input" name="phone" value="{{ $shippingAddress['phone'] }}" placeholder="{{translate('Ex:01xxxxxxxxx')}}">
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="country">{{translate('Country')}}</label>
                                                <select name="country" id="country"  class="form-select select2 select_picker">
                                                    <option value="" disabled selected>{{translate('Select_Country')}}</option>
                                                    @if($country_restrict_status)
                                                        @foreach($delivery_countries as $country)
                                                            <option value="{{$country['name']}}" {{ $country['name'] == $shippingAddress->country? 'selected' : ''}}>{{$country['name']}}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach(COUNTRIES as $country)
                                                            <option value="{{ $country['name'] }}" {{ $shippingAddress->country == $country['name']? 'selected' : '' }}>{{ $country['name'] }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="city">{{translate('City')}}</label>
                                                <input class="form-control" type="text" id="address-city" name="city" value="{{$shippingAddress->city}}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="zip-code">{{translate('Zip_Code')}}</label>
                                                @if($zip_restrict_status)
                                                    <select name="zip" class="form-control select2 select_picker" data-live-search="true" id="" required>
                                                        @foreach($delivery_zipcodes as $zip)
                                                            <option value="{{ $zip->zipcode }}" {{ $zip->zipcode == $shippingAddress->zip? 'selected' : ''}}>{{ $zip->zipcode }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <input class="form-control" type="text" id="zip_code" name="zip" value="{{$shippingAddress->zip}}" required>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-5 mt-md-0">
                                            <div class="d-flex justify-content-end mb-5">
                                                <a href="{{ route('user-profile') }}" class="btn-link text-secondary d-flex align-items-baseline">
                                                    <i class="bi bi-chevron-left fs-12"></i> {{translate('Go_back')}}
                                                </a>
                                            </div>

                                            <h6 class="fw-semibold text-muted mb-3">{{translate('Choose_Address_Type')}}</h6>
                                            <div class="d-flex flex-wrap style--two gap-4 mb-3">
                                                <div>
                                                    <label class="d-flex align-items-center gap-2 cursor-pointer">
                                                        <input type="radio" name="is_billing" value="1" {{ $shippingAddress->is_billing == '1' ? 'checked' : ''}} >
                                                        {{translate('Billing_Address')}}
                                                    </label>
                                                </div>
                                                <div>
                                                    <label class="d-flex align-items-center gap-2 cursor-pointer">
                                                        <input type="radio" name="is_billing" value="0" {{ $shippingAddress->is_billing == '0' ? 'checked' : ''}} >
                                                        {{translate('Shipping_Address')}}
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mb-3 ">
                                                <input id="pac-input" class="controls rounded __inline-46" title="{{translate('search_your_location_here')}}" type="text" placeholder="{{translate('search_here')}}"/>
                                                <div class="dark-support rounded w-100 __h-14rem" id="location_map_canvas"></div>
                                            </div>

                                            <div class="form-group">
                                                <label for="address">{{translate('Address')}}</label>
                                                <textarea name="address" id="address" rows="5" class="form-control" placeholder="{{translate('Ex:_1216_Dhaka')}}">{{$shippingAddress->address}}</textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" id="latitude"
                                               name="latitude" class="form-control d-inline"
                                               placeholder="Ex : -94.22213" value="{{$shippingAddress->latitude??0}}" required readonly>
                                        <input type="hidden"
                                               name="longitude" class="form-control"
                                               placeholder="Ex : 103.344322" id="longitude" value="{{$shippingAddress->longitude??0}}" required readonly>
                                        <div class="col-12">
                                            <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
                                                <label class="custom-checkbox"></label>

                                                <div class="d-flex justify-content-end gap-3">
                                                    <button type="reset" class="btn btn-secondary">{{translate('Reset')}}</button>
                                                    <button type="submit" class="btn btn-primary">{{translate('Update_Address')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End Main Content -->
@endsection
@push('script')
    <script src="{{ theme_asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select_picker').select2();
        });

        $(".select_picker").select2({
            theme: "classic"
        });
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{\App\CPU\Helpers::get_business_settings('map_api_key')}}&callback=initAutocomplete&libraries=places&v=3.49" defer></script>
    <script>
        function initAutocomplete() {
            var myLatLng = { lat: {{$shippingAddress->latitude??'-33.8688'}}, lng: {{$shippingAddress->longitude??'151.2195'}} };

            const map = new google.maps.Map(document.getElementById("location_map_canvas"), {
                center: { lat: {{$shippingAddress->latitude??'-33.8688'}}, lng: {{$shippingAddress->longitude??'151.2195'}} },
                zoom: 13,
                mapTypeId: "roadmap",
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
            });

            marker.setMap( map );
            var geocoder = geocoder = new google.maps.Geocoder();
            google.maps.event.addListener(map, 'click', function (mapsMouseEvent) {
                var coordinates = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);
                var coordinates = JSON.parse(coordinates);
                var latlng = new google.maps.LatLng( coordinates['lat'], coordinates['lng'] ) ;
                marker.setPosition( latlng );
                map.panTo( latlng );

                document.getElementById('latitude').value = coordinates['lat'];
                document.getElementById('longitude').value = coordinates['lng'];

                geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[1]) {
                            document.getElementById('address').value = results[1].formatted_address;
                            console.log(results[1].formatted_address);
                        }
                    }
                });
            });

            // Create the search box and link it to the UI element.
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });
            let markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }
                // Clear out the old markers.
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();
                places.forEach((place) => {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var mrkr = new google.maps.Marker({
                        map,
                        title: place.name,
                        position: place.geometry.location,
                    });

                    google.maps.event.addListener(mrkr, "click", function (event) {
                        document.getElementById('latitude').value = this.position.lat();
                        document.getElementById('longitude').value = this.position.lng();

                    });

                    markers.push(mrkr);

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        };
        $(document).on('ready', function () {
            initAutocomplete();
        });
        $(document).on("keydown", "input", function(e) {
            if (e.which==13) e.preventDefault();
        });
    </script>
@endpush
