@extends('template')
@section('view')
<div class="row">
    <div class="col-12">
        <h1>Pemesan Baru</h1>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="mt-2 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Choose a Packages</h4>
                                        <small>Fit your requiment</small>
                                        <div class="form-group">
                                            <select class="form-select" id="packages">
                                                <option value="null">Please Choose One</option>
                                                @foreach($product as $p)
                                                <option value="{{ $p['pid'] }}">{{ $p['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Choose a Billing Cycle</h4>
                                        <small>Renewal price are same</small>
                                        <div class="form-group">
                                            <select class="form-select" id="pricing">
                                                <option value="null">Please Choose One Packages</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Please Fill your domain for your hosting</h4>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type_domain" id="type_domain1" value="register_new" checked>
                                            <label class="form-check-label" for="type_domain1">
                                                Register New Domains
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type_domain" id="type_domain2" value="have_domain">
                                            <label class="form-check-label" for="type_domain2">
                                                I have a domain
                                            </label>
                                        </div>
                                        <div class="register_domain">
                                            <input class="form-control" name="domain" placeholder="input your new domain">
                                        </div>
                                        <div class="have_domain">
                                            <input class="form-control" name="domain" placeholder="input your new domain">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-dark">
                            <div class="card-body">
                                <h4 class="text-white">Ringkasan Pesanan</h4>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td colspan="2">Detail</td>
                                            <td>1 items</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" id="product_name">Product</td>
                                            <td id="price"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Sub Total</td>
                                            <td id="sub_total"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">PPN @ 11.00%</td>
                                            <td id="ppn"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h3 id="price">Rp. 999.000</h3>
                                <button class="btn btn-warning w-100">Bayar Sekarang</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('script')
    <script>
        let pricing_packages;
        $("#packages").on('change', function() {
            var val = $(this).val();
            let form = new FormData();
            form.append('_token', csrf_token);
            form.append('id', val);
            axios.post("{{url('ajax/get-product')}}", form)
                .then(response => {
                    pricing_packages = `<option value="null">Please Select Billing Cycle</option>`;
                    for (var key in response.data.pricing) {
                        pricing_packages += `<option value="${key}">${response.data.prefix} ${response.data.pricing[key]} ${response.data.suffix}</option>`;
                    }
                    $("#pricing").html(pricing_packages);
                })
                .catch(error => {
                    if (error.response) {
                        let errorList = '';
                        errorList += '<ul style="list-style-type: none;">';
                        $.each(error.response.data.errors, function(key, value) {
                            errorList += '<li>' + value + '</li>';
                        });
                        errorList += '</ul>';
                        setTimeout(function() {
                            swal.fire({
                                title: 'Oops...',
                                icon: 'error',
                                html: errorList,
                                buttonsStyling: false,
                                confirmButtonText: 'Ok lets check',
                                customClass: {
                                    confirmButton: 'btn font-weight-bold btn-danger',
                                },
                            });
                        }, 200);
                    } else if (error.request) {
                        // The request was made but no response was received
                        // console.log(error.request);
                        setTimeout(function() {
                            swal.fire({
                                title: 'Oops...',
                                icon: 'error',
                                text: 'Something went wrong!',
                                buttonsStyling: false,
                                confirmButtonText: 'Ok lets check',
                                customClass: {
                                    confirmButton: 'btn font-weight-bold btn-danger',
                                },
                            });
                        }, 200);
                    } else {
                        // Something happened in setting up the request that triggered an Error
                        console.log('Error', error.message);
                    }
                });
        })
    </script>
    @endsection