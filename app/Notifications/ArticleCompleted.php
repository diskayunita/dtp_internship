<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Auth;

class ArticleCompleted extends Notification
{
  use Queueable;
  
  private $article;
  private $notif;

  public function __construct($article, $notif)
  {
    $this->article = $article;
    $this->notif = $notif;
  }

  public function via($notifiable)
  {
    return ['slack'];
  }

  public function toMail($notifiable)
  {
    return (new MailMessage)
    ->line('The introduction to the notification.')
    ->action('Notification Action', url('/'))
    ->line('Thank you for using our application!');
  }

  public function toArray($notifiable)
  {
    return [
            //
    ];
  }

  public function toSlack($notifiable)
  {
    $article = $this->article;
    $notif = $this->notif;

    return (new SlackMessage)
    ->success()
    ->to(env('SLACK_CHANNEL', '#general'))
    ->content($notif);
  }
}
