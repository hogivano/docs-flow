<section>
    <form method="post" action="{{ route('process.change-order') }}" id="form-order">
        {{ csrf_field() }}
        <ul id="sortable" class="list-group mb-4">
            @foreach($data as $key => $process)
                <li class="list-group-item border-0 p-4 mb-2 bg-gray-100 border-radius-lg cursor-pointer">
                    {{ $process->title }}
                    <input type="text" name="process_id[]" value="{{ $process->id }}" hidden>
                </li>
            @endforeach
        </ul>
        <div class="text-right">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn bg-gradient-primary" form="form-order">Save changes</button>
        </div>
    </form>
    @push('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $( "#sortable" ).sortable();
            $( "#sortable" ).disableSelection();
        } );
    </script>
    @endpush
</section>
