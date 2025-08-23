<?php

namespace App\Notifications;

use App\Models\PromissoryNote;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PromissoryNoteEvaluated extends Notification
{
    use Queueable;

    public function __construct(
        public PromissoryNote $note,
        public string $decision,        // 'approved' | 'rejected'
        public ?string $reason = null
    ) {}

    public function via($notifiable): array
    {
        return ['database']; // stored in notifications table
    }

    public function toDatabase($notifiable): array
    {
        return [
            'pn_id'       => $this->note->pn_id,
            'student_id'  => $this->note->student_id,
            'amount'      => (float)($this->note->amount ?? 0),
            'decision'    => $this->decision,
            'reason'      => $this->reason,
            'status'      => $this->note->status,
            'occurred_at' => now()->toIso8601String(),
        ];
    }
}
