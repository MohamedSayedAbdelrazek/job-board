<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class JobApplicationStatusUpdated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $status;
    protected $jobTitle;


    public function __construct(string $status, string $jobTitle)
    {
        //
        $this->status = $status;
        $this->jobTitle = $jobTitle;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => $this->buildMessage(),
            'status' => $this->status,
            'job_title' => $this->jobTitle,
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->buildMessage(),
            'status' => $this->status,
            'job_title' => $this->jobTitle,
        ];
    }

    protected function buildMessage(): string
    {
        $statusFormatted = $this->formatStatus();
        return "📢 Your application for the position of \"{$this->jobTitle}\" has been {$statusFormatted}.We will contact you soon regarding the next steps.";
    }

    protected function formatStatus(): string
    {
        return match(strtolower($this->status)) {
            'accepted' => 'Accepted ✅',
            'rejected' => 'Rejected ❌',
            default => "{$this->status}"
        };
    }

}
