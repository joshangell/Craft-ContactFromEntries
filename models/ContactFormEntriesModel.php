<?php
namespace Craft;

class ContactFormEntriesModel extends BaseModel
{
	protected function defineAttributes()
	{
		return array(
			'fromName'   => array(AttributeType::String, 'label' => 'From Name'),
			'fromEmail'  => array(AttributeType::Email,  'required' => true, 'label' => 'From Email'),
			'message'    => array(AttributeType::String, 'required' => true, 'label' => 'Message'),
			'subject'    => array(AttributeType::String, 'label' => 'Subject')
		);
	}
}
