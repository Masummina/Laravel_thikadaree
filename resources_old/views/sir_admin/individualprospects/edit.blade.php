@extends('admin.individualprospects.create')
@section('id',$item->id)
@section('report_date',$item->report_date)
@section('previous',$item->previous)
@section('new',$item->new)
@section('esc',$item->esc)
@section('close',$item->close)
@section('editMethod')
    {{method_field('PUT')}}
@endsection
