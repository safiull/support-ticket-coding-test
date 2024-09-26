@if($reply->type)
    <div class="ticket-content right mt-3">
        <p class="incoming-message">{{ $reply->comment }}</p>
        <small class="d-block"><span class="text-dark">{{ $reply->sender->name  }}</span> <span class="text-primary">{{ formatted_date($reply->created_at, 'd M, Y h:i A') }}</span></small>
    </div>
@else
    <div class="ticket-content mt-3">
        <p class="my-message">{{ $reply->comment }}</p>
        <small class="d-block"><span class="text-dark">{{ $reply->sender->name  }}</span> <span class="text-primary">{{ formatted_date($reply->created_at, 'd M, Y h:i A') }}</span></small>
    </div>
@endif
