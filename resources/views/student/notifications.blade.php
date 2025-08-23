@extends('layouts.layout')
@section('title','Notifications')

@section('content')
<div class="min-h-screen bg-gray-100 p-6 max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Notifications</h1>

    <div class="bg-white rounded-xl shadow">
        <div class="divide-y">
            @forelse($notifications as $n)
                <div class="p-4 flex items-start justify-between {{ is_null($n->read_at) ? 'bg-red-50' : '' }}">
                    <div>
                        <div class="font-semibold">
                            Promissory Note {{ data_get($n->data,'decision') === 'approved' ? 'Approved' : 'Rejected' }}
                        </div>
                        <div class="text-sm text-gray-600">
                            PN ID: {{ data_get($n->data,'pn_id') }} • Status: {{ data_get($n->data,'status') }}
                        </div>
                        @if(data_get($n->data,'reason'))
                            <div class="text-sm mt-1">Reason: {{ data_get($n->data,'reason') }}</div>
                        @endif
                        <div class="text-xs text-gray-500 mt-1">
                            {{ $n->created_at->format('Y-m-d H:i') }}
                        </div>
                    </div>
                    @if(is_null($n->read_at))
                    <form method="POST" action="{{ route('student.notifications.read', $n->id) }}">
                        @csrf
                        <button class="text-white bg-[#660809] hover:bg-black px-3 py-1 rounded-lg text-sm">
                            Mark as read
                        </button>
                    </form>
                    @endif
                </div>
            @empty
                <div class="p-6 text-center text-gray-500">No notifications.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
