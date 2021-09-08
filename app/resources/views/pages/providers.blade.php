@extends('layouts.app')
@extends('components.header')

@section('content')
    <div class="vkg-providers">
        @if(request('t') === 'list')
            <table class="vkg-providers__table">
                <thead class="vkg-providers__table-header">
                <tr class="vkg-providers__table-header-row">
                    <th class="vkg-providers__table-header-row-td">
                        Name
                    </th>
                    <th class="vkg-providers__table-header-row-td">
                        Email
                    </th>
                </tr>
                </thead>
                <tbody id="vkg-providers__table-body" class="vkg-providers__table-body">
                </tbody>
            </table>

            <script>
                $.ajax({
                    url: `/api/admin/providers`,
                    type: 'GET',
                    success: function (data) {
                        $(`#vkg-providers__table-body`).html();

                        data.record.forEach((provider) => {
                            $(`#vkg-providers__table-body`).append(
                                $(`<tr class="vkg-providers__table-body-row">`).append(
                                    $(`<td class="vkg-providers__table-body-row-td">`).text(
                                        provider.name
                                    ),
                                    $(`<td class="vkg-providers__table-body-row-td">`).text(
                                        provider.email
                                    )
                                ),
                            )
                        })

                        $(`#vkg-providers__table-body`).append(
                            $(`<tr class="vkg-providers__table-body-row">`).append(
                                $(`<a class='vkg-providers__form-button vkg-providers__table-button ' href='{{route('providers')}}'>`).text(
                                    'Create provider'
                                )
                            ),
                        )
                    },
                    error: function (error) {
                        $(`#vkg-providers__table-body`).append(
                            $(`<tr class="vkg-providers__table-body-row">`).append(
                                $(`<td class="vkg-providers__table-body-row-td">`).text(
                                    'error'
                                ),
                                $(`<td class="vkg-providers__table-body-row-td">`).text(
                                    'error'
                                )
                            ),
                            $(`<tr class="vkg-providers__table-body-row">`).append(
                                $(`<a class='vkg-providers__form-button vkg-providers__table-button ' href='{{route('providers')}}'>`).text(
                                    'Create provider'
                                )
                            ),
                        )
                    }
                })
            </script>
        @else
            <form class="vkg-providers__form">
                <h1 class="vkg-providers__form-header">Providers registration</h1>
                <labeL for="vkg-provider__form-name">
                    <span class="vkg-providers__form-name-label">Name</span>
                    <br>
                    <input type="text" name="vkg-provider__form-name"
                           class="vkg-providers__form-name"
                           required
                    />

                    <p id="vkg-name-error" class="vkg-providers__form-error"></p>
                </labeL>

                <labeL for="vkg-provider__form-email">
                    <span class="vkg-providers__form-email-label">Email</span>
                    <br>
                    <input type="email" name="vkg-provider__form-email"
                           class="vkg-providers__form-email"
                           required
                    />

                    <p id="vkg-email-error" class="vkg-providers__form-error"></p>
                </labeL>

                <button
                    id="vkg-create-button"
                    class="vkg-providers__form-button"
                    onclick="createProvider();return false;"
                >
                    Create
                </button>
                <a
                    class="vkg-providers__form-button"
                    href="{{route('providers', ['t' => 'list'])}}"
                >
                    View providers
                </a>
            </form>
        @endif
    </div>
@endsection
@section('script')
    <script>
        var createButton = $(`#vkg-create-button`);

        function createProvider() {
            $(`#vkg-name-error`).text('');
            $(`#vkg-email-error`).text('');
            createButton.text('Loading');

            setTimeout(() => {
                $.ajax({
                    url: `/api/admin/providers`,
                    data: {
                        'name': $(`input[name="vkg-provider__form-name"]`).val(),
                        'email': $(`input[name="vkg-provider__form-email"]`).val()
                    },
                    type: 'POST',
                    success: function (data) {
                        alert(data.message);
                        $(`input[name="vkg-provider__form-name"]`).val('');
                        $(`input[name="vkg-provider__form-email"]`).val('');
                        createButton.text('Create');
                    },
                    error: function (error) {
                        if (error?.responseJSON?.errors && error.responseJSON.errors.name) {
                            $(`#vkg-name-error`).text(error.responseJSON.errors.name);
                        }

                        if (error?.responseJSON?.errors && error.responseJSON.errors.email) {
                            $(`#vkg-email-error`).text(error.responseJSON.errors.email);
                        }

                        if (error?.responseJSON?.message) {
                            alert(error.responseJSON.message);
                        }

                        createButton.text('Create');
                    }
                })
            }, 300);
        }
    </script>
@endsection
