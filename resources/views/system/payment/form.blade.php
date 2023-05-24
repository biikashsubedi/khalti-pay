@extends('system.layouts.form')
@section('inputs')

    <x-system.form.form-group :input="[ 'name' => 'title', 'label'=> 'Title', 'required' => 'true']">
        <x-slot name="inputs">
            <x-system.form.input-select
                :input="[ 'name' => 'title', 'label'=> 'Title', 'required' => 'true', 'default' => $item->title ?? old('title') , 'options' => $titles, 'placeholder' => isset($item) ? null : 'Select Title', 'error' => $errors->first('title')]"/>
        </x-slot>
    </x-system.form.form-group>

    <x-system.form.form-group
        :input="['name' => 'url','required'=>'true', 'label' => 'Url','default'=>old('url') ?? $item->url ?? '', 'error' => $errors->first('url')]"/>

    <x-system.form.form-group :input="['label' => 'Mode','required' => 'true']">
        <x-slot name="inputs">
            <x-system.form.input-radio
                :input="['name' => 'mode', 'options' => $mode, 'default' => old('mode') ?? $item->mode ?? 0]"/>
        </x-slot>
    </x-system.form.form-group>
    <x-system.form.form-group :input="['label' => 'Api Status','required' => 'true']">
        <x-slot name="inputs">
            <x-system.form.input-radio
                :input="['name' => 'api_status', 'options' => $status, 'default' => old('api_status') ?? $item->api_status ?? 0]"/>
        </x-slot>
    </x-system.form.form-group>

    <x-system.form.form-group :input="['label' => 'Web Status','required' => 'true']">
        <x-slot name="inputs">
            <x-system.form.input-radio
                :input="['name' => 'web_status', 'options' => $status, 'default' => old('web_status') ?? $item->web_status ?? 0]"/>
        </x-slot>
    </x-system.form.form-group>

    <x-system.form.form-group :input="['label' => 'Is Default']">
        <x-slot name="inputs">
            <x-system.form.input-radio
                :input="['name' => 'default', 'options' => $defaults, 'default' => old('default') ?? $item->default ?? 0, 'error' => $errors->first('default')]"/>
        </x-slot>
    </x-system.form.form-group>

    <x-system.form.form-group
        :input="[ 'name' => 'icon', 'label'=> 'Icon',]">
        <x-slot name="inputs">
            <x-system.form.input-file
                :input="[ 'name' => 'icon','data-id' => 'icon','default'=>$item->icon->url ?? old('icon'), 'label'=> 'Choose Icon','accept' => 'image/*','placeholder' => 'Select Icon', 'error' => $errors->first('icon')]"/>
        </x-slot>
    </x-system.form.form-group>

@endsection

@section('Scripts')
@endsection

