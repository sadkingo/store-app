@extends('layout.app')
@section('body')
    <div class="d-flex flex-column mt-25 bg-black bg-opacity-25 p-5">
        <div class="row col-md-6 m-auto p-md-5">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="fullname" class="form-label">Full name</label>
                        <input type="text" name="full_name" class="form-control" id="fullname"
                            value="{{ old('full_name') }}" required>
                        @error('full_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="username" class="form-label">username</label>
                        <input type="text" name="username" class="form-control" id="username"
                            value="{{ old('username') }}" required>
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 ">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="phone" name="phone" class="form-control" id="phone" value="{{ old('phone') }}"
                        required>
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 ">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}"
                        required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="password_confirmation" class="form-label">Confirmation</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                            required>
                        @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <label for="City" class="form-label">City</label>
                    <select name="city" class="selectpicker mb-3 text-white w-100" data-live-search="true"
                        title="Select City" id="City" required>
                        <option class="d-none"></option>
                        @foreach ($states as $state)
                            <optgroup label="{{ $state->name }}">
                                @foreach ($state->city as $city)
                                    @if (old('city') == $state->id . '-' . $city->id)
                                        <option value="{{ $state->id . '-' . $city->id }}" selected>{{ $city->name }}
                                        </option>
                                    @else
                                        <option value="{{ $state->id . '-' . $city->id }}">{{ $city->name }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        @endforeach
                        <!-- Add more options as needed -->
                    </select>
                    @error('city')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row px-5 mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" id="address" value="{{ old('address') }}" required>
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row justify-content-center">
                    <button type="submit" class="btn btn-primary w-25">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
