@props(['data'])

<div class="col-sm-12 col-md-7">
    <div class="dataTables_paginate paging_simple_numbers float-right">
        {!!  $data->appends(request()->except(['_token']))->links('pagination::bootstrap-4') !!}
    </div>
</div>
