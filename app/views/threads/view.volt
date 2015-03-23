<br />

<div class="row">
    <ol class="breadcrumb">
      <li>{{ link_to("", "Home") }}</li>
      <li>{{ link_to("boards/view/"~board.slug, board.name) }}</li>
      <li class="active">{{ thread.title }}</li>
    </ol>
</div>

<div class="row">
    <nav class="pull-left">
        <ul class="pagination">
            {% if page.current > 1 %} 
                <li>{{ link_to("threads/view/"~thread.slug~"?page="~page.before, "« Previous") }}</li>    
            {% else %}
                <li class="disabled"><a href="#">« Previous</a></li>  
            {% endif %}    

            {% for i in max_previous_pages..1 %}
                {% if page.current - i > 0 %}
                    <li>{{link_to("threads/view/"~thread.slug~"?page="~(page.current - i), page.current - i)}}</li>
                {% endif %}
            {% endfor %}

            <li class="active">{{link_to("threads/view/"~thread.slug~"?page="~page.current, page.current)}}</li>

            {% for i in 1..max_next_pages %}
                {% if page.current + i <= page.last %}
                    <li>{{link_to("threads/view/"~thread.slug~"?page="~(page.current + i), page.current + i)}}</li>
                {% endif %}
            {% endfor %} 

            {% if page.current < page.last %}
                <li>{{ link_to("threads/view/"~thread.slug~"?page="~page.next, "Next »") }}</li>   
            {% else %}
                <li class="disabled"><a href="#">Next »</a></li>  
            {% endif %}   
        </ul>
    </nav>

 {% if auth.loggedIn %}
{{ link_to("posts/create?thread="~thread.slug, '<button type="button" class="btn btn-default pull-right">Reply</button>') }}
{% endif %}
</div>

<div class="clearfix"></div>

<div class="row">
    <div class="panel panel-default">
        <table class="table table-striped table-thread">
            {% for post in page.items %}     
                <tr>
                    <td>
                        <div class="user">
                            <b>{{ post.user_display }}</b><br />
                            <small>Posts: {{ post.user_post_count }}</small>
                        </div>
                   </td>
                   <td>
                        <div class="post">
                            {{ post.content }}
                        </div>
                        <i class="pull-right">
                            <small>
                                {{ date('M j, Y \a\t h:i A', strtotime(post.created)) }}
                            </small>
                        </i>
                   </td>
                </tr>
            {% endfor %}
        </table>
    </div>
</div>
