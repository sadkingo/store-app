<?php

namespace App\Livewire;

use App\Http\Requests\RegisterRequest;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use App\Rules\StateCityRule;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use Jeffgreco13\FilamentBreezy\Livewire\MyProfileComponent;

class MyCustomComponent extends MyProfileComponent
    {
    protected string $view = "livewire.my-custom-component";
    protected static ?string $model = User::class;

    public array $data;
    public $user;
    public $full_name, $username, $email, $phone, $address, $state_id, $city_id;
    public $stateCity;
    public function mount()
        {
        $this->user = authUser();
        $this->stateCity = State::with('city')->get();

        $this->full_name = $this->user->full_name;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->address = $this->user->address;
        $this->state_id = $this->user->state_id;
        $this->city_id = $this->user->city_id;
        }

    public function form(Form $form) : Form
        {
        return $form->schema([
            TextInput::make('full_name')->rules(RegisterRequest::rules()['full_name']),
            TextInput::make('username')->rules(RegisterRequest::rules($this->user->id)['username']),
            TextInput::make('email')->rules(RegisterRequest::rules($this->user->id)['email']),
            TextInput::make('phone')->rules(RegisterRequest::rules()['phone']),
            TextInput::make('address')->rules(RegisterRequest::rules()['address']),
            Select::make('state_id')
                ->options(function ()
                    {
                         $this->state_id === $this->user->state_id ?: $this->city_id =0;
                    return $this->stateCity->pluck('name', 'id');
                    })
                ->label('State')
                ->rules('required|numeric|exists:states,id')
                ->live(),
            Select::make('city_id')
                ->options(function ()
                    {
                    return $this->stateCity->find($this->state_id)?->city?->pluck('name','id');
                    })
                ->rules('required|numeric|exists:cities,id')->label('City')
                ->label('City'),
        ]);
        }

    public function submit()
        {
        $this->full_name === $this->user->full_name ?: $this->data['full_name'] = $this->full_name;
        $this->username === $this->user->username ?: $this->data['username'] = $this->username;
        $this->email === $this->user->email ?: $this->data['email'] = $this->email;
        $this->phone === $this->user->phone ?: $this->data['phone'] = $this->phone;
        $this->address === $this->user->address ?: $this->data['address'] = $this->address;
        $this->state_id === $this->user->state_id ?: $this->data['state_id'] = $this->state_id;
        $this->city_id === $this->user->city_id ?: $this->data['city_id'] = $this->city_id;
        $this->validate();
        $this->user->update($this->data);
        }
    }
