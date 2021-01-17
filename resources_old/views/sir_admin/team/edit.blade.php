@extends('admin.team.create')
@section('id',$item->id)
@section('name',$item->name)
@section('short_note',$item->description)
@section('editMethod')
    {{method_field('PUT')}}
@endsection
