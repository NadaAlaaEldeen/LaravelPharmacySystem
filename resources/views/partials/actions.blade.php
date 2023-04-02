<div class="btn-group btn-group-toggle gap-2" data-toggle="buttons">
<a href="#" class="btn btn-primary">View</a> 
<a href="#" class="btn btn-success">Edit</a>
<form method="post" class="delete_item me-2"  id="option_a3" action="#">
        @csrf
        @method("DELETE")
        <button type="submit" class="btn btn-danger rounded delete-area" onclick="deletemodalShow(event)" id="delete" data-bs-toggle="modal" data-bs-target="#del-model">delete</button>
</form>
</div>