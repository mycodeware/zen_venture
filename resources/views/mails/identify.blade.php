<h2>Identify Request</h2>

<ul>
@foreach ($users as $user)
    <li>
        <h3>
            @switch($user->type)
                @case(App\User::TYPE_INVESTOR)
                    <a href="{{ route('investors.show', ['investor' => $user->investor->user_id]) }}">
                        {{ $user->investor->first_name }} {{ $user->investor->family_name }}
                    </a>
                    @break
                @case(App\User::TYPE_COMPANY)
                    <a href="{{ route('companies.show', ['company' => $user->company->user_id]) }}">
                        {{ $user->company->first_name }} {{ $user->company->family_name }}
                    </a>
                    @break
                @case(App\User::TYPE_ENTREPRENEUR)
                    <a href="{{ route('startups.show', ['startup' => $user->entrepreneur->user_id]) }}">
                        {{ $user->entrepreneur->first_name }} {{ $user->entrepreneur->family_name }}
                    </a>
                    @break
                @case(App\User::TYPE_FREELANCER)
                    <a href="{{ route('professionals.show', ['professional' => $user->freelancer->user_id]) }}">
                        {{ $user->freelancer->first_name }} {{ $user->freelancer->family_name }}
                    </a>
                    @break
            @endswitch
            requested to Identify Identity Proof Document
            @switch($user->type)
                @case(App\User::TYPE_INVESTOR)
                    <a href="{{ route('investors.identity', ['filename' => $user->investor->identity_filename]) }}">
                        {{ $user->investor->identity_filename }}
                    </a>
                    @break
                @case(App\User::TYPE_COMPANY)
                    <a href="{{ route('companies.identity', ['filename' => $user->company->identity_filename]) }}">
                        {{ $user->company->identity_filename }}
                    </a>
                    @break
                @case(App\User::TYPE_ENTREPRENEUR)
                    <a href="{{ route('startups.identity', ['filename' => $user->entrepreneur->identity_filename]) }}">
                        {{ $user->entrepreneur->identity_filename }}
                    </a>
                    @break
                @case(App\User::TYPE_FREELANCER)
                    <a href="{{ route('professionals.identity', ['filename' => $user->freelancer->identity_filename]) }}">
                        {{ $user->freelancer->identity_filename }}
                    </a>
                    @break
            @endswitch
            .
        </h3>
    </li>
@endforeach
</ul>
