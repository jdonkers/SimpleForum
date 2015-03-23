<br />
<div class="row">

    <ol class="breadcrumb">
      <li>{{ link_to("", "Home") }}</li>
      <li class="active">{{ link_to("boards/view/"~board.slug, board.name) }}</li>
    </ol>
</div>

{% if auth.loggedIn %}    
    <div class="row">
        {{ link_to("threads/create?board="~board.slug, '<button type="button" class="btn btn-default pull-right">New Thread</button>') }}
    </div>
{% endif %}

<br />

<div class="row">
    <div class="panel panel-default">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Replies</th>
                    <th>Created By</th>
                </tr>
            </thead>

            <tbody>
                {% for thread in threads %}
                    <tr>
                        <td class="thread-link">
                            {{ link_to("threads/view/"~thread.slug, thread.title) }}
                            <br>
                        </td>
                        <td>{{ thread.replies }}</td>
                        <td><small>{{ date('M j, Y \a\t h:i A', strtotime(thread.updated)) }}</small></td>
                    </tr>
                {% endfor %}
            </tbody>
        </table>
    </div>
</div>