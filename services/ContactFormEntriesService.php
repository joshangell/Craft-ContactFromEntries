<?php
namespace Craft;

/**
 * Contact Form Entries service
 */
class ContactFormEntriesService extends BaseApplicationComponent
{
  /**
   * Saves an email to the channel specified in the settings.
   *
   * @paraam ContactFormModel $message
   * @return bool
   */
  public function saveMessageEntry(ContactFormEntriesModel $message)
  {
    $plugin   = craft()->plugins->getPlugin('contactFormEntries');
    $settings = $plugin->getSettings();

    $entry = new EntryModel();
    $entry->sectionId  = $settings['section'];
    $entry->enabled    = true;

    // populate fields
    $entry->getContent()->setAttributes(array(
      'title'     => $message->subject,
      'body'      => $message->message,
      'fromName'  => $message->fromName,
      'fromEmail' => $message->fromEmail
    ));

    // save entry to db
    $success = craft()->entries->saveEntry($entry);
  }
}
