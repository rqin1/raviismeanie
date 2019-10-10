@extends('layouts.app')

@section('script')
<script src="{{ mix('js/managed_property.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/vendor/bootstrap-datepicker/dist/locales/bootstrap-datepicker.ja.min.js"></script>
<!-- Select2 -->
<script src="/vendor/select2/dist/js/select2.full.min.js"></script>
@endsection

@section('vendor_style')
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="/vendor/select2/dist/css/select2.min.css">
@endsection

@section('style')
<link href="{{ mix('css/managed_property.css') }}" rel="stylesheet">
@endsection

@section('title')
@if ($is_create)
管理物件新規登録
@else
管理物件編集
@endif
@endsection

@section('content_header')
<section class="content-header">
    <h1>
        @if ($is_create)
            管理物件新規登録
        @else
            管理物件編集
        @endif
    </h1>
    <ol class="breadcrumb">
        <li>管理物件管理</li>
        @if ($is_create)
        <li><a href="{{ route('property.managed_property.index').session('qs') }}">管理物件一覧</a></li>
        @else
        <li><a href="{{ route('property.managed_property.show', $managed_property->id) }}">管理物件詳細</a></li>
        @endif
  
        <li class="active">
            @if ($is_create)
            管理物件新規登録
            @else
            管理物件編集
            @endif
        </li>
    </ol>
</section>
@endsection

@section('content')
<error-modal></error-modal>
@if (session()->has('notice'))
<toast
    type="{{ session()->get('notice_type') }}"
    title="{{ session()->get('notice_title') }}"
    :messages="{{ json_encode(session()->get('notice')) }}"
    :is-session="true"
></toast>
@endif
<toast
    :type="toast.type"
    :title="toast.title"
    :messages="toast.messages"
    :is-session="false"
></toast>
<div class="row" v-cloak  id="fan-managed_property-form-area">
    <div class="col-md-12">
        <div class="box box-primary" id="fan-managed-property-edit">
            <div class="box-body">
                @if ($is_create)
                <form class="form-horizontal h-adr" method="POST" action="{{ route('property.managed_property.store') }}" id="managed_property-data">
                @else
                <form class="form-horizontal h-adr" method="POST" action="{{ route('property.managed_property.update', $managed_property->id) }}" id="managed_property-data">
                    {{ method_field('PATCH') }}
                @endif
                {{ csrf_field() }}
                @include('managed_property._form_inputs', ['is_managed_property' => true])
                </form>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-4">
                        @if ($is_create)
                        <a class="btn btn-default btn-block" href="{{ route('property.managed_property.index').session('qs') }}">
                            <i class="fa fa-chevron-circle-left" aria-hidden="true"></i> 一覧に戻る
                        </a>
                        @else
                        <a class="btn btn-default btn-block" href="{{ route('property.managed_property.show', $managed_property->id) }}">
                            <i class="fa fa-times-circle" aria-hidden="true"></i> キャンセル
                        </a>
                        @endif
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block" form="managed_property-data">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i> 保存する
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
