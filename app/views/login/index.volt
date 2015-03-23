<br />
<div class="row">
    <ol class="breadcrumb">
      <li>{{ link_to("", "Home") }}</li>
      <li class="active">Login</li>
    </ol>
</div>

<br />

<div class="row">
    <div class="well clearfix login-container">
        {{ form("login/auth", "method":"post") }}  

        <div class="form-group">
          {{ text_field("login", "size" : 50, "placeholder" : "Username", "class" : "form-control") }}
        </div>

        <div class="form-group">
            {{ password_field("password", "size" : 50, "placeholder" : "Password", "class" : "form-control") }}
        </div>

        {{ submit_button("Login", "class" : "btn btn-default pull-right") }}
    </div>
</div>