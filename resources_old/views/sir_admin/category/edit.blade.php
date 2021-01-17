@extends('admin.category.create')
@section('id',$item->id)
@section('name',$item->name)
@section('short_note',$item->short_note)
@section('n_p',$item->n_p)
@section('initial_amount',$item->initial_amount)
@section('editMethod')
    {{method_field('PUT')}}
@endsection
