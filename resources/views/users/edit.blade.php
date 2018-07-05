<form action="{{ route('users.update', $user) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <input name="name" type="text" value="{{ old('name', $user->name) }}" placeholder="Name"><br>
    {!! ($errors->has('name')) ? '<small>' . $errors->first('name') . '</small>' : '' !!}
    <input name="email" type="text" value="{{ old('email', $user->email) }}" placeholder="Email"><br>
    {!! ($errors->has('email')) ? '<small>' . $errors->first('email') . '</small>' : '' !!}
    <input name="password" type="password" placeholder="Password"><br>
    {!! ($errors->has('password')) ? '<small>' . $errors->first('password') . '</small>' : '' !!}

    <input type="submit" value="Update">
    <input type="button" value="Delete" onclick="document.getElementById('delete').submit()">
</form>

<form id="delete" action="{{ route('users.destroy', $user) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>

<style>
    input {
        margin-bottom: 5px;
    }
    small {
        color: red;
        display: block;
    }
</style>