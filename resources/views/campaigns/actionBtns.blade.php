<div class="mt-2 btn-group" data-id={{$id}} role="group" aria-label="Basic outlined example">
    <a href="{{route('campaign.show',$id)}}" class="px-3 btn btn-sm bg-gradient-primary"
        type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="show details">
        <i class="fa fa-eye"></i>
    </a> 
    <button class="px-3 btn btn-sm bg-gradient-info campaignEditBtn"
        type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit item">
        <i class="fa fa-pen"></i>
    </button>
    <button class="px-3 btn btn-sm bg-gradient-danger campaignDeleteBtn"
        type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove item">
        <i class="fa fa-trash"></i>
    </button>
</div>