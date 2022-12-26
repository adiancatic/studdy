<x-modal.modal center size="lg">
    <x-slot name="header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __("Import calendar") }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </x-slot>

    @if($events)
        <table class="table">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Start</th>
                <th>End</th>
            </tr>
            @foreach($events as $event)
                @php $event = new \App\Models\Event($event) @endphp
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->date_start->format("D, d. m. Y - H:i \\h") }}</td>
                    <td>{{ $event->date_end->format("D, d. m. Y - H:i \\h") }}</td>
                </tr>
            @endforeach
        </table>
    @else
        <form>
            <x-form.drag-drop
                model="ical"
                icon="fad fa-calendar-circle-plus"
                title="Select <code>.ics</code>/<code>.ical</code> file to upload"
                description="or drag and drop it here"
            />
        </form>
    @endif

    <x-slot name="footer">
        <div wire:loading.remove wire:target="commit">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            @if($events)
                <button type="button" wire:click="commit" class="btn btn-primary">Save changes</button>
            @endif
        </div>

        <div wire:loading wire:target="commit">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </x-slot>
</x-modal.modal>
