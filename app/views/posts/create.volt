<br />
<div class="row">
    <ol class="breadcrumb">
      <li>{{ link_to("", "Home") }}</li>
      <li>{{ link_to("boards/view/"~board.slug, board.name) }}</li>
      <li>{{ link_to("threads/view/"~thread.slug, thread.title) }}</li>
      <li class="active">Reply</li>
    </ol>
</div>

<div class="row">
    <div class="well clearfix">
        {{ form("posts/create?thread="~thread.slug, "method":"post") }}
        {{ text_area("content", "size" : 2500, "style" : "width:100%;height:200px;") }}
        {{ submit_button("Submit", "class" : "btn btn-default pull-right") }}
    </div>
</div>