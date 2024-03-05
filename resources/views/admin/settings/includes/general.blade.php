<div class="tile">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">General Settings</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="site_name">Site Name</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Enter site name"
                    id="site_name"
                    name="site_name"
                    value="{{ config('settings.site_name') }}"
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="site_title">Site Title</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Enter site title"
                    id="site_title"
                    name="site_title"
                    value="{{ config('settings.site_title') }}"
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="default_email_address">Default Email Address</label>
                <input
                    class="form-control"
                    type="email"
                    placeholder="Enter store default email address"
                    id="default_email_address"
                    name="default_email_address"
                    value="{{ config('settings.default_email_address') }}"
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="inquery_mail">Inquery Email Address</label>
                <input
                    class="form-control"
                    type="email"
                    placeholder="Enter store default email address"
                    id="inquery_mail"
                    name="inquery_mail"
                    value="{{ config('settings.inquery_mail') }}"
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="cod_fees">Cash On delevery Fees</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Enter Cash On delevery Fees"
                    id="cod_fees"
                    name="cod_fees"
                    value="{{ config('settings.cod_fees') }}"
                />
            </div>
          
			
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Settings</button>
                </div>
            </div>
        </div>
    </form>
</div>
