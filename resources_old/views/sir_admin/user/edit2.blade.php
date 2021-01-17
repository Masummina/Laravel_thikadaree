@extends('admin.user.create')
@section('id',$item->id)
@section('group_id',$item->group_id)
@section('team_id',$item->team_id)
@section('name',$item->name)
@section('email',$item->email)
@section('phone',$item->phone)
@section('editMethod')
    {{method_field('PUT')}}
@endsection
