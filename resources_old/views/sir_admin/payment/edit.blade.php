@extends('admin.payment.create')
@section('id',$item->id)
@section('account_id',$item->account_id)
@section('amount',$item->amount)
@section('date',$item->date)
@section('payment_date',$item->payment_date)
@section('check_no',$item->check_no)
@section('bank',$item->bank)
@section('type',$item->type)
@section('remark',$item->remark)
@section('editMethod')
    {{method_field('PUT')}}
@endsection
