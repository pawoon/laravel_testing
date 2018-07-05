<form action="{{ route('users.store') }}" method="POST">
    {{ csrf_field() }}

    <input name="name" type="text" value="{{ old('name') }}" placeholder="Name"><br>
    {!! ($errors->has('name')) ? '<small>' . $errors->first('name') . '</small>' : '' !!}
    <input name="email" type="text" value="{{ old('email') }}" placeholder="Email"><br>
    {!! ($errors->has('email')) ? '<small>' . $errors->first('email') . '</small>' : '' !!}
    <input name="password" type="password" placeholder="Password"><br>
    {!! ($errors->has('password')) ? '<small>' . $errors->first('password') . '</small>' : '' !!}

    <input type="submit" value="Save">
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