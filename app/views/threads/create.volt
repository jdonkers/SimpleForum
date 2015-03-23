<br />
<div class="row">
    <ol class="breadcrumb">
      <li>{{ link_to("", "Home") }}</li>
      <li>{{ link_to("boards/view/"~board.slug, board.name) }}</li>
      <li class="active">New Thread</li>
    </ol>
</div>

<div class="row">
    <div class="well clearfix">
        {{ form("threads/create?board="~board.slug, "method":"post") }}  

        <div class="form-group form-inline">
          {{ text_field("title", "size" : 300, "placeholder" : "Title", "class" : "form-control", "style" : "width:100%;") }}
        </div>

        <div class="form-group">
          {{ text_area("content", "size" : 2500, "class" : "form-control", "style" : "width:100%;height:200px;") }}
        </div>

        {{ submit_button("Submit", "class" : "btn btn-default pull-right") }}
    </div>
</div>