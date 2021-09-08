@extends('layouts.app')
@extends('components.header')

@section('content')
    <div class="vkg-hours">
        @if(request('t') === 'exports')
            <table class="vkg-providers__table">
                <thead class="vkg-providers__table-header">
                <tr class="vkg-providers__table-header-row">
                    <th class="vkg-providers__table-header-row-td">
                        Name
                    </th>
                    <th class="vkg-providers__table-header-row-td">
                        Email
                    </th>
                    <th class="vkg-providers__table-header-row-td">
                        Total Hours
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
                                    ),
                                    $(`<td class="vkg-providers__table-body-row-td">`).text(
                                        provider.total_hours || '-'
                                    )
                                ),
                            )
                        })

                        $(`#vkg-providers__table-body`).append(
                            $(`<tr class="vkg-providers__table-body-row">`).append(
                                $(`<a class='vkg-providers__form-button vkg-providers__table-button ' href='{{route('hours', ['t' => 'exports2'])}}'>`).text(
                                    'Next export'
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
                                $(`<a class='vkg-providers__form-button vkg-providers__table-button ' href='{{route('hours', ['t' => 'exports2'])}}'>`).text(
                                    'Next export'
                                )
                            ),
                        )
                    }
                })
            </script>
        @elseif(request('t') === 'exports2')
            <table class="vkg-providers__table">
                <thead class="vkg-providers__table-header">
                <tr class="vkg-providers__table-header-row">
                    <th class="vkg-providers__table-header-row-td">
                        Name
                    </th>
                    <th class="vkg-providers__table-header-row-td">
                        Email
                    </th>
                    <th class="vkg-providers__table-header-row-td">
                        Total Morning
                    </th>
                    <th class="vkg-providers__table-header-row-td">
                        Total Afternoon
                    </th>
                    <th class="vkg-providers__table-header-row-td">
                        Total Night
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
                                    ),
                                    $(`<td class="vkg-providers__table-body-row-td">`).text(
                                        provider.total_morning || '-'
                                    ),
                                    $(`<td class="vkg-providers__table-body-row-td">`).text(
                                        provider.total_afternoon || '-'
                                    ),
                                    $(`<td class="vkg-providers__table-body-row-td">`).text(
                                        provider.total_night || '-'
                                    ),
                                ),
                            )
                        })

                        $(`#vkg-providers__table-body`).append(
                            $(`<tr class="vkg-providers__table-body-row">`).append(
                                $(`<a class='vkg-providers__form-button vkg-providers__table-button ' href='{{route('hours', ['t' => 'exports3'])}}'>`).text(
                                    'Next export'
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
                                $(`<a class='vkg-providers__form-button vkg-providers__table-button ' href='{{route('hours', ['t' => 'exports3'])}}'>`).text(
                                    'Next export'
                                )
                            ),
                        )
                    }
                })
            </script>
        @elseif(request('t') === 'exports3')
            <table class="vkg-providers__table">
                <thead class="vkg-providers__table-header">
                <tr class="vkg-providers__table-header-row">
                    <th class="vkg-providers__table-header-row-td">
                        Total Morning
                    </th>
                    <th class="vkg-providers__table-header-row-td">
                        Total Afternoon
                    </th>
                    <th class="vkg-providers__table-header-row-td">
                        Total Night
                    </th>
                </tr>
                </thead>
                <tbody id="vkg-providers__table-body" class="vkg-providers__table-body">
                </tbody>
            </table>

            <script>
                $.ajax({
                    url: `/api/admin/providers/hours`,
                    type: 'GET',
                    success: function (data) {
                        $(`#vkg-providers__table-body`).html();

                        $(`#vkg-providers__table-body`).append(
                            $(`<tr class="vkg-providers__table-body-row">`).append(
                                $(`<td class="vkg-providers__table-body-row-td">`).text(
                                    data.record.total_morning || '-'
                                ),
                                $(`<td class="vkg-providers__table-body-row-td">`).text(
                                    data.record.total_afternoon || '-'
                                ),
                                $(`<td class="vkg-providers__table-body-row-td">`).text(
                                    data.record.total_night || '-'
                                ),
                            ),
                            $(`<tr class="vkg-providers__table-body-row">`).append(
                                $(`<a class='vkg-providers__form-button vkg-providers__table-button ' href='{{route('hours')}}'>`).text(
                                    'Create hour'
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
                                $(`<a class='vkg-providers__form-button vkg-providers__table-button ' href='{{route('hours')}}'>`).text(
                                    'Create hour'
                                )
                            ),
                        )
                    }
                })
            </script>
        @else
            <form class="vkg-hours__form">
                <h1 class="vkg-hours__form-header">Hours registration</h1>

                <labeL for="vkg-provider__form-email">
                    <span class="vkg-hours__form-email-label">Provider's email</span>
                    <br>
                    <input type="email" name="vkg-provider__form-email"
                           class="vkg-hours__form-email"
                           required
                    />

                    <p id="vkg-email-error" class="vkg-hours__form-error"></p>
                </labeL>

                <labeL for="vkg-provider__form-value">
                    <span class="vkg-hours__form-value-label">Hours (max: 8)</span>
                    <br>
                    <input type="number" name="vkg-provider__form-value"
                           class="vkg-hours__form-value"
                           required
                    />

                    <p id="vkg-value-error" class="vkg-hours__form-error"></p>
                </labeL>

                <labeL for="vkg-provider__form-period">
                    <span class="vkg-hours__form-period-label">Period (Morning, Afternoon, Night)</span>
                    <br>
                    <input type="text" name="vkg-provider__form-period"
                           class="vkg-hours__form-period"
                           required
                    />

                    <p id="vkg-period-error" class="vkg-hours__form-error"></p>
                </labeL>

                <labeL for="vkg-provider__form-date">
                    <span class="vkg-hours__form-date-label">Date</span>
                    <br>
                    <input type="date" name="vkg-provider__form-date"
                           class="vkg-hours__form-date"
                           required
                    />

                    <p id="vkg-date-error" class="vkg-hours__form-error"></p>
                </labeL>

                <button
                    id="vkg-create-button"
                    class="vkg-hours__form-button"
                    onclick="createProvidersHour();return false;"
                >
                    Create
                </button>
                <a
                    class="vkg-hours__form-button"
                    href="{{route('hours', ['t' => 'exports'])}}"
                >
                    View exports
                </a>
            </form>

            <script>
                $.ajax({
                    url: `/api/admin/providers/email`,
                    type: 'GET',
                    success: function (data) {
                        var providers = data.record;
                        $(`input[name="vkg-provider__form-email"]`).autocomplete({
                            source: providers
                        });
                    }
                })
            </script>
        @endif
    </div>
@endsection
@section('script')
    <script>
        var createButton = $(`#vkg-create-button`);

        function createProvidersHour() {
            $(`#vkg-email-error`).text('');
            $(`#vkg-value-error`).text('');
            $(`#vkg-period-error`).text('');
            $(`#vkg-date-error`).text('');
            createButton.text('Loading');

            setTimeout(() => {
                $.ajax({
                    url: `/api/admin/providers/hours`,
                    data: {
                        'email': $(`input[name="vkg-provider__form-email"]`).val(),
                        'value': $(`input[name="vkg-provider__form-value"]`).val(),
                        'period': $(`input[name="vkg-provider__form-period"]`).val().toLowerCase(),
                        'date': $(`input[name="vkg-provider__form-date"]`).val().replaceAll('/', '-'),
                    },
                    type: 'POST',
                    success: function (data) {
                        alert(data.message);
                        $(`input[name="vkg-provider__form-email"]`).val('');
                        $(`input[name="vkg-provider__form-value"]`).val('');
                        $(`input[name="vkg-provider__form-period"]`).val('');
                        $(`input[name="vkg-provider__form-date"]`).val('');
                        createButton.text('Create');
                    },
                    error: function (error) {
                        if (error?.responseJSON?.errors && error.responseJSON.errors.email) {
                            $(`#vkg-email-error`).text(error.responseJSON.errors.email);
                        }

                        if (error?.responseJSON?.errors && error.responseJSON.errors.value) {
                            $(`#vkg-value-error`).text(error.responseJSON.errors.value);
                        }

                        if (error?.responseJSON?.errors && error.responseJSON.errors.period) {
                            $(`#vkg-period-error`).text(error.responseJSON.errors.period);
                        }

                        if (error?.responseJSON?.errors && error.responseJSON.errors.date) {
                            $(`#vkg-date-error`).text(error.responseJSON.errors.date);
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
