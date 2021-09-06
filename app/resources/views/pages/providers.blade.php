@extends('layouts.app')
@extends('components.header')

@section('content')
    <div class="vkg-providers">
        <form class="vkg-providers__form bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <labeL for="vkg-provider_name">Name</labeL>
            <input type="text" name="provider_name"
                   class="vkg-"
            />
        </form>
    </div>
@endsection
