@extends('layouts.app')
@extends('components.header')

@section('content')
    <div class="vkg-providers">
        <form class="vkg-providers__form">
            <h1 class="vkg-providers__form-header">Providers registration</h1>

            <labeL for="vkg-provider__form-name">
                <span class="vkg-providers__form-name-label">Name</span>
                <br>
                <input type="text" name="vkg-provider__form-name"
                       class="vkg-providers__form-name"
                       required
                />
            </labeL>

            <labeL for="vkg-provider__form-email">
                <span class="vkg-providers__form-email-label">Email</span>
                <br>
                <input type="email" name="vkg-provider__form-email"
                       class="vkg-providers__form-email"
                       required
                />
            </labeL>
        </form>
    </div>
@endsection
