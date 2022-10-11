<div class="modal newsletter-wrap fade" id="emiModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-primary">
                    Banks Under Online EMI and it's Charges:
                </button>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="las la-times"></i>
                </button>
            </div>
            <div class="modal-body">

                <div class="d-flex align-items-start justify-content-around">
                    <div style="height: 400px; overflow-y: scroll;">
                        <ul class="nav flex-column nav-tabs tabs">
                            @foreach ($product_emi as $bank_index => $bank_data)
                                <li class="nav-item">
                                    <a href="#{{ $bank_data->bank_short_name }}" data-toggle="tab"
                                        class="nav-link @if ($bank_index == 0) active @endif">
                                        {{ $bank_data->bank_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="tab-content" style="height: 400px; overflow-y: scroll;">
                        @foreach ($product_emi as $bank_index => $bank_data)
                            <div id="{{ $bank_data->bank_short_name }}"
                                class="tab-pane @if ($bank_index == 0) active @endif">
                                <table class="table table-striped">
                                    <thead class="btn-primary">
                                        <tr>
                                            <th scope="col">Months</th>
                                            <th scope="col">Monthly EMI</th>
                                            <th scope="col">Overall Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bank_data->emis as $emi_data)
                                            <tr>
                                                <td>{{ $emi_data->months }}</td>
                                                <td>
                                                    {{ number_format($emi_data->overall_cost / $emi_data->months, 2) }}৳
                                                    ({{ $emi_data->percentage }}%)
                                                </td>
                                                <td>{{ number_format($emi_data->overall_cost) }}৳</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <p>More Details About Trusttech Online EMI Facility.</p> --}}
            </div>
        </div>
    </div>
</div>
