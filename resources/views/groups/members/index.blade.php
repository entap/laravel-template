@extends('layouts.ladybird')

@section('content')
    <p>{{ $group->name }}</p>

    <div class="text-right">
        <a href="{{ route('groups.members.create', $group) }}" class="btn btn-primary text-nowrap">
            @lang('Invite')
        </a>
    </div>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>@lang('Name')</th>
                <th>@lang('E-mail')</th>
                <th>@lang('Role')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>
                        @if (auth()->user()->id != $member->user_id)
                            <div class="dropdown">
                                <button class="btn btn-sm btn-link dropdown-toggle" type="button"
                                    id="dropdownRoleSwitch-{{ $member->id }}" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    {{ $member->roles->pluck('name')->join(', ') }}
                                </button>

                                <div class="dropdown-menu">
                                    @foreach ($roleOptions->diff($member->roles->pluck('name')) as $role)
                                        <form action="{{ route('groups.members.roles.update', [$group, $member]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="role" value="{{ $role }}">

                                            <button type="submit" class="btn btn-link text-nowrap">
                                                {{ $role }}
                                            </button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <button class="btn btn-sm btn-link" type="button" disabled>
                                {{ $member->roles->pluck('name')->join(', ') }}
                            </button>
                        @endif
                    </td>
                    <td>
                        @if (auth()->user()->id != $member->user_id)
                            <form action="{{ route('groups.members.destroy', [$group, $member]) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger text-nowrap"
                                    onclick="return confirm('@lang('Are you sure you want to delete?')')">
                                    @lang('Delete')
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
