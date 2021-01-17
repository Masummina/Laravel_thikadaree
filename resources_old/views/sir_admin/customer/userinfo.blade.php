@extends('admin.customer.new')
@section('prefix',$personal[0]->prefix)
@section('name',$personal[0]->name)
@section('dob',$personal[0]->dob)
@section('home_district',$personal[0]->home_district)
@section('interest_01',$personal[0]->interest_01)
@section('interest_02',$personal[0]->interest_02)
@section('food_habit',$personal[0]->food_habit)
@section('health_info',$personal[0]->health_info)
@section('car_preference',$personal[0]->car_preference)
@section('color_preference',$personal[0]->color_preference)
@section('customer_id',$customer_id)
@section('mobile',$contact[0]->mobile)
@section('alt_mobile',$contact[0]->alt_mobile)
@section('phone',$contact[0]->phone)
@section('fax',$contact[0]->fax)
@section('email',$contact[0]->email)
@section('website',$contact[0]->website)
@section('facebook',$contact[0]->facebook)
@section('twitter',$contact[0]->twitter)
@section('instagram',$contact[0]->instagram)
@section('address_1',$contact[0]->address_1)
@section('address_2',$contact[0]->address_2)
@section('city',$contact[0]->city)
@section('city_2',$contact[0]->city_2)
@section('district',$contact[0]->district)
@section('country',$contact[0]->country)
@section('content_persion',$contact[0]->content_persion)
@section('relation_client',$contact[0]->relation_client)
@section('area_of_interest',$area[0]->area_of_interest)
@section('size_of_interest',$area[0]->size_of_interest)
@section('price_of_interest',$area[0]->price_of_interest)
@section('organization',$area[0]->organization)
@section('designation',$area[0]->designation)
@section('profession',$area[0]->profession)
@section('office_mobile',$office[0]->mobile)
@section('office_alt_mobile',$office[0]->alt_mobile)
@section('office_phone',$office[0]->phone)
@section('office_fax',$office[0]->fax)
@section('office_email',$office[0]->email)
@section('office_website',$office[0]->website)
@section('office_facebook',$office[0]->facebook)
@section('office_twitter',$office[0]->twitter)
@section('office_address_1',$office[0]->address_1)
@section('office_address_2',$office[0]->address_2)
@section('office_city',$office[0]->city)
@section('office_district',$office[0]->district)
@section('office_country',$office[0]->country)
@section('wife_prefix',$wife[0]->prefix)
@section('wife_name',$wife[0]->name)
@section('wife_dob',$wife[0]->dob)
@section('wife_dom',$wife[0]->dom)
@section('wife_home_district',$wife[0]->home_district)
@section('wife_interest_01',$wife[0]->interest_01)
@section('wife_food_habit',$wife[0]->food_habit)
@section('wife_health_info',$wife[0]->health_info)
@section('editMethod')
    {{method_field('PUT')}}
@endsection
