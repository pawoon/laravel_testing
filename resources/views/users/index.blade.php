@if (Session::has('message_success'))
<p class="txt-success">{{ Session::get('message_success') }}</p>
@endif

<table border="1" cellpadding="5">
    <tr>
        <th align="left">Name</th>
    </tr>
    @foreach($users as $user)
        <tr>
            <td>
                <a href="{{ route('users.show', $user) }}">{{ $user->name }}</a>
                <a href="{{ route('users.edit', $user) }}" style="float: right">edit</a>
            </td>
        </tr>
    @endforeach
</table>
<a href="{{ route('users.create') }}">+ Add</a>

<style>
    a {
        text-decoration: none;
    }
    .txt-success {
        color: green
    }
</style>