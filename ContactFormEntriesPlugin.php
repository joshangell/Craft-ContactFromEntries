<?php
namespace Craft;

class ContactFormEntriesPlugin extends BasePlugin
{
  function getName()
  {
    return Craft::t('Contact Form Entries');
  }

  function getVersion()
  {
    return '0.1';
  }

  function getDeveloper()
  {
    return 'Josh Angell';
  }

  function getDeveloperUrl()
  {
    return 'http://joshangell.co.uk';
  }

  protected function defineSettings()
  {
    return array(
      'section'      => array(AttributeType::Number, 'required' => true)
    );
  }

  public function getSettingsHtml()
  {
    return craft()->templates->render('contactformentries/_settings', array(
      'settings' => $this->getSettings()
    ));
  }

  public function init()
  {
    craft()->on('contactForm.beforeSend', function(ContactFormEvent $event) {

      $message = $event->params['message'];

      $messageEntry = new ContactFormEntriesModel();

      $messageEntry->fromEmail = $message->fromEmail;
      $messageEntry->fromName  = $message->fromName;
      $messageEntry->subject   = $message->subject;
      $messageEntry->message   = $message->message;

      craft()->contactFormEntries->saveMessageEntry($messageEntry);
    });
  }
}
