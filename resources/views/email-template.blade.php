<div class="container" style="padding: 1rem; background: #f5f5f5;">
    <p style="font-size: 26px; font-weight: bold;">Congratulations, dear <b>{{ $data['name'] }}</b></p>
    <p style="font-size: 18px;">
        You have successfully registered in <b> {{ $data['program']->title }}</b>. Your email address is <b>{{ $data['email'] }}</b> and phone number is <b>{{ $data['phone'] }}</b>.
    </p>
</div>