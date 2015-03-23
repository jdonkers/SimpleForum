<div class="row clearfix">
    <h2 class="pull-left">My Message Board</h2>
    <span class="pull-right">
        <br>
        {% if auth.loggedIn %}
            Logged in as {{auth.user.display}} | {{ link_to("login/logout", 'Logout') }}
        {% else %}
            {{ link_to("login", '<button type="button" class="btn btn-primary pull-right">Login</button>') }}
        {% endif %}
    </span>
</div>
<br/>
<div class="row">
    <div class="panel panel-default">
        <table class="table table-board">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Threads</th>
                    <th>Posts</th>
                </tr>
            </thead>
            <tbody>
                {% for board in boards %}
                    <tr>
                        <td>
                            <h4>
                                {{ link_to("boards/view/"~board.slug, board.name) }}
                                <br />
                                <small>
                                    {{ board.description }}
                                </small>
                            </h4>
                        </td>
                        <td>
                            {{ board.thread_count }}
                        </td>
                        <td>
                            {{ board.post_count }}
                        </td>
                    </tr>
                {% endfor %}
            </tbody>
        </table>
    </div>
</div>