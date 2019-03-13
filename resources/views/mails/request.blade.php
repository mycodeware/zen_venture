<h2>Match Request</h2>

<ul>
@foreach ($requests as $request)
    <li>
        <h3>
            @switch($request->from_user_all->type)
                @case(App\User::TYPE_INVESTOR)
                    {{ __('Investor: ') }}
                    <a href="{{ route('investors.show', ['investor' => $request->from_investor_all->user_id]) }}">
                        {{ $request->from_investor_all->company_name }}
                    </a>
                    @break
                @case(App\User::TYPE_COMPANY)
                    {{ __('Company: ') }}
                    <a href="{{ route('companies.show', ['company' => $request->from_company_all->user_id]) }}">
                        {{ $request->from_company_all->company_name }}
                    </a>
                    @break
                @case(App\User::TYPE_ENTREPRENEUR)
                    {{ __('Start-up: ') }}
                    <a href="{{ route('startups.show', ['startup' => $request->from_entrepreneur_all->user_id]) }}">
                        {{ $request->from_entrepreneur_all->company_name }}
                    </a>
                    @break
                @case(App\User::TYPE_FREELANCER)
                    {{ __('Professional: ') }}
                    <a href="{{ route('professionals.show', ['professional' => $request->from_freelancer_all->user_id]) }}">
                        @if (!is_null($request->from_freelancer_all->first_name) || !is_null($request->from_freelancer_all->family_name))
                          {{ $request->from_freelancer_all->first_name }} {{ $request->from_freelancer_all->family_name }}
                        @else
                          {{ __('NO NAME') }}
                        @endif
                    </a>
                    @break
            @endswitch
            requested
            @if ($request->is_contact)
                {{ __('"Contact"') }}
            @endif
            @if ($request->is_contact && $request->is_further_information)
                {{ __(' and ') }}
            @endif
            @if ($request->is_further_information)
                {{ __('"Further Information"') }}
            @endif
            {{ __('of') }}
            @switch($request->to_user_all->type)
                @case(App\User::TYPE_INVESTOR)
                    {{ __('Investor: ') }}
                    <a href="{{ route('investors.show', ['investor' => $request->to_investor_all->user_id]) }}">
                        {{ $request->to_investor_all->company_name }}
                    </a>
                    @break
                @case(App\User::TYPE_COMPANY)
                    {{ __('Company: ') }}
                    <a href="{{ route('companies.show', ['company' => $request->to_company_all->user_id]) }}">
                        {{ $request->to_company_all->company_name }}
                    </a>
                    @break
                @case(App\User::TYPE_ENTREPRENEUR)
                    {{ __('Start-up: ') }}
                    <a href="{{ route('startups.show', ['startup' => $request->to_entrepreneur_all->user_id]) }}">
                        {{ $request->to_entrepreneur_all->company_name }}
                    </a>
                    @break
                @case(App\User::TYPE_FREELANCER)
                    {{ __('Professional: ') }}
                    <a href="{{ route('professionals.show', ['professional' => $request->to_freelancer_all->user_id]) }}">
                        @if (!is_null($request->to_freelancer_all->first_name) || !is_null($request->to_freelancer_all->family_name))
                          {{ $request->to_freelancer_all->first_name }}{{ $request->to_freelancer_all->family_name }}
                        @else
                          {{ __('NO NAME') }}
                        @endif
                    </a>
                    @break
            @endswitch
        </h3>
    </li>
@endforeach
</ul>
