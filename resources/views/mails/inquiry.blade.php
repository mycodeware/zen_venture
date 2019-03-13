<h2>{{ __('Inquiry from Contact Us') }}</h2>

<dl>
    <dt><strong>{{ __('Company Name') }}</strong></dt>
    <dd>{{ $request->company_name }}</dd>
    <dt><strong>{{ __('Department / Section') }}</strong></dt>
    <dd>{{ $request->department_section }}</dd>
    <dt><strong>{{ __('Job Title') }}</strong></dt>
    <dd>{{ $request->job_title }}</dd>
    <dt><strong>{{ __('Name') }}</strong></dt>
    <dd>{{ $request->first_name }}&nbsp;{{ $request->family_name }}</dd>
    <dt><strong>{{ __('E-mail') }}</strong></dt>
    <dd>{{ $request->email }}</dd>
    <dt><strong>{{ __('Phone Number') }}</strong></dt>
    <dd>{{ $request->phone_number }}</dd>
    <dt><strong>{{ __('Inquiry') }}</strong></dt>
    <dd>{!! nl2br(e($request->inquiry)) !!}</dd>
</dl>
